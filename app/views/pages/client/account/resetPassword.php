<section class="signin-area">
    <div class="signin-header">
        <div class="row align-items-center">
            <div class="col-xl-4 col-sm-6">
                <a href="" class="site-logo"><img src="public/images/logo/logo.png" alt="logo"></a>
            </div>
            <div class="col-md-2 d-lg-block d-none">
                <a href="login" class="back-btn"><i class="far fa-angle-left"></i></a>
            </div>
            <div class="col-xl-6 col-lg-4 col-sm-6">
                <div class="singin-header-btn">
                    <p>Bạn đã có tài khoản?</p>
                    <a href="login" class="btn-custom">Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="signin-banner bg_image bg_image--10">
                <h3 class="title">Chúng tôi Cung cấp Những Sản phẩm Tốt nhất</h3>
            </div>
        </div>
        <div class="col-lg-6 offset-xl-2">
            <div class="signin-form-wrap">
                <div class="signin-form-main">
                    <h3 class="title">Đặt lại mật khẩu</h3>
                    <p class="desc"></p>
                    <form class="singin-form" method="post">
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="Mật khẩu">
                            <div class="invalid-feedback ">
                                Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="re_passwordLogin" name="re_password" placeholder="Nhập lại mật khẩu">
                            <div class="invalid-feedback ">
                                Mật khẩu chưa khớp.
                            </div>
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div>
                                <button type="submit" id="btn_ele" class="btn btn-custom text-capitalize ">Đặt lại mật khẩu <span class="spin"><i class="fas fa-spinner"></i></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>