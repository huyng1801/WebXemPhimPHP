<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Include your database connection code here
    include 'db_connection.php';

    // Get the genre ID from the URL parameter
    $genre_id = $_GET["id"];

    // SQL query to delete the genre with the given ID
    $sql = "DELETE FROM genres WHERE genre_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $genre_id);
        if ($stmt->execute()) {
            // Redirect to the genre list page after successful deletion
            header("Location: genre.php");
        } else {
            echo "Lỗi khi xóa thể loại phim: " . $stmt->error;
        }

        // Đóng statement
        $stmt->close();
    } else {
        echo "Lỗi khi chuẩn bị truy vấn.";
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to an error page or handle the error as needed
    echo "Yêu cầu không hợp lệ";
}
?>
