<?php
include 'db_connection.php';
if (isset($_POST['movie_id'])) {
    session_start(); 
    $userName = $_SESSION['user_name'];
    $movieID = $_POST['movie_id'];
    $checkSQL = "SELECT * FROM favorite_movies WHERE user_name = '$userName' AND movie_id = $movieID";
    $checkResult = $conn->query($checkSQL);
    if ($checkResult->num_rows > 0) {
        $deleteSQL = "DELETE FROM favorite_movies WHERE user_name = '$userName' AND movie_id = $movieID";
        if ($conn->query($deleteSQL) === TRUE) {
            echo "success_unfavorite"; 
        } else {
            echo "error_unfavorite";
        }
    } else {
        $insertSQL = "INSERT INTO favorite_movies (user_name, movie_id) VALUES ('$userName', $movieID)";
        if ($conn->query($insertSQL) === TRUE) {
            echo "success_favorite"; 
        } else {
            echo "error_favorite";
        }
    }
    $conn->close();
} else {
    echo "invalid_request";
}
?>
