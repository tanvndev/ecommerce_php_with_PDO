<?php
// echo '<pre>';
// print_r($userData);
// echo '</pre>';
?>
<header>
    <div class="admin-header">
        <div class="header-wrapper m-0">
            <!-- <div class="header-logo-wrapper p-0">
                            <div class="logo-wrapper">
                                <a href="index.html">
                                    <img class="img-fluid main-logo" src="assets/images/logo/1.png" alt="logo">

                                </a>
                            </div>
                            <div class="toggle-sidebar">
                                <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                                <a href="index.html">
                                    <img src="assets/images/logo/1.png" class="img-fluid" alt="">
                                </a>
                            </div>
                        </div> -->

            <div class="nav-menus">
                <div class="profile-media">
                    <div class="me-4 ">
                        <img class="user-profile" src="<?php echo isset($userData) && !empty($userData) && isset($userData['avatar']) ? $userData['avatar'] : 'https://t4.ftcdn.net/jpg/05/49/98/39/360_F_549983970_bRCkYfk0P6PP5fKbMhZMIb07mCJ6esXL.jpg' ?>" alt="avatarUser">
                    </div>
                    <div class="media-body">
                        <span><?php echo isset($userData) && !empty($userData) ? $userData['fullname'] : 'Admin' ?></span>
                        <p class="mb-0">Admin <i class="fas fa-chevron-down"></i></p>
                    </div>
                </div>


                <ul class="profile-dropdown position-absolute">
                    <li>
                        <a href="admin/user">
                            <i class="fas fa-user"></i>
                            <span>Tài khoản</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin/order">
                            <i class="fas fa-archive"></i>
                            <span>Đơn hàng</span>
                        </a>
                    </li>

                    <li>
                        <a href="coming-soon">
                            <i class="fas fa-cog"></i>
                            <span>Cài đặt</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Đăng xuất</span>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Header Ends-->
</header>