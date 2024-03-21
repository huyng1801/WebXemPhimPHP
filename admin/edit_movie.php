<!DOCTYPE html>
<html lang="vi">
<?php
include 'head.php';
?>

<body>
    <div class="container-custom">
        <?php
        include 'sidebar.php';
        ?>
        <!-- Main Content -->
        <div class="content" id="main-content">
            <span id="menu-toggle" onclick="toggleSidebar()">&#9776;</span>
            <?php
            // Kiểm tra xem có tham số movie_id được cung cấp trong URL không
            if (isset($_GET['id'])) {
                $movie_id = $_GET['id'];

                // Kết nối đến cơ sở dữ liệu
                include 'db_connection.php';

                // Truy vấn để lấy thông tin của phim
                $sql = "SELECT m.*, GROUP_CONCAT(ma.actor_id) AS selected_actors
                    FROM movies m
                    LEFT JOIN movie_actors ma ON m.movie_id = ma.movie_id
                    WHERE m.movie_id = '$movie_id'
                    GROUP BY m.movie_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
            ?>
                    <h1>Chỉnh sửa phim</h1>
                    <div class="form-container">
                        <form action="process_edit_movie.php" method="post">
                            <input type="hidden" name="movie_id" value="<?php echo $row['movie_id']; ?>">
                            <div>
                                <label for="title">Tiêu đề:</label>
                                <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required>
                            </div>
                            <div>
                                <label for="release_day">Ngày phát hành:</label>
                                <input type="date" id="release_day" name="release_day" value="<?php echo $row['release_day']; ?>">
                            </div>
                            <div>
                                <label for="director_id">Đạo diễn:</label>
                                <select id="director_id" name="director_id">
                                    <!-- Load danh sách các đạo diễn từ cơ sở dữ liệu -->
                                    <?php
                                    $director_id = $row['director_id'];
                                    $sql_directors = "SELECT director_id, director_name FROM directors";
                                    $result_directors = $conn->query($sql_directors);

                                    if ($result_directors->num_rows > 0) {
                                        while ($director_row = $result_directors->fetch_assoc()) {
                                            $selected = ($director_row['director_id'] == $director_id) ? 'selected' : '';
                                            echo '<option value="' . $director_row['director_id'] . '" ' . $selected . '>' . $director_row['director_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="country_id">Quốc gia:</label>
                                <select id="country_id" name="country_id">
                                    <!-- Load danh sách các quốc gia từ cơ sở dữ liệu -->
                                    <?php
                                    $country_id = $row['country_id'];
                                    $sql_countries = "SELECT country_id, country_name FROM countries";
                                    $result_countries = $conn->query($sql_countries);

                                    if ($result_countries->num_rows > 0) {
                                        while ($country_row = $result_countries->fetch_assoc()) {
                                            $selected = ($country_row['country_id'] == $country_id) ? 'selected' : '';
                                            echo '<option value="' . $country_row['country_id'] . '" ' . $selected . '>' . $country_row['country_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="genre_id">Thể loại:</label>
                                <select id="genre_id" name="genre_id">
                                    <!-- Load danh sách các thể loại từ cơ sở dữ liệu -->
                                    <?php
                                    $genre_id = $row['genre_id'];
                                    $sql_genres = "SELECT genre_id, genre_name FROM genres";
                                    $result_genres = $conn->query($sql_genres);

                                    if ($result_genres->num_rows > 0) {
                                        while ($genre_row = $result_genres->fetch_assoc()) {
                                            $selected = ($genre_row['genre_id'] == $genre_id) ? 'selected' : '';
                                            echo '<option value="' . $genre_row['genre_id'] . '" ' . $selected . '>' . $genre_row['genre_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="selectedActors">Diễn viên:</label>
                                <input type="hidden" id="selectedActors" name="selectedActors">
                                <div class="actors-container">
                                    <select id="allActors" multiple>
                                        <!-- Load danh sách tất cả các diễn viên từ cơ sở dữ liệu -->
                                        <?php
                                        $selected_actors = explode(',', $row['selected_actors']);
                                        $sql_actors = "SELECT actor_id, actor_name FROM actors ORDER BY actor_id";
                                        $result_actors = $conn->query($sql_actors);

                                        if ($result_actors->num_rows > 0) {
                                            while ($actor_row = $result_actors->fetch_assoc()) {
                                                $selected = (in_array($actor_row['actor_id'], $selected_actors)) ? 'selected' : '';
                                                echo '<option value="' . $actor_row['actor_id'] . '" ' . $selected . '>' . $actor_row['actor_name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <ul class="selected-actors-list" id="selectedActorsList">
                                        <!-- Hiển thị danh sách diễn viên đã chọn -->
                                        <?php
                                        foreach ($selected_actors as $selected_actor_id) {
                                            $sql_actor_name = "SELECT actor_name FROM actors WHERE actor_id = '$selected_actor_id'";
                                            $result_actor_name = $conn->query($sql_actor_name);
                                            if ($result_actor_name->num_rows > 0) {
                                                $actor_name = $result_actor_name->fetch_assoc()['actor_name'];
                                                echo '<li data-actor-id="' . $selected_actor_id . '">
                                                    <span class="actor-name">' . $actor_name . '</span>
                                                    <span class="remove-actor">&#10006;</span>
                                                </li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <select id="movie_status" name="movie_status">
                                        <option value="0" <?php echo ($row['movie_status'] == 0) ? 'selected' : ''; ?>>Ẩn</option>
                                        <option value="1" <?php echo ($row['movie_status'] == 1) ? 'selected' : ''; ?>>Hiện</option>
                                    </select>
                                </div>

                                <label for="image_link">Link hình ảnh:</label>
                                <input type="text" id="image_link" name="image_link" value="<?php echo $row['image_link']; ?> " oninput="displayImage()">
                            </div>
                            <div class="image-container">
                                <img id="image_display" src="<?php echo $row['image_link']; ?>" alt="Hình ảnh">
                            </div>
                            <div class="form-group">
                                <label for="directory">Đường dẫn tệp phim:</label>
                                <input type="text" class="form-control" id="directory" name="directory" value="<?php echo $row['directory']; ?>" oninput="updateVideo()">
                            </div>
                            <div>
                                <iframe id="video_frame" src="<?php echo $row['directory']; ?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                            <!-- Thêm các trường thông tin khác -->
                            <div class="button-center">
                                <button type="submit" class="button">
                                    <i class="fas fa-save"></i> Lưu <!-- Change the icon here -->
                                </button>
                                <a href="movie.php" class="button"><i class="fas fa-arrow-left"></i> Trở về</a>
                            </div>
                        </form>
                    </div>
            <?php
                } else {
                    echo "Không tìm thấy phim.";
                }
            } else {
                echo "Không có ID phim được cung cấp.";
            }
            ?>
        </div>
    </div>
    <script>
        <?php include 'assets/js/main.js'; 
        include 'assets/js/movie.js';
        ?>
    </script>
</body>

</html>