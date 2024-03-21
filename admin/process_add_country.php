<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    include 'db_connection.php';

    // Get the country name from the form
    $country_name = $_POST["country_name"];

    // SQL query to insert the new country into the database
    $sql = "INSERT INTO countries (country_name) VALUES (?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $country_name);
        if ($stmt->execute()) {
            // Redirect to the country list page after successful insertion
            header("Location: country.php");
        } else {
            echo "Lỗi khi thêm quốc gia: " . $stmt->error;
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
