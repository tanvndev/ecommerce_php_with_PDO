<?php

// echo '<pre>';
// print_r($dataBrand);
// echo '</pre>';
?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách thương hiệu</h5>
            <div class="right-options">
                <ul>
                    <li>
                        <button data-bs-toggle="modal" data-bs-target="#addBrand" class="btn btn-custom">Thêm thương hiệu</button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-custom">
            <table class="theme-table" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>
                        <th>Tên thương hiệu</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($dataBrand as $brandItem) {
                    ?>
                        <tr>
                            <td><?php echo $brandItem['name'] ?></td>

                            <td>
                                <ul class="options">
                                    <li class="m-0 ">
                                        <a onclick="updateBrand(<?php echo $brandItem['id'] ?>)" data-bs-toggle="modal" data-bs-target="#updateBrand" href="javascript:void(0)">
                                            <i class="edit fas fa-edit"></i>
                                        </a>
                                    </li>

                                    <li class="m-0 ">
                                        <a onclick="setDataIdToInput(<?php echo $brandItem['id'] ?>)" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteConfirm">
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
        $("#idBrand").val(id);
    }

    function updateBrand(id) {
        $.get(`admin/brand/getOneBrandApi/${id}`, (data) => {
            const dataBrand = JSON.parse(data)
            $('#brandName').val(dataBrand.name);
            $('#idBrandVal').val(dataBrand.id);
        })
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
                <form method="POST" action="admin/brand/deleteBrand">
                    <input type="hidden" id="idBrand" name="id">
                    <button type="submit" class="btn btn-custom btn-yes fw-bold">Đồng ý</button>
                </form>
                <div class="ms-3 ">
                    <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ</button>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade theme-modal" id="addBrand" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content py-3">
            <div class="modal-header border-0  d-block text-center">
                <h5 class="modal-title w-100 mb-5 fs-1 ">Thêm thương hiệu mới</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="admin/brand/addBrand" method="POST">
                <div class="modal-body add-wrap-admin">
                    <div class="form-input">
                        <div class="mb-5 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Tên thương hiệu</label>
                            <div class="col-sm-9">
                                <input name="name" class="form-control input-text" type="text" placeholder="Tên thương hiệu " required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 ">
                    <div class="ms-3 ">
                        <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ bỏ</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-custom btn-yes fw-bold">Thêm mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade theme-modal" id="updateBrand" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content py-3">
            <div class="modal-header border-0  d-block text-center">
                <h5 class="modal-title w-100 mb-5 fs-1 ">Cập nhập thương hiệu</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="admin/brand/updateBrand" method="POST">
                <div class="modal-body add-wrap-admin">
                    <div class="form-input">
                        <div class="mb-5 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Tên thương hiệu</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" id="idBrandVal">
                                <input name="name" id="brandName" class="form-control input-text" type="text" placeholder="Tên thương hiệu" required>
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