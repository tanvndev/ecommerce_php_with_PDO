<?php
// echo '<pre>';
// print_r($dataProdVariants);
// echo '</pre>';
?>
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
                                    <input class="form-control input-text" value="<?= $dataProd['title'] ?? '' ?>" type="text" placeholder="Tên sản phẩm" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Attribute -->
                <div class="col-sm-8 m-auto ">
                    <div class="card">
                        <div class="card-title-top">
                            <h5>Thuộc tính sản phẩm</h5>
                        </div>
                        <div class="form-input">
                            <?php
                            foreach ($attributeData as $attributeItem) {
                            ?>
                                <div class="mb-5 row">
                                    <label class="form-label-title col-sm-2 mb-0"> <?= $attributeItem['name'] . ' (' . $attributeItem['display_name'] . ')' ?></label>
                                    <div class="col-sm-10">
                                        <div class="d-flex flex-wrap gap-4">
                                            <?php foreach ($attributeValueData as $attributeValueItem) {
                                                if ($attributeItem['id'] == $attributeValueItem['attribute_id']) {
                                            ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="attribute_id_<?= $attributeItem['name'] ?>" type="radio" value="<?= $attributeItem['id'] . '-' . $attributeValueItem['id'] . ' (' . $attributeValueItem['value_name'] . ') ' ?>" id="<?= $attributeValueItem['id'] ?>">

                                                        <label class="form-check-label text-uppercase " for="<?= $attributeValueItem['id'] ?>">
                                                            <?= $attributeValueItem['value_name'] ?>
                                                        </label>
                                                    </div>
                                            <?php }
                                            } ?>

                                        </div>

                                    </div>
                                </div>
                            <?php } ?>

                            <div class="btn-variant">
                                <button id="add-variant" type="button"> <i class="fa fa-plus"></i> Tạo ra biến thể </button>
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
                            <div id="form-variant">
                                <span id="no-variant" class="text-center d-block ">Chưa có biến thể..</span>
                            </div>
                        </div>
                        <!--  -->

                    </div>
                </div>

                <button id="btn_ele" class="btn btn-custom col-sm-8 m-auto">Thêm biến thể <span class="spin"><i class="fas fa-spinner"></i></span></button>
            </div>


        </form>
    </div>
</section>


<script>
    let itemCounter = 1;
    $('#add-variant').click(() => {
        $('#no-variant').remove()
        let selectedAttributes = $('input[type="radio"]:checked');
        let attributeData = generateCombinations(selectedAttributes);

        //Lay ra id cua attribute and value attribute
        let attributeValue = attributeData.match(/\d+-\d+/g).join(', ');
        //Ten value attribute
        let nameValueAttribute = attributeData.match(/\(\s*([^)]+?)\s*\)/g).join(', ');


        const newVariant = `
        <div id="form-input-item-${itemCounter}" class="form-input-item">
                                    <div class="mb-5 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Ảnh</label>
                                        <div class="col-sm-9">
                                            <input class="form-control input-file" name="images[]" type="file" multiple>
                                        </div>
                                    </div>

                                    <div class="mb-5 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Kết hợp</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="attribute[]" value="${attributeValue}">
                                            <input class="form-control input-text" value="${nameValueAttribute}" type="text" placeholder="Kết hợp" disabled readonly>
                                        </div>
                                    </div>

                                    <div class="mb-5 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Số lượng <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control input-text" name="quantity_variant[]" type="number" placeholder="Số lượng" required>
                                        </div>
                                    </div>


                                    <!--  -->
                                    <div class="mb-5 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Giá <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control input-text" name="price_variant[]" type="number" placeholder="Giá sản phẩm" required>
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
                                        <button onclick="delItemVariant('form-input-item-${itemCounter}')" type="button" class="btn btn-custom">Xoá biến thể</button>
                                    </div>
                                </div>
              `
        itemCounter++


        $('#form-variant').append(newVariant)
    })


    function generateCombinations(attributes) {
        var combinations = [
            []
        ];

        attributes.each(function() {
            var attributeValues = $(this).val().split(' ');
            var firstValue = attributeValues.shift();

            if (attributeValues.length > 0) {
                firstValue = [firstValue, attributeValues.join(' ')].join(' ');
            }

            var currentCombinations = [];

            combinations.forEach(function(combination) {
                currentCombinations.push(combination.concat(firstValue));
            });

            combinations = currentCombinations;
        });

        return combinations.join(' , ');
    }


    const delItemVariant = (idName) => {
        const itemEle = $(`#${idName}`)
        itemEle.remove();
    }
</script>