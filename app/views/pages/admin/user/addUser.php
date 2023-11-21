<?php
// echo '<pre>';
// print_r($dataRole);
// echo '</pre>';
?>
<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin người dùng</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Họ và tên <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="fullname" value="<?= $dataValueOld['fullname'] ?? '' ?>" class="form-control input-text" type="text" placeholder="Họ và tên">
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Email <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="email" value="<?= $dataValueOld['email'] ?? '' ?>" class="form-control input-text" type="email" placeholder="Email ">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mật khẩu <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="password" value="<?= $dataValueOld['password'] ?? '' ?>" class="form-control input-text" type="password" placeholder="Mật khẩu">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Xác nhận mật khẩu <span class="text-danger ">*</span></label>
                                <div class="col-sm-9">
                                    <input name="re_password" value="<?= $dataValueOld['re_password'] ?? '' ?>" class="form-control input-text" type="password" placeholder="Xác nhận mật khẩu">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Phân quyền</label>


                                <div class="col-sm-9">
                                    <div class="d-flex flex-wrap gap-4">
                                        <?php
                                        foreach ($dataRole as $value) :
                                        ?>
                                            <div class="form-check">
                                                <input class="form-check-input" value="<?= $value['id'] ?>" type="radio" name="role_id" id="<?= $value['name'] ?>">
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
                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto ">Thêm người dùng mới <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>
        </form>
    </div>

</section>