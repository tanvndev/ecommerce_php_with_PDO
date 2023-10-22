<?php
// echo '<pre>';
// print_r($dataVariant);
// echo '</pre>';
?>

<section class="header-top-campaign">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-10">
                <div class="header-campaign-activation">
                    <div class="slick-slide">
                        <div class="campaign-content">
                            <p>SINH VIÊN NHẬN NGAY 10% GIẢM GIÁ: <a href="#">NHẬN GIẢM GIÁ</a></p>
                        </div>
                    </div>
                    <div class="slick-slide">
                        <div class="campaign-content">
                            <p>SINH VIÊN NHẬN NGAY 15% GIẢM GIÁ: <a href="#">NHẬN GIẢM GIÁ</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="detail-product-area">
    <div class="detail-product-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="product-thumb-small">
                                <?php foreach ($dataImageProd as $thumbItem) {
                                ?>
                                    <div class="small-thumb-img">
                                        <img src="public/images/product/<?php echo $thumbItem['image'] ?>" alt="image <?php echo $dataProd['title'] ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class=" zoom-gallery">
                                <div class="product-thumb-large">
                                    <?php foreach ($dataImageProd as $imageItem) {
                                    ?>
                                        <div class="thumbnail">
                                            <img src="public/images/product/<?php echo $imageItem['image'] ?>" alt="image <?php echo $dataProd['title'] ?>">

                                            <div class="product-quick-view">
                                                <a href="public/images/product/<?php echo $imageItem['image'] ?>" class="popup-zoom">
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
                <div class="col-lg-5">
                    <div class="detail-product-content">
                        <div class="inner">
                            <h2 class="product-title"><?php echo $dataProd['title'] ?></h2>
                            <div class="price">
                                <span class="price-amount"><?php echo Format::formatCurrency($dataProd['price']) ?></span>

                                <?php if ($dataProd['discount'] != 0) : ?>
                                    <span class="price-amount-old"><?php echo Format::calculateOriginalPrice($dataProd['price'], $dataProd['discount']) ?></span>
                                    <span class="text-danger "><?php echo ($dataProd['discount'] . '%') ?> </span>
                                <?php endif ?>
                            </div>
                            <div class="product-rating">
                                <div class="star-rating">
                                    <?php echo Format::renderStars($dataProd['totalRatings']) ?>
                                </div>
                                <div class="review-link">
                                    (<span><?php echo $dataProd['totalUserRatings'] ?></span> Đánh giá)
                                </div>
                            </div>
                            <ul class="product-meta">
                                <?php if ($dataProd['quantity'] != 0) : ?>
                                    <li><i class="fal fa-check"></i>Còn hàng</li>
                                <?php endif ?>
                                <li><i class="fal fa-check"></i>Miễn phí giao hàng</li>
                                <li><i class="fal fa-check"></i>Khuyến mãi giảm giá 30% Sử dụng mã: MOTIVE30</li>
                            </ul>
                            <!-- <p class="description">In ornare lorem ut est dapibus, ut tincidunt nisi pretium. Integer ante est, elementum eget magna. Pellentesque sagittis dictum libero, eu dignissim tellus.</p> -->

                            <form action="cart/addCart/<?php echo $dataProd['id'] ?>" id="formProduct" method="post">
                                <div class="product-variations-wrapper mt-5 ">
                                    <div class="product-variation">
                                        <?php if (!empty($dataVariant)) : ?>
                                            <h6 class="title">Color:</h6>
                                        <?php endif ?>
                                        <div class="color-variant-wrapper">
                                            <ul class="color-variant">
                                                <input id="colorProduct" type="hidden" name="color">
                                                <?php
                                                $activeSet = false;
                                                foreach ($dataVariant as $colorItem) :
                                                    if ($colorItem['name'] == 'Color') :
                                                ?>
                                                        <li <?php if (!$activeSet) {
                                                                echo 'class="active"';
                                                                $activeSet = true;
                                                            } ?>>
                                                            <?php echo $colorItem['value'] ?>
                                                        </li>
                                                <?php
                                                    endif;
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-variation">
                                        <?php if (!empty($dataVariant)) : ?>
                                            <h6 class="title">Size:</h6>
                                        <?php endif ?>
                                        <ul class="size-variant">
                                            <input id="sizeProduct" type="hidden" name="size">
                                            <?php
                                            $activeSet = false;
                                            foreach ($dataVariant as $sizeItem) :
                                                if ($sizeItem['name'] == 'Size') :
                                            ?>
                                                    <li <?php if (!$activeSet) {
                                                            echo 'class="active"';
                                                            $activeSet = true;
                                                        } ?>>
                                                        <?php echo $sizeItem['value'] ?>
                                                    </li>
                                            <?php
                                                endif;
                                            endforeach;
                                            ?>

                                        </ul>
                                    </div>
                                </div>

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

                                            <button onclick="addCart(<?php echo $dataProd['id'] ?>)" type="button" class="<?php echo $buttonClass; ?>"><?php echo $buttonText; ?></button>

                                        </li>
                                        <li class="wishlist">
                                            <a href="#" class=" wishlist-btn">
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
                                <?php echo $dataProd['description'] ?>
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
                                            <img src="public/images/others/<?php echo $iconsFeature['icon'] ?>" alt="icon">
                                        </div>
                                        <?php echo $iconsFeature['title'] ?>
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
                                <form method="POST" id="formRatings" action="product/addRatingProd">
                                    <div class="rating-wrapper d-flex-center mb--30">
                                        Số sao <span class="require">*</span>
                                        <div class="reating-inner ml--20">
                                            <input type="hidden" name="star" id="currentRating">
                                            <input type="hidden" name="id" value="<?php echo $dataProd['id'] ?>">
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
                    $productLink = "product/productDetail/{$itemDataProdRecent['id']}";
                    $thumbSrc = "public/images/product/thumb/{$itemDataProdRecent['thumb']}";
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
                                    <a class="thumb-link" href="<?php echo $productLink ?>">
                                        <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800" loading="lazy" src="<?php echo $thumbSrc ?>" alt="<?php echo $itemDataProdRecent['title'] ?>">
                                    </a>

                                    <div class="actions-hover">
                                        <ul class="action-list mb-0 ">
                                            <li class="quickview">
                                                <a class="btn-action" href="<?php echo $productLink ?>"><i class="far fa-eye"></i></a>
                                            </li>

                                            <li class="select-option">
                                                <?php if ($quantity > 0) : ?>
                                                    <button type="button" onclick="addCart(<?php echo $itemDataProdRecent['id'] ?>)" class="btn-action-lagre">
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
                                        <div class="product-badget">Giảm <?php echo $discount . ' %' ?> </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="content">
                                <div class="inner">
                                    <div class="product-rating">
                                        <span class="icon">
                                            <?php echo Format::renderStars($totalRatings) ?>
                                        </span>
                                        <span class="rating-number">(<?php echo $prodTotalUserRatings ?>)</span>
                                    </div>
                                    <h5 class="title">
                                        <a href="<?php echo $productLink ?>"><?php echo $itemDataProdRecent['title'] ?></a>
                                    </h5>
                                    <div class="product-price-variant">
                                        <span class="price current-price"><?php echo Format::formatCurrency($price) ?></span>
                                        <?php if ($discount) : ?>
                                            <span class="price old-price"><?php echo Format::calculateOriginalPrice($price, $discount) ?></span>
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