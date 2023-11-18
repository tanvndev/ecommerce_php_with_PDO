<section class="news-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row g-5">
                    <?php for ($i = 0; $i < 8; $i++) {
                    ?>
                        <div class="col-md-6">
                            <div class="content-blog">
                                <div class="inner">
                                    <div class="thumbnail">
                                        <a href="blog-details.html">
                                            <img src="https://new.axilthemes.com/demo/template/etrade/assets/images/blog/blog-12.png" alt="Blog Images">
                                        </a>
                                        <div class="blog-category">
                                            <a href="#">Digital Art's</a>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="blog-details.html">Keeping yourself safe when buying NFTs on eTrade</a></h5>

                                        <div class="read-more-btn">
                                            <a class="right-icon" href="blog-details.html">Read More <i class="fal fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>



                </div>
                <!-- <div class="post-pagination">
                    <nav class="navigation" aria-label="Products">
                        <ul class="page-numbers">
                            <li><span aria-current="page" class="page-numbers current">1</span></li>
                            <li><a class="page-numbers" href="#">2</a></li>
                            <li><a class="page-numbers" href="#">3</a></li>
                            <li><a class="page-numbers" href="#">4</a></li>
                            <li><a class="page-numbers" href="#">5</a></li>
                            <li><a class="next page-numbers" href="#"><i class="fal fa-arrow-right"></i></a></li>
                        </ul>
                    </nav>
                </div> -->
            </div>
            <div class="col-lg-4">
                <aside class="news-sidebar-area">

                    <div class="news-single-widget">
                        <h6 class="widget-title">Latest Posts</h6>

                        <?php for ($i = 0; $i < 4; $i++) {
                        ?>
                            <div class="content-blog-side">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="https://new.axilthemes.com/demo/template/etrade/assets/images/blog/blog-04.png" alt="Blog Images">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="blog-details.html">Dubai’s FRAME Offers its Take on the</a></h6>
                                    <div class="news-post-meta">
                                        <div class="post-meta-content">
                                            <ul class="post-meta-list">
                                                <li>Mar 27, 2022</li>
                                                <li>300k Views</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                    <div class="news-single-widget mt--40">
                        <h6 class="widget-title">Recent Viewed Products</h6>
                        <ul class="product_list_widget">
                            <?php for ($i = 0; $i < 3; $i++) {

                            ?>
                                <li>
                                    <div class="thumbnail">
                                        <a class="overflow-hidden " href="blog-details.html">
                                            <img src="https://new.axilthemes.com/demo/template/etrade/assets/images/product/product-12.jpg" alt="Blog Images">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><a href="blog-details.html">Men's Fashion Tshirt</a></h6>
                                        <div class="product-meta-content">
                                            <span class=" amount">
                                                <del>$30</del>
                                                $20
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>

                        </ul>

                    </div>


                    <div class="news-single-widget mt--40">
                        <h6 class="widget-title">Tags</h6>
                        <div class="tagcloud">
                            <a href="#">Design</a>
                            <a href="#">HTML</a>
                            <a href="#">Graphic</a>
                            <a href="#">Development</a>
                            <a href="#">UI/UX Design</a>
                            <a href="#">eCommerce</a>
                            <a href="#">CSS</a>
                            <a href="#">JS</a>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</section>