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
            <h1>Thêm phim</h1>
            <div class="form-container">
                <form action="process_add_movie.php" method="post">
                    <div>
                        <label for="title">Tiêu đề:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div>
                        <label for="release_day">Ngày phát hành:</label>
                        <input type="date" id="release_day" name="release_day">
                    </div>
                    <div class="form-group">
                        <label for="director_id">Đạo diễn:</label>
                        <select id="director_id" name="director_id">
                            <!-- Load danh sách các đạo diễn từ cơ sở dữ liệu -->
                            <?php
                            include 'db_connection.php';
                            $sql = "SELECT director_id, director_name FROM directors ORDER BY director_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['director_id'] . '">' . $row['director_name'] . '</option>';
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
                            $sql = "SELECT country_id, country_name FROM countries ORDER BY country_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['country_id'] . '">' . $row['country_name'] . '</option>';
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
                            $sql = "SELECT genre_id, genre_name FROM genres ORDER BY genre_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['genre_id'] . '">' . $row['genre_name'] . '</option>';
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
                                $sql = "SELECT actor_id, actor_name FROM actors ORDER BY actor_id";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row['actor_id'] . '">' . $row['actor_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <ul class="selected-actors-list" id="selectedActorsList"></ul>
                        </div>
                    </div>
                    <div>
                        <label for="movie_status">Trạng thái:</label>
                        <select id="movie_status" name="movie_status">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                        </select>
                    </div>

                    <div>
                        <label for="image_link">Link hình ảnh:</label>
                        <input type="text" id="image_link" name="image_link" oninput="displayImage()">
                    </div>
                    <div class="image-container">
                        <img id="image_display" src="" alt="Hình ảnh">
                    </div>

                    <div class="form-group">
                        <label for="directory">Đường dẫn tệp phim:</label>
                        <input type="text" class="form-control" id="directory" name="directory" oninput="updateVideo()">
                    </div>
                    <div>
                        <iframe id="video_frame" src="" frameborder="0" allowfullscreen></iframe>
                    </div>

                    <!-- Thêm các trường thông tin khác -->
                    <div class="button-center">
                        <button type="submit" class="button"><i class="fas fa-save"></i> Lưu</button>
                        <a href="movie.php" class="button"><i class="fas fa-arrow-left"></i> Trở về</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        <?php include 'assets/js/main.js'; ?>
        <?php include 'assets/js/movie.js'; ?>
    </script>
</body>

</html>
