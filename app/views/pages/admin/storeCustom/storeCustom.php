<?php
// echo '<pre>';
// print_r($dataStoreCustom);
// echo '</pre>';
?>
<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin cửa hàng</h5>
                        </div>
                        <div class="form-input">

                            <input type="hidden" name="store_id" value="<?= $dataStoreCustom['id'] ?? '' ?>">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên của hàng<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="name" class="form-control input-text" value="<?= $dataStoreCustom['name'] ?? '' ?>" type="text" placeholder="Tên của hàng" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Địa chỉ cửa hàng<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control input-text" name="address" cols="1" rows="3"><?= $dataStoreCustom['address'] ?? '' ?></textarea>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Số điện thoại<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="phone" class="form-control input-text" value="<?= $dataStoreCustom['phone'] ?? '' ?>" type="tel" placeholder="Số điện thoại" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Email cửa hàng<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="email" class="form-control input-text" value="<?= $dataStoreCustom['email'] ?? '' ?>" type="email" placeholder="Email cửa hàng" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Giờ mở cửa<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="open_time" class="form-control input-text" value="<?= $dataStoreCustom['open_time'] ?? '' ?>" type="text" placeholder="Giờ mở cửa" required>
                                </div>
                            </div>
                            <!--  -->


                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Logo của hàng<span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <input name="logo" class="form-control input-file" type="file">
                                </div>

                                <div class="col-sm-3">
                                    <img class="img-review" src="<?= $dataStoreCustom['logo'] ?? '' ?>" alt="<?= 'image ' . $dataStoreCustom['name'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin banner</h5>
                        </div>
                        <div class="form-input">
                            <input type="hidden" name="banner_id" value="<?= $dataBanner['id'] ?? '' ?>">

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tiêu đề banner<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="title" class="form-control input-text" value="<?= $dataBanner['title'] ?? '' ?>" type="text" placeholder="Tiêu đề banner" required>
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Mô tả banner<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="description" class="form-control input-text" value="<?= $dataBanner['description'] ?? '' ?>" type="text" placeholder="Mô tả banner" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Danh mục <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="select-custom" name="cate_id" id="select-custom" required>
                                        <?php
                                        foreach ($dataCate as $cateItem) {
                                            $idCategory = $dataBanner['cate_id'] ?? '';

                                            $selectedCate = $cateItem['id'] == $idCategory ?? '' ? 'selected' : '';
                                        ?>
                                            <option <?= $selectedCate  ?> value="<?= $cateItem['id'] ?>"><?= $cateItem['name'] ?></option>
                                        <?php } ?>

                                    </select>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto ">Cập nhập thông tin cửa hàng <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>
        </form>
    </div>

</section>