<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Include your database connection code here
    include 'db_connection.php';

    // Get the actor ID from the query string
    $actor_id = $_GET["id"];

    // SQL query to delete the actor from the database
    $sql = "DELETE FROM actors WHERE actor_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $actor_id);
        if ($stmt->execute()) {
            // Redirect to the actor list page after successful deletion
            header("Location: actor.php");
        } else {
            echo "Lỗi khi xóa diễn viên: " . $stmt->error;
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
