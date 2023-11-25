<?php
// echo '<pre>';
// print_r($dataRatings);
// echo '</pre>';
?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách đánh giá</h5>

        </div>

        <div class="table-custom">
            <table class="theme-table" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>
                        <th>No.</th>
                        <th>Tên khách hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Xếp hạng</th>
                        <th>Đánh giá</th>
                        <th>Ẩn</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $i = 1  ?>
                    <?php foreach ($dataRatings as $dataRatingsItem) {
                        extract($dataRatingsItem);
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $fullname ?></td>
                            <td><?= $title ?></td>
                            <td style="color: var(--star);"><?= Format::renderStars($star) ?></td>
                            <td>
                                <div style="max-width: 400px;" class="text-truncate "><?= $comment ?></div>
                            </td>

                            <td>
                                <label class="switch">
                                    <input onchange="toggleStatusProdRating(<?= $id ?>)" name="status" <?= $status == 1 ? 'checked' : ''  ?> type="checkbox">
                                    <span class="slider"></span>
                                </label>
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
        $("#idRatings").val(id);
    }
</script>


<div class="modal fade theme-modal" id="deleteConfirm" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content py-3">
            <div class="modal-header border-0  d-block text-center">
                <h5 class="modal-title w-100 ">Bạn đã chắc chắn chưa?</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0 text-center">Nếu thực hiện 'đồng ý' xoá bạn sẽ bị xoá vĩnh viễn không thể khôi phục lại hãy suy nghĩ thật kĩ trước khi xoá.</p>
            </div>
            <div class="modal-footer border-0 ">
                <form method="POST" action="admin/delete-rating-product">
                    <input type="hidden" id="idRatings" name="id">
                    <button type="submit" class="btn btn-custom btn-yes fw-bold">Đồng ý</button>
                </form>
                <div class="ms-3 ">
                    <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ bỏ</button>
                </div>

            </div>
        </div>
    </div>
</div>