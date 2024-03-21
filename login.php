<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Xem Phim - Đăng nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/login_register.css">
</head>

<body>
    <div class="container-custom">
        <h1 class="text-center text-white">Đăng nhập</h1>
        <div id="message" class="message-container">
            <p id="error-message"></p> <span class="close-icon" id="close-icon" onclick="closeMessage()">
                <i class="fas fa-times"></i>
            </span>
        </div>

        <form action="process_login.php" method="post" class="form text-white">
            <div class="input-group">
                <input type="hidden" id="form-action" name="formAction" value="login">
                <label for="userName"><i class="fas fa-user"></i> Tên đăng nhập</label>
                <input type="text" id="userName" name="userName" class="form-input" required maxlength="20" placeholder="Nhập tên đăng nhập">
            </div>

            <div class="input-group">
                <label for="userPassword"><i class="fas fa-solid fa-lock"></i> Mật khẩu</label>
                <input type="password" id="userPassword" name="userPassword" class="form-input" required maxlength="20" placeholder="Nhập mật khẩu">
                <span class="toggle-password" onclick="togglePasswordVisibility('userPassword', 'eye-icon')">
                    <i class="fas fa-eye" id="eye-icon"></i>
                </span>
            </div>
            <button type="submit" class="button">Đăng nhập</button>
        </form>
        <div class="text-center">
            <p class="text-white">Bạn chưa có tài khoản? <a href="register.php" class="info-color">Tạo tài khoản</a></p>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        <?php include 'assets/js/login_register.js'; ?>
    </script>

</body>

</html>