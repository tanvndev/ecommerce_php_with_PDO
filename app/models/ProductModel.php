<?php
class ProductModel extends DB
{
    use CRUD;
    use SweetAlert;
    private $idUser;
    function getProdRecently()
    {
        return $this->findByNameOrderBy('product', 1, 'status', 8, ' id DESC');
    }
    function getAttributeProd($name)
    {
        return $this->findByName('attribute', $name, 'name');
    }

    function getAllProduct($params)
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $sql = "SELECT p.*
                        FROM product p
                        LEFT JOIN product_attribute pa ON p.id = pa.prod_id
                        LEFT JOIN attribute a ON pa.attribute_id = a.id
                        WHERE p.status = 1";

                if (!empty($_POST['cate_id'])) {
                    $sql .= " AND p.cate_id = " . intval($_POST['cate_id']);
                }

                if (!empty($_POST['color'])) {
                    $colors = $_POST['color'];
                    $sql .= " AND (a.name = 'color' AND a.value IN ('$colors')) ";
                }

                if (!empty($_POST['size'])) {
                    $condition = 'AND';
                    if (!empty($_POST['color'])) {
                        $condition = 'OR';
                    }
                    $sql .= " $condition (a.name = 'size' AND a.value = '" . $_POST['size'] . "') ";
                }

                if (!empty($_POST['price'])) {
                    $price = explode(" - ", $_POST['price']);
                    if (count($price) == 2) {
                        $priceStart = intval($price[0]);
                        $priceEnd = intval($price[1]);
                        $sql .= " AND (p.price BETWEEN $priceStart AND $priceEnd) ";
                    }
                }

                $sql .= " GROUP BY p.id";

                if (!empty($_POST['order'])) {
                    $orderBy = explode(" - ", $_POST['order']);
                    if (count($orderBy) == 2) {
                        $name = $orderBy[0];
                        $order = $orderBy[1];
                        $sql .= " ORDER BY $name $order ";
                    }
                }

                if (!empty($_POST['limit'])) {
                    $limitCurrent = Session::get('limitProd');
                    $limitPage =  $limitCurrent + $_POST['limit'];
                    $sql .= " LIMIT " . $limitPage;
                    Session::set('limitProd', $limitPage);
                } else {
                    $sql .= " LIMIT 12";
                    Session::set('limitProd', 12);
                }
                // var_dump($sql);
                $stmt = $this->conn->query($sql);
                $dataProd = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($dataProd);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        if (!empty($params) && $params != 'null' && intval($params) != 0) {
            Session::set('limitProd', 12);
            return json_encode($this->findByName('product', $params, 'cate_id', 12));
        }

        if (!empty($params) && $params != 'null' && $params) {
            try {
                $sql = "SELECT * FROM product WHERE title LIKE '%$params%' AND status = 1";
                $stmt = $this->conn->query($sql);
                $dataProd = $stmt->fetchAll(PDO::FETCH_ASSOC);
                Session::set('limitProd', 12);
                return json_encode($dataProd);
            } catch (\Throwable $th) {
                return json_encode([]);
            }
        }

        Session::set('limitProd', 12);
        return json_encode($this->find('product'));
    }


    function getOneProd($id)
    {
        return $this->findById('product', $id);
    }
    function getImageProd($id)
    {
        return $this->findByName('images_product', $id, 'prod_id');
    }
    function getVariantProd($id)
    {
        try {
            $sql = "SELECT attr.name,  attr.value
            FROM product_attribute attrPro
            JOIN attribute attr ON attrPro.attribute_id = attr.id
            WHERE attrPro.prod_id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $dataVariant = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $dataVariant;
        } catch (PDOException $e) {
            return [];
        }
    }
    function getProdByCateNft()
    {
        return $this->findProductsByCategory(31, 4);
    }
    function getProdMostSold()
    {
        return $this->find('product', 'sold', 'DESC', 8);
    }

    function getAllRatings($id)
    {
        try {
            $sql = "SELECT r.star, r.comment, r.create_at , u.avatar, u.fullname
            FROM ratings r
            JOIN user u ON r.user_id = u.id
            WHERE r.prod_id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $dataRatings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($dataRatings);
        } catch (PDOException $e) {
            echo '<pre>';
            print_r($e);
            echo '</pre>';
            return json_encode([]);
        }
    }

    function addRatingProd()
    {
        $rs = ViewShare::$dataShare;
        if (empty($rs)) {
            return json_encode('Failed');
        }

        $this->idUser = $rs['dataUser']['payload']['user_id'];

        $star = $_POST['star'] ?? '';
        $prod_id = $_POST['id'] ?? null;
        $comment = $_POST['comment'];
        if (empty($comment)) {
            $comment = 'Người dùng không để lại cảm nghĩ.';
        }
        $update_at = date('Y-m-d H:i:s');

        if (empty($star)) {
            return json_encode(['error' => 'Vui lòng chọn số sao.']);
        }

        try {
            // check If user had ratings 
            $sql = 'SELECT * FROM ratings WHERE prod_id = ? AND user_id = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$prod_id, $this->idUser]);
            $dataRatings = $stmt->fetch(PDO::FETCH_ASSOC);

            $dataInsertAndUpdate = [
                'user_id' => $this->idUser,
                'prod_id' => $prod_id,
                'star' => $star,
                'comment' => $comment,
                'update_at' => $update_at
            ];

            // add new rating if not has or upate 
            if (empty($dataRatings)) {
                $this->create('ratings', $dataInsertAndUpdate);
            } else {
                $this->findByNameAndUpdate('ratings', $dataInsertAndUpdate, 'id = ' . $dataRatings['id']);
            }

            $dataRatingAll = $this->findByName('ratings', $prod_id, 'prod_id');


            $totalRatings = 0;
            foreach ($dataRatingAll as $dataRatingItem) {
                $totalRatings += $dataRatingItem['star'];
            }


            $dataUpdateProd = [
                'totalUserRatings' => count($dataRatingAll),
                'totalRatings' => count($dataRatingAll) > 0 ? round($totalRatings / count($dataRatingAll), 2) : $star,
                'update_at' => $update_at
            ];

            $this->findByNameAndUpdate('product', $dataUpdateProd, 'id = ' . $prod_id);

            if (empty($dataRatings)) {
                return json_encode(['success' => 'Thêm đánh giá thành công.']);
            } else {
                return json_encode(['success' => 'Cập nhật đánh giá thành công.']);
            }
        } catch (PDOException $e) {
            return json_encode(['error' => 'Thêm đánh giá thất bại.']);
        }
    }
}
