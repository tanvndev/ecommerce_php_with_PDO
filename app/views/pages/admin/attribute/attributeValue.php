<?php
// echo '<pre>';
// print_r($dataAttributeValue);
// echo '</pre>';

?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách giá trị thuộc tính</h5>
            <div class="right-options">
                <ul>
                    <li>
                        <button data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-custom">Thêm giá trị thuộc tính</button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-custom">
            <table class="theme-table" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>
                        <th>Tên thuộc tính</th>
                        <th>Giá trị</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($dataAttributeValue as $dataAttributeValueItem) {
                        extract($dataAttributeValueItem)
                    ?>
                        <tr>

                            <td class="text-capitalize"><?= $name ?></td>
                            <td class="fw-bold "><?= $value_name ?></td>


                            <td>
                                <ul class="options">
                                    <li class="m-0 ">
                                        <a href="javascript:void(0)" onclick="update(<?= $id ?>)">
                                            <i class="edit fas fa-edit"></i>
                                        </a>
                                    </li>

                                    <li class="m-0 ">
                                        <a onclick="setDataIdToInput(<?= $id ?>)" href="javascript:void(0)" data-id="<?= $attributeItem['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteConfirm">
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
        $("#idData").val(id);
    }

    function modalUpdate(data) {
        return `
        <div class="modal fade theme-modal" id="modalUpdate" aria-hidden="true" tabindex="-1">
              <div class="modal-dialog modal-lg">
        <div class="modal-content py-3">
            <div class="modal-header border-0  d-block text-center">
                <h5 class="modal-title w-100 mb-5 fs-1 ">Cập nhập giá trị thuộc tính </h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="admin/attributes/updateAttributeValue" method="POST">
                <div class="modal-body add-wrap-admin">
                    <div class="form-input">
                        <div class="mb-5 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Giá trị thuộc tính <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" value="${data.id}">
                                <input type="hidden" name="attribute_id" value="${data.attribute_id}">
                                <input name="value_name" value="${data.value_name}" class="form-control input-text" type="text" placeholder="Giá trị thuộc tính" required>
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
    `
    }

    async function update(id) {
        try {
            const response = await fetch(`admin/attributes/getOneAttributeValueApi/${id}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();

            if (data.code == 200) {

                $('#modalUpdate').remove();
                $('body').append(modalUpdate(data.data));
                $('#modalUpdate').modal('show');
            }
        } catch (error) {
            console.error(error);
        }
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
                <form method="POST" action="admin/attributes/deleteAttributeValue">
                    <input type="hidden" id="idData" name="id">
                    <input type="hidden" name="attribute_id" value="<?= $attribute_id ?>">
                    <button type="submit" class="btn btn-custom btn-yes fw-bold">Đồng ý</button>
                </form>
                <div class="ms-3 ">
                    <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade theme-modal" id="addModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content py-3">
            <div class="modal-header border-0  d-block text-center">
                <h5 class="modal-title w-100 mb-5 fs-1 ">Thêm giá trị thuộc tính mới</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="admin/attributes/addAttributeValue" method="POST">
                <div class="modal-body add-wrap-admin">
                    <div class="form-input">
                        <div class="mb-5 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Giá trị thuộc tính <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="hidden" name="attribute_id" value="<?= $attribute_id ?>">
                                <input name="value_name" class="form-control input-text" type="text" placeholder="Thêm nhiều cách nhau bởi dấu ','. Ex: Màu đỏ, Màu xanh,..." required>
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