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
                        <img class="user-profile" src="public/images/users/<?php echo isset($userData) && !empty($userData) && isset($userData['avatar']) ? $userData['avatar'] : 'userDefault.webp' ?>" alt="avatarUser">
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
                        <a href="Other/comingsoon">
                            <i class="fas fa-archive"></i>
                            <span>Orders</span>
                        </a>
                    </li>

                    <li>
                        <a href="Other/comingsoon">
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