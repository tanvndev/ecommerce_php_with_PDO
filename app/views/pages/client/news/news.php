<?php
// echo '<pre>';
// print_r($dataProdRecent);
// echo '</pre>';
?>
<section class="news-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row g-5">
                    <?php foreach ($dataNews as $dataNewsItem) {
                        extract($dataNewsItem);
                    ?>
                        <div class="col-md-6">
                            <div class="content-blog">
                                <div class="inner">
                                    <div class="thumbnail">
                                        <a href="news/<?= "$slug-$id" ?>">
                                            <img src="<?= $thumb ?>" alt="<?= $title ?>">
                                        </a>
                                        <!-- <div class="blog-category">
                                            <a href="#"></a>
                                        </div> -->
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="news/<?= "$slug-$id" ?>"><?= $title ?></a></h5>

                                        <div class="read-more-btn">
                                            <a class="right-icon" href="news/<?= "$slug-$id" ?>">Đọc thêm <i class="fal fa-long-arrow-right"></i></a>
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
                        <h6 class="widget-title">Bài viết mới nhất</h6>

                        <?php foreach ($dataNews as $newsItem) {
                        ?>
                            <div class="content-blog-side">
                                <div class="thumbnail">
                                    <a href="news/<?= "{$newsItem['slug']}-{$newsItem['id']}" ?>">
                                        <img src="<?= $newsItem['thumb'] ?>" alt="<?= $newsItem['title'] ?>">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="title"><a href="news/<?= "{$newsItem['slug']}-{$newsItem['id']}" ?>"><?= $newsItem['title'] ?></a></h6>
                                    <div class="news-post-meta">
                                        <div class="post-meta-content">
                                            <ul class="post-meta-list">
                                                <li><?= date('d M, Y', strtotime($newsItem['create_at'])) ?></li>
                                                <li><?= $newsItem['view'] ?> Lượt xem</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                    <div class="news-single-widget mt--40">
                        <h6 class="widget-title">Sản phẩm đã xem gần đây</h6>
                        <ul class="product_list_widget">
                            <?php
                            $i = 0;
                            foreach ($dataProdRecent as $item) {
                                if ($i == 4) {
                                    break;
                                }
                                $i++;
                            ?>
                                <li>
                                    <div class="thumbnail">
                                        <a class="overflow-hidden " href="product/<?= "{$item['slug']}-{$item['id']}" ?>">
                                            <img src="<?= $item['thumb'] ?>" alt="<?= $item['title'] ?>">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h6 class="title"><a href="product/<?= "{$item['slug']}-{$item['id']}" ?>"><?= $item['title'] ?></a></h6>
                                        <div class="product-meta-content">
                                            <span class=" amount">
                                                <?php if ($item['discount']) : ?>
                                                    <del><?= Format::calculateOriginalPrice($item['price'], $item['discount']) ?></del>
                                                <?php endif; ?>
                                                <?= Format::formatCurrency($item['price']) ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>

                        </ul>

                    </div>


                    <!-- <div class="news-single-widget mt--40">
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
                    </div> -->

                </aside>
            </div>
        </div>
    </div>
</section>