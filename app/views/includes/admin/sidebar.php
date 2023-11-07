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
                        <i class="fas fa-store"></i>
                        <span>Sản phẩm</span>
                        <div class="according-menu">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </a>
                    <!--  -->
                    <ul class="sidebar-submenu">
                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/product">Danh sách sản phẩm</a>
                        </li>

                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/add-product">Thêm mới</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-list <?php echo $active == 'category' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="javascript:void(0)">
                        <i class="fas fa-th-list"></i>
                        <span>Danh mục</span>
                        <div class="according-menu">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </a>
                    <!--  -->
                    <ul class="sidebar-submenu">
                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/category">Danh sách danh mục</a>
                        </li>

                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/add-category">Thêm mới</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-list <?php echo $active == 'brand' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="admin/brand">
                        <i class="fas fa-copyright"></i>
                        <span>Thương hiệu</span>
                    </a>
                </li>

                <li class="sidebar-list <?php echo $active == 'attributes' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="javascript:void(0)">
                        <i class="fas fa-sliders-h"></i>
                        <span>Thuộc tính</span>
                        <div class="according-menu">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </a>
                    <!--  -->
                    <ul class="sidebar-submenu">
                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/attribute">Danh sách thuộc tính</a>
                        </li>

                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/add-attribute">Thêm mới</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-list <?php echo $active == 'user' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="javascript:void(0)">
                        <i class="fas fa-users"></i>
                        <span>Người dùng</span>
                        <div class="according-menu">
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </a>
                    <!--  -->
                    <ul class="sidebar-submenu">
                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/user">Danh sách người dùng</a>
                        </li>

                        <li>
                            <i class="fas fa-minus"></i>
                            <a href="admin/add-user">Thêm mới</a>
                        </li>
                    </ul>
                </li>

                <!--  -->
                <li class="sidebar-list <?php echo $active == 'ratings' ? 'active' : '' ?>">
                    <a class="sidebar-list-link " href="admin/ratingProduct">
                        <i class="far fa-star"></i>
                        <span>Đánh giá sản phẩm</span>
                    </a>
                </li>


            </ul>
        </div>
    </nav>
</section>