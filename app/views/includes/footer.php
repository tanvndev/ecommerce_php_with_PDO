 <section class="service-area">
     <div class="container service-area-brb">
         <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1">
             <div class="col">
                 <div class="service-box">
                     <div class="icon">
                         <img src="public/images/icons/service1.png" alt="Service">
                     </div>
                     <div class="content">
                         <h6 class="title">Giao hàng Nhanh chóng & An toàn</h6>
                         <p>Kể về dịch vụ của bạn.</p>
                     </div>
                 </div>
             </div>
             <div class="col">
                 <div class="service-box">
                     <div class="icon">
                         <img src="public/images/icons/service2.png" alt="Service">
                     </div>
                     <div class="content">
                         <h6 class="title">Cam kết hoàn tiền</h6>
                         <p>Trong vòng 10 ngày.</p>
                     </div>
                 </div>
             </div>
             <div class="col">
                 <div class="service-box">
                     <div class="icon">
                         <img src="public/images/icons/service3.png" alt="Service">
                     </div>
                     <div class="content">
                         <h6 class="title">Chính sách trả hàng trong 24h</h6>
                         <p>Không kể lý do.</p>
                     </div>
                 </div>
             </div>
             <div class="col">
                 <div class="service-box">
                     <div class="icon">
                         <img src="public/images/icons/service4.png" alt="Service">
                     </div>
                     <div class="content">
                         <h6 class="title">Hỗ trợ Chất lượng Chuyên nghiệp</h6>
                         <p>Hỗ trợ Trực tuyến 24/7.</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <footer class="footer-area">
     <div class="footer-top">
         <div class="container">
             <div class="row">
                 <div class="col-lg-3 col-sm-6">
                     <div class="footer-widget">
                         <h5 class="widget-title">Hỗ trợ</h5>
                         <div class="logo mb--30">
                             <a href="">
                                 <img class="light-logo" src="<?= $dataStoreCustom['logo'] ?>" alt="Logo Images">
                             </a>
                         </div>
                         <div class="inner">
                             <p><?= $dataStoreCustom['address'] ?>
                             </p>
                             <ul class="support-list-item">
                                 <li>
                                     <a href="mailto:<?= $dataStoreCustom['email'] ?>">
                                         <i class="fal fa-envelope-open"></i>
                                         <?= $dataStoreCustom['email'] ?>
                                     </a>
                                 </li>
                                 <li><a href="tel:<?= $dataStoreCustom['phone'] ?>"><i class="fal fa-phone-alt"></i><?= $dataStoreCustom['phone'] ?></a></li>
                                 <li><i class="fal fa-map-marker-alt"></i> <?= $dataStoreCustom['address'] ?></li>
                             </ul>
                         </div>
                     </div>
                 </div>

                 <div class="col-lg-3 col-sm-6">
                     <div class="footer-widget">
                         <h5 class="widget-title">Tài khoản</h5>
                         <div class="inner">
                             <ul class="inner-ul">
                                 <li><a href="account">Tài khoản của bạn</a></li>
                                 <li><a href="login">Đăng nhập / Đăng kí</a></li>
                                 <li><a href="cart">Giỏ hàng</a></li>
                                 <li><a href="coming-soon">Yêu thích</a></li>
                                 <li><a href="product">Danh mục sản phẩm</a></li>
                             </ul>
                         </div>
                     </div>
                 </div>

                 <div class="col-lg-3 col-sm-6">
                     <div class="footer-widget">
                         <h5 class="widget-title">Đường dẫn nhanh</h5>
                         <div class="inner">
                             <ul class="inner-ul">
                                 <li><a href="coming-soon">Chính sách Bảo mật</a></li>
                                 <li><a href="coming-soon">Điều khoản sử dụng</a></li>
                                 <li><a href="coming-soon">FAQ</a></li>
                                 <li><a href="coming-soon">Giới thiệu</a></li>
                                 <li><a href="contact">Liên hệ</a></li>
                             </ul>
                         </div>
                     </div>
                 </div>

                 <div class="col-lg-3 col-sm-6">
                     <div class="footer-widget">
                         <h5 class="widget-title">Tải ứng dụng</h5>
                         <div class="inner">
                             <span>Tiết kiệm 100.000đ với Ứng dụng & Chỉ dành cho Người dùng mới.</span>
                             <div class="download-btn-group">
                                 <div class="qr-code">
                                     <img src="public/images/others/qrcode.png" alt="Vu Ngoc Tan_facebook">
                                 </div>
                                 <div class="app-link">
                                     <a class="mb-4 d-block " href="#">
                                         <img src="public/images/others/app-store.png" alt="App Store">
                                     </a>
                                     <a href="#">
                                         <img src="public/images/others/play-store.png" alt="Play Store">
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="copyright-area">
         <div class="container bt">
             <div class="row align-items-center">
                 <div class="col-xl-4">
                     <div class="social-share">
                         <a href="#"><i class="fab fa-facebook-f"></i></a>
                         <a href="#"><i class="fab fa-instagram"></i></a>
                         <a href="#"><i class="fab fa-twitter"></i></a>
                         <a href="#"><i class="fab fa-linkedin-in"></i></a>
                         <a href="#"><i class="fab fa-discord"></i></a>
                     </div>
                 </div>
                 <div class="col-xl-4 col-lg-12">
                     <div class="copyright-left d-flex flex-wrap justify-content-center">
                         <ul class="quick-link">
                             <li>© 2023. Bản quyền thuộc về <a target="_blank" href="#">Vungtan2004</a>.</li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-4 col-lg-12">
                     <div class="copyright-right d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
                         <span class="card-text">Chấp nhận thanh toán</span>
                         <ul class="payment-icons-bottom quick-link">
                             <li><img src="public/images/icons/cart/cart-1.png" alt="paypal cart"></li>
                             <li><img src="public/images/icons/cart/cart-2.png" alt="paypal cart"></li>
                             <li><img src="public/images/icons/cart/cart-5.png" alt="paypal cart"></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </footer>