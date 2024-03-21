<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    include 'db_connection.php';

    // Get the actor ID and updated actor information from the form
    $actor_id = $_POST["actor_id"];
    $actor_name = $_POST["actor_name"];

    // SQL query to update actor information in the database
    $sql = "UPDATE actors SET actor_name = ? WHERE actor_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $actor_name, $actor_id);
        if ($stmt->execute()) {
            // Redirect to the actor list page after successful update
            header("Location: actor.php");
        } else {
            echo "Lỗi khi cập nhật thông tin diễn viên: " . $stmt->error;
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
