<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Include your database connection code here
    include 'db_connection.php';

    // Get the country ID from the query string
    $country_id = $_GET["id"];

    // SQL query to delete the country from the database
    $sql = "DELETE FROM countries WHERE country_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $country_id);
        if ($stmt->execute()) {
            // Redirect to the country list page after successful deletion
            header("Location: country.php");
        } else {
            echo "Lỗi khi xóa quốc gia: " . $stmt->error;
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
