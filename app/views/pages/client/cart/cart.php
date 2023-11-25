<section class="cart-product-cart-area">
    <div class="container">
        <div class="cart-product-cart-wrap">
            <div class="product-table-heading">
                <h4 class="title">Giỏ hàng của bạn</h4>
                <a href="cart/deleteAllCart" class="cart-clear">Xoá tất cả sản phẩm</a>
            </div>
            <div class="table-responsive">
                <table class="table cart-product-table mb--40">
                    <thead>
                        <tr>
                            <th scope="col" class="product-remove"></th>
                            <th scope="col" class="product-thumbnail">Sản phẩm</th>
                            <th scope="col" class="product-title"></th>
                            <th scope="col" class="product-price">Giá </th>
                            <th scope="col" class="product-quantity">Số lượng</th>
                            <th scope="col" class="product-subtotal">Tạm tính</th>
                        </tr>
                    </thead>
                    <tbody id="cart_main">
                    </tbody>
                </table>
                <div id="not-cart-main">

                </div>

            </div>
            <!-- <div class="cart-discount-btn-area">
                <input placeholder="Nhập mã giảm giá" type="text">
                <div class="product-cupon-btn">
                    <button type="submit" class="cart-btn">Áp dụng</button>
                </div>

            </div> -->
            <div class="row">
                <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                    <div class="cart-order-summery mt--80">
                        <h5 class="title mb--20">Tóm tắt đơn hàng</h5>
                        <div class="summery-table-wrap">
                            <table class="table summery-table mb--30">
                                <tbody>
                                    <tr class="order-subtotal">
                                        <td>Tạm tính</td>
                                        <td id="order-subtotal">0</td>
                                    </tr>
                                    <!-- <tr class="order-shipping">
                                        <td>Shipping</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="radio" id="radio1" name="shipping" checked="">
                                                <label for="radio1">Free Shippping</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio2" name="shipping">
                                                <label for="radio2">Local: $35.00</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="radio" id="radio3" name="shipping">
                                                <label for="radio3">Flat rate: $12.00</label>
                                            </div>
                                        </td>
                                    </tr> -->
                                    <!-- <tr class="order-tax">
                                        <td>State Tax</td>
                                        <td>$8.00</td>
                                    </tr> -->

                                    <tr class="order-total">
                                        <td>Tổng</td>
                                        <td id="order-total-amount" class="order-total-amount">$125.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="checkout" class="btn-custom">Tiến hành thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>