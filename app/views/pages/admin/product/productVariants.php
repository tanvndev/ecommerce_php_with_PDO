<?php
// echo '<pre>';
// print_r($dataProdVariants);
// echo '</pre>';
?>
<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form method="POST">
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
                                    <input class="form-control input-text" value="<?= $dataProd['title'] ?? '' ?>" type="text" placeholder="Tên sản phẩm" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Variant -->
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <div class="d-flex align-items-start  justify-content-between ">
                                <h5>Biến thể sản phẩm</h5>
                                <a class="btn btn-custom variant" href="admin/add-product-variants/<?= $dataProd['id'] ?>">Thêm biến thể mới</a>
                            </div>
                        </div>
                        <div class="form-input">
                            <?php
                            if (empty($dataProdVariants)) {
                            ?>
                                <span class="text-center d-block ">Chưa có biến thể..</span>
                                <?php
                            } else {
                                foreach ($dataProdVariants as $item) :
                                ?>
                                    <div class="form-input-item">
                                        <input type="hidden" name="product_variants_id[]" value="<?= $item['id'] ?>">
                                        <input type="hidden" name="discount[]" value="<?= $item['discount'] ?>">

                                        <div class="mb-5 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Kết hợp</label>
                                            <div class="col-sm-9">
                                                <input class="form-control input-text" value="<?= $item['attribute_values'] ?>" type="text" placeholder="Kết hợp" disabled readonly>
                                            </div>
                                        </div>

                                        <div class="mb-5 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Số lượng <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control input-text" name="quantity_variant[]" type="number" value="<?= $item['quantity'] ?>" placeholder="Số lượng" required>
                                            </div>
                                        </div>


                                        <!--  -->
                                        <div class="mb-5 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Giá <span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control input-text" name="price_variant[]" type="number" value="<?= $item['price'] ?>" placeholder="Giá sản phẩm" required>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="mb-5 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Giá sale</label>
                                            <div class="col-sm-9">
                                                <input class="form-control input-text" name="sale_price_variant[]" type="number" placeholder="Giá sale">
                                            </div>
                                        </div>
                                        <div class="del-variant">
                                            <button type="button" onclick="deleteProduct(<?= $item['id'] ?>)" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#deleteConfirm">Xoá biến thể</button>


                                        </div>
                                    </div>
                            <?php endforeach;
                            } ?>

                        </div>
                        <!--  -->

                    </div>
                </div>

                <?php
                if (!empty($dataProdVariants)) {
                ?>
                    <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto">Cập nhập biến thể <span class="spin"><i class="fas fa-spinner"></i></span></button>
                <?php } else { ?>
                    <button class="btn disabled btn-custom col-sm-8 m-auto">Vui lòng thêm biến thể<span class="spin"><i class="fas fa-spinner"></i></span></button>
                <?php
                } ?>
            </div>


        </form>
    </div>
</section>

<script>
    function deleteProduct(id) {
        $('#idDel').val(id);
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
                <form action="admin/delete-product-variant/<?= $dataProd['id'] ?>" method="post">
                    <input id="idDel" name="id" type="hidden">
                    <button type="submit" class="btn btn-custom btn-yes fw-bold">Đồng ý</button>
                </form>
                <div class="ms-3 ">
                    <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ</button>
                </div>

            </div>
        </div>
    </div>
</div>