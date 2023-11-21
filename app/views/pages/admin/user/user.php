<?php

// echo '<pre>';
// print_r($dataUser);
// echo '</pre>';
?>

<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách người dùng</h5>
            <div class="right-options">
                <ul>
                    <li>
                        <a class="btn btn-custom" href="admin/add-user">Thêm người dùng</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-custom">
            <table class="theme-table" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>

                        <th>Ảnh</th>
                        <th>Họ và tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Quyền</th>
                        <th>Chặn</th>
                        <th>Ngày tham gia</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($dataUserAd as $userItem) {
                    ?>
                        <tr>
                            <td>
                                <div class="table-image">
                                    <img style="width: 70px; height: 70px; object-fit: contain; border-radius: 50%;" src="<?= $userItem['avatar'] ?>" class="img-fluid" alt="<?= $userItem['fullname'] ?>">
                                </div>
                            </td>
                            <td class="fw-bold "><?= $userItem['fullname'] ?></td>
                            <td><?= $userItem['phone'] ?></td>
                            <td><?= $userItem['email'] ?></td>
                            <?php
                            foreach ($dataRole as $dataRoleItem) {
                                if ($dataRoleItem['id'] == $userItem['role_id']) {

                            ?>
                                    <td class="text-capitalize fw-bold "><?= $dataRoleItem['description'] ?></td>
                            <?php }
                            } ?>
                            <td>
                                <div>
                                    <label class="switch">
                                        <input id="isBlock" onchange="changeIsBlock(<?= $userItem['id'] ?>)" <?= $userItem['isBlock'] == 1 ? 'checked' : '' ?> value="1" type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </td>

                            <td><?= date('F j, Y, g:i a', strtotime($userItem['create_At'])) ?></td>

                            <td>
                                <ul class="options">
                                    <li class="m-0 ">
                                        <a href="admin/update-user/<?= $userItem['id'] ?>">
                                            <i class="edit fas fa-edit"></i>
                                        </a>
                                    </li>

                                    <li class="m-0 ">
                                        <a onclick="setDataIdToInput(<?= $userItem['id'] ?>, <?= $userItem['role_id'] ?>)" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteConfirm">
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
    function setDataIdToInput(id, role_id) {
        $("#idUser").val(id);
        $("#role_id").val(role_id)
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
                <form method="POST" action="admin/delete-user">
                    <input type="hidden" id="idUser" name="id">
                    <input type="hidden" id="role_id" name="role_id">
                    <button type="submit" class="btn btn-custom btn-yes fw-bold">Đồng ý</button>
                </form>
                <div class="ms-3 ">
                    <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ</button>
                </div>

            </div>
        </div>
    </div>
</div>