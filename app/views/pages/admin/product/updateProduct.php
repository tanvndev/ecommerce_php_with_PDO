<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin sản phẩm</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên sản phẩm<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control input-text" value="<?= $dataProd['title'] ?? '' ?>" name="title" type="text" placeholder="Tên sản phẩm" required>
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Danh mục <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="select-custom" name="cate_id" id="select-custom" required>
                                        <?php
                                        foreach ($cateData as $cateItem) {
                                            $dataOldCate = $dataProd['cate_id'] ?? '';
                                            $selectedCate = $cateItem['id'] == $dataOldCate ?? '' ? 'selected' : '';
                                        ?>
                                            <option <?= $selectedCate  ?> value="<?= $cateItem['id'] ?>"><?= $cateItem['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Thương hiệu <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="select-custom" name="brand_id" id="select-custom2" required>

                                        <?php
                                        foreach ($brandData as $brandItem) {
                                            $dataOldBrand = $dataProd['brand_id'] ?? '';
                                            $selectedBrand = $brandItem['id'] == $dataOldBrand ? 'selected' : '';
                                        ?>
                                            <option <?= $selectedBrand  ?> value="<?= $brandItem['id'] ?>"><?= $brandItem['name'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Số lượng <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control input-text" value="<?= $dataProd['quantity'] ?? '' ?>" name=" quantity" type="number" placeholder="Số lượng" required>
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Giá <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control input-text" value="<?= $dataProd['price'] ?? '' ?>" name=" price" type="number" placeholder="Giá sản phẩm" required>
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Giá sale</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-text" value="<?= $dataProd['price_sale'] ?? '' ?>" name=" sale_price" type="number" placeholder="Giá sale">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Hiển thị</label>
                                <div class="col-sm-9">
                                    <label class="switch">
                                        <input name="status" <?= $dataProd['status'] == 1 ? 'checked' : '' ?> value="1" type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>



                <!-- Variant -->
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Biến thể sản phẩm</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Biến thể</label>
                                <div class="col-sm-9">
                                    <div class="d-flex align-items-center justify-content-between ">
                                        <label class="switch">
                                            <input name="isVariant" <?= $dataProd['isVariant'] == 1 ? 'checked' : '' ?> value="1" type="checkbox">
                                            <span class="slider"></span>
                                        </label>
                                        <a class="attribute-view" href="admin/product-variants/<?= $dataProd['id'] ?>">Xem biến thể <i class="far fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->

                    </div>
                </div>




                <!-- description -->
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Mô tả </h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row ">
                                <label class="form-label-title col-sm-3 mb-0">Mô tả ngắn </label>
                                <div class="col-sm-9">
                                    <textarea name="short_description" class="ckEditor"><?= $dataProd['short_description'] ?? '' ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-input">
                            <div class="mb-5 row ">
                                <label class="form-label-title col-sm-3 mb-0">Mô tả sản phẩm</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="ckEditor"><?= $dataProd['description'] ?? '' ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Images -->
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Ảnh sản phẩm (extend file .jpg | .png | .jpeg | .webp & file < 5MB)</h5>
                        </div>
                        <div class="form-input">
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Thumbnail (1 ảnh) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="thumb" class="form-control input-file" type="file">
                                </div>
                            </div>

                            <div class="mb-5 row align-items-center">
                                <?php
                                if ($dataProd['thumb'] == '2004') {
                                ?>
                                    <span class="text-center ">Chưa có ảnh..</span>
                                <?php } else { ?>
                                    <div class="images_thumb">
                                        <div class="position-relative">
                                            <img src="<?= $dataProd['thumb'] ?>" alt="<?= $dataProd['title'] ?>">
                                            <a class="icon-link" href="admin/delete-product-thumb/<?= $dataProd['id'] ?>">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ảnh (N ảnh) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control input-file" name="images[]" type="file" multiple>
                                </div>
                            </div>

                            <div class="mb-5 row align-items-center">
                                <?php
                                if (empty($prodImages)) {
                                ?>
                                    <span class="text-center ">Chưa có ảnh..</span>
                                <?php } else { ?>
                                    <div class="images_thumb">
                                        <?php foreach ($prodImages as $prodImagesItem) : ?>
                                            <div class="position-relative">
                                                <img src="<?= $prodImagesItem['image'] ?>" alt="<?= $dataProd['title'] ?>">
                                                <a class="icon-link" href="admin/delete-product-image/<?= $prodImagesItem['id'] . '/' . $dataProd['id'] ?>">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Price -->

                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto">Cập nhập sản phẩm <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>


        </form>
    </div>

</section>