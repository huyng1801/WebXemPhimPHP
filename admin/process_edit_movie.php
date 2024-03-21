<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu
    include 'db_connection.php';

    // Lấy dữ liệu từ biểu mẫu chỉnh sửa phim
    $movie_id = $_POST['movie_id'];
    $title = $_POST['title'];
    $release_day = $_POST['release_day'];
    $director_id = $_POST['director_id'];
    $country_id = $_POST['country_id'];
    $genre_id = $_POST['genre_id'];
    $image_link = $_POST['image_link'];
    $directory = $_POST['directory'];
    $movie_status = $_POST['movie_status'];
    // Xử lý cập nhật thông tin phim trong cơ sở dữ liệu
    $sql_update_movie = "UPDATE movies 
                         SET title = '$title', release_day = '$release_day', 
                             director_id = '$director_id', country_id = '$country_id', 
                             genre_id = '$genre_id', image_link = '$image_link', 
                             directory = '$directory', movie_status = '$movie_status' 
                         WHERE movie_id = '$movie_id'";
    if ($conn->query($sql_update_movie) === TRUE) {
        // Xóa tất cả diễn viên liên quan đến phim
        $sql_delete_actors = "DELETE FROM movie_actors WHERE movie_id = '$movie_id'";
        $conn->query($sql_delete_actors);

        // Lưu danh sách diễn viên đã chọn
        $selected_actors_json = $_POST['selectedActors'];
        $selected_actors = json_decode($selected_actors_json);

        if (!empty($selected_actors)) {
            foreach ($selected_actors as $actor_id) {
                // Thêm diễn viên vào bảng movie_actors
                $sql_insert_actor = "INSERT INTO movie_actors (movie_id, actor_id) 
                                     VALUES ('$movie_id', '$actor_id')";
                $conn->query($sql_insert_actor);
            }
        }

        // Chuyển hướng người dùng sau khi cập nhật thành công
        header("Location: movie.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật thông tin phim: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
} else {
    // Nếu không phải là phương thức POST, chuyển hướng người dùng về trang index hoặc trang khác
    header("Location: movie.php");
    exit();
}
?>
