<?php
// echo '<pre>';
// print_r($countCart);
// echo '</pre>';
$menu = array(
    [
        'name' => 'Trang chủ',
        'path' => 'home'
    ],
    [
        'name' => 'Sản phẩm',
        'path' => 'product/'
    ],
    [
        'name' => 'Giới thiệu',
        'path' => 'Other/comingSoon'
    ],
    [
        'name' => 'Liên hệ',
        'path' => 'Other/comingSoon'
    ],
);

?>

<header>
    <div class="topbar">
        <div class="container d-flex justify-content-end ">
            <a href="Other/comingSoon">Trợ giúp</a>
            <a href="Other/comingSoon">Tham gia với chúng tôi</a>
            <?php
            if (isset($dataUser) && !empty($dataUser) && $dataUser['valid']) {
            ?>
                <a href="Other/comingSoon">Welcome, <?php echo $dataUser['payload']['fullname'] ?? 'Customer' ?></a>
            <?php } else { ?>
                <a href="account/login">Đăng nhập</a>
            <?php } ?>
        </div>
    </div>
    <div class="header-navbar">
        <nav class="container d-flex-center">
            <div class="header-logo">
                <a href=""><img src="public/images/logo/logo.png" alt="logo"></a>
            </div>

            <div class="header-menu">
                <ul class="menu-list">
                    <?php foreach ($menu as $itemMenu) { ?>
                        <li><a <?php if ($itemMenu['path'] == $currentPath) {
                                    echo 'class="active"';
                                } ?> href="<?php echo $itemMenu['path'] ?>"><?php echo $itemMenu['name'] ?></a></li>
                    <?php } ?>

                </ul>
            </div>
            <div class="header-action">
                <ul class="action">
                    <li>
                        <form action="product/" method="get">
                            <div class="position-relative">
                                <input type="text" name="search" class="form-control" placeholder="Bạn muốn tìm gì?">
                                <button type="submit" class="btn-search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                    <li class="wishlist">
                        <a class="action-link" href="Other/comingSoon">
                            <i class="flaticon-heart"></i>
                        </a>
                    </li>

                    <li class="shopping-cart">
                        <button class="action-link shopping-cart-btn">
                            <i class="flaticon-shopping-cart"></i>
                        </button>
                        <?php if (isset($dataUser) && !empty($dataUser) && $dataUser['valid']) : ?>
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
                                    <a href="Other/comingSoon">Tài khoản</a>
                                </li>
                                <li>
                                    <a href="Other/comingSoon">Bắt đầu trả hàng</a>
                                </li>
                                <li>
                                    <a href="Other/comingSoon">Hỗ trợ</a>
                                </li>
                                <li>
                                    <a href="Other/comingSoon">Ngôn ngữ</a>
                                </li>
                            </ul>
                            <div class="login-btn">
                                <a href="account/<?php echo (isset($dataUser) && !empty($dataUser) && $dataUser['valid']) ? 'Logout' : 'Login' ?>" class="btn-custom">
                                    <?php echo (isset($dataUser) && !empty($dataUser)) ? 'Đăng xuất' : 'Đăng nhập' ?>
                                </a>
                            </div>
                            <div class="register-footer text-center <?php echo (isset($dataUser) && !empty($dataUser) && $dataUser['valid']) ? 'd-none ' : '' ?>">
                                <?php echo (isset($dataUser) && !empty($dataUser) && $dataUser['valid']) ? '' : 'Bạn chưa có tài khoản? <a href="account/register" class="btn-link">Đăng ký ngay.</a>' ?>
                            </div>

                        </div>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</header>

<?php include 'cart.php' ?>