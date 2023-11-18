<section class="dashboard-account-area">
    <div class="container">
        <div class="dashboard-warp">
            <div class="dashboard-author">
                <div class="media">
                    <div class="thumbnail">
                        <img src="https://new.axilthemes.com/demo/template/etrade/assets/images/product/author1.png" alt="Hello Annie">
                    </div>
                    <div class="media-body">
                        <h5 class="title mb-0">Xin chào, Tân</h5>
                        <span class="joining-date">Thành viên kể từ tháng 9 năm 2020</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-4">
                    <aside class="dashboard-aside">
                        <nav class="dashboard-nav">
                            <div class="nav nav-tabs" role="tablist">
                                <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-dashboard" role="tab" aria-selected="true">
                                    <i class="fas fa-th-large"></i>Bảng điều khiển
                                </a>

                                <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-orders" role="tab" aria-selected="false">
                                    <i class="fas fa-shopping-basket"></i>Đơn hàng
                                </a>

                                <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-address" role="tab" aria-selected="false">
                                    <i class="fas fa-location-circle"></i>Địa chỉ
                                </a>

                                <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-account" role="tab" aria-selected="false">
                                    <i class="fas fa-user"></i>Tài khoản
                                </a>

                                <a class="nav-item nav-link" href="logout">
                                    <i class="fas fa-sign-out"></i>Đăng xuất
                                </a>
                            </div>

                        </nav>
                    </aside>
                </div>
                <div class="col-xl-9 col-md-8">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel">
                            <div class="dashboard-overview">

                                <div class="welcome-text">Xin chào, Tân (không phải <span class="fw-bold ">Annie?</span>
                                    <a href="logout">Đăng xuất</a>)
                                </div>
                                <p>Từ bảng điều khiển tài khoản của mình, bạn có thể xem các đơn đặt hàng gần đây, quản lý địa chỉ giao hàng và thanh toán cũng như chỉnh sửa mật khẩu và chi tiết tài khoản của mình.</p>
                                <div class="dashboard-order">

                                    <div class="table-custom">
                                        <table class="theme-table table_id">
                                            <thead class="rounded-3 overflow-hidden  ">
                                                <tr>
                                                    <th>Mã đơn</th>
                                                    <th>Ngày đặt hàng</th>
                                                    <th>Phương thức thanh toán</th>
                                                    <th>Trạng thái</th>
                                                    <th>Tổng</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                foreach ($dataOrder as $dataOrderItem) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?= '#' . $dataOrderItem['order_code'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $dataOrderItem['order_date'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $dataOrderItem['display_name'] ?>
                                                        </td>

                                                        <td class=" <?= true ? 'status-success' : 'status-danger' ?>">
                                                            <span class="fw-medium">
                                                                <?= $dataOrderItem['order_status'] ?>
                                                            </span>
                                                        </td>

                                                        <td> <?= Format::formatCurrency($dataOrderItem['total_money']) ?></td>

                                                    </tr>

                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-orders" role="tabpanel">
                            <div class="dashboard-order">
                                <div class="table-custom">
                                    <table class="theme-table table_id">
                                        <thead class="rounded-3 overflow-hidden  ">
                                            <tr>
                                                <th>ID</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng</th>
                                                <th>Chi tiết</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($dataOrder as $orderItemDetail) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?= '#' . $orderItemDetail['order_code'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $orderItemDetail['order_date'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $orderItemDetail['display_name'] ?>
                                                    </td>
                                                    <td class=" <?= true ? 'status-success' : 'status-danger' ?>">
                                                        <span class="fw-medium">
                                                            <?= $dataOrderItem['order_status'] ?>
                                                        </span>
                                                    </td>
                                                    <td> <?= Format::formatCurrency($orderItemDetail['total_money']) ?></td>
                                                    <td>
                                                        <ul class="options">
                                                            <li class="m-0 ">
                                                                <a onclick="updateBrand(<?php echo $brandItem['id'] ?>)" data-bs-toggle="modal" data-bs-target="#updateBrand" href="javascript:void(0)">
                                                                    <i class="view fas fa-eye"></i>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </td>

                                                </tr>

                                            <?php } ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-address" role="tabpanel">
                            <div class="dashboard-address">
                                <p class="notice-text">Các địa chỉ sau sẽ được sử dụng trên trang thanh toán theo mặc định.</p>
                                <div class="row row--30">
                                    <div class="col-lg-6">
                                        <div class="address-info mb--40">
                                            <div class="addrss-header d-flex align-items-center justify-content-between">
                                                <h4 class="title mb-0">Địa chỉ giao hàng</h4>
                                                <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                            </div>
                                            <ul class="address-details">
                                                <li>Name: Annie Mario</li>
                                                <li>Email: annie@example.com</li>
                                                <li>Phone: 1234 567890</li>
                                                <li class="mt--30">7398 Smoke Ranch Road <br>
                                                    Las Vegas, Nevada 89128</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="address-info">
                                            <div class="addrss-header d-flex align-items-center justify-content-between">
                                                <h4 class="title mb-0">Địa chỉ thanh toán</h4>
                                                <a href="#" class="address-edit"><i class="far fa-edit"></i></a>
                                            </div>
                                            <ul class="address-details">
                                                <li>Name: Annie Mario</li>
                                                <li>Email: annie@example.com</li>
                                                <li>Phone: 1234 567890</li>
                                                <li class="mt--30">7398 Smoke Ranch Road <br>
                                                    Las Vegas, Nevada 89128</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-account" role="tabpanel">
                            <div class="col-lg-9">
                                <div class="dashboard-account">
                                    <form class="account-details-form">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" value="Annie">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" value="Mario">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mb--40">
                                                    <label>Country/ Region</label>
                                                    <select class="select2">
                                                        <option value="1">United Kindom (UK)</option>
                                                        <option value="1">United States (USA)</option>
                                                        <option value="1">United Arab Emirates (UAE)</option>
                                                        <option value="1">Australia</option>
                                                    </select>
                                                    <p class="b3 mt--10">This will be how your name will be displayed in the account section and in reviews</p>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <h5 class="title">Password Change</h5>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" value="123456789101112131415">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm New Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group mb--0">
                                                    <input type="submit" class="btn btn-custom" value="Save Changes">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>