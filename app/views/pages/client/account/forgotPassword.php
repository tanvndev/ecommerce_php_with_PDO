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
                    <h3 class="title">Quên mật khẩu?</h3>
                    <p class="desc mb--55">Vui lòng nhập địa chỉ email bạn đã sử dụng khi đăng ký, chúng tôi sẽ gửi hướng dẫn để đặt lại mật khẩu của bạn.</p>
                    <form class="singin-form" id="formForgot" method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div>
                                <button type="button" id="btn_ele" onclick="forgotPasswordUser()" class="btn btn-custom text-capitalize ">Gửi ngay <span class="spin"><i class="fas fa-spinner"></i></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>