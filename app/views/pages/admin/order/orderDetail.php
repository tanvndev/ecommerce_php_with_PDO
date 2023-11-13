<?php

?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Đơn hàng #1123</h5>

        </div>

        <div class="order-detail">
            <div class="order-top">
                <ul class="info">
                    <li>October 21, 2021 at 9:08 pm</li>
                    <li>6 items</li>
                    <li>Total $5,882.00</li>
                </ul>
            </div>
            <div class="row g-4 pt-5 ">
                <div class="col-xl-8">
                    <div class="table-details">
                        <div class="heading">Items</div>
                        <table class="table table-borderless">
                            <tbody>
                                <?php for ($i = 0; $i < 4; $i++) {
                                ?>
                                    <tr class="table-order">
                                        <td>
                                            <div class="image">
                                                <img src="https://themes.pixelstrap.com/fastkart/back-end/assets/images/profile/1.jpg" class="img-fluid blur-up lazyload" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                <p>Product Name</p>
                                                <h5>Outwear &amp; Coats</h5>
                                            </div>
                                        </td>
                                        <td>
                                            <p>Quantity</p>
                                            <h5>1</h5>
                                        </td>
                                        <td>
                                            <p>Price</p>
                                            <h5>$63.54</h5>
                                        </td>
                                    </tr>

                                <?php } ?>


                            </tbody>

                            <tfoot class="mt-4">
                                <tr class="table-order-footer">
                                    <td colspan="3">
                                        <h5>Subtotal :</h5>
                                    </td>
                                    <td>
                                        <h4>$55.00</h4>
                                    </td>
                                </tr>

                                <tr class="table-order-footer ">
                                    <td colspan="3">
                                        <h5>Shipping :</h5>
                                    </td>
                                    <td>
                                        <h4>$12.00</h4>
                                    </td>
                                </tr>


                                <tr class="table-order-footer">
                                    <td colspan="3">
                                        <h4 class="theme-color fw-bold">Total Price :</h4>
                                    </td>
                                    <td>
                                        <h4 class="theme-color fw-bold">$6935.00</h4>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!--  -->

                <div class="col-xl-4">
                    <div class="order-summery">
                        <div class="row g-4">
                            <h4>Tóm tắt</h4>
                            <ul class="order-details">
                                <li>Mã đơn hàng: 5563853658932</li>
                                <li>Ngày đặt hàng: October 22, 2018</li>
                                <li>Tổng tiền: $907.28</li>
                            </ul>

                            <h4>Địa chỉ giao hàng</h4>
                            <ul class="order-details">
                                <li>Hang Trong, Hoàn Kiếm, Hanoi</li>
                            </ul>

                            <div class="payment-mode">
                                <h4>Phương thức thanh toán</h4>
                                <p>Thanh toán khi nhận hàng</p>
                            </div>

                            <div class="delivery-sec">
                                <h3>Dự kiến nhận hàng: <span>october 22, 2018</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>