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
}
?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách danh mục</h5>
            <div class="right-options">
                <ul>
                    <li>
                        <a class="btn btn-custom" href="admin/addCategory"> Thêm danh mục</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-custom">
            <table class="theme-table" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>
                        <th>Tên danh mục</th>
                        <th>Ảnh danh mục</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($dataCate as $cateItem) {
                    ?>
                        <tr>
                            <td>
                                <div class="table-image">
                                    <img src="public/images/category/<?php echo $cateItem['image'] ?>" class="img-fluid" alt="<?php echo $cateItem['name'] ?>">
                                </div>
                            </td>

                            <td><?php echo $cateItem['name'] ?></td>

                            <td>
                                <ul class="options">
                                    <li class="m-0 ">
                                        <a href="admin/updateCategory/<?php echo $cateItem['id'] ?>">
                                            <i class="edit fas fa-edit"></i>
                                        </a>
                                    </li>

                                    <li class="m-0 ">
                                        <a onclick="setDataIdToInput(this)" href="javascript:void(0)" data-id="<?php echo $cateItem['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteConfirm">
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
    function setDataIdToInput(link) {
        const dataId = link.getAttribute("data-id");
        document.getElementById("idCate").value = dataId;
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
                <p class="mb-0 text-center">The permission for the use/group, preview is inherited from the object, object will create a
                    new permission for this object</p>
            </div>
            <div class="modal-footer border-0 ">
                <form method="POST" action="admin/deleteCategory">
                    <input type="hidden" id="idCate" name="id" value="">
                    <button type="submit" class="btn btn-custom btn-yes fw-bold">Yes</button>
                </form>
                <div class="ms-3 ">
                    <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">No</button>
                </div>

            </div>
        </div>
    </div>
</div>