<?php
// echo '<pre>';
// print_r($dataError);
// echo '</pre>';
?>
<section>
    <form method="POST" action="admin/test/post_user">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br>

        <label for="fullname">Tên người dùng:</label>
        <input type="text" id="fullname" name="fullname"><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password"><br>

        <label for="re_password">Xác nhận mật khẩu:</label>
        <input type="password" id="re_password" name="re_password"><br>

        <button type="submit" class="btn btn-custom">Đăng ký</button>
    </form>
</section>