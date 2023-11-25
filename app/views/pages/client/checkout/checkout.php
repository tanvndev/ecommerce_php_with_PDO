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
                    <?php
                    foreach ($dataCoupon as $dataCouponItem) :
                        $couponValue = null;
                        preg_match('/(\d+)(%)/', $dataCouponItem['value'], $couponValueArr);
                        if (end($couponValueArr) == '%') {
                            $couponValue = $dataCouponItem['value'];
                        } else {
                            $couponValue = Format::formatCurrency($dataCouponItem['value']);
                        }
                    ?>
                        <div class="slick-slide">
                            <div class="campaign-content">
                                <p class="text-uppercase "><?= "{$dataCouponItem['title']} $couponValue" ?> : <a href="coupon">NHẬN GIẢM GIÁ</a></p>
                            </div>
                        </div>
                    <?php endforeach ?>

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

                        <!-- <div class="address-default">
                            <div class="heading-address">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="ms-3 ">Địa chỉ nhận hàng</span>
                            </div>
                            <div class="address">
                                <h5>
                                    Trần Văn B - 01234584572</span>
                                </h5>
                                <p>
                                Ha noi
                                </p>
                            </div>

                            <div class="change-address">
                                <span>Mặc định </span>
                                <a href="">Thay đổi </a>
                            </div>
                        </div> -->

                        <p class="text-danger ">Vui lòng xem kỹ thông tin nhận hàng.</p>
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

                            <textarea name="address" rows="1 placeholder=" Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng."><?= $dataAddress['address'] ?? '' ?></textarea>
                        </div>


                        <div class="form-group">
                            <label>Lời nhắn cho người bán</label>
                            <textarea name="note" rows="2" placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng."></textarea>
                        </div>

                        <!--  -->
                        <div class="coupon-apply mb--40">
                            <input id="coupon_code" type="text" name="coupon_code" class="mb--15" placeholder="Nhập mã giảm giá">
                            <button onclick="updateProductCoupon(<?= $dataCart[0]['totalPrice'] ?>)" type="button" class="btn">Áp dụng</button>
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
                        <button type="submit" class="btn btn-custom">Thanh toán</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>