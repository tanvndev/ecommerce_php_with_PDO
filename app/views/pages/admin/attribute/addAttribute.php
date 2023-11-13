<?php

?>

<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin thuộc tính</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên thuộc tính <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="name" value="<?= $dataValueOld['name'] ?? '' ?>" class="form-control input-text" type="text" placeholder="Tên thuộc tính không bằng tiếng việt">
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên hiển thị <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="display_name" value="<?= $dataValueOld['display_name'] ?? '' ?>" class="form-control input-text" type="text" placeholder="Màu sắc, kích kích thước, ...">
                                </div>
                            </div>

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Giá trị thuộc tính </label>
                                <div class="col-sm-9">
                                    <input name="value_name" value="<?= $dataValueOld['value_name'] ?? '' ?>" class="form-control input-text" type="text" placeholder="Thêm nhiều cách nhau bởi dấu ','. Ex: Màu đỏ, Màu xanh,...">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <button class="btn btn-custom col-sm-8 m-auto">Thêm thuộc tính mới </button>
            </div>
        </form>
    </div>


</section>