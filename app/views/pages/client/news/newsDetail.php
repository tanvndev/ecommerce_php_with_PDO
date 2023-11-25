<?php
// echo '<pre>';
// print_r($dataNew);
// echo '</pre>';
?>
<section class="post-single-wrapper news-area position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 news-post-wrapper">
                <div class="post-heading">
                    <h2 class="title"><?= $dataNew['title'] ?>.</h2>
                    <div class="news-post-meta">
                        <div class="post-author-avatar">
                            <img src="<?= $dataNew['avatar'] ?>" alt="<?= $dataNew['fullname'] ?>">
                        </div>
                        <div class="post-meta-content">
                            <h6 class="author-title">
                                <a href="javascrip:void()"><?= $dataNew['fullname'] ?></a>
                            </h6>
                            <ul class="post-meta-list">
                                <li><?= date('d M, Y', strtotime($dataNew['create_at'])) ?></li>
                                <li><?= $dataNew['view'] ?> lượt xem</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-description">
                    <?= $dataNew['content'] ?>
                </div>

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