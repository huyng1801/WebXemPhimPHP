<?php
session_start(); 
include 'db_connection.php';

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    $sql = "SELECT * FROM users WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Tên đăng nhập đã tồn tại!";
    } else {  
        if ($userPassword != $confirmPassword) {
            echo "Mật khẩu không khớp!";
        }
        else {
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (user_name, user_password, user_role) VALUES (?, ?, 'user')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $userName, $hashedPassword);

        if ($stmt->execute()) {
            echo '<script>window.location.href = "login.php";</script>';
        } else {
            echo "Đăng ký không thành công!";
        }
        }
     
    }
    
    $stmt->close();
}

$conn->close();
