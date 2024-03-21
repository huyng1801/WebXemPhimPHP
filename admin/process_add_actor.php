<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    include 'db_connection.php';

    // Get the actor name from the form
    $actor_name = $_POST["actor_name"];

    // SQL query to insert the actor name into the database
    $sql = "INSERT INTO actors (actor_name) VALUES (?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $actor_name);
        if ($stmt->execute()) {
            // Redirect to the actor list page after successful addition
            header("Location: actor.php");
        } else {
            echo "Lỗi khi thêm diễn viên: " . $stmt->error;
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
