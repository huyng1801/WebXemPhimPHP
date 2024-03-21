<?php
include 'db_connection.php';
$selectedCountry = $_GET['country'];
$sql = "SELECT *
        FROM movies
        JOIN countries ON movies.country_id = countries.country_id
        JOIN directors ON movies.director_id = directors.director_id
        WHERE countries.country_name = '$selectedCountry' AND movie_status = 1";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="movie-card">';
        echo '<div class="image-title"><a href="watch_movie.php?movie_id=' . $row["movie_id"] . '"><img src="' . $row["image_link"] . '" alt="' . $row["title"] . '"></a>';
        echo '<p class="movie-title"><a href="watch_movie.php?movie_id=' . $row["movie_id"] . '">' . $row["title"] . '</a></p></div>';
        echo '<div class="left"><p class="view-favorite"><i class="fas fa-eye"></i> ' . $row["view_count"] . '</p>';
        echo '<p class="view-favorite"><i class="fas fa-solid fa-heart"></i> ' . $row["like_count"] . '</p></div>';
        $avg_rating = round($row["avg_rating"], 1);
        echo '<div class="star-rating center">';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $avg_rating) {
                echo '<i class="fas fa-star"></i>';
            } elseif ($i - 0.5 <= $avg_rating) {
                echo '<i class="fas fa-star-half-alt"></i>'; // Half star
            } else {
                echo '<i class="far fa-star"></i>';
            }
        }
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Không tìm thấy bộ phim nào.</p>';
}
mysqli_close($conn);
?>