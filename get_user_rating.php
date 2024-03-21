<?php
 include 'db_connection.php';

if (isset($_GET['movie_id'])) {
    $movieID = $_GET['movie_id'];
    session_start();
    $userName = $_SESSION['user_name'];
    $sql = "SELECT rating FROM user_ratings WHERE user_name = '$userName' AND movie_id = $movieID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userRating = $row['rating'];
        echo $userRating;
    } else {
        echo "no_rating"; 
    }
} else {
    echo "no_rating"; 
}
 $conn->close();
?>
