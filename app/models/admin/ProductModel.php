<?php
class ProductModel extends DB
{
    use CRUD;
    use SweetAlert;
    function getAllProduct()
    {
        return $this->find('product');
    }

    function countProduct()
    {
        return $this->countColumn('product');
    }

    function getOneProduct($id)
    {
        return $this->findById('product', $id);
    }

    function getAllProductOrderBySold()
    {
        return $this->find('product', 'sold', null,  4);
    }

    function getProdForCateChart()
    {
        try {
            $sql = 'SELECT c.id, c.name AS category_name, COUNT(p.id) AS product_count
            FROM category c
            LEFT JOIN product p ON c.id = p.cate_id
            GROUP BY c.id, c.name';

            $stmt = $this->conn->query($sql);
            $product_count = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($product_count);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    function addNewProduct()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'] ?? '';
            $slug = Format::createSlug($title);
            $cate_id = $_POST['cate_id'] ?? '';
            $brand_id = $_POST['brand_id'] ?? '';
            $weight = $_POST['weight'] ?? 0;
            $images = $_FILES['images'] ?? [];
            $description = $_POST['description'] ?? '';

            $quantity = $_POST['quantity'] ?? '';
            $price = $_POST['price'] ?? '';
            $discount = $_POST['discount'] ?? 0;
            $status = $_POST['status'] ?? 0;
            $attribute_id = $_POST['attribute_id'] ?? [];

            $thumb = $_FILES['thumb'] ?? '';

            if (empty($title) || empty($cate_id) || empty($brand_id) || empty($images['name']) || empty($thumb['name']) || empty($price)) {
                $this->Toast('error', 'Vui lòng không để trống.');
                return;
            }



            // image thumb
            $thumbName = $this->uploadSingleImage($thumb, 'product/thumb');
            if ($thumbName) {
                try {
                    $sql = 'INSERT INTO product (title, cate_id, brand_id, slug, weight, thumb, description, quantity, price, discount, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([
                        $title, $cate_id, $brand_id, $slug, $weight, $thumbName, $description, $quantity, $price, $discount, $status
                    ]);
                    $prodId = $this->conn->lastInsertId();

                    //upload variant 

                    if (!empty($attribute_id)) {
                        $sql = 'INSERT INTO product_attribute (prod_id, attribute_id) VALUES (?, ?)';
                        $stmt = $this->conn->prepare($sql);
                        foreach ($attribute_id as $attr) {
                            $stmt->execute([$prodId, $attr]);
                        }
                    }


                    $uploadedFiles = [];

                    foreach ($images['name'] as $key => $name) {
                        $tmp_name = $images['tmp_name'][$key];
                        $type = $images['type'][$key];
                        $size = $images['size'][$key];
                        $maxFileSize = 8000000;
                        $allowTypes = array('image/jpg', 'image/png', 'image/jpeg', 'image/webp');
                        $targetDir = "public/images/product/";
                        $targetFile = $targetDir . basename($name);

                        if (file_exists($targetFile)) {
                            $this->Toast('error', 'File has existed.');
                            return false;
                        } elseif ($size > $maxFileSize) {
                            $this->Toast('error', 'File size exceeds the maximum limit.');
                            return false;
                        } elseif (!in_array($type, $allowTypes)) {
                            $this->Toast('error', 'Invalid file type.');
                            return false;
                        } elseif (!move_uploaded_file($tmp_name, $targetFile)) {
                            $this->Toast('error', 'Failed to upload the file.');
                            return false;
                        } else {
                            $uploadedFiles[] = $name;
                        }
                    }

                    if (empty($uploadedFiles)) {
                        $this->Toast('error', 'Failed to upload the file.');
                        return false;
                    }

                    $sql = 'INSERT INTO images_product (image, prod_id) VALUES (?,?)';
                    $stmt = $this->conn->prepare($sql);
                    foreach ($uploadedFiles as $file) {
                        $stmt->execute([$file, $prodId]);
                    }

                    $this->Toast('success', 'Add new product success.', 'admin/product', 1000);
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        }
    }

