<?php
class ProductModel extends BaseModel
{

    use SweetAlert;
    private $idUser;

    public function tableName()
    {
        return 'product';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }

    function getProdRecently()
    {
        return $this->db->table($this->tableName())->select('id, title, slug , thumb, price, totalRatings, quantity, discount, totalUserRatings')->where('status', '=', 1)->orderBy('id')->limit(12)->get();
    }

    function getProdByCateNft()
    {
        return $this->db->table($this->tableName())->select('id, title, cate_id, thumb, price')->where('cate_id', '=', 31)->limit(8)->get();
    }

    function getProdMostSold()
    {
        return $this->db->table($this->tableName())->select('id, title, slug , thumb, price, totalRatings, quantity, discount, totalUserRatings ')->where('status', '=', 1)->orderBy('sold')->limit(10)->get();
    }

    function getOneProd($id)
    {
        return $this->db->findById($this->tableName(), $this->tableField(),  $id);
    }

    function getAllProdImages($id)
    {
        return $this->db->table('images_product')->where('prod_id', '=', $id)->get();
    }

    function getImageProd($id)
    {
        return $this->db->table('images_product')->where('prod_id', '=', $id)->get();
    }
    function getVariantProd($id)
    {

        $sql = "SELECT attr.name,  attr.value
            FROM product_attribute attrPro
            JOIN attribute attr ON attrPro.attribute_id = attr.id
            WHERE attrPro.prod_id = $id";
        $stmt = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }

    function countProduct()
    {
        $data = $this->db->table($this->tableName())->select('COUNT(*) AS countProduct')->getOne();
        return $data;
    }

    function getAllProduct()
    {
        $data = $this->db->table($this->tableName())->orderBy('id')->get();
        return $data;
    }

    function getAllProductOrderBySold()
    {
        $data = $this->db->table($this->tableName())->select('thumb, title, create_At, price, sold, quantity')->orderBy('sold')->limit(4)->get();
        return $data;
    }

    function addNewProduct($data)
    {
        $success = $this->db->create($this->tableName(), $data);
        if ($success) {
            return $this->db->lastInsertId();
        }
        return null;
    }

    function updateProduct($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }

    function deleteImageProduct($id)
    {
        return $this->db->findIdAndDelete('images_product', $id);
    }
    function deleteProductVariant($id)
    {
        $delProductVariant = $this->db->findIdAndDelete('product_variants', $id);
        $delProductVariantValue = $this->db->findAndDelete('variants_value', ['product_variant_id' => $id]);

        if ($delProductVariant && $delProductVariantValue) {
            return true;
        }
        return false;
    }

    function getAllProdVariants($id)
    {
        $sql = "SELECT pv.id, pv.price, pv.quantity, pv.discount, p.title, a.id AS attribute_id, a.display_name, av.value_name AS attribute_value
        FROM product_variants pv
        JOIN variants_value vv ON pv.id = vv.product_variant_id
        JOIN attribute a ON vv.attribute_id = a.id
        JOIN attribute_value av ON vv.attribute_value_id = av.id
        JOIN product p ON pv.prod_id = p.id
        WHERE pv.prod_id = $id ORDER BY pv.id ASC
        ";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    function getOneProdVariant($variantId)
    {
        return $this->db->findById('product_variants', '*', $variantId);
    }

    function deleteProduct($id)
    {
        $deleteProd = $this->db->findIdAndDelete($this->tableName(), $id);
        $dataProdVariants = $this->db->table('product_variants')->select('id')->where('prod_id', '=', $id)->get();

        $deleteProdVariant = $this->db->findAndDelete('product_variants', ['prod_id' => $id]);
        $deleteProdImages = $this->db->findAndDelete('images_product', ['prod_id' => $id]);

        if (!empty($dataProdVariants)) {
            foreach ($dataProdVariants as $item) {
                $deleteProdVariantValue = $this->db->findAndDelete('variants_value', ['product_variant_id' => $item['id']]);
                if (!$deleteProdVariantValue) {
                    return false;
                }
            }
        }

        if (!$deleteProd || !$deleteProdVariant || !$deleteProdImages) {
            return false;
        }

        return true;
    }




    function getAllRatingsProd()
    {
        return $this->db->table('ratings r')->select('r.id, r.star, r.comment, u.fullname, p.title ')->join('user u', 'r.user_id = u.id')->join('product p', 'r.prod_id = p.id')->get();
    }

    function deleteRatingsProd($id)
    {
        return $this->db->findIdAndDelete('ratings', $id);
    }

    // function addRatingProd()
    // {
    //     $rs = ViewShare::$dataShare;
    //     if (empty($rs)) {
    //         return json_encode('Failed');
    //     }

    //     $this->idUser = $rs['dataUser']['payload']['user_id'];

    //     $star = $_POST['star'] ?? '';
    //     $prod_id = $_POST['id'] ?? null;
    //     $comment = $_POST['comment'];
    //     if (empty($comment)) {
    //         $comment = 'Người dùng không để lại cảm nghĩ.';
    //     }
    //     $update_at = date('Y-m-d H:i:s');

    //     if (empty($star)) {
    //         return json_encode(['error' => 'Vui lòng chọn số sao.']);
    //     }

    //     try {
    //         // check If user had ratings 
    //         $sql = 'SELECT * FROM ratings WHERE prod_id = ? AND user_id = ?';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([$prod_id, $this->idUser]);
    //         $dataRatings = $stmt->fetch(PDO::FETCH_ASSOC);

    //         $dataInsertAndUpdate = [
    //             'user_id' => $this->idUser,
    //             'prod_id' => $prod_id,
    //             'star' => $star,
    //             'comment' => $comment,
    //             'update_at' => $update_at
    //         ];

    //         // add new rating if not has or upate 
    //         if (empty($dataRatings)) {
    //             $this->create('ratings', $dataInsertAndUpdate);
    //         } else {
    //             $this->findByNameAndUpdate('ratings', $dataInsertAndUpdate, 'id = ' . $dataRatings['id']);
    //         }

    //         $dataRatingAll = $this->findByName('ratings', $prod_id, 'prod_id');


    //         $totalRatings = 0;
    //         foreach ($dataRatingAll as $dataRatingItem) {
    //             $totalRatings += $dataRatingItem['star'];
    //         }


    //         $dataUpdateProd = [
    //             'totalUserRatings' => count($dataRatingAll),
    //             'totalRatings' => count($dataRatingAll) > 0 ? round($totalRatings / count($dataRatingAll), 2) : $star,
    //             'update_at' => $update_at
    //         ];

    //         $this->findByNameAndUpdate('product', $dataUpdateProd, 'id = ' . $prod_id);

    //         if (empty($dataRatings)) {
    //             return json_encode(['success' => 'Thêm đánh giá thành công.']);
    //         } else {
    //             return json_encode(['success' => 'Cập nhật đánh giá thành công.']);
    //         }
    //     } catch (PDOException $e) {
    //         return json_encode(['error' => 'Thêm đánh giá thất bại.']);
    //     }
    // }
}
