<?php
session_start(); 
include 'db_connection.php';

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPassword"];
    $sql = "SELECT user_password, user_role FROM users WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashedPassword, $userRole);
        $stmt->fetch();
        if (password_verify($userPassword, $hashedPassword)) {
         $_SESSION["user_name"] = $userName;
            $_SESSION["user_role"] = $userRole;
   
            if ($userRole === 'admin') {
                echo "admin";
                exit();
            } else {
                echo "user";
                exit();
            }
        } else {
            echo "Thông tin đăng nhập không chính xác!";
        }
    } else {
        echo "Thông tin đăng nhập không chính xác!";
    }

    $stmt->close();
}

$conn->close();
