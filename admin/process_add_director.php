<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    include 'db_connection.php';
    // Get the director name from the form
    $director_name = $_POST["director_name"];

    // SQL query to insert the new director into the database
    $sql = "INSERT INTO directors (director_name) VALUES ('$director_name')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the director list page after successful addition
        header("Location: director_list.php");
    } else {
        echo "Lỗi khi thêm đạo diễn: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to an error page or handle the error as needed
    echo "Yêu cầu không hợp lệ";
}
?>
