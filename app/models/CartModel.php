<?php
class CartModel extends BaseModel
{


    public function tableName()
    {
        return 'cart';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }


    function getAllCart($idUser)
    {

        $dataCart = $this->db->table('cart c')->select('c.id, c.prod_id, c.totalPrice, c.quantity, c.color, c.size, p.title, p.price, p.thumb, p.totalRatings, p.totalUserRatings')->join('product p', 'c.prod_id = p.id')->where('c.user_id', '=', $idUser)->get();

        return $dataCart;
    }

    function addNewProductCart($prodId)
    {

        $rs = ViewShare::$dataShare;

        if (empty($rs)) {
            return json_encode('Failed');
        }

        $this->idUser = $rs['dataUser']['payload']['user_id'];

        $sql = 'SELECT * FROM cart WHERE prod_id = ? AND user_id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$prodId, $this->idUser]);
        $dataCart = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dataProd = $this->findById('product', $prodId);


        if (isset($_POST['color'])) {
            $color = trim($_POST['color']) ?? '';
        }
        if (isset($_POST['size'])) {
            $size = trim($_POST['size']) ?? '';
        }

        $quantity = $_POST['quantity'] ?? 1;

        $price = $dataProd['price'] ?? '';
        $totalPrice = $price * $quantity;

        $dataInsert = ['prod_id' => $prodId, 'user_id' => $this->idUser, 'quantity' => $quantity, 'totalPrice' => $totalPrice];

        if (!empty($size)) {
            $dataInsert['size'] = $size;
        }


        // if cart id not exist then add new
        if (empty($dataCart)) {
            $this->create('cart', $dataInsert);
            return json_encode(['success' => 'Thêm sản phẩm thành công.']);
        }

        if (!empty($color)) {
            $dataInsert['color'] = $color;

            $foundMatchingColor = false;
            foreach ($dataCart as $dataCartItem) {
                if ($dataCartItem['color'] == $color) {
                    $foundMatchingColor = true;

                    $sumQuantity = $dataCartItem['quantity'] + $quantity;
                    $totalPrice += $dataCartItem['totalPrice'];
                    $dataUpate = ['quantity' => $sumQuantity,  'totalPrice' => $totalPrice];
                    $condition = 'id = ' . $dataCartItem['id'];
                    $this->findByNameAndUpdate('cart', $dataUpate, $condition);
                    return json_encode(['success' => 'Thêm sản phẩm thành công.']);
                }
            }
            if (!$foundMatchingColor) {
                $this->create('cart', $dataInsert);
                return json_encode(['success' => 'Thêm sản phẩm thành công.']);
            }
        } else {
            $sumQuantity = $dataCart[0]['quantity'] + $quantity;
            $totalPrice += $dataCart[0]['totalPrice'];
            $dataUpate = ['quantity' => $sumQuantity,  'totalPrice' => $totalPrice];
            $condition = 'id = ' . $dataCart[0]['id'];
            $this->findByNameAndUpdate('cart', $dataUpate, $condition);
            return json_encode(['success' => 'Thêm sản phẩm thành công.']);
        }
    }

    function deleteCart($id)
    {
        $success = $this->deleteById('cart', $id);

        if ($success) {
            return  json_encode(['message' => 'Delete success.']);
        }
        return  json_encode(['message' => 'Delete Failed.']);
    }

    function updateQuantity($id, $action)
    {
        try {
            $sql = "SELECT c.*, p.price
            FROM cart c
            JOIN product p ON c.prod_id = p.id
            WHERE c.id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $cartData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($cartData)) {
                return json_encode(['message' => 'Update quantity failed.']);
            }

            if ($action == 'plus') {
                $newQuantity = $cartData['quantity'] + 1;
            } elseif ($action == 'minus' && $cartData['quantity'] > 1) {
                $newQuantity = $cartData['quantity'] - 1;
            } else {
                return json_encode(['message' => 'Update not < 1']);
            }

            $newTotalPrice = $newQuantity * $cartData['price'];

            $condition = 'id = ' . $id;
            $dataUpdate = [
                'quantity' => $newQuantity,
                'totalPrice' => $newTotalPrice,
                'update_at' => date('Y-m-d H:i:s'),
            ];

            $success =  $this->findByNameAndUpdate('cart', $dataUpdate, $condition);
            if ($success) {
                return json_encode(['message' => 'Update quantity success.']);
            }

            return json_encode(['message' => 'Update quantity failed.']);
        } catch (PDOException $e) {
            return json_encode(['message' => 'Update quantity failed.']);
        }
    }
}
