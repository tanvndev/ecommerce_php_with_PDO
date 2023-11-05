<section class="signin-area">
    <div class="signin-header">
        <div class="row align-items-center">
            <div class="col-sm-4">
                <a href="" class="site-logo"><img src="public/images/logo/logo.png" alt="logo"></a>
            </div>
            <div class="col-sm-8">
                <div class="singin-header-btn">
                    <p class="mb-0 ">Chưa có tài khoản?</p>
                    <a href="signup" class="btn btn-custom">Đăng ký ngay</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="signin-banner bg_image bg_image--9">
                <h3 class="title">Chúng tôi Cung cấp Những Sản phẩm Tốt nhất</h3>
            </div>
        </div>
        <div class="col-lg-6 offset-xl-2">
            <div class="signin-form-wrap">
                <div class="signin-form-main">
                    <h3 class="title">Đăng nhập</h3>
                    <p class="desc mb--55">Nhập chi tiết của bạn bên dưới</p>

                    <form class="singin-form" method="POST">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="<?= $dataValueOld['email'] ?? '' ?>" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" value="<?= $dataValueOld['password'] ?? '' ?>" class="form-control" name="password" placeholder="Mật khẩu">
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div>
                                <button id="btn_ele" type="submit" class="btn btn-custom">Đăng nhập <span class="spin"><i class="fas fa-spinner"></i></span></button>
                            </div>
                            <a href="reset" class="forgot-btn">Quên mật khẩu?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>