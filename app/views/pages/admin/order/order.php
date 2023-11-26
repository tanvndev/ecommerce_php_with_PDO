<?php
// echo '<pre>';
// print_r($dataOrder);
// echo '</pre>';
?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách đơn hàng</h5>
            <div class="right-options">
                <!-- <ul>
                    <li>
                        <a class="btn btn-custom" href="admin/add-category"> Thêm đơn hàng</a>
                    </li>
                </ul> -->
            </div>
        </div>

        <div class="table-custom">
            <table class="theme-table" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày tạo đơn</th>
                        <th>Người đặt hàng</th>
                        <th>Phương thức thanh toán</th>
                        <th>Thành tiền</th>
                        <th>Trạng thái</th>
                        <th>hoá đơn</th>
                        <th>Cập nhập đơn hàng</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($dataOrder as $dataOrderItem) {
                        extract($dataOrderItem)
                    ?>
                        <tr>
                            <td class="fw-bold "><?= "#$order_code" ?></td>
                            <td><?= $order_date ?></td>
                            <td><?= $fullname ?></td>
                            <td><?= $payment_method_name ?></td>
                            <td class="fw-bold "><?= Format::formatCurrency($total_money) ?></td>
                            <td class=" <?= $dataOrderItem['order_status_id'] == 5 ? 'status-danger' : 'status-success' ?>">
                                <span class="fw-medium">
                                    <?= $dataOrderItem['order_status_name'] ?>
                                </span>
                            </td>

                            <td>
                                <ul class="options">

                                    <li class="m-0 ">
                                        <a href="admin/order/downloadInvoice/<?= $order_id ?>">
                                            <i class="edit far fa-download"></i>
                                        </a>
                                    </li>

                                    <li class="m-0 ">
                                        <button onclick="printInvoice(<?= $order_id ?>)" style="background-color: transparent;" type="button"">
                                            <i class=" view far fa-print"></i>
                                        </button>
                                    </li>

                                </ul>
                            </td>

                            <td class=" btn-update">
                                <a href="admin/order-detail/<?= "$order_id-$order_code" ?>" class="btn btn-custom">Cập nhập </a>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</section>