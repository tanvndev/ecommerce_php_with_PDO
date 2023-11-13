<section class="sidebar-wrapper">
    <div class="top-fixed-sidebar">
        <div class="logo-wrapper">
            <a href="admin">
                <img class="img-fluid for-white" src="public/images/logo/logo.png" alt="logo">
            </a>
        </div>
    </div>
    <nav class="sidebar-main">
        <div class="sidebar-menu">
            <ul class="sidebar-links">
                <li class="sidebar-list <?php echo $active == 'dashboard' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="admin/dashboard">
                        <i class="fas fa-home"></i>
                        <span>Bảng điều khiển</span>
                    </a>
                </li>



                <li class="sidebar-list <?php echo $active == 'product' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="javascript:void(0)">
                        <i class="fas fa-sliders-h"></i>
                        <span>Mục lục</span>
                        <div class="according-menu">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </a>
                    <!--  -->
                    <ul class="sidebar-submenu">
                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/product">Sản phẩm</a>
                        </li>

                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/category">Danh mục</a>
                        </li>
                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/attributes">Thuộc tính</a>
                        </li>
                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/coupon">Mã giảm giá</a>
                        </li>
                    </ul>
                </li>





                <li class="sidebar-list <?php echo $active == 'brand' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="admin/brand">
                        <i class="fas fa-copyright"></i>
                        <span>Thương hiệu</span>
                    </a>
                </li>

                <li class="sidebar-list <?php echo $active == 'order' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="admin/order">
                        <i class="fas fa-archive"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>



                <li class="sidebar-list <?php echo $active == 'user' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="admin/user">
                        <i class="fas fa-user-friends"></i>
                        <span>Người dùng</span>
                    </a>
                </li>

                <!--  -->
                <li class="sidebar-list <?php echo $active == 'ratings' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="admin/rating-product">
                        <i class="fas fa-star"></i>
                        <span>Đánh giá sản phẩm</span>
                    </a>
                </li>

                <!--  -->
                <li class="sidebar-list <?php echo $active == 'storeCustom' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="admin/store-custom">
                        <i class="fab fa-centos"></i>
                        <span>Tuỳ chỉnh cửa hàng</span>
                    </a>
                </li>


            </ul>
        </div>
    </nav>
</section>