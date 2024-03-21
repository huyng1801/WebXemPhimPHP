<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Xem Phim - Đăng ký</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAAhYWFAMfHxwBra2sAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACAAMAAAAAAAAAAAAAAAAAAAIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACAQMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACAwMDAwMDAAAAAAAAAAAAAgEBAQEBAwADAAMAAAAAAAIBAQEBAQMAAQABAAAAAAACAQEBAQEDAAIAAgAAAAAAAgICAgICAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIDAwAAAAIDAwAAAAAAAAACAQMAAAACAQMAAAAAAAAAAgICAAAAAgICAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPB/AAD4/wAA8H8AAPB/AADAHQAAwAkAAMABAADAAQAAwAEAAMAJAADAHQAAgg8AAIIPAACCDwAAxx8AAP//AAA=" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/login_register.css">
</head>

<body>
    <div class="container-custom">
        <h1 class="text-center text-white">Đăng ký</h1>
        <div id="message" class="message-container">
            <p id="error-message"></p> <span class="close-icon" id="close-icon" onclick="closeMessage()">
                <i class="fas fa-times"></i>
            </span>
        </div>
        <form action="process_register.php" method="post" class="form text-white">
            <div class="input-group">
                <input type="hidden" id="form-action" name="formAction" value="register">
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
            <div class="input-group">
                <label for="confirmPassword"><i class="fas fa-solid fa-lock"></i> Nhập lại mật khẩu</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-input" required maxlength="20" placeholder="Nhập lại mật khẩu">
                <span class="toggle-password" onclick="togglePasswordVisibility('confirmPassword', 'eye-icon-confirmPassword')">
                    <i class="fas fa-eye" id="eye-icon-confirmPassword"></i>
                </span>
            </div>
            <button type="submit" class="button">Đăng ký</button>
        </form>
        <div class="text-center mt-3">
            <p class="text-white">Bạn đã có tài khoản? <a href="/login.php" class="info-color">Đăng nhập</a></p>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        <?php include 'assets/js/login_register.js'; ?>
    </script>

</body>

</html>