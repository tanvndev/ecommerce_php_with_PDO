<?php
// echo '<pre>';
// print_r($productPrice);
// echo '</pre>';
?>

<section class="header-top-campaign">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="header-campaign-activation">
                    <?php
                    foreach ($dataCoupon as $dataCouponItem) :
                    ?>
                        <div class="slick-slide">
                            <div class="campaign-content">
                                <p class="text-uppercase "><?= $dataCouponItem['title'] ?>: <a href="coupon">NHẬN GIẢM GIÁ</a></p>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="detail-product-area">
    <div class="detail-product-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="product-thumb-small">
                                <?php foreach ($dataImageProd as $thumbItem) {
                                ?>
                                    <div class="small-thumb-img">
                                        <img src="<?= $thumbItem['image'] ?>" alt="image <?= $dataProd['title'] ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class=" zoom-gallery ">
                                <div class="product-thumb-large ">
                                    <?php foreach ($dataImageProd as $imageItem) {
                                    ?>
                                        <div class="thumbnail">
                                            <img src="<?= $imageItem['image'] ?>" alt="image <?= $dataProd['title'] ?>">

                                            <div class="product-quick-view">
                                                <a href="<?= $imageItem['image'] ?>" class="popup-zoom">
                                                    <i class="far fa-search-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="detail-product-content">
                        <div class="inner">
                            <h2 class="product-title"><?= $dataProd['title'] ?></h2>
                            <div class="product-stock">Số lượng:
                                <span id="product-stock"><?= $dataProd['isVariant'] == 1 ? $dataVariant[0]['quantity'] : $dataProd['quantity'] ?></span>
                            </div>
                            <div id="product-price" class="price">
                                <span class="price-amount">
                                    <?php
                                    echo ($dataProd['isVariant'] == 1) ?
                                        Format::formatCurrency($productPrice[0]['min_price']) . ' - ' . Format::formatCurrency($productPrice[0]['max_price']) :
                                        Format::formatCurrency($dataProd['price']);
                                    ?>

                                </span>

                                <?php if ($dataProd['isVariant'] != 1 && $dataProd['discount'] != 0) : ?>
                                    <span class="price-amount-old"><?= Format::calculateOriginalPrice($dataProd['price'], $dataProd['discount']) ?></span>
                                    <span class="text-danger "><?= ($dataProd['discount'] . '%') ?> </span>
                                <?php endif ?>
                            </div>
                            <div class="product-rating">
                                <div class="star-rating">
                                    <?= Format::renderStars($dataProd['totalRatings']) ?>
                                </div>
                                <div class="review-link">
                                    (<span><?= $dataProd['totalUserRatings'] ?></span> Đánh giá)
                                </div>
                            </div>
                            <ul class="product-meta">
                                <?php if ($dataProd['quantity'] != 0) : ?>
                                    <li><i class="fal fa-check"></i>Còn hàng</li>
                                <?php endif ?>
                                <li><i class="fal fa-check"></i>Miễn phí giao hàng</li>
                                <li><i class="fal fa-check"></i>Kiểm tra mã giảm giá của bạn để có mã tốt nhất</li>
                            </ul>
                            <p class="description"><?= $dataProd['short_description'] ?></p>

                            <form id="formProduct" action="cart/addCartApi" method="post">
                                <?php if (!empty($dataVariant)) : ?>
                                    <div class="product-variations-wrapper mt-5 ">

                                        <div class="product-variation">
                                            <h6 class="title">Phân loại:</h6>
                                            <div class="color-variant-wrapper">
                                                <input id="product_variant_id" type="hidden" name="product_variant_id">
                                                <ul class="product-variant">
                                                    <?php
                                                    foreach ($dataVariant as $dataVariantItem) {
                                                    ?>
                                                        <li id="<?= $dataVariantItem['id'] ?>" onclick="getVariant(<?= $dataVariantItem['id'] ?>)"><?= $dataVariantItem['attribute_values'] ?></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <div class="product-action-wrapper d-flex-center">
                                    <div class="pro-quantity">
                                        <button type="button" class="dec quantity-btn">-</button>
                                        <input type="text" name="quantity" value="1">
                                        <button type="button" class="inc quantity-btn">+</button>
                                    </div>

                                    <ul class="product-action d-flex-center mb-0 ">
                                        <li class="add-to-cart">
                                            <?php
                                            $quantity = $dataProd['quantity'];
                                            $isProductAvailable = ($quantity != 0);
                                            $buttonText = $isProductAvailable ? 'Thêm vào giỏ hàng' : 'Sản phẩm tạm hết';
                                            $buttonClass = $isProductAvailable ? 'btn-custom btn-bg-primary' : 'btn-custom btn-bg-primary disabled';
                                            ?>

                                            <button onclick="addCart()" type="button" class="<?= $buttonClass; ?>"><?= $buttonText; ?></button>

                                        </li>
                                        <li class="wishlist">
                                            <a href="javascrip:void(0)" class=" wishlist-btn">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<section class="woocommerce-tabs bg-vista-white">
    <div class="container">
        <ul class="nav tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a id="description-tab" class="active" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Mô tả</a>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <a id="additional-info-tab" data-bs-toggle="tab" href="#additional-info" role="tab" aria-controls="additional-info" aria-selected="false" class="" tabindex="-1">Thông tin bổ sung</a>
            </li> -->
            <li class="nav-item" role="presentation">
                <a class="" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false" class="" tabindex="-1">Đánh giá</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            <!-- Description -->
            <div class="tab-pane fade active show " id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="product-desc-wrapper">
                    <div class="row">
                        <div class="col-lg-12 mb-30">
                            <div class="single-desc">
                                <?= $dataProd['description'] ?>
                            </div>
                        </div>

                    </div>
                    <!-- End .row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="pro-des-features">
                                <?php
                                $iconsFeatures = [
                                    [
                                        'icon' => 'icon-3.png',
                                        'title' => 'Easy Returns'
                                    ],
                                    [
                                        'icon' => 'icon-2.png',
                                        'title' => 'Quality Service'
                                    ],
                                    [
                                        'icon' => 'icon-1.png',
                                        'title' => 'Original Product'
                                    ],
                                ]
                                ?>
                                <?php
                                foreach ($iconsFeatures as $iconsFeature) {
                                ?>
                                    <li class="li-features">
                                        <div class="icon">
                                            <img src="public/images/others/<?= $iconsFeature['icon'] ?>" alt="icon">
                                        </div>
                                        <?= $iconsFeature['title'] ?>
                                    </li>
                                <?php  } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Desccription-->
            </div>
            <!-- Infor -->
            <!-- <div class="tab-pane fade" id="additional-info" role="tabpanel" aria-labelledby="additional-info-tab">
                <div class="product-additional-info">
                    <div class="table-responsive">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Stand Up</th>
                                    <td>35″L x 24″W x 37-45″H(front to back wheel)</td>
                                </tr>
                                <tr>
                                    <th>Folded (w/o wheels) </th>
                                    <td>32.5″L x 18.5″W x 16.5″H</td>
                                </tr>
                                <tr>
                                    <th>Folded (w/ wheels) </th>
                                    <td>32.5″L x 24″W x 18.5″H</td>
                                </tr>
                                <tr>
                                    <th>Door Pass Through </th>
                                    <td>24</td>
                                </tr>
                                <tr>
                                    <th>Frame </th>
                                    <td>Aluminum</td>
                                </tr>
                                <tr>
                                    <th>Weight (w/o wheels) </th>
                                    <td>20 LBS</td>
                                </tr>
                                <tr>
                                    <th>Weight Capacity </th>
                                    <td>60 LBS</td>
                                </tr>
                                <tr>
                                    <th>Width</th>
                                    <td>24″</td>
                                </tr>
                                <tr>
                                    <th>Handle height (ground to handle) </th>
                                    <td>37-45″</td>
                                </tr>
                                <tr>
                                    <th>Wheels</th>
                                    <td>Aluminum</td>
                                </tr>
                                <tr>
                                    <th>Size</th>
                                    <td>S, M, X, XL</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
            <!-- End Info -->

            <!-- Comment -->
            <div class="tab-pane fade " id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="reviews-wrapper">
                    <div class="row">
                        <div class="col-lg-6 mb--40">
                            <div class="pro-desc-commnet-area">
                                <h5 class="title">Đánh giá cho sản phẩm này</h5>
                                <ul id="comment-list" class="comment-list ps-0 "> </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 mb--40">
                            <div class="comment-respond mt-0">
                                <h5 class="title mb--30">Đánh giá sản phẩm</h5>
                                <form method="POST" id="formRatings">
                                    <div class="rating-wrapper d-flex-center mb--30">
                                        Số sao <span class="require">*</span>
                                        <div class="reating-inner ml--20">
                                            <input type="hidden" name="star" id="currentRating">
                                            <input type="hidden" name="prod_id" value="<?= $dataProd['id'] ?>">
                                            <span data-rating="1" class="star"><i class="fas fa-star"></i></span>
                                            <span data-rating="2" class="star"><i class="fas fa-star"></i></span>
                                            <span data-rating="3" class="star"><i class="fas fa-star"></i></span>
                                            <span data-rating="4" class="star"><i class="fas fa-star"></i></span>
                                            <span data-rating="5" class="star"><i class="fas fa-star"></i></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Mời bạn chia sẻ cảm nhận</label>
                                                <textarea name="comment" placeholder="Cảm nhận của bạn"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-submit">
                                                <button onclick="addRatingProd()" type="button" class="btn-custom btn-bg-primary w-auto">Gửi đánh giá</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                                    <a type="button" href="<?= $productLink ?>" class="btn-action-lagre">
                                                        Mua sản phẩm
                                                    </a>
                                                <?php else : ?>
                                                    <a class="btn-action-lagre disabled" href="#">
                                                        Sản phẩm hết hàng
                                                    </a>
                                                <?php endif; ?>
                                            </li>

                                            <li class="wishlist">
                                                <button class="btn-action" type="button"><i class="far fa-heart"></i></button>
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
                                        <a href="<?= $productLink ?>"><?= $itemDataProdRecent['title'] ?></a>
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