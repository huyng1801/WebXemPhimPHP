<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    include 'db_connection.php';

    // Get the genre ID and updated genre information from the form
    $genre_id = $_POST["genre_id"];
    $genre_name = $_POST["genre_name"];
    // Add similar code for other genre information as needed

    // Validate input data
    if (empty($genre_id) || empty($genre_name)) {
        echo "Dữ liệu không hợp lệ.";
    } else {
        // SQL query to update genre information in the database
        $sql = "UPDATE genres SET
                genre_name = ?
                WHERE genre_id = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("si", $genre_name, $genre_id);
            if ($stmt->execute()) {
                // Redirect to the genre list page after successful update
                header("Location: genre.php");
            } else {
                echo "Lỗi khi cập nhật thông tin thể loại phim: " . $stmt->error;
            }

            // Đóng statement
            $stmt->close();
        } else {
            echo "Lỗi khi chuẩn bị truy vấn.";
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to an error page or handle the error as needed
    echo "Yêu cầu không hợp lệ";
}
?>
