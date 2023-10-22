<section class="content-dashboard-wrap-top">
    <div class="container-fulid">
        <div class="row">
            <!--  -->
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-0 card-hover">
                    <div class="card-body success">
                        <div class="media d-flex  align-items-center">
                            <div class="media-body p-0">
                                <span class="m-0">Tổng doanh thu</span>
                                <h4 class="mb-0 counter"><?php echo Format::formatNumber($totalRevenue) ?>
                                </h4>
                            </div>
                            <div class="icon icon--success text-center">
                                <i class="success fas fa-database"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-0  card-hover">
                    <div class="card-body violet">
                        <div class="media d-flex  align-items-center">
                            <div class="media-body p-0">
                                <span class="m-0">Tổng lượt bán</span>
                                <h4 class="mb-0 counter"><?php echo $totalSold ?>
                                </h4>
                            </div>
                            <div class="icon icon--violet text-center">
                                <i class="fas violet fa-shopping-bag"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-0  card-hover">
                    <div class="card-body primary">
                        <div class="media d-flex  align-items-center">
                            <div class="media-body p-0">
                                <span class="m-0">Tổng sản phẩm</span>
                                <h4 class="mb-0 counter"><?php echo $prodCount ?>
                                </h4>
                            </div>
                            <div class="icon icon--primary text-center">
                                <i class="primary fab fa-product-hunt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-0  card-hover">
                    <div class="card-body danger">
                        <div class="media d-flex  align-items-center">
                            <div class="media-body p-0">
                                <span class="m-0">Tổng khách hàng</span>
                                <h4 class="mb-0 counter"><?php echo $userCount ?>
                                </h4>
                            </div>
                            <div class="icon icon--danger text-center">
                                <i class="fab danger fas fa-user "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="col-xl-6 ">
                <div class="card-hover card-chart">
                    <div class="card-header border-0 pb-1">
                        <div class="card-header-title">
                            <h4>Báo cáo doanh thu</h4>
                        </div>
                    </div>
                    <div class="card-body border-0  p-0">
                        <div id="report-chart"></div>
                    </div>
                </div>
            </div>

            <!--  -->

            <div class="col-xl-6 col-md-12 ">
                <div class="card-hover card-table">
                    <div class="card-header pb-1">
                        <div class="card-header-title">
                            <h4>Sản phẩm bán chạy nhất</h4>
                        </div>
                    </div>
                    <div class="card-body border-0 p-0">
                        <table class="table">

                            <tbody>
                                <?php foreach ($dataProdOrderBySold as $dataProdBestSell) {

                                ?>
                                    <tr>
                                        <td>
                                            <div class="best-product-box">
                                                <div class="product-image">
                                                    <img src="public/images/product/thumb/<?php echo $dataProdBestSell['thumb'] ?>" class="img-fluid" alt="<?php echo $dataProdBestSell['title'] ?>">
                                                </div>
                                                <div class="product-name ms-4">
                                                    <h5 style="max-width: 150px;" class="mb-2 text-truncate "><?php echo $dataProdBestSell['title']  ?></h5>
                                                    <h6 class="mb-0 "><?php echo $dataProdBestSell['create_At'] ?></h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="product-detail-box">
                                                <h6 class="mb-2">Giá</h6>
                                                <h5 class="mb-0"><?php echo Format::formatCurrency($dataProdBestSell['price']) ?></h5>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="product-detail-box">
                                                <h6 class="mb-2">Lượt bán</h6>
                                                <h5 class="mb-0"><?php echo $dataProdBestSell['sold'] ?></h5>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="product-detail-box">
                                                <h6 class="mb-2">Tồn kho</h6>
                                                <h5 class="mb-0"><?php echo $dataProdBestSell['quantity'] ?></h5>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="product-detail-box">
                                                <h6 class="mb-2">Tổng tiền</h6>
                                                <h5 class="mb-0"><?php echo Format::formatNumber($dataProdBestSell['sold'] * $dataProdBestSell['price']) ?>
                                                </h5>
                                            </div>
                                        </td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <!--  -->
            <!-- 
            <div class="col-xl-6">
                <div class="card-hover card-table">
                    <div class="card-header pb-1">
                        <div class="card-header-title">
                            <h4>coming soon</h4>
                        </div>
                    </div>
                    <div class="card-body border-0 p-0">
                        <table class="table box--padding">

                            <tbody>

                                <tr>
                                    <td>
                                        <div class="product-detail-box">
                                            <h6 class="mb-2">Aata Buscuit</h6>
                                            <h5 class="mb-0">#64548</h5>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="product-detail-box">
                                            <h6 class="mb-2">Date Placed</h6>
                                            <h5 class="mb-0">5/1/22</h5>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="product-detail-box">
                                            <h6 class="mb-2">Price</h6>
                                            <h5 class="mb-0">$625</h5>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="product-detail-box">
                                            <h6 class="mb-2">Order Status</h6>
                                            <h5 class="mb-0">123</h5>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="product-detail-box">
                                            <h6 class="mb-2">Payment</h6>
                                            <h5 class="mb-0 paid ">Unpaid</h5>

                                        </div>
                                    </td>

                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->


            <!--  -->

            <!-- <div class="col-xl-6 ">
                <div class="card-hover card-chart">
                    <div class="card-header border-0 pb-1">
                        <div class="card-header-title">
                            <h4>coming soon</h4>
                        </div>
                    </div>
                    <div class="card-body border-0  p-0">
                        <div id="earning-chart">

                        </div>
                    </div>
                </div>
            </div> -->

            <!--  -->

            <div class="col-xl-6 ">
                <div class="card-hover card-chart">
                    <div class="card-header border-0 pb-1">
                        <div class="card-header-title">
                            <h4>số lượng sản phẩm trong danh mục</h4>
                        </div>
                    </div>
                    <div class="card-body border-0  p-0">
                        <div id="productCate">

                        </div>
                    </div>
                </div>
            </div>


            <!--  -->

            <div class="col-xl-6">
                <div class="card-hover card-table">
                    <div class="card-header pb-1">
                        <div class="card-header-title">
                            <h4>Đánh giá gần đây</h4>
                        </div>
                    </div>
                    <div class="card-body border-0 p-0">
                        <table class="table box--padding">

                            <tbody>

                                <?php foreach ($dataRatingsProd as $dataRatingsProdItem) {
                                    extract($dataRatingsProdItem);
                                ?>
                                    <tr>
                                        <td>
                                            <div class="product-detail-box">
                                                <h6 class="mb-2">Người dùng</h6>
                                                <h5 class="mb-0"><?php echo  $fullname ?></h5>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="product-detail-box">
                                                <h6 class="mb-2">Tên sản phẩm</h6>
                                                <h5 style="max-width: 250px;" class="mb-0 text-truncate "><?php echo $title  ?></h5>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="product-detail-box">
                                                <h6 class="mb-2">Xếp hạng</h6>
                                                <h5 style="color: var(--star);" class="mb-0"><?php echo Format::renderStars($star) ?></h5>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="product-detail-box">
                                                <h6 class="mb-2">Ngày</h6>
                                                <h5 class="mb-0"><?php echo $update_at ?></h5>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>