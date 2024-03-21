<?php
// Include your database connection code here
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem tên thể loại đã được gửi từ biểu mẫu chưa
    if (isset($_POST["genre_name"])) {
        $genreName = $_POST["genre_name"];

        // Chuẩn bị truy vấn để thêm thể loại phim mới vào cơ sở dữ liệu
        $sql = "INSERT INTO genres (genre_name) VALUES (?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $genreName);
            $stmt->execute();

            // Kiểm tra xem thêm thể loại phim đã thành công hay không
            if ($stmt->affected_rows > 0) {
                // Thêm thành công, chuyển hướng đến trang danh sách thể loại phim
                header("Location: genre.php");
            } else {
                // Lỗi khi thêm thể loại phim
                echo "Lỗi khi thêm thể loại phim vào cơ sở dữ liệu.";
            }

            // Đóng kết nối và statement
            $stmt->close();
        } else {
            // Lỗi khi chuẩn bị truy vấn
            echo "Lỗi khi chuẩn bị truy vấn.";
        }
    } else {
        // Không nhận được dữ liệu từ biểu mẫu
        echo "Không nhận được dữ liệu từ biểu mẫu.";
    }
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
