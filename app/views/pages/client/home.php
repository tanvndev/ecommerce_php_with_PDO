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
                    <?php foreach ($dataBanner as $itemdDataBanner) {

                    ?>
                        <div class="mian-banner-thumb">
                            <div class="banner-product">
                                <div class="thumb">
                                    <a href="product/<?= $itemdDataBanner['id'] ?>"><img src="<?= $itemdDataBanner['thumb'] ?>" alt="<?= $itemdDataBanner['title'] ?>"></a>
                                </div>

                                <div class="content">
                                    <h5 class="title"><a href="product/<?= $itemdDataBanner['id'] ?>"><?= $itemdDataBanner['title'] ?></a></h5>
                                    <div class="product-price-variant">
                                        <span class="price"><?= Format::formatCurrency($itemdDataBanner['price']) ?></span>
                                    </div>
                                    <ul class="cart-action">
                                        <li class="select-option">
                                            <button class="btn-custom" type="button" onclick="addCart(<?= $itemdDataBanner['id'] ?>)" href="">Mua sản phẩm</button>
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
                                                    <button type="button" onclick="addCartModal()" class="btn-action-lagre">
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


<!-- Product Quick View Modal Start -->
<!-- display: block;
padding-right: 20px; -->
<div class="modal fade quick-view-product " style="" id="quick-view-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="single-product-thumb">
                    <div class="row">
                        <div class="col-lg-7 mb--40">
                            <div class="row">
                                <div class="col-lg-10 order-lg-2">
                                    <div class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">
                                        <div class="thumbnail">
                                            <img src="assets/images/product/product-big-01.png" alt="Product Images">
                                            <div class="label-block label-right">
                                                <div class="product-badget">20% OFF</div>
                                            </div>
                                            <div class="product-quick-view position-view">
                                                <a href="assets/images/product/product-big-01.png" class="popup-zoom">
                                                    <i class="far fa-search-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="thumbnail">
                                            <img src="assets/images/product/product-big-02.png" alt="Product Images">
                                            <div class="label-block label-right">
                                                <div class="product-badget">20% OFF</div>
                                            </div>
                                            <div class="product-quick-view position-view">
                                                <a href="assets/images/product/product-big-02.png" class="popup-zoom">
                                                    <i class="far fa-search-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="thumbnail">
                                            <img src="assets/images/product/product-big-03.png" alt="Product Images">
                                            <div class="label-block label-right">
                                                <div class="product-badget">20% OFF</div>
                                            </div>
                                            <div class="product-quick-view position-view">
                                                <a href="assets/images/product/product-big-03.png" class="popup-zoom">
                                                    <i class="far fa-search-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 order-lg-1">
                                    <div class="product-small-thumb small-thumb-wrapper">
                                        <div class="small-thumb-img">
                                            <img src="assets/images/product/product-thumb/thumb-08.png" alt="thumb image">
                                        </div>
                                        <div class="small-thumb-img">
                                            <img src="assets/images/product/product-thumb/thumb-07.png" alt="thumb image">
                                        </div>
                                        <div class="small-thumb-img">
                                            <img src="assets/images/product/product-thumb/thumb-09.png" alt="thumb image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb--40">
                            <div class="single-product-content">
                                <div class="inner">
                                    <div class="product-rating">
                                        <div class="star-rating">
                                            <img src="assets/images/icons/rate.png" alt="Rate Images">
                                        </div>
                                        <div class="review-link">
                                            <a href="#">(<span>1</span> customer reviews)</a>
                                        </div>
                                    </div>
                                    <h3 class="product-title">Serif Coffee Table</h3>
                                    <span class="price-amount">$155.00 - $255.00</span>
                                    <ul class="product-meta">
                                        <li><i class="fal fa-check"></i>In stock</li>
                                        <li><i class="fal fa-check"></i>Free delivery available</li>
                                        <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>
                                    </ul>
                                    <p class="description">In ornare lorem ut est dapibus, ut tincidunt nisi
                                        pretium. Integer ante est, elementum eget magna. Pellentesque sagittis
                                        dictum libero, eu dignissim tellus.</p>

                                    <div class="product-variations-wrapper">

                                        <!-- Start Product Variation  -->
                                        <div class="product-variation">
                                            <h6 class="title">Colors:</h6>
                                            <div class="color-variant-wrapper">
                                                <ul class="color-variant mt--0">
                                                    <li class="color-extra-01 active"><span><span class="color"></span></span>
                                                    </li>
                                                    <li class="color-extra-02"><span><span class="color"></span></span>
                                                    </li>
                                                    <li class="color-extra-03"><span><span class="color"></span></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- End Product Variation  -->

                                        <!-- Start Product Variation  -->
                                        <div class="product-variation">
                                            <h6 class="title">Size:</h6>
                                            <ul class="range-variant">
                                                <li>xs</li>
                                                <li>s</li>
                                                <li>m</li>
                                                <li>l</li>
                                                <li>xl</li>
                                            </ul>
                                        </div>
                                        <!-- End Product Variation  -->

                                    </div>

                                    <!-- Start Product Action Wrapper  -->
                                    <div class="product-action-wrapper d-flex-center">
                                        <!-- Start Quentity Action  -->
                                        <div class="pro-qty"><input type="text" value="1"></div>
                                        <!-- End Quentity Action  -->

                                        <!-- Start Product Action  -->
                                        <ul class="product-action d-flex-center mb--0">
                                            <li class="add-to-cart"><a href="cart.html" class="axil-btn btn-bg-primary">Add to Cart</a></li>
                                            <li class="wishlist"><a href="wishlist.html" class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a>
                                            </li>
                                        </ul>
                                        <!-- End Product Action  -->

                                    </div>
                                    <!-- End Product Action Wrapper  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Quick View Modal End -->