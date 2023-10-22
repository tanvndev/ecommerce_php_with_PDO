<section class="signin-area">
    <div class="signin-header">
        <div class="row align-items-center">
            <div class="col-sm-4">
                <a href="" class="site-logo"><img src="public/images/logo/logo.png" alt="logo"></a>
            </div>
            <div class="col-sm-8">
                <div class="singin-header-btn">
                    <p class="mb-0 ">Bạn đã có tài khoản?</p>
                    <a href="account/login" class="btn btn-custom">Đăng nhập</a>
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
                    <h3 class="title">Đăng ký</h3>
                    <p class="desc mb--55">Nhập chi tiết của bạn bên dưới</p>
                    <form class="singin-form" id="formRegister" method="POST">

                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Họ và tên">

                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" required class="form-control" id="emailLogin" name="email" placeholder="Email">
                            <div class="invalid-feedback ">
                                Email đã tồn tại.
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" id="passwordLogin" name="password" placeholder="Mật khẩu">
                            <div class="invalid-feedback ">
                                Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <div>
                                <button id="btn-register" onclick="registerUser()" type="button" class="btn-custom text-capitalize ">
                                    Tạo tài khoản <span class="spin"><i class="fas fa-spinner"></i></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>