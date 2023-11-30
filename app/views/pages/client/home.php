<?php
// echo '<pre>';
// print_r($dataBannerTitle);
// echo '</pre>';
?>

<section class="banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-xl-6 pr--80">
                <div>
                    <span class="title-highlighter highlighter-secondary"> <i class="fas fa-fire"></i><?= $dataBannerTitle['title'] ?></span>

                    <h1 class="title"><?= $dataBannerTitle['description'] ?></h1>

                    <div class="shop-btn">
                        <a href="product/category/31" class="btn btn-bg-white right-icon">Khám phá <i class="fal fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 ">
                <div class="slide-banner-thumb">
                    <?php foreach ($dataBanner as $itemdDataBanner) {

                    ?>
                        <div class="mian-banner-thumb">
                            <div class="banner-product">
                                <div class="thumb">
                                    <a href="product/<?= "{$itemdDataBanner['slug']}-{$itemdDataBanner['id']}" ?>"><img src="<?= $itemdDataBanner['thumb'] ?>" alt="<?= $itemdDataBanner['title'] ?>"></a>
                                </div>

                                <div class="content">
                                    <h5 class="title"><a href="product/<?= "{$itemdDataBanner['slug']}-{$itemdDataBanner['id']}" ?>"><?= $itemdDataBanner['title'] ?></a></h5>
                                    <div class="product-price-variant">
                                        <span class="price"><?= Format::formatCurrency($itemdDataBanner['price']) ?></span>
                                    </div>
                                    <ul class="cart-action">
                                        <li class="select-option">
                                            <a href="product/<?= "{$itemdDataBanner['slug']}-{$itemdDataBanner['id']}" ?>" class="btn-custom">Mua sản phẩm</a>
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
            <h2 class="title">Tìm kiếm theo danh mục</h2>
        </div>

        <div class="category">
            <?php
            foreach ($dataCate as $cateItem) {
            ?>
                <a class="category-item" href="product-category?category=<?= $cateItem['id'] ?>">
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

                        <a href="product-category?category=4" class="btn-custom btn-bg-primary">Kiểm tra ngay!</a>
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
                                                    <a href="<?= $productLink ?>" class="btn-action-lagre">
                                                        Mua sản phẩm
                                                    </a>
                                                <?php else : ?>
                                                    <a class="btn-action-lagre disabled" href="#">
                                                        Sản phẩm hết hàng
                                                    </a>
                                                <?php endif; ?>
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

<section class="new-arrivals-product-area pb--0">
    <div class="container">
        <div class="title">
            <span class="title-highlighter highlighter-secondary"> <i class="far fa-shopping-basket"></i> Tuần này</span>
            <h2 class="title">Sản phẩm mới</h2>
        </div>
        <div class="new-arrivals-product">
            <?php
            foreach ($dataProdNewDate as $prodNewDateItem) :
            ?>
                <div class="product-area-two">
                    <div class="thumbnail">
                        <a href="product/<?= $prodNewDateItem['slug'] ?>-<?= $prodNewDateItem['id'] ?>">
                            <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500" src="<?= $prodNewDateItem['thumb'] ?>" alt="<?= $prodNewDateItem['title'] ?>">
                        </a>
                        <?php
                        if ($prodNewDateItem['discount'] != 0) :
                        ?>
                            <div class="label-block">
                                <div class="product-badget">Giảm <?= $prodNewDateItem['discount'] ?> %</div>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="product-content">
                        <div class="inner">
                            <h5 class="title">
                                <a href="product/<?= $prodNewDateItem['slug'] ?>-<?= $prodNewDateItem['id'] ?>"><?= $prodNewDateItem['title'] ?></a>
                            </h5>
                            <div class="product-price-variant">
                                <?php
                                if ($prodNewDateItem['discount'] != 0) :
                                ?>
                                    <span class="price old-price"><?= Format::calculateOriginalPrice($prodNewDateItem['price'], $prodNewDateItem['discount']) ?></span>
                                <?php endif ?>
                                <span class="price current-price"><?= Format::formatCurrency($prodNewDateItem['price']) ?></span>
                            </div>
                            <div class="product-hover-action">
                                <ul class="cart-action">
                                    <li class="quickview">
                                        <a class="btn-action" href="product/<?= $prodNewDateItem['slug'] ?>-<?= $prodNewDateItem['id'] ?>">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    <li class="select-option">
                                        <a href="<?= $prodNewDateItem['slug'] ?>-<?= $prodNewDateItem['id'] ?>">Mua sản phẩm
                                        </a>
                                    </li>
                                    <li class="wishlist">
                                        <button class="btn-action"><i class="far fa-heart"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>
        </div>
    </div>
</section>


<section class="most-sold-product">
    <div class="container">
        <div class="most-sold-product-wrap">
            <div class="section-title-wrapper text-center ">
                <span class="title-highlighter highlighter-primary"><i class="fas fa-star"></i> Bán chạy nhất</span>
                <h2 class="title">Sản phẩm bán chạy trong cửa hàng</h2>
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
                                        <a href="<?= $productLink ?>" class="cart-btn">
                                            <i class="fal fa-shopping-cart"></i>
                                        </a>
                                        <button class="cart-btn">
                                            <i class="fal fa-heart"></i>
                                        </button>
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


<!-- Start Why Choose Area  -->
<section class="why-choose-area pb--50 ">
    <div class="container">
        <div class="section-title-wrapper text-center ">
            <span class="title-highlighter justify-content-center  highlighter-secondary"><i class="fal fa-thumbs-up"></i>Tại sao chọn chúng tôi</span>
            <h2 class="title">Tại sao bạn chọn chúng tôi</h2>
        </div>
        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 row--20">
            <div class="col">
                <div class="service-box">
                    <div class="icon">
                        <img src="public/images/icons/service6.png" alt="Service">
                    </div>
                    <h6 class="title">Giao hàng nhanh tróng &amp; an toàn</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box">
                    <div class="icon">
                        <img src="public/images/icons/service7.png" alt="Service">
                    </div>
                    <h6 class="title">Đảm bảo 100% về sản phẩm</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box">
                    <div class="icon">
                        <img src="public/images/icons/service8.png" alt="Service">
                    </div>
                    <h6 class="title">Hàng ngàn mã ưu đãi hập dẫn</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box">
                    <div class="icon">
                        <img src="public/images/icons/service9.png" alt="Service">
                    </div>
                    <h6 class="title">Chính sách hoàn trả 24 giờ</h6>
                </div>
            </div>
            <div class="col">
                <div class="service-box">
                    <div class="icon">
                        <img src="public/images/icons/service10.png" alt="Service">
                    </div>
                    <h6 class="title">Chất lượng chuyên nghiệp</h6>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Why Choose Area  -->


<!-- Start Product Poster Area  -->
<section class="poster-home">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb--30">
                <div class="single-poster">
                    <a href="product-category?category=4">
                        <img src="public/images/others/poster-01.png" alt="eTrade promotion poster">
                        <div class="poster-content">
                            <div class="inner">
                                <h3 class="title">Âm thanh
                                    <br>phong phú.
                                </h3>
                                <span class="sub-title">Bộ sưu tập <i class="fal fa-long-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 mb--30">
                <div class="single-poster">
                    <a href="product-category?category=9">
                        <img src="public/images/others/poster-02.png" alt="eTrade promotion poster">
                        <div class="poster-content content-left">
                            <div class="inner">
                                <span class="sub-title  ">Ưu đãi 50% vào mùa đông</span>
                                <h3 class="title mt-2 ">Nhận kính <br> VR</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Poster Area  -->

<!-- Start Newsletter Area  -->
<!-- <div class="newsletter-area pt--0">
    <div class="container">
        <div class="etrade-newsletter-wrapper bg_image bg_image--5">
            <div class="newsletter-content">
                <span class="title-highlighter highlighter-primary2"><i class="fas fa-envelope-open"></i>Newsletter</span>
                <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
                <div class="input-group newsletter-form">
                    <div class="position-relative newsletter-inner mb--15">
                        <input placeholder="example@gmail.com" type="text">
                    </div>
                    <button type="submit" class="btn mb--15">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- End Newsletter Area  -->