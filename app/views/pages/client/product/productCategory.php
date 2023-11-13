<?php
// echo '<pre>';
// print_r($_GET);
// echo '</pre>';

$priceSelect = array(
    ['title' => '0 đ - 1.000.000 đ', 'value' => '0 - 1000000'],
    ['title' => '1.000.000 đ - 5.000.000 đ', 'value' => '1000000 - 5000000'],
    ['title' => '5.000.000 đ - 12.000.000 đ', 'value' => '5000000 - 12000000'],
    ['title' => '12.000.000 đ - 25.000.000 đ', 'value' => '12000000 - 25000000'],
    ['title' => '25.000.000 đ - 48.000.000 đ', 'value' => '25000000 - 48000000'],
    ['title' => '48.000.000 đ - 80.000.000 đ', 'value' => '48000000 - 80000000'],
)
?>

<section class="product-area">
    <div class="container">
        <div class="shop-top">
            <form action="" id="form-prod-category" method="post">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="category-select">
                            <select class="niceSelect" name="cate_id">
                                <option value="">Danh mục</option>
                                <?php foreach ($dataCateList as $cateItem) : ?>
                                    <option value="<?php echo $cateItem['id'] ?>"><?php echo $cateItem['name'] ?></option>
                                <?php endforeach ?>

                            </select>


                            <select class="niceSelect" name="color">
                                <option value="">Màu sắc</option>
                                <?php foreach ($dataColor as $colorItem) : ?>
                                    <option><?php echo $colorItem['value'] ?></option>
                                <?php endforeach ?>
                            </select>

                            <select class="niceSelect" name="size">
                                <option value="">Dung lượng</option>
                                <?php foreach ($dataSize as $sizeItem) : ?>
                                    <option><?php echo $sizeItem['value'] ?></option>
                                <?php endforeach ?>
                            </select>


                            <select class="niceSelect" name="price">
                                <option value="">Khoảng giá</option>
                                <?php foreach ($priceSelect as $priceSelectItem) : ?>
                                    <option value="<?php echo $priceSelectItem['value'] ?>"><?php echo $priceSelectItem['title'] ?></option>
                                <?php endforeach ?>

                            </select>

                            <select class="niceSelect" name="order">
                                <option value="create_At - DESC">Mới nhất</option>
                                <option value="sold - DESC">Bán chạy nhất</option>
                                <option value="price - ASC">Giá: Thấp đến cao</option>
                                <option value="price - DESC">Giá: Cao đến thấp</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="filter-select">
                            <span class="me-3">
                                <button onclick="filterProdCate()" type="button" class="btn btn-custom">Áp dụng</button>
                            </span>
                            <span>
                                <a href="Product" class="btn btn-custom btn-bg-danger">Xoá tất cả</a>
                            </span>
                        </div>
                    </div>
            </form>

        </div>
    </div>

    <div class="main-product">
        <div id="main-product" class="row">


        </div>
    </div>



    </div>
</section>