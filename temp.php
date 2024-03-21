$sqlFavorite = "SELECT * FROM favorite_movies WHERE movie_id = '" . $movieID . "' AND user_name = '" . $userName . "'";
    $resultFavorite = $conn->query($sqlFavorite);