<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database (adjust these credentials as needed)
    include 'db_connection.php';

    // Extract data from the form
    $title = $_POST['title'];
    $release_day = $_POST['release_day'];
    $director_id = $_POST['director_id'];
    $country_id = $_POST['country_id'];
    $genre_id = $_POST['genre_id'];
    $image_link = $_POST['image_link'];
    $directory = $_POST['directory'];
    $movie_tatus =  $_POST['movie_tatus'];
    $selectedActors = json_decode($_POST['selectedActors']);
    $uniqueActors = array_unique($selectedActors);
    $selectedActors = array_values($uniqueActors);


    // Prepare and execute the SQL query to insert the movie
    $sql = "INSERT INTO movies (title, release_day, director_id, country_id, genre_id, image_link, directory, movie_status) VALUES ('$title', '$release_day', '$director_id', '$country_id', '$genre_id', '$image_link', '$directory', '$movie_status')";

    if ($conn->query($sql) === TRUE) {
        // Get the ID of the newly inserted movie
        $movie_id = $conn->insert_id;
    if (!empty($selectedActors)) {
        foreach ($selectedActors as $selectedActor) {
            $actors[] = $selectedActor;
            foreach ($actors as $actor_id) {
                $sql = "INSERT INTO movie_actors (movie_id, actor_id) VALUES ('$movie_id', '$actor_id')";
                $conn->query($sql);
            }
        }
    }
        // Loop through the selected actors and insert them into the movie_actors table
       

        // Redirect to the movie list page after successful insertion
        header("Location: movie.php");
    } else {
        echo "Lỗi khi thêm phim: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Dữ liệu không được gửi qua biểu mẫu.";
}
?>
