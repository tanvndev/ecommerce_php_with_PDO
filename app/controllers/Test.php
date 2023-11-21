<?php
class Test extends Controller
{
    private $req = null;
    function __construct()
    {
        $this->req = new Request;
    }
    function Default()
    {
        $orderData = array(
            'order_id' => 123456,
            'order_desc' => 'Hoá đơn mua hàng',
            'amount' => 200000,
            'bank_code' => 'NCB',
        );
        $check = Services::generateVnPayUrl($orderData);

        header('location: ' . $check);
    }

    function getDataGet()
    {
        $dataGet = $this->req->getFields();
        echo '<pre>';
        print_r($dataGet);
        echo '</pre>';
    }

    function detail($i)
    {
        echo 'Trang test - ' . $i;
    }

    function get_user()
    {
        $this->view('layoutLogin', [
            'title' => 'trang thu nghiem',
            'pages' => 'test/viewTest',

        ]);
    }
    function modelTest()
    {
        $testModel = $this->model('TestModel');
        echo '<pre>';
        print_r($testModel->getList());
        echo '</pre>';
    }

    function post_user()
    {
        // set rules
        $this->req->rules([
            'fullname' => 'required|min:5|max:30',
            'email' => 'required|email|min:6',
            'password' => 'required|strong',
            're_password' => 'match:password',
        ]);

        // set message

        $this->req->message([
            'fullname.required' => 'Ho ten khong duoc de trong',
            'fullname.min' => 'Toi thieu 5 ky tu',
            'fullname.max' => 'Toi da 8 ky tu',
            'email.required' => 'Email khong duoc de trong',
            'email.email' => 'Dung dinh dang email',
            'email.min' => 'Toi thieu 6 ky tu',
            'password.required' => 'Mat khau khong duoc de trong',
            'password.strong' => 'Mat khau chua dung yeu cau',
            're_password.match' => 'Mat khau khong khop',
        ]);

        $validate = $this->req->validate();
        $this->view('layoutLogin', [
            'pages' => 'test/viewTest',
            'dataError' => $this->req->errors(),
        ]);
    }
}
die();
?>
<!-- Product Quick View Modal Start -->
<!-- display: block;
padding-right: 20px; -->
<div class="modal fade quick-view-product show" style="display: block;
padding-right: 20px;" id="quick-view-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="single-product">
                    <div class="row">
                        <div class="col-lg-5 mb--40">
                            <div class="thumb">
                                <img src="<?= $dataProd['thumb'] ?>" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7 mb--40">
                            <div class="single-product-content">
                                <div class="inner">
                                    <h2 class="product-title"><?= $dataProd['title'] ?></h2>
                                    <div class="product-stock">Số lượng:
                                        <span id="product-stock"><?= $dataProd['quantity'] ?></span>
                                    </div>
                                    <div id="product-price" class="price">
                                        <span class="price-amount"><?= Format::formatCurrency($dataProd['price']) ?></span>

                                        <?php if ($dataProd['discount'] != 0) : ?>
                                            <span class="price-amount-old"><?= Format::calculateOriginalPrice($dataProd['price'], $dataProd['discount']) ?></span>
                                            <span class="text-danger "><?= ($dataProd['discount'] . '%') ?> </span>
                                        <?php endif ?>
                                    </div>


                                    <p class="description"><?= $dataProd['short_description'] ?></p>

                                    <form id="formProduct" action="cart/addCartApi" method="post">
                                        <?php if (!empty($dataVariant)) : ?>
                                            <div class="product-variations-wrapper mt-5 ">

                                                <div class="product-variation">
                                                    <h6 class="title">Phân loại:</h6>
                                                    <div class="color-variant-wrapper">
                                                        <input id="product_variant_id" type="hidden" name="product_variant_id">
                                                        <ul class="product-variant">
                                                            <?php
                                                            foreach ($dataVariant as $dataVariantItem) {
                                                            ?>
                                                                <li id="<?= $dataVariantItem['id'] ?>" onclick="getVariant(<?= $dataVariantItem['id'] ?>)"><?= $dataVariantItem['attribute_values'] ?></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                        <div class="product-action-wrapper d-flex-center">
                                            <div class="pro-quantity">
                                                <button type="button" class="dec quantity-btn">-</button>
                                                <input type="text" name="quantity" value="1">
                                                <button type="button" class="inc quantity-btn">+</button>
                                            </div>

                                            <ul class="product-action d-flex-center mb-0 ">
                                                <li class="add-to-cart">
                                                    <?php
                                                    $quantity = $dataProd['quantity'];
                                                    $isProductAvailable = ($quantity != 0);
                                                    $buttonText = $isProductAvailable ? 'Thêm vào giỏ hàng' : 'Sản phẩm tạm hết';
                                                    $buttonClass = $isProductAvailable ? 'btn-custom btn-bg-primary' : 'btn-custom btn-bg-primary disabled';
                                                    ?>

                                                    <button onclick="addCart()" type="button" class="<?= $buttonClass; ?>"><?= $buttonText; ?></button>

                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Quick View Modal End -->