<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Include your database connection code here
    include 'db_connection.php';

    // Get the director ID from the URL
    $director_id = $_GET["id"];

    // SQL query to delete the director from the database
    $sql = "DELETE FROM directors WHERE director_id = '$director_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the director list page after successful deletion
        header("Location: director.php");
    } else {
        echo "Lỗi khi xóa đạo diễn: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to an error page or handle the error as needed
    echo "Yêu cầu không hợp lệ";
}
?>
