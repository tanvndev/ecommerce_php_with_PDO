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
                                    <input name="name" value="<?= $dataAttribute['name'] ?? '' ?>" class="form-control input-text" type="text" placeholder="Tên thuộc tính không bằng tiếng việt">
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên hiển thị <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="display_name" value="<?= $dataAttribute['display_name'] ?? '' ?>" class="form-control input-text" type="text" placeholder="Màu sắc, kích kích thước, ...">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto ">Cập nhập thuộc tính <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>
        </form>
    </div>

</section>