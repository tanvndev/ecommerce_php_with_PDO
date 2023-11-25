<?php
// echo '<pre>';
// print_r($dataUserCurrent);
// echo '</pre>';
?>
<section class="dashboard-account-area">
    <div class="container">
        <div class="dashboard-warp">
            <div class="dashboard-author">
                <div class="media">
                    <div class="thumbnail">
                        <img src="<?= $dataUserCurrent['avatar'] ?>" alt="<?= $dataUserCurrent['fullname'] ?>">
                    </div>
                    <div class="media-body">
                        <h5 class="title mb-0">Xin chào, <?= $dataUserCurrent['fullname'] ?></h5>
                        <span class="joining-date">Thành viên kể từ <?= date('d-m-Y', strtotime($dataUserCurrent['create_At'])) ?>.</span>
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

                                <div class="welcome-text">Xin chào, <?= $dataUserCurrent['fullname'] ?> (không phải <span class="fw-bold "><?= $dataUserCurrent['fullname'] ?>?</span>
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
                                                            <?= $dataOrderItem['payment_method_name'] ?>
                                                        </td>

                                                        <td class=" <?= $dataOrderItem['order_status_id'] == 5 ? 'status-danger' : 'status-success' ?>">
                                                            <span class="fw-medium">
                                                                <?= $dataOrderItem['order_status_name'] ?>
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
                                                        <?= $orderItemDetail['payment_method_name'] ?>
                                                    </td>
                                                    <td class=" <?= $orderItemDetail['order_status_id'] == 5 ? 'status-danger' : 'status-success' ?>">
                                                        <span class="fw-medium">
                                                            <?= $orderItemDetail['order_status_name'] ?>
                                                        </span>
                                                    </td>
                                                    <td> <?= Format::formatCurrency($orderItemDetail['total_money']) ?></td>
                                                    <td>
                                                        <ul class="options">
                                                            <li class="m-0 ">
                                                                <a href="order-detail/<?= "{$orderItemDetail['order_id']}-{$orderItemDetail['order_code']}" ?>">
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
                                                <a href="coming-soon" class="address-edit"><i class="far fa-edit"></i></a>
                                            </div>
                                            <ul class="address-details">
                                                <li>Họ và tên: <?= $dataUserCurrent['fullname'] ?></li>
                                                <li>Email: <?= $dataUserCurrent['email'] ?></li>
                                                <li>Số điện thoại: <?= $dataUserCurrent['phone'] ?></li>
                                                <li class="mt--30"><?= $dataUserCurrent['address'] ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="address-info">
                                            <div class="addrss-header d-flex align-items-center justify-content-between">
                                                <h4 class="title mb-0">Địa chỉ thanh toán</h4>
                                                <a href="coming-soon" class="address-edit"><i class="far fa-edit"></i></a>
                                            </div>
                                            <ul class="address-details">
                                                <li>Họ và tên: <?= $dataUserCurrent['fullname'] ?></li>
                                                <li>Email: <?= $dataUserCurrent['email'] ?></li>
                                                <li>Số điện thoại: <?= $dataUserCurrent['phone'] ?></li>
                                                <li class="mt--30"><?= $dataUserCurrent['address'] ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-account" role="tabpanel">
                            <div class="col-lg-9">
                                <div class="dashboard-account">
                                    <form method="post" action="updateUserCurrent" enctype="multipart/form-data" class="account-details-form">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Họ và tên</label>
                                                    <input type="text" name="fullname" class="form-control" value="<?= $dataUserCurrent['fullname'] ?>" placeholder="Nhập họ và tên" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control" value="<?= $dataUserCurrent['email'] ?>" placeholder="Nhập địa chỉ email" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Số điện thoại</label>
                                                    <input type="tel" name="phone" class="form-control" value="<?= $dataUserCurrent['phone'] ?>" placeholder="Nhập số điện thoại" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Ảnh đại diện</label>
                                                    <input type="file" name="avatar" class="form-control" placeholder="Nhập số điện thoại" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <h5 class="title">Thay đổi mật khẩu</h5>
                                                <div class="form-group">
                                                    <label>Mật khẩu cũ</label>
                                                    <input name="old_password" type="password" placeholder="Mật khẩu hiện tại" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mật khẩu mới</label>
                                                    <input name="new_password" type="password" placeholder="Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt." class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Xác nhận mật khẩu mới</label>
                                                    <input name="re_new_password" type="password" placeholder="Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt." class="form-control" required>
                                                </div>
                                                <div class="form-group mb--0">
                                                    <input type="submit" class="btn btn-custom" value="Cập nhập thông tin">
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