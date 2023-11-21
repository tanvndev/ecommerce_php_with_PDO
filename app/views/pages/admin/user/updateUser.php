<section class="add-wrap-admin">

    <div class="container-fluid ">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin user</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Họ và tên <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="fullname" value="<?= $dataUserUp['fullname'] ?>" class="form-control input-text" type="text" placeholder="Họ và tên">
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Email <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="email" value="<?= $dataUserUp['email'] ?>" class="form-control input-text" type="email" placeholder="Email">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Số điện thoại <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="phone" value="<?= $dataUserUp['phone'] ?>" class="form-control input-text" type="text" placeholder="Số điện thoại">
                                </div>
                            </div>



                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mật khẩu <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="password" value="<?= $dataUserUp['password'] ?>" class="form-control input-text" type="password" placeholder="Mật khẩu">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Xác nhận mật khẩu <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="re_password" value="<?= $dataUserUp['password'] ?>" class="form-control input-text" type="password" placeholder="Xác nhận mật khẩu">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <textarea placeholder="Địa chỉ" class="form-control input-text" name="address" rows="3"><?= $dataUserUp['address'] ?></textarea>
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ảnh đại diện</label>
                                <div class="col-sm-9">
                                    <input name="avatar" class="form-control input-file" type="file">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Chặn</label>
                                <div class="col-sm-9">
                                    <label class="switch">
                                        <input name="isBlock" <?= $dataUserUp['isBlock'] == 1 ? 'checked' : '' ?> value="1" type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Quyền</label>

                                <div class="col-sm-9">
                                    <div class="d-flex flex-wrap gap-4">
                                        <?php
                                        foreach ($dataRole as $value) :
                                            $checkedRole = $value['id'] == $dataUserUp['role_id'] ? 'checked' : '';

                                        ?>
                                            <div class="form-check">
                                                <input <?= $checkedRole ?> class="form-check-input" value="<?= $value['id'] ?>" type="radio" name="role_id" id="<?= $value['name'] ?>">
                                                <label class="form-check-label text-capitalize " for="<?= $value['name'] ?>">
                                                    <?= $value['description'] ?>
                                                </label>
                                            </div>
                                        <?php endforeach ?>
                                    </div>

                                </div>
                            </div>




                        </div>
                    </div>
                </div>
                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto ">Cập nhập người dùng <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>
        </form>
    </div>

</section>