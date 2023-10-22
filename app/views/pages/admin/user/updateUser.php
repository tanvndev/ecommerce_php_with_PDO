<section class="add-wrap-admin">

    <div class="container-fluid ">
        <form action="" method="POST" enctype="multipart/form-data">
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
                                    <input name="fullname" value="<?php echo $dataUserUp['fullname'] ?>" class="form-control input-text" type="text" placeholder="Họ và tên">
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Email <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="email" value="<?php echo $dataUserUp['email'] ?>" class="form-control input-text" type="email" placeholder="Email">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Số điện thoại <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="phone" value="<?php echo $dataUserUp['phone'] ?>" class="form-control input-text" type="text" placeholder="Số điện thoại">
                                </div>
                            </div>



                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mật khẩu <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="password" value="<?php echo $dataUserUp['password'] ?>" class="form-control input-text" type="password" placeholder="Mật khẩu">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Xác nhận mật khẩu <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="re_password" value="<?php echo $dataUserUp['password'] ?>" class="form-control input-text" type="password" placeholder="Xác nhận mật khẩu">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <textarea placeholder="Địa chỉ" class="form-control input-text" name="address" rows="3"><?php echo $dataUserUp['address'] ?></textarea>
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
                                        <input name="isBlock" <?php echo $dataUserUp['isBlock'] == 1 ? 'checked' : '' ?> value="1" type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Quyền</label>
                                <div class="col-sm-9">
                                    <div class="d-flex flex-wrap gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" <?php echo $dataUserUp['role'] == 1 ? 'checked' : '' ?> value="1" type="radio" name="role" id="admin">
                                            <label class="form-check-label" for="admin">
                                                Người quản trị
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" <?php echo $dataUserUp['role'] == 2 ? 'checked' : '' ?> value="2" type="radio" name="role" id="customer">
                                            <label class="form-check-label" for="customer">
                                                Người dùng
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>




                        </div>
                    </div>
                </div>
                <button class="btn btn-custom col-sm-8 m-auto ">Update product</button>
            </div>
        </form>
    </div>

</section>