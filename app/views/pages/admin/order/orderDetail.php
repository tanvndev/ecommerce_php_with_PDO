<?php
// echo '<pre>';
// print_r($dataOrderStatus);
// echo '</pre>';
?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Đơn hàng #<?= $dataOrder[0]['order_code'] ?></h5>
        </div>

        <div class="order-detail">
            <div class="order-top">
                <ul class="info">
                    <li><?= $dataOrder[0]['order_date'] ?></li>
                    <li><?= count($dataOrder) ?> mặt hàng</li>
                    <li>Tổng <?= Format::formatCurrency($dataOrder[0]['total_money']) ?></li>
                </ul>
            </div>
            <div class="row g-4 pt-5 ">
                <div class="col-xl-8">
                    <div class="table-details">
                        <div class="heading">Mặt hàng</div>
                        <table class="table table-borderless">
                            <tbody>
                                <?php
                                $subtotal = 0;
                                foreach ($dataOrder as $dataOrderItem) {
                                    extract($dataOrderItem);
                                    $subtotal += $sub_total;
                                ?>
                                    <tr class="table-order">
                                        <td>
                                            <div class="image">
                                                <img src="<?= $thumb ?>" class="img-fluid blur-up lazyload" alt="<?= $title ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product_variant">
                                                <h5 class="mt-0">
                                                    <?= $title ?>

                                                </h5>
                                                <p>Phân loại: <span><?= $attribute_values ?></span></p>
                                            </div>
                                        </td>
                                        <td>
                                            <p>Số lượng</p>
                                            <h5><?= $quantity ?></h5>
                                        </td>
                                        <td>
                                            <p>Giá</p>
                                            <h5><?= Format::formatCurrency($price) ?></h5>
                                        </td>
                                    </tr>

                                <?php } ?>


                            </tbody>

                            <tfoot class="mt-4">
                                <tr class="table-order-footer">
                                    <td colspan="3">
                                        <h5>Tạm tính :</h5>
                                    </td>
                                    <td>
                                        <h4><?= Format::formatCurrency($subtotal) ?></h4>
                                    </td>
                                </tr>

                                <tr class="table-order-footer ">

                                    <td colspan="3">
                                        <h5>Ưu dãi :</h5>
                                    </td>
                                    <td>
                                        <h4><?= Format::formatCurrency($total_money - $subtotal) ?></h4>
                                    </td>
                                </tr>


                                <tr class="table-order-footer">
                                    <td colspan="3">
                                        <h4 class="theme-color fw-bold">Thành tiền :</h4>
                                    </td>
                                    <td>
                                        <h4 class="theme-color fw-bold"><?= Format::formatCurrency($total_money) ?></h4>
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
                                <li>Mã đơn hàng: #<?= $order_code ?></li>
                                <li>Ngày đặt hàng: <?= date('d/m/Y', strtotime($order_date)) ?></li>
                                <li>Tổng tiền: <?= Format::formatCurrency($total_money) ?></li>
                            </ul>

                            <h4>Địa chỉ giao hàng</h4>
                            <ul class="order-details">
                                <li><?= "$fullname - $phone - $address" ?></li>
                            </ul>

                            <h4>Phương thức thanh toán</h4>
                            <ul class="order-details">
                                <li><?= $payment_method_name ?></li>
                            </ul>


                            <div class="payment-mode">
                                <h4>Trạng thái đơn hàng</h4>
                                <?php
                                foreach ($dataOrderStatus as $item) {
                                    $cancer = $item['id'] == 5 ? 'inactive' : 'active';
                                    if ($selected = $item['id'] == $order_status_id) {
                                ?>
                                        <p class="status <?= $cancer ?>"><?= $item['name'] ?></p>
                                <?php }
                                } ?>
                            </div>

                            <div class="delivery-sec">
                                <h3>
                                    Dự kiến nhận hàng: <span><?= date('d/m/Y', strtotime($order_date) + 3 * 24 * 3600) ?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!in_array($order_status_id, [3, 4, 5])) : ?>
                    <div class="col-xl-4 ms-auto">
                        <div class="update-status">
                            <button data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-custom">Cập nhập trạng thái đơn hàng</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
</section>

<div class="modal fade theme-modal" id="updateModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content py-3">
            <div class="modal-header border-0  d-block text-center">
                <h5 class="modal-title w-100 mb-5 fs-1 ">Cập nhập trạng thái đơn hàng</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="admin/update-order-status" method="POST">
                <div class="modal-body add-wrap-admin">
                    <div class="form-input">
                        <input type="hidden" value="<?= $order_id ?>" name="order_id">
                        <input type="hidden" value="<?= $idData ?>" name="idData">
                        <div class="mb-5 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Tên thương hiệu</label>
                            <div class="col-sm-9">
                                <select class="select-custom" name="order_status_id" id="select-custom" required>
                                    <?php
                                    foreach ($dataOrderStatus as $orderStatusItem) {
                                        $selectedStatus = $orderStatusItem['id'] == $order_status_id ?? '' ? 'selected' : '';
                                        if ($orderStatusItem['id'] != 4) {

                                    ?>
                                            <option <?= $selectedStatus  ?> value="<?= $orderStatusItem['id'] ?>"><?= $orderStatusItem['name'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 ">
                    <div class="ms-3 ">
                        <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ bỏ</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-custom btn-yes fw-bold">Cập nhập</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>