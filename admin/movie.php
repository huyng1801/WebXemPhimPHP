<!DOCTYPE html>
<html lang="vi">
<?php
        include 'head.php';
        ?>

<body>
    <div class="container-custom">
        <!-- Sidebar (Menu) -->
        <?php
        include 'sidebar.php';
        ?>
        <!-- Main Content -->
        <div class="content" id="main-content">
            <span id="menu-toggle" onclick="toggleSidebar()">&#9776;</span>

            <!-- Add your PHP code for movie list here -->
            <main">

                <h1>Danh sách phim</h1>
                <button class="button" onclick="location.href='add_movie.php'">
                    <i class="fas fa-plus"></i> Thêm phim
                </button>

                <!-- Movie List Table -->
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                            <th class="hidden">Hình ảnh</th>
                                <th>Tiêu đề</th>
                                <th>Ngày phát hành</th>
                                <th>Quốc gia</th>
                                <th class="hidden">Đạo diễn</th>
                                <th>Thể loại</th>
                                <th class="hidden">Diễn viên</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Your PHP code to populate the table goes here -->
                            <?php
                            // Include your database connection code here
                            include 'db_connection.php';

                            // Truy vấn để lấy danh sách phim kèm tên diễn viên, đạo diễn, thể loại và quốc gia
                            $sql = "SELECT m.*, GROUP_CONCAT(a.actor_name SEPARATOR ', ') AS actors, 
                                 d.director_name, g.genre_name, c.country_name
                                 FROM movies m
                                 LEFT JOIN movie_actors ma ON m.movie_id = ma.movie_id
                                 LEFT JOIN actors a ON ma.actor_id = a.actor_id
                                 LEFT JOIN directors d ON m.director_id = d.director_id
                                 LEFT JOIN genres g ON m.genre_id = g.genre_id
                                 LEFT JOIN countries c ON m.country_id = c.country_id
                                 GROUP BY m.movie_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td class="center hidden"><img src="' . $row['image_link'] . '" style="max-width: 100px; max-height: 50px;"></td>';
                                    echo '<td>' . $row['title'] . '</td>';
                                    echo '<td class="center">' . $row['release_day'] . '</td>';
                                    echo '<td class="center">' . $row['country_name'] . '</td>';
                                    echo '<td class="center hidden">' . $row['director_name'] . '</td>';
                                    echo '<td class="center">' . $row['genre_name'] . '</td>';
                                    echo '<td class="hidden">' . $row['actors'] . '</td>'; // Hiển thị tên diễn viên
                                    echo '<td class="center">' . (($row['movie_status'] == 0) ? 'Ẩn' : 'Hiện') . '</td>';

                                    echo '<td class="center"><a href="edit_movie.php?id=' . $row['movie_id'] . '"><i class="fas fa-edit icon icon-edit"></i></a> <a href="process_delete_movie.php?id=' . $row['movie_id'] . '"><i class="fas fa-trash-alt icon icon-delete"></i></a></td>';

                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="9">Không có phim nào trong cơ sở dữ liệu.</td></tr>';
                            }

                            // Close the database connection
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <script>
        <?php include 'assets/js/main.js'; ?>

    </script>
</body>

</html>