<section class="contact-page-area">
    <div class="container">
        <div class="contact-page">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-form">
                        <h3 class="title mb--10">Chúng tôi rất mong nhận được phản hồi từ bạn.</h3>
                        <p class="bot-title">Nếu bạn có những sản phẩm tuyệt vời mà bạn đang tạo ra hoặc muốn hợp tác với chúng tôi thì hãy liên hệ với chúng tôi.</p>
                        <form method="POST" action="coming-soon" class="contact-form">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="contact-name">Họ và tên <span class="text-danger ">*</span></label>
                                        <input type="text" name="contact-name" id="contact-name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="contact-phone">Số điện thoại <span class="text-danger ">*</span></label>
                                        <input type="text" name="contact-phone" id="contact-phone">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="contact-email">E-mail <span class="text-danger ">*</span></label>
                                        <input type="email" name="contact-email" id="contact-email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="contact-message">Tin nhắn của bạn</label>
                                        <textarea name="contact-message" id="contact-message" cols="1" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb--0">
                                        <button name="submit" type="submit" id="submit" class="btn btn-custom">Gửi tin nhắn</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-form-about">
                        <div class="contact-location mb--40">
                            <h4 class="title mb--20">Cửa hàng của chúng tôi</h4>
                            <span class="address mb--20"><?= $dataStoreCustom['address'] ?></span>
                            <span class="phone">Số điện thoại: <?= $dataStoreCustom['phone'] ?></span>
                            <span class="email">Email: <?= $dataStoreCustom['email'] ?></span>
                        </div>
                        <div class="contact-career mb--40">
                            <h4 class="title mb--20">Nghề nghiệp</h4>
                            <p>Thay vì mua sáu thứ, hãy mua một thứ mà bạn thực sự thích.</p>
                        </div>
                        <div class="opening-hour">
                            <h4 class="title mb--20">Giờ mở cửa</h4>
                            <p><?= $dataStoreCustom['open_time'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Google Map Area  -->
        <div class="google-map-wrap ">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe class="w-100 " src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29793.988211049866!2d105.8369637!3d21.022739599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9bd9861ca1%3A0xe7887f7b72ca17a9!2sHanoi!5e0!3m2!1sen!2s!4v1700055425254!5m2!1sen!2s" width="1280" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <!-- End Google Map Area  -->
    </div>
</section>