<?php
// session_start();
// if (!isset($_SESSION["user_name"])) {
//     echo '<script>window.location.href = "login.php";</script>';
//     exit;
// }
include 'header.php';
include 'db_connection.php';
?>
<main>
    <div class="content-title">
        <h2 id="content-title">Danh sách phim</h2>
    </div>
    <section class="movie-list" id="movies-container">
        <?php
        $sql = "SELECT 
            movies.*,
            IFNULL(view_counts.view_count, 0) AS view_count,
            IFNULL(avg_ratings.avg_rating, 0) AS avg_rating,
            IFNULL(like_counts.like_count, 0) AS like_count
            FROM movies
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
            WHERE movies.movie_status = 1";
        $result = $conn->query($sql);
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
                        echo '<i class="fas fa-star-half-alt"></i>';
                    } else {
                        echo '<i class="far fa-star"></i>';
                    }
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Không có bộ phim nào trong CSDL.</p>';
        }
        ?>
    </section>
    <div class="content-title">
        <h2>Danh sách phim đã xem</h2>
    </div>
    <section class="movie-list" id="watched-movies-container">
        <?php
        $user_name = $_SESSION["user_name"];
        $sqlWatchedMovies = "SELECT DISTINCT movies.*,
            IFNULL(view_counts.view_count, 0) AS view_count,
            IFNULL(avg_ratings.avg_rating, 0) AS avg_rating,
            IFNULL(like_counts.like_count, 0) AS like_count
            FROM movies
            INNER JOIN movie_views ON movies.movie_id = movie_views.movie_id
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
            WHERE movie_views.user_name = '$user_name'";
        $resultWatchedMovies = $conn->query($sqlWatchedMovies);

        if ($resultWatchedMovies->num_rows > 0) {
            while ($rowWatched = $resultWatchedMovies->fetch_assoc()) {
                echo '<div class="movie-card">';
                echo '<div class="image-title"><a href="watch_movie.php?movie_id=' . $rowWatched["movie_id"] . '"><img src="' . $rowWatched["image_link"] . '" alt="' . $rowWatched["title"] . '"></a>';
                echo '<p class="movie-title"><a href="watch_movie.php?movie_id=' . $rowWatched["movie_id"] . '">' . $rowWatched["title"] . '</a></p></div>';
                echo '<div class="left"><p class="view-favorite"><i class="fas fa-eye"></i> ' . $rowWatched["view_count"] . '</p>';
                echo '<p class="view-favorite"><i class="fas fa-solid fa-heart"></i> ' . $rowWatched["like_count"] . '</p></div>';
                $avg_rating = round($rowWatched["avg_rating"], 1);
                echo '<div class="star-rating center">';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $avg_rating) {
                        echo '<i class="fas fa-star"></i>';
                    } elseif ($i - 0.5 <= $avg_rating) {
                        echo '<i class="fas fa-star-half-alt"></i>';
                    } else {
                        echo '<i class="far fa-star"></i>';
                    }
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Không có phim nào đã xem.</p>';
        }
        ?>
    </section>
</main>
<?php include 'footer.php'; ?>
<script>
    <?php include 'assets/js/main.js'; ?>
</script>
</body>
</html>