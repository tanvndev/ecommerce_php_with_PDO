<?php
// echo '<pre>';
// print_r($userData);
// echo '</pre>';
$menu = array(
    [
        'name' => 'Trang chủ',
        'path' => 'home'
    ],
    [
        'name' => 'Sản phẩm',
        'path' => 'product'
    ],
    [
        'name' => 'Tin Tức',
        'path' => 'news'
    ],
    [
        'name' => 'Liên hệ',
        'path' => 'contact'
    ],
    [
        'name' => 'Ưu đãi',
        'path' => 'coupon'
    ],
);

?>

<header>
    <div class="topbar">
        <div class="container d-flex justify-content-end ">
            <a href="coming-soon">Trợ giúp</a>
            <a href="contact">Liên hệ với chúng tôi</a>
            <?php
            if (isset($userData) && !empty($userData)) {
            ?>
                <a href="account">Welcome, <?= $userData['fullname'] ?? 'Customer' ?></a>
            <?php } else { ?>
                <a href="login">Đăng nhập</a>
            <?php } ?>
        </div>
    </div>
    <div class="header-navbar">
        <nav class="container d-flex-center">
            <div class="header-logo">
                <a href=""><img src="<?= $dataStoreCustom['logo'] ?>" alt="logo"></a>
            </div>

            <div class="header-menu">
                <ul class="menu-list">
                    <?php foreach ($menu as $itemMenu) { ?>
                        <li><a <?php if ($itemMenu['path'] == $currentPath) {
                                    echo 'class="active"';
                                } ?> href="<?= $itemMenu['path'] ?>"><?= $itemMenu['name'] ?></a></li>
                    <?php } ?>

                </ul>
            </div>
            <div class="header-action">
                <ul class="action">
                    <li>
                        <form action="product-category" method="get">
                            <div class="position-relative">
                                <input type="text" name="search" class="form-control" placeholder="Bạn muốn tìm gì?">
                                <button type="submit" class="btn-search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                    <li class="wishlist">
                        <a class="action-link" href="coming-soon">
                            <i class="flaticon-heart"></i>
                        </a>
                    </li>

                    <li class="shopping-cart">
                        <button class="action-link shopping-cart-btn">
                            <i class="flaticon-shopping-cart"></i>
                        </button>
                        <?php if (isset($userData) && !empty($userData)) : ?>
                            <span id="shopping-cart-quantity" class="shopping-cart-quantity">0</span>
                        <?php endif; ?>

                    </li>

                    <li class="my-account position-relative ">
                        <button class="action-link ">
                            <i class="flaticon-person"></i>
                        </button>
                        <div class="my-account-dropdown ">
                            <span class="title">Đường dẫn nhanh</span>
                            <ul>
                                <li>
                                    <a href="account">Tài khoản</a>
                                </li>
                                <li>
                                    <a href="coming-soon">Bắt đầu trả hàng</a>
                                </li>
                                <li>
                                    <a href="coming-soon">Hỗ trợ</a>
                                </li>
                                <li>
                                    <a href="coming-soon">Ngôn ngữ</a>
                                </li>
                            </ul>
                            <div class="login-btn">
                                <a href="<?= (isset($userData) && !empty($userData)) ? 'Logout' : 'Login' ?>" class="btn-custom">
                                    <?= (isset($userData) && !empty($userData)) ? 'Đăng xuất' : 'Đăng nhập' ?>
                                </a>
                            </div>
                            <div class="register-footer text-center <?= (isset($userData) && !empty($userData)) ? 'd-none ' : '' ?>">
                                <?= (isset($userData) && !empty($userData)) ? '' : 'Bạn chưa có tài khoản? <a href="signup" class="btn-link">Đăng ký ngay.</a>' ?>
                            </div>

                        </div>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</header>

<?php include 'cart.php' ?>