    function updateProduct($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $title = $_POST['title'] ?? '';
                $slug = Format::createSlug($title);
                $cate_id = $_POST['cate_id'] ?? '';
                $brand_id = $_POST['brand_id'] ?? '';
                $weight = $_POST['weight'] ?? 0;
                $images = $_FILES['images'] ?? [];
                $description = $_POST['description'] ?? '';

                $quantity = $_POST['quantity'] ?? '';
                $price = $_POST['price'] ?? '';
                $discount = $_POST['discount'] ?? 0;
                $status = $_POST['status'] ?? 0;
                $attribute_id = $_POST['attribute_id'] ?? [];

                $thumb = $_FILES['thumb'] ?? '';
                $isSuccess = false;


                // Validation
                if (empty($title) || empty($cate_id) || empty($brand_id) || empty($price)) {
                    $this->Toast('error', 'Vui lòng không để trống.');
                    return;
                }

                // Handle Thumbnail
                if (!empty($thumb['name'])) {
                    $thumbName = $this->uploadSingleImage($thumb, 'product/thumb');
                    if (!$thumbName) {
                        $this->Toast('error', 'Failed to upload thumbnail');
                        return false;
                    }
                }

                // Update Product Data
                $sql = 'UPDATE product SET title=?, cate_id=?, brand_id=?, slug=?, weight=?, description=?, quantity=?, price=?, discount=?, status=?, update_At= NOW()';
                $params = [$title, $cate_id, $brand_id, $slug, $weight, $description, $quantity, $price, $discount, $status];

                if (!empty($thumbName)) {
                    $sql .= ', thumb=?';
                    $params[] = $thumbName;
                }

                $sql .= ' WHERE id=?';
                $params[] = $id;

                $stmt = $this->conn->prepare($sql);
                $stmt->execute($params);
                $isSuccess = true;


                //upload variant 
                if (!empty($attribute_id)) {
                    $sql = 'DELETE FROM product_attribute WHERE prod_id = :id';
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();

                    $sql = 'INSERT INTO product_attribute (prod_id, attribute_id) VALUES (?, ?)';
                    $stmt = $this->conn->prepare($sql);
                    foreach ($attribute_id as $attr) {
                        $stmt->execute([$id, $attr]);
                    }
                }


                if (!empty($images['name'][0])) {
                    $uploadedFiles = [];

                    foreach ($images['name'] as $key => $name) {
                        $tmp_name = $images['tmp_name'][$key];
                        $type = $images['type'][$key];
                        $size = $images['size'][$key];
                        $maxFileSize = 8000000;
                        $allowTypes = array('image/jpg', 'image/png', 'image/jpeg', 'image/webp');
                        $targetDir = "public/images/product/";
                        $targetFile = $targetDir . basename($name);

                        if (file_exists($targetFile)) {
                            $this->Toast('error', 'File has existed 2.');
                            return false;
                        } elseif (
                            $size > $maxFileSize
                        ) {
                            $this->Toast('error', 'File size exceeds the maximum limit.');
                            return false;
                        } elseif (!in_array($type, $allowTypes)) {
                            $this->Toast('error', 'Invalid file type.');
                            return false;
                        } elseif (!move_uploaded_file($tmp_name, $targetFile)) {
                            $this->Toast('error', 'Failed to upload the file.');
                            return false;
                        } else {
                            $uploadedFiles[] = $name;
                        }
                    }

                    if (empty($uploadedFiles)) {
                        $this->Toast('error', 'Failed to upload an image');
                        return false;
                    }


                    $existingImages = $this->findByName('images_product', $id, 'prod_id');
                    if (!empty($existingImages)) {
                        foreach ($existingImages as $image) {
                            $imagePath = 'public/images/product/' . $image['image'];
                            if (file_exists($imagePath)) {
                                unlink($imagePath);
                            }
                        }

                        $sql = 'DELETE FROM images_product WHERE prod_id = :id';
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();
                    }

                    $sql = 'INSERT INTO images_product (image, prod_id) VALUES (?, ?)';
                    $stmt = $this->conn->prepare($sql);

                    foreach ($uploadedFiles as $file) {
                        $stmt->execute([$file, $id]);
                    }

                    $isSuccess = true;
                }
                if ($isSuccess) {
                    return $this->Toast('success', 'Update product success.', 'admin/product', 1000);
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }


    function deleteProduct($id)
    {
        $dataProduct = $this->findById('product', $id);
        $dataProductImages = $this->findByName('images_product', $id, 'prod_id');

        function deleteImage($imagePath)
        {
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $mainImagePath = "public/images/product/thumb/" . $dataProduct['thumb'];
        deleteImage($mainImagePath);

        foreach ($dataProductImages as $prodItem) {
            $imagePath = "public/images/product/" . $prodItem['image'];
            deleteImage($imagePath);
        }

        try {
            $sql = 'DELETE FROM images_product WHERE prod_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            //delete variant 
            $sql = 'DELETE FROM product_attribute WHERE prod_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $success = $this->deleteById('product', $id);

            if ($success) {
                Session::set('deleteMessage', 'Xoá thành công.');
                Session::set('deleteType', 'success');
                header('Location: /WEB2041_Ecommerce/admin/product');
                return true;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        Session::set('deleteMessage', 'Xoá thất bại.');
        Session::set('deleteType', 'error');
        return false;
    }

    function getAllRatingsProd($limit = null)
    {
        try {
            $sql = 'SELECT r.*, u.fullname, p.title
                FROM ratings r
                INNER JOIN product p ON p.id = r.prod_id
                INNER JOIN user u ON u.id = r.user_id ';

            if (!empty($limit)) {
                $sql .= 'LIMIT ' . $limit;
            }

            // var_dump($sql);
            $stmt = $this->conn->query($sql);
            $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $ratings;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    function deleteRatingProduct($id)
    {
        $success = $this->deleteById('ratings', $id);

        if ($success) {
            Session::set('deleteMessage', 'Xoá thành công.');
            Session::set('deleteType', 'success');
            header('Location: /WEB2041_Ecommerce/admin/brand');
            return true;
        }

        Session::set('deleteMessage', 'Xoá thất bại.');
        Session::set('deleteType', 'error');
        return false;
    }
}
