<?php
// echo '<pre>';
// print_r($dataProdRecent);
// echo '</pre>';
?>

<section class="banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-xl-6 pr--80">
                <div>
                    <span class="title-highlighter highlighter-secondary"> <i class="fas fa-fire"></i>Thị trường NFT lớn nhất</span>

                    <h1 class="title">Khám phá, sưu tập và bán NFT đặc biệt</h1>

                    <div class="shop-btn">
                        <a href="product/category/31" class="axil-btn btn-bg-white right-icon">Khám phá <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 ">
                <div class="slide-banner-thumb">
                    <?php foreach ($dataProdNft as $itemdDataProdNft) {

                    ?>
                        <div class="mian-banner-thumb">
                            <div class="banner-product">
                                <div class="thumb">
                                    <a href="product/<?= $itemdDataProdNft['id'] ?>"><img src="<?= $itemdDataProdNft['thumb'] ?>" alt="<?= $itemdDataProdNft['title'] ?>"></a>
                                </div>

                                <div class="content">
                                    <h5 class="title"><a href="product/<?= $itemdDataProdNft['id'] ?>"><?= $itemdDataProdNft['title'] ?></a></h5>
                                    <div class="product-price-variant">
                                        <span class="price"><?= Format::formatCurrency($itemdDataProdNft['price']) ?></span>
                                    </div>
                                    <ul class="cart-action">
                                        <li class="select-option">
                                            <button class="btn-custom" type="button" onclick="addCart(<?= $itemdDataProdNft['id'] ?>)" href="">Mua sản phẩm</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!--  -->

                </div>
            </div>


        </div>
    </div>
</section>

<section class="home-category">
    <div class="container">
        <div class="title">
            <span class="title-highlighter highlighter-secondary"> <i class="far fa-tags"></i> Danh mục</span>
            <h2 class="title">Tìm kiếm theo Danh mục</h2>
        </div>

        <div class="category">
            <?php
            foreach ($dataCate as $cateItem) {
            ?>
                <a class="category-item" href="product/<?= $cateItem['id'] ?>">
                    <div class="categrie-product" data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500">
                        <div class="categorie-link">
                            <img class="img-fluid" src="public/images/category/<?= $cateItem['image'] ?>" alt="<?= $cateItem['name'] ?>">
                            <h6 class="cate-title "><?= $cateItem['name'] ?></h6>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</section>

<section class="home-poster">
    <div class="container">
        <div class="poster-wrap">
            <div class="row align-items-center ">
                <div class="col-xl-5 col-lg-6">
                    <div class="content">
                        <div class="title">
                            <span class="title-highlighter highlighter-secondary"> <i class="fal fa-headphones-alt"></i> Không Nên Bỏ Lỡ!!</span>

                            <h2 class="title">Nâng cao Trải nghiệm Âm nhạc Của Bạn</h2>
                        </div>

                        <a href="product/" class="btn-custom btn-bg-primary">Kiểm tra ngay!</a>
                    </div>

                </div>

                <div class="col-xl-7 col-lg-6">
                    <div class="thumb">
                        <img src="public/images/others/poster-03.png" alt="Poster Product">

                        <div class="music-singnal">
                            <div class="item-circle circle-1"></div>
                            <div class="item-circle circle-2"></div>
                            <div class="item-circle circle-3"></div>
                            <div class="item-circle circle-4"></div>
                            <div class="item-circle circle-5"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

<section class="product-area">
    <div class="container">
        <div class="title">
            <span class="title-highlighter highlighter-secondary"> <i class="far fa-shopping-basket"></i>Các mục đã xem gần đây</span>
            <h2 class="title">Sản phẩm từng xem</h2>
        </div>

        <div class="main-product">
            <div class="row">
                <?php foreach ($dataProdRecent as $itemDataProdRecent) : ?>
                    <?php
                    $productLink = "product/{$itemDataProdRecent['slug']}-{$itemDataProdRecent['id']}";
                    $thumbSrc = "{$itemDataProdRecent['thumb']}";
                    $quantity = $itemDataProdRecent['quantity'];
                    $discount = $itemDataProdRecent['discount'];
                    $price = $itemDataProdRecent['price'];
                    $totalRatings = $itemDataProdRecent['totalRatings'];
                    $prodTitle = $itemDataProdRecent['title'];
                    $prodTotalUserRatings = $itemDataProdRecent['totalUserRatings'];
                    ?>

                    <div class="col-xl-3 mb-5 col-lg-4 col-sm-6 col-12">
                        <div class="product-item px-3">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <a class="thumb-link" href="<?= $productLink ?>">
                                        <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800" loading="lazy" src="<?= $thumbSrc ?>" alt="<?= $itemDataProdRecent['title'] ?>">
                                    </a>

                                    <div class="actions-hover">
                                        <ul class="action-list mb-0 ">
                                            <li class="quickview">
                                                <a class="btn-action" href="<?= $productLink ?>"><i class="far fa-eye"></i></a>
                                            </li>

                                            <li class="select-option">
                                                <?php if ($quantity > 0) : ?>
                                                    <button type="button" onclick="addCart(<?= $itemDataProdRecent['id'] ?>)" class="btn-action-lagre">
                                                        Thêm vào giỏ hàng
                                                    </button>
                                                <?php else : ?>
                                                    <a class="btn-action-lagre disabled" href="#">
                                                        Sản phẩm hết hàng
                                                    </a>
                                                <?php endif; ?>
                                            </li>

                                            <li class="wishlist">
                                                <a class="btn-action" href="wishlist"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="lable-sale">
                                    <?php if ($discount != 0) { ?>
                                        <div class="product-badget">Giảm <?= $discount . ' %' ?> </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="inner">
                                    <div class="product-rating">
                                        <span class="icon">
                                            <?= Format::renderStars($totalRatings) ?>
                                        </span>
                                        <span class="rating-number">(<?= $prodTotalUserRatings ?>)</span>
                                    </div>
                                    <h5 class="title">
                                        <a href="<?= $productLink ?>"><?= $itemDataProdRecent['title']  ?></a>
                                    </h5>
                                    <div class="product-price-variant">
                                        <span class="price current-price"><?= Format::formatCurrency($price) ?></span>
                                        <?php if ($discount) : ?>
                                            <span class="price old-price"><?= Format::calculateOriginalPrice($price, $discount) ?></span>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


                <div class="col-lg-12 text-center mt--20 mt_sm--0">
                    <a href="product/" class="btn-custom btn-bg-lighter">Xem tất cả</a>
                </div>
            </div>
        </div>


    </div>
</section>


<section class="most-sold-product">
    <div class="container">
        <div class="most-sold-product-wrap">
            <div class="section-title-wrapper text-center ">
                <span class="title-highlighter highlighter-primary"><i class="fas fa-star"></i> Bán chạy nhất</span>
                <h2 class="title">Sản phẩm Bán chạy nhất trong Cửa hàng</h2>
            </div>

            <div class="content">
                <div class="row row-cols-xl-2 row-cols-1">
                    <?php
                    foreach ($dataProdMostSold as $itemDataProdMostSold) {
                    ?>
                        <?php
                        $productLink = "product/{$itemDataProdMostSold['slug']}-{$itemDataProdMostSold['id']}";
                        $thumbSrc = "{$itemDataProdMostSold['thumb']}";
                        $quantity = $itemDataProdMostSold['quantity'];
                        $discount = $itemDataProdMostSold['discount'];
                        $price = $itemDataProdMostSold['price'];
                        $totalRatings = $itemDataProdMostSold['totalRatings'];
                        $prodTitle = $itemDataProdMostSold['title'];
                        $prodTotalUserRatings = $itemDataProdMostSold['totalUserRatings'];
                        ?>
                        <div class="col">
                            <div class="product-list">
                                <div class="thumbnail">
                                    <a href="<?= $productLink  ?>">
                                        <img data-sal="zoom-in" data-sal-delay="100" data-sal-duration="1500" src="<?= $thumbSrc ?>" alt="<?= $prodTitle ?>">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <div class="product-rating">
                                        <span class="rating-icon">
                                            <?= Format::renderStars($totalRatings) ?>
                                        </span>
                                        <span class="rating-number">
                                            <span><?= $prodTotalUserRatings ?></span> Đánh giá
                                        </span>
                                    </div>
                                    <h6 class="product-title text-truncate ">
                                        <a href="<?= $productLink ?>"><?= $prodTitle  ?> </a>
                                    </h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price"><?= Format::formatCurrency($price) ?></span>
                                        <?php if ($discount != 0) : ?>
                                            <span class="price old-price"><?= Format::calculateOriginalPrice($price, $discount) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-cart">
                                        <button onclick="addCart(<?= $itemDataProdMostSold['id'] ?>)" href="cart" class="cart-btn">
                                            <i class="fal fa-shopping-cart"></i>
                                        </button>
                                        <a href="wishlist" class="cart-btn">
                                            <i class="fal fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>


        </div>
    </div>
</section>