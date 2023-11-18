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
                            <h5>Thông tin bài viết</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tiêu đề bài viết <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="title" class="form-control input-text" value="<?= $dataValueOld['title'] ?? '' ?>" type="text" placeholder="Tiêu đề bài viết" required>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Ảnh bài viết <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="thumb" class="form-control input-file" type="file" required>
                                </div>
                            </div>
                            <!--  -->
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Hiển thị</label>
                                <div class="col-sm-9">
                                    <label class="switch">
                                        <?php
                                        $status = $dataValueOld['status'] ?? '';
                                        $checkedStatus = $status == 1 ? 'checked' : '';
                                        ?>
                                        <input name="status" <?= $checkedStatus ?> value="1" type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Nội dung bài viết</h5>
                        </div>
                        <div class="form-input">
                            <div class="mb-5 row ">
                                <label class="form-label-title col-sm-3 mb-0">Nội dung bài viết <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea name="content" class="ckEditor"><?= $dataValueOld['content'] ?? '' ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto ">Thêm bài viết mới <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>
        </form>
    </div>

</section>