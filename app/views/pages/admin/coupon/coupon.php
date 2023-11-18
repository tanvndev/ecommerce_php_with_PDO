<?php
// echo '<pre>';
// print_r($dataNews);
// echo '</pre>';
?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách mã giảm giá</h5>
            <div class="right-options">
                <ul>
                    <li>
                        <a class="btn btn-custom" href="admin/add-coupon"> Thêm mã giảm giá</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-custom">
            <table class="theme-table" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Mã</th>
                        <th>Giá trị mã</th>
                        <th>Giá tối thiểu</th>
                        <th>Trạng thái</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($dataCoupon as $dataCouponItem) {
                        extract($dataCouponItem);
                    ?>
                        <tr>
                            <td>
                                <div class="table-image">
                                    <img src="<?= $thumb ?>" class="img-fluid" alt="<?= $title ?>">
                                </div>
                            </td>

                            <td>
                                <div style="max-width: 500px;" class="text-truncate"><?= $title ?></div>
                            </td>
                            <td><?= $code ?></td>
                            <td><?= $value ?></td>
                            <td><?= $min_amount ?></td>
                            <td class=" <?= $status == 1 && strtotime($expired) > date('YmdHis') ? 'status-success' : 'status-danger' ?>">
                                <span class="fw-medium"><?= $status == 1 && strtotime($expired) > date('YmdHis') ? 'Hoạt động' : 'Hết hạn' ?></span>
                            </td>

                            <td>
                                <ul class="options">
                                    <li class="m-0 ">
                                        <a href="admin/update-coupon/<?= $id ?>">
                                            <i class="edit fas fa-edit"></i>
                                        </a>
                                    </li>

                                    <li class="m-0 ">
                                        <a onclick="setDataIdToInput(<?= $id ?>)" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteConfirm">
                                            <i class="delete fas fa-trash-alt"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    function setDataIdToInput(id) {
        $('#idDel').val(id)
    }
</script>


<div class="modal fade theme-modal" id="deleteConfirm" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content py-3">
            <div class="modal-header border-0  d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Bạn đã chắc chắn chưa?</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0 text-center">Nếu thực hiện 'đồng ý' xoá bạn sẽ bị xoá vĩnh viễn không thể khôi phục lại hãy suy nghĩ thật kĩ trước khi xoá.</p>
            </div>
            <div class="modal-footer border-0 ">
                <form method="POST" action="admin/coupon/deleteCoupon">
                    <input type="hidden" id="idDel" name="id">
                    <button type="submit" class="btn btn-custom btn-yes fw-bold">Đồng ý</button>
                </form>
                <div class="ms-3 ">
                    <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ</button>
                </div>

            </div>
        </div>
    </div>
</div>