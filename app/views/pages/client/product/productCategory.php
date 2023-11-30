<?php
// echo '<pre>';
// print_r($dataBrand);
// echo '</pre>';

$priceSelect = array(
    ['title' => 'Dưới 2 triệu', 'value' => '0 - 2000000'],
    ['title' => 'Từ 2 - 4 triệu', 'value' => '2000000 - 4000000'],
    ['title' => 'Từ 4 - 7 triệu', 'value' => '4000000 - 7000000'],
    ['title' => 'Từ 7 - 13 triệu', 'value' => '7000000 - 13000000'],
    ['title' => 'Từ 13 - 20 triệu', 'value' => '13000000 - 20000000'],
    ['title' => 'Từ 20 - 32 triệu', 'value' => '20000000 - 32000000'],
    ['title' => 'Trên 32 triệu', 'value' => '32000000 - 8000000000'],
)
?>


<section class="product-area">
    <div class="container">
        <div class="shop-top">
            <form id="form-prod-category" method="post">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="category-select">
                            <select class="niceSelect product-filter-select" name="category">
                                <option value="">Danh mục</option>
                                <?php foreach ($dataCateList as $cateItem) : ?>
                                    <option value="<?= $cateItem['id'] ?>"><?= $cateItem['name'] ?></option>
                                <?php endforeach ?>

                            </select>


                            <select class="niceSelect product-filter-select" name="brand">
                                <option value="">Thương hiệu</option>
                                <?php foreach ($dataBrand as $brandItem) : ?>
                                    <option value="<?= $brandItem['id'] ?>"><?= $brandItem['name'] ?></option>
                                <?php endforeach ?>
                            </select>


                            <select class="niceSelect product-filter-select" name="price">
                                <option value="">Khoảng giá</option>
                                <?php foreach ($priceSelect as $priceSelectItem) : ?>
                                    <option value="<?= $priceSelectItem['value'] ?>"><?= $priceSelectItem['title'] ?></option>
                                <?php endforeach ?>

                            </select>

                            <select class="niceSelect product-filter-select" name="sort">
                                <option value="-create_at">Mới nhất</option>
                                <option value="-sold">Bán chạy nhất</option>
                                <option value="price">Giá: Thấp đến cao</option>
                                <option value="-price">Giá: Cao đến thấp</option>
                            </select>
                            <input id="limit-product-filter" type="hidden" name="limit" value="12">

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="filter-select">
                            <span>
                                <a href="product-category" class="btn btn-custom">Làm mới</a>
                            </span>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="container">
        <div class="main-product">
            <div id="main-product-filter" class="row">
                <?php if (!empty($dataProd)) : ?>
                    <?php foreach ($dataProd as $itemDataProd) : ?>
                        <div class="col-xl-3 mb-5 col-lg-4 col-sm-6 col-12">
                            <div class="product-item px-3">
                                <div class="thumb">
                                    <div class="thumb-img">
                                        <a class="thumb-link" href="product/<?= $itemDataProd['slug'] ?>-<?= $itemDataProd['id'] ?>">
                                            <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800" loading="lazy" src="<?= $itemDataProd['thumb'] ?>" alt="<?= $itemDataProd['title'] ?>">
                                        </a>

                                        <div class="actions-hover">
                                            <ul class="action-list mb-0">
                                                <li class="quickview">
                                                    <a class="btn-action" href="product/<?= $itemDataProd['slug'] ?>-<?= $itemDataProd['id'] ?>"><i class="far fa-eye"></i></a>
                                                </li>

                                                <li class="select-option">
                                                    <a href="<?= $itemDataProd['quantity'] > 0 ? 'product/' . $itemDataProd['slug'] . '-' . $itemDataProd['id'] : '#' ?>" class="btn-action-lagre <?= $itemDataProd['quantity'] > 0 ? '' : 'disabled' ?>">
                                                        <?= $itemDataProd['quantity'] > 0 ? 'Mua sản phẩm' : 'Sản phẩm hết hàng' ?>
                                                    </a>
                                                </li>

                                                <li class="wishlist">
                                                    <button class="btn-action">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="lable-sale">
                                        <?php if ($itemDataProd['discount'] != 0) : ?>
                                            <div class="product-badget">Giảm <?= $itemDataProd['discount'] . ' %' ?> </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="inner">
                                        <div class="product-rating">
                                            <span class="icon"><?= Format::renderStars($itemDataProd['totalRatings']) ?></span>
                                            <span class="rating-number">(<?= $itemDataProd['totalUserRatings'] ?>)</span>
                                        </div>
                                        <h5 class="title">
                                            <a href="product/<?= $itemDataProd['slug'] ?>-<?= $itemDataProd['id'] ?>"><?= $itemDataProd['title'] ?></a>
                                        </h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price"><?= Format::formatCurrency($itemDataProd['price']) ?></span>
                                            <?php if ($itemDataProd['discount']) : ?>
                                                <span class="price old-price"><?= Format::calculateOriginalPrice($itemDataProd['price'], $itemDataProd['discount']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-lg-12 text-center mt--20">
                        <span onclick="learnMoreProductFilter()" class="btn-custom btn-bg-lighter">Xem thêm</span>
                    </div>
                <?php else : ?>
                    <div class="text-center">
                        <img class="img-fluid" src="https://www.maytinhtrangbom.vn/client/theme/image/emptycart.webp" alt="Chưa có sản phẩm img">
                        <p class="fs-4">Chưa có sản phẩm.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


</section>