<?php
if ($delMessage && $delType) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500, 
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            }
        });

        Toast.fire({
            icon: "' . $delType . '",
            title: "' . $delMessage . '",
        });
    })
    </script>';
    Session::unsetSession('deleteMessage');
    Session::unsetSession('deleteType');
    echo '<pre>';
    print_r($dataRatings);
    echo '</pre>';
}
?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách đánh giá</h5>
            <div class="right-options">
                <ul>
                    <!-- <li>
                        <button data-bs-toggle="modal" data-bs-target="#addBrand" class="btn btn-custom"> Add Brand</button>
                    </li> -->
                </ul>
            </div>
        </div>

        <div class="table-custom">
            <table class="theme-table" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>
                        <th>No.</th>
                        <th>Tên khách hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Xếp hạng</th>
                        <th>Bình luận</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $i = 1  ?>
                    <?php foreach ($dataRatings as $dataRatingsItem) {
                        extract($dataRatingsItem);
                    ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $fullname ?></td>
                            <td><?php echo $title ?></td>
                            <td style="color: var(--star);"><?php echo Format::renderStars($star) ?></td>
                            <td>
                                <div style="max-width: 400px;" class="text-truncate "><?php echo $comment ?></div>
                            </td>

                            <td>
                                <ul class="options">
                                    <!-- <li class="m-0 ">
                                        <a onclick="updateBrand()" data-bs-toggle="modal" data-bs-target="#updateBrand" href="javascript:void(0)">
                                            <i class="edit fas fa-edit"></i>
                                        </a>
                                    </li> -->

                                    <li class="m-0 ">
                                        <a onclick="setDataIdToInput(<?php echo $id ?>)" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteConfirm">
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
                <form method="POST" action="admin/">
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