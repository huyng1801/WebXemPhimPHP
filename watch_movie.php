<?php
if (isset($_GET['movie_id'])) {
    $movieID = $_GET['movie_id'];
    session_start();
    $userName = $_SESSION['user_name'];
    include 'db_connection.php';
    
    // Insert a new record into the movie_views table
    $insertSQL = "INSERT INTO movie_views (user_name, movie_id) VALUES ('$userName', $movieID)";
    if ($conn->query($insertSQL) === TRUE) {
        // The record was inserted successfully
    } else {
        echo "Error inserting record into movie_views: " . $conn->error;
    }
    $sqlFavorite = "SELECT * FROM favorite_movies WHERE movie_id = '" . $movieID . "' AND user_name = '" . $userName . "'";
    $resultFavorite = $conn->query($sqlFavorite);
    // Fetch movie details
    $sql = "SELECT m.*, 
                   d.director_name, 
                   c.country_name, 
                   g.genre_name,
                   GROUP_CONCAT(a.actor_name SEPARATOR ', ') AS actors
            FROM movies AS m
            LEFT JOIN directors AS d ON m.director_id = d.director_id
            LEFT JOIN countries AS c ON m.country_id = c.country_id
            LEFT JOIN genres AS g ON m.genre_id = g.genre_id
            LEFT JOIN movie_actors AS ma ON m.movie_id = ma.movie_id
            LEFT JOIN actors AS a ON ma.actor_id = a.actor_id
            WHERE m.movie_id = $movieID
            GROUP BY m.movie_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $movieURL = $row['directory'];
        $title = $row['title'];
        $content = $row['content'];
        $release_day = $row['release_day'];
        $release_day = date('d/m/Y', strtotime($row['release_day'])); // Format the release day
        $director_name = $row['director_name'];
        $country_name = $row['country_name'];
        $actors = $row['actors'];
        $genre_name = $row['genre_name'];
        // Fetch the number of views for the video
        $viewSQL = "SELECT COUNT(*) AS view_count FROM movie_views WHERE movie_id = $movieID";
        $viewResult = $conn->query($viewSQL);

        if ($viewResult) {
            $viewRow = $viewResult->fetch_assoc();
            $viewCount = $viewRow['view_count'];
        } else {
            $viewCount = 0; // Handle the case where the query fails
        }

        // Fetch the number of likes for the video
        $likeSQL = "SELECT COUNT(*) AS like_count FROM favorite_movies WHERE movie_id = $movieID";
        $likeResult = $conn->query($likeSQL);

        if ($likeResult) {
            $likeRow = $likeResult->fetch_assoc();
            $likeCount = $likeRow['like_count'];
        } else {
            $likeCount = 0; // Handle the case where the query fails
        }

        // Display movie information
        include 'header.php';
        echo '<main>';
        echo '<div class="video-frame">';
        echo '<input type="hidden" id="movie_id" name="movie_id" value="' . $movieID . '">';
        echo '<iframe src="' . $movieURL . '" class="video-item" frameborder="0" allowfullscreen></iframe>';
        echo '</div>';
        echo '<div class="right">';
        if ($resultFavorite->num_rows == 0) {
            echo '<span id="favorite-icon" class="far fa-heart" onclick="toggleFavorite()"></span>';
        } else {
            echo '<span id="favorite-icon" class="fas fa-heart" onclick="toggleFavorite()"></span>';
        }

        // Display rating stars (assuming you have a function for this)
        echo '<div class="rating" id="ratingStars">';
        echo '<span class="star" onclick="rateVideo(1)"><i class="fas fa-star"></i></span>';
        echo '<span class="star" onclick="rateVideo(2)"><i class="fas fa-star"></i></span>';
        echo '<span class="star" onclick="rateVideo(3)"><i class="fas fa-star"></i></span>';
        echo '<span class="star" onclick="rateVideo(4)"><i class="fas fa-star"></i></span>';
        echo '<span class="star" onclick="rateVideo(5)"><i class="fas fa-star"></i></span>';
        echo '</div>';
        echo '</div>';
        echo '<div class="movie-details">';
        echo '<h2 class="movie-details-title">' . $title . '</h2>';
        echo '<p><strong>Nội dung:</strong>' . $content . '</p>';
        echo '<p><strong>Ngày phát hành:</strong> ' . $release_day. '</p>';
        echo '<p><strong>Đạo diễn:</strong> ' . $director_name . '</p>';
        echo '<p><strong>Quốc gia:</strong> ' . $country_name. '</p>';
        echo '<p><strong>Thể loại:</strong> ' . $genre_name . '</p>';
        echo '<p><strong>Các diễn viên:</strong> ' . $actors . '</p>';
        echo '<p><strong>Lượt xem:</strong> ' . $viewCount . '</p>';
        echo '<p><strong>Lượt thích:</strong> ' . $likeCount . '</p>';
        echo '</div>';

        echo '</main>';
     
        include 'footer.php';
    } else {
        echo '<p>Không tìm thấy phim.</p>';
        exit;
    }
} else {
    echo '<p>Không tìm thấy phim.</p>';
    exit;
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
