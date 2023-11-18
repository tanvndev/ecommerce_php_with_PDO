<?php
// echo '<pre>';
// print_r($dataCart);
// echo '</pre>';
?>

<section class="header-top-campaign">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="header-campaign-activation">
                    <div class="slick-slide">
                        <div class="campaign-content">
                            <p>SINH VIÊN NHẬN NGAY 10% GIẢM GIÁ: <a href="#">NHẬN GIẢM GIÁ</a></p>
                        </div>
                    </div>
                    <div class="slick-slide">
                        <div class="campaign-content">
                            <p>SINH VIÊN NHẬN NGAY 15% GIẢM GIÁ: <a href="#">NHẬN GIẢM GIÁ</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout-area">
    <div class="container">
        <form action="checkout-final" method="POST">
            <div class="row">
                <div class="col-lg-6 pe-5 ">
                    <div class="checkout-billing">
                        <h4 class="title mb--30">Thanh toán</h4>
                        <?php
                        if (!empty($dataAddress['fullname']) && !empty($dataAddress['address']) && !empty($dataAddress['phone'])) {
                        ?>
                            <div class="address-default">
                                <div class="heading-address">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span class="ms-3 ">Địa chỉ nhận hàng</span>
                                </div>
                                <div class="address">
                                    <h5>
                                        <?= $dataAddress['fullname'] . ' - ' ?>
                                        <span><?= $dataAddress['phone'] ?></span>
                                    </h5>
                                    <p>
                                        <?= $dataAddress['address'] ?>
                                    </p>
                                </div>

                                <div class="change-address">
                                    <span>Mặc định </span>
                                    <a href="">Thay đổi </a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <p class="text-danger ">Vui lòng nhập đầy đủ thông tin nhận hàng.</p>
                            <div class="form-group">
                                <label>Họ và tên <span class="text-danger ">*</span></label>
                                <input name="fullname" type="text" value="<?= $dataAddress['fullname'] ?? '' ?>" class="mb--15" placeholder="Họ và tên">
                            </div>

                            <div class="form-group">
                                <label>Số điện thoại <span class="text-danger ">*</span></label>
                                <input name="phone" type="tel" value="<?= $dataAddress['phone'] ?? '' ?>" class="mb--15" placeholder="Số điện thoại">
                            </div>

                            <div class="form-group">
                                <label>Địa chỉ giao hàng<span class="text-danger ">*</span></label>
                                <input name="address" type="text" value="<?= $dataAddress['address'] ?? '' ?>" class="mb--15" placeholder="Địa chỉ cụ thể">
                            </div>
                        <?php } ?>
                        <div class="coupon-apply mb--40">
                            <input type="text" name="coupon_code" class="mb--15" placeholder="Nhập mã giảm giá">
                            <button type="button" class="btn">Áp dụng</button>
                        </div>


                        <div class="form-group">
                            <label>Lời nhắn cho người bán</label>
                            <textarea name="note" rows="2" placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng."></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="order-checkout-summery">
                        <h5 class="title mb--20">Đơn hàng của bạn</h5>
                        <div class="summery-table-wrap">
                            <table class="table summery-table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Tạm tính</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($dataCart as $cartItem) {

                                    ?>
                                        <tr class="order-product">
                                            <td>
                                                <div class="inner">
                                                    <div class="thumb me-2 ">
                                                        <img src="<?= $cartItem['thumb'] ?>" alt="<?= $cartItem['title'] ?>">
                                                    </div>
                                                    <div class="title">
                                                        <p class="mb-0"><?= $cartItem['title'] ?>
                                                            <span class="quantity"><?= 'x' . $cartItem['quantity'] ?></span>
                                                        </p>

                                                        <span class="variant">Phân loại: <font>
                                                                <?= $cartItem['attribute_values'] ?>
                                                            </font>
                                                        </span>


                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?= Format::formatCurrency(($cartItem['price'] * $cartItem['quantity'])) ?>
                                            </td>
                                        </tr>
                                    <?php } ?>



                                    <tr class="order-subtotal">
                                        <td>Tạm tính</td>
                                        <td class="order-subtotal-amount">
                                            <?= Format::formatCurrency($dataCart[0]['totalPrice']) ?>
                                        </td>
                                    </tr>

                                    <tr class="order-coupon">
                                        <td>Ưu đãi</td>
                                        <td class="order-coupon-amount">0</td>
                                    </tr>


                                    <!-- <tr class="order-shipping">
                                        <td colspan="2">
                                            <div class="shipping-amount">
                                                <span class="title">Shipping Method</span>
                                                <span class="amount">$35.00</span>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio1" name="shipping" checked>
                                                <label for="radio1">Free Shippping</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio2" name="shipping">
                                                <label for="radio2">Local</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio3" name="shipping">
                                                <label for="radio3">Flat rate</label>
                                            </div>
                                        </td>
                                    </tr> -->

                                    <tr class="order-total">
                                        <td>Tổng</td>
                                        <td class="order-total-amount">
                                            <?= Format::formatCurrency($dataCart[0]['totalPrice']) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="order-payment-method">


                            <?php
                            foreach ($dataPaymentMethod as $paymentMethod) {

                            ?>
                                <div class="single-payment">
                                    <div class="input-group justify-content-between align-items-center">
                                        <input type="radio" id="<?= $paymentMethod['name']  ?>" name="payment_method" value="<?= $paymentMethod['id']  ?> - <?= $paymentMethod['name'] ?> ">
                                        <label for="<?= $paymentMethod['name'] ?>"><?= $paymentMethod['display_name']  ?></label>
                                        <img src="<?= $paymentMethod['thumb']  ?>" alt="<?= $paymentMethod['display_name']  ?>">
                                    </div>
                                    <p class="desc"><?= $paymentMethod['description'] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-custom">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>