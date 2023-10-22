<?php
require_once 'sweetAleart.php';
trait CRUD
{
    use SweetAlert;

    function find($table, $orderName = 'id', $orderBy = 'DESC', $limit = '')
    {
        try {
            if (!isset($orderName)) {
                $orderName = 'id';
            }

            if (!isset($orderBy)) {
                $orderBy = 'DESC';
            }
            $sql = "SELECT * FROM $table ORDER BY $orderName $orderBy";

            if ($limit) {
                $sql .= " LIMIT $limit";
            }

            $stmt = $this->conn->query($sql);
            $dataProd = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $dataProd;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 'Find Failed';
        }
    }
    function findById($table, $id)
    {
        try {
            $sql = 'SELECT * FROM ' . $table . ' WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $dataProd = $stmt->fetch(PDO::FETCH_ASSOC);

            return $dataProd;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 'Find Failed';
        }
    }



    function findByName($table, $variant, $name, $limit = null)
    {
        try {
            $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $name . ' = :variant';

            if ($limit) {
                $sql .= ' LIMIT ' . $limit;
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':variant', $variant);
            $stmt->execute();
            $dataProd = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $dataProd;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 'Find Failed';
        }
    }

    function findByColumn($table, $column, $condition = null, $limit = null)
    {
        try {
            $sql = 'SELECT ' . $column . ' FROM ' . $table;
            if ($limit) {
                $sql .= ' LIMIT ' . $limit;
            }
            if ($condition) {
                $sql .= ' WHERE ' . $condition;
            }

            $stmt = $this->conn->query($sql);
            $dataProd = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $dataProd;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 'Find Failed';
        }
    }


    function findByNameAndUpdate($tableName, $dataToUpdate, $condition)
    {
        try {
            $sql = "UPDATE $tableName SET ";
            $updates = [];
            foreach ($dataToUpdate as $key => $value) {
                $updates[] = "$key = :$key";
            }
            $sql .= implode(", ", $updates);
            if (!empty($condition)) {
                $sql .= " WHERE $condition";
            }
            $stmt = $this->conn->prepare($sql);
            foreach ($dataToUpdate as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: $e";
            return false;
        }
    }

    function create($tableName, $dataToInsert)
    {
        try {
            $sql = "INSERT INTO $tableName (";
            $columns = implode(", ", array_keys($dataToInsert));
            $sql .= $columns . ") VALUES (";
            $values = implode(", ", array_fill(0, count($dataToInsert), "?"));
            $sql .= $values . ")";
            $stmt = $this->conn->prepare($sql);

            $index = 1;
            foreach ($dataToInsert as $value) {
                $stmt->bindValue($index++, $value);
            }
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error: $e";
            return false;
        }
    }

    function checkIdentificationExisted($identification, $name,  $message)
    {
        $identificationExisted = $this->findByName('user', $identification, $name);
        if (!empty($identificationExisted)) {
            $this->Toast('error', $message);
            return false;
        }
        return true;
    }

    function deleteById($table, $id)
    {
        try {
            $sql = 'DELETE FROM ' . $table . ' WHERE id = :id';
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $success =  $stmt->execute();

            return $success;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 'Delete Failed';
        }
    }

    function countColumn($table, $condition = null)
    {
        try {
            $sql = 'SELECT COUNT(*) FROM ' . $table;
            $stmt = $this->conn->query($sql);
            if (!empty($condition)) {
                $sql .= " WHERE $condition";
            }
            $result = $stmt->fetchColumn();

            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 'Delete Failed';
        }
    }

    function findProductsByCategory($categoryId, $limit = null, $orderBy = 'id DESC')
    {
        try {
            $sql = 'SELECT p.*, c.name
                FROM product p
                INNER JOIN category c ON p.cate_id = c.id
                WHERE c.id = :categoryId';

            if (!is_null($orderBy)) {
                $sql .= ' ORDER BY ' . $orderBy;
            }

            if (!is_null($limit)) {
                $sql .= ' LIMIT ' . $limit;
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':categoryId', $categoryId);
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }




    function uploadSingleImage($file, $url)
    {

        $name = $file['name'];
        $tmp_name = $file['tmp_name'];
        $type = $file['type'];
        $size = $file['size'];
        $maxFileSize = 8000000;

        $allowTypes = array('image/jpg', 'image/png', 'image/jpeg', 'image/webp');

        $target_dir = "public/images/$url/";
        $target_file = $target_dir . basename($name);

        if (file_exists($target_file)) {
            $this->Toast('error', 'File has existed.');
            return false;
        } elseif ($size > $maxFileSize) {
            $this->Toast('error', 'File size exceeds the maximum limit.');
            return false;
        }
        if (!in_array($type, $allowTypes)) {
            $this->Toast('error', 'Invalid file type.');
            return false;
        }

        if (!move_uploaded_file($tmp_name, $target_file)) {
            $this->Toast('error', 'Failed to upload the file.');
            return false;
        }

        return $name;
    }
}
