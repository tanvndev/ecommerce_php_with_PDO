<?php
// echo '<pre>';
// print_r($dataValueOld);
// echo '</pre>';
?>
<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin mã giảm giá</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tiêu đề mã giảm giá <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="title" class="form-control input-text" value="<?= $dataValueOld['title'] ?? '' ?>" type="text" placeholder="Tiêu đề mã giảm giá" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mã <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="code" class="form-control input-text" value="<?= $dataValueOld['code'] ?? '' ?>" type="text" placeholder="Ex: CMT3304" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Giá trị mã (% hoặc VND) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="value" class="form-control input-text" value="<?= $dataValueOld['value'] ?? '' ?>" type="text" placeholder="Ex: 100000 hoặc 10%" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Giá tối thiểu <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="min_amount" class="form-control input-text" value="<?= $dataValueOld['min_amount'] ?? '' ?>" type="number" placeholder="Giá tối thiểu để áp dụng mã" required>
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Số lượng <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="quantity" class="form-control input-text" value="<?= $dataValueOld['quantity'] ?? '' ?>" type="number" placeholder="Số lượng sử dụng mã giảm giá" required>
                                </div>
                            </div>
                            <!--  -->


                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ngày hết hạn <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="expired" class="form-control input-text" value="<?= $dataValueOld['expired'] ?? '' ?>" type="datetime-local" placeholder="Ngày hết hạn" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ảnh mã giảm giá <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="thumb" class="form-control input-file" type="file" required>
                                </div>
                            </div>

                            <!--  -->
                        </div>
                    </div>
                </div>

                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto ">Thêm mã giảm giá mới <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>
        </form>
    </div>

</section>