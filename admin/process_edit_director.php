<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web_xem_phim";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Get the director ID from the form
    $director_id = $_POST["director_id"];

    // Get the updated director information from the form
    $director_name = $_POST["director_name"];
    // Add similar code for other director information as needed

    // SQL query to update director information in the database
    $sql = "UPDATE directors SET
            director_name = '$director_name'
            WHERE director_id = '$director_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the director list page after successful update
        header("Location: director.php");
    } else {
        echo "Lỗi khi cập nhật thông tin đạo diễn: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to an error page or handle the error as needed
    echo "Yêu cầu không hợp lệ";
}
?>
