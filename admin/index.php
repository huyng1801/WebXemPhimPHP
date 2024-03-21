<!DOCTYPE html>
<html lang="vi">
<?php include 'head.php'; ?>
<body>
    <div class="container-custom">
        <?php include 'sidebar.php'; ?>
        <div class="content" id="main-content">
            <span id="menu-toggle" onclick="toggleSidebar()">&#9776;</span>
        <main>
            <section>
                <h1>Trang chủ</h1>
                <div>
                <h2>Số lượng phim theo thể loại</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Thể loại</th>
                                <th>Số lượng phim</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'db_connection.php';
                            $genreCountQuery = "SELECT g.genre_name, COUNT(*) AS movie_count
                                                FROM genres g
                                                JOIN movies m ON g.genre_id = m.genre_id
                                                GROUP BY g.genre_id";
                            $genreCountResult = $conn->query($genreCountQuery);

                            if ($genreCountResult->num_rows > 0) {
                                while ($row = $genreCountResult->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td  class="center">' . $row['genre_name'] . '</td>';
                                    echo '<td  class="center">' . $row['movie_count'] . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="2">Không có dữ liệu thể loại phim.</td></tr>';
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
                <div>
                <h2>Số lượt xem phim</h2>
                    <table>
                        <thead>
        
                            <tr>
                                <th>Tên phim</th>
                                <th>Số lượt xem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'db_connection.php';
                            $viewsQuery = "SELECT m.title, COUNT(*) AS view_count
                                          FROM movies m
                                           JOIN movie_views mv ON m.movie_id = mv.movie_id
                                          GROUP BY m.movie_id";
                            $viewsResult = $conn->query($viewsQuery);

                            if ($viewsResult->num_rows > 0) {
                                while ($row = $viewsResult->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td  class="center">' . $row['title'] . '</td>';
                                    echo '<td  class="center">' . $row['view_count'] . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="2">Không có dữ liệu số lượt xem.</td></tr>';
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
        </div>

    </div>
    <script>
        <?php include 'assets/js/main.js'; ?>
    </script>
</body>
</html>
