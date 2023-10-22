<?php
$variants = array(
    ['value' => 'Size'],
    ['value' => 'Color']
);
?>

<section class="add-wrap-admin">
    <div class="container-fluid ">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thông tin thuộc thính</h5>

                        </div>
                        <div class="form-input">
                            <input type="hidden" value="<?php echo $dataAttribute['id'] ?>">
                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Tên thuộc tính</label>

                                <div class="col-sm-9">
                                    <select class="select-custom" name="name" id="select-custom">
                                        <?php foreach ($variants as $variant) { ?>
                                            <option <?php echo $dataAttribute['name'] == $variant['value'] ? 'selected' : '' ?> value="<?php echo $variant['value'] ?>"><?php echo $variant['value'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--  -->

                            <div class="mb-5 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Giá trị thuộc tính</label>
                                <div class="col-sm-9">
                                    <input name="value" value="<?php echo $dataAttribute['value'] ?>" class="form-control input-text" type="text" placeholder="Attribute value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-custom col-sm-8 m-auto ">Cập nhập thuộc tính</button>
            </div>
        </form>
    </div>

</section>