<?php
include 'db_connection.php';
$movieID = $_POST['movie_id'];
$rating = $_POST['rating'];
session_start();
$userName = $_SESSION['user_name'];
$sqlCheckExistingRating = "SELECT * FROM user_ratings WHERE user_name = '$userName' AND movie_id = $movieID";
$resultCheckExistingRating = $conn->query($sqlCheckExistingRating);

if ($resultCheckExistingRating->num_rows > 0) {
    $sqlUpdateRating = "UPDATE user_ratings SET rating = $rating WHERE user_name = '$userName' AND movie_id = $movieID";

    if ($conn->query($sqlUpdateRating) === TRUE) {
        echo "success_rating";
    } else {
        echo "Lỗi khi cập nhật đánh giá: " . $conn->error;
    }
} else {
    $sqlInsertRating = "INSERT INTO user_ratings (user_name, movie_id, rating) VALUES ('$userName', $movieID, $rating)";

    if ($conn->query($sqlInsertRating) === TRUE) {
        echo "success_rating";
    } else {
        echo "Lỗi khi thêm đánh giá mới: " . $conn->error;
    }
}
$conn->close();
?>
