<?php
// Check if the movie_id parameter is provided in the URL
if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];

    // Connect to the database (adjust these credentials as needed)
    include 'db_connection.php';

    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to delete the movie
    $sql = "DELETE FROM movies WHERE movie_id = '$movie_id'";
    if ($conn->query($sql) === TRUE) {
        // Redirect to the movie list page after successful deletion
        header("Location: movie.php");
    } else {
        echo "Lỗi khi xóa phim: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Không có ID phim được cung cấp.";
}
?>
