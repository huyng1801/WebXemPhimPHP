<?php
include 'db_connection.php';
session_start();
$userName = $_SESSION['user_name'];
$sql = "SELECT 
movies.*,
IFNULL(view_counts.view_count, 0) AS view_count,
IFNULL(avg_ratings.avg_rating, 0) AS avg_rating,
IFNULL(like_counts.like_count, 0) AS like_count,
IFNULL(view_times.view_time, 0) AS view_time,
directors.director_name,
GROUP_CONCAT(actors.actor_name SEPARATOR ', ') AS actor_names
FROM movies
LEFT JOIN directors ON movies.director_id = directors.director_id
LEFT JOIN movie_actors ON movies.movie_id = movie_actors.movie_id
LEFT JOIN actors ON movie_actors.actor_id = actors.actor_id
LEFT JOIN (
SELECT movie_id, MAX(view_time) AS view_time
FROM movie_views
WHERE user_name = '" . $userName . "'
GROUP BY movie_id
) AS view_times ON movies.movie_id = view_times.movie_id
LEFT JOIN (
SELECT movie_id, COUNT(*) AS view_count
FROM movie_views
GROUP BY movie_id
) AS view_counts ON movies.movie_id = view_counts.movie_id
LEFT JOIN (
SELECT movie_id, AVG(rating) AS avg_rating
FROM user_ratings
GROUP BY movie_id
) AS avg_ratings ON movies.movie_id = avg_ratings.movie_id
LEFT JOIN (
SELECT movie_id, COUNT(*) AS like_count
FROM favorite_movies
GROUP BY movie_id
) AS like_counts ON movies.movie_id = like_counts.movie_id
WHERE view_time <> 0
GROUP BY movies.movie_id;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="movie-card">';
        echo '<div class="image-title"><a href="watch_movie.php?movie_id=' . $row["movie_id"] . '"><img src="' . $row["image_link"] . '" alt="' . $row["title"] . '"></a>';
        echo '<p class="movie-title"><a href="watch_movie.php?movie_id=' . $row["movie_id"] . '">' . $row["title"] . '</a></p></div>';
        echo '<div class="left"><p class="view-favorite"><i class="fas fa-eye"></i> ' . $row["view_count"] . '</p>';
        echo '<p class="view-favorite"><i class="fas fa-solid fa-heart"></i> ' . $row["like_count"] . '</p></div>';
        echo '<div class="center"><p class="view-time">' . $row["view_time"] . '</p></div>';
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
    echo '<p>Không tìm thấy kết quả nào.</p>';
}

$conn->close();
?>
