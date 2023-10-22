<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form action="admin/updateProduct/<?php echo $prod['id'] ?>" method="POST" enctype="multipart/form-data">
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
                                    <input type="hidden" name="id">
                                    <input class="form-control input-text" value="<?php echo $prod['title'] ?>" name="title" type="text" placeholder="Tên sản phẩm">
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Danh mục <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="select-custom" name="cate_id" id="select-custom">
                                        <?php
                                        foreach ($cateData as $cateItem) {
                                        ?>
                                            <option <?php echo $prod['cate_id'] == $cateItem['id'] ? 'selected' : '' ?> value="<?php echo $cateItem['id'] ?>"><?php echo $cateItem['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Thương hiệu <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select class="select-custom" name="brand_id" id="select-custom2">
                                        <?php
                                        foreach ($brandData as $brandItem) {
                                        ?>
                                            <option <?php echo $prod['brand_id'] == $brandItem['id'] ? 'selected' : '' ?> value="<?php echo $brandItem['id'] ?>"><?php echo $brandItem['name'] ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Cân nặng (gram)</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-text" value="<?php echo $prod['weight'] ?>" name="weight" type="text" placeholder="Cân nặng">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Số lượng <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control input-text" value="<?php echo $prod['quantity'] ?>" name="quantity" type="number" placeholder="Số lượng">
                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Trạng thái</label>
                                <div class="col-sm-9">
                                    <label class="switch">
                                        <input name="status" <?php echo $prod['status'] == 1 ? 'checked' : '' ?> value="1" type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>


                <!-- Price -->
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Giá sản phẩm</h5>

                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Giá <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control input-text" id="price" value="<?php echo $prod['price'] ?>" type="number" placeholder="Giá ">
                                </div>
                            </div>
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Giảm giá</label>
                                <div class="col-sm-7">
                                    <input class="form-control input-text" id="discount" value="<?php echo $prod['discount'] ?>" name="discount" type="number" placeholder="Giảm giá">
                                </div>
                                <div class="col-sm-2">
                                    <span>Tối đa: 99%</span>
                                </div>
                            </div>
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Thành tiền</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-text" id="price_new" value="<?php echo $prod['price'] ?>" readonly name="price" type="number" placeholder="Thành tiền">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Variant -->
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thuộc tính sản phẩm</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row">
                                <label class="form-label-title col-sm-2 mb-0">Màu sắc <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="d-flex flex-wrap gap-4">
                                        <?php
                                        foreach ($colorData as $color) {
                                            $isCheckedColor = in_array($color['id'], $selectedId)
                                        ?>
                                            <div class="form-check">
                                                <input <?php echo $isCheckedColor ? 'checked' : '' ?> class="form-check-input" name="attribute_id[]" type="checkbox" value="<?php echo $color['id'] ?>" id="<?php echo $color['name'] . '_' . $color['value']  ?>">

                                                <label class="form-check-label  text-uppercase " for="<?php echo $color['name'] . '_' . $color['value']  ?>">
                                                    <?php echo $color['value'] ?>
                                                </label>
                                            </div>
                                        <?php } ?>


                                    </div>

                                </div>
                            </div>

                            <!--  -->
                            <div class="mb-5 row">
                                <label class="form-label-title col-sm-2 mb-0">Dung lượng <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="d-flex flex-wrap gap-4">
                                        <?php
                                        foreach ($sizeData as $size) {
                                            $isCheckedSize = in_array($size['id'], $selectedId)
                                        ?>
                                            <div class="form-check">
                                                <input <?php echo $isCheckedSize ? 'checked' : '' ?> class="form-check-input" name="attribute_id[]" type="checkbox" value="<?php echo $size['id'] ?>" id="<?php echo $size['name'] . '_' . $size['value']  ?>">

                                                <label class="form-check-label  text-uppercase " for="<?php echo $size['name'] . '_' . $size['value']  ?>">
                                                    <?php echo $size['value'] ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- description -->
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Mô tả</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row ">
                                <label class="form-label-title col-sm-3 mb-0">Mô tả sản phẩm</label>
                                <div class="col-sm-9">
                                    <textarea name="description" id="editor"><?php echo $prod['description'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Images -->
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Ảnh sản phẩm</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Thumbnail (1 ảnh)</label>
                                <div class="col-sm-9">
                                    <input name="thumb" class="form-control input-file" type="file">
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ảnh (N ảnh)</label>
                                <div class="col-sm-9">
                                    <input class="form-control input-file" name="images[]" type="file" multiple>
                                </div>
                            </div>
                            <!--  -->



                        </div>
                    </div>
                </div>

                <!-- Product Price -->


                <button class="btn btn-custom col-sm-8 m-auto ">Update now</button>
            </div>
        </form>
    </div>

</section>