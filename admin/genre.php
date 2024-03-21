<!DOCTYPE html>
<html lang="vi">
<?php
include 'head.php'; 
?>

<body>
    <div class="container-custom">
        <!-- Sidebar (Menu) -->
        <?php
        include 'sidebar.php'; // Include your sidebar
        ?>
        <!-- Main Content -->
        <div class="content" id="main-content">
            <span id="menu-toggle" onclick="toggleSidebar()">&#9776;</span>

            <main>

                <h1>Danh sách thể loại</h1>
                <button class="button" onclick="location.href='add_genre.php'">
                    <i class="fas fa-plus"></i> Thêm thể loại
                </button>
                <!-- Genre List Table -->
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên thể loại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Your PHP code to populate the table goes here -->
                            <?php
                            // Include your database connection code here
                            include 'db_connection.php';

                            // Truy vấn để lấy danh sách các thể loại phim
                            $sql = "SELECT * FROM genres ORDER BY genre_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td class="center">' . $row['genre_id'] . '</td>';
                                    echo '<td class="center">' . $row['genre_name'] . '</td>';
                                    echo '<td class="center">
                                            <a href="edit_genre.php?id=' . $row['genre_id'] . '"><i class="fas fa-edit icon icon-edit"></i></a>
                                            <a href="process_delete_genre.php?id=' . $row['genre_id'] . '"><i class="fas fa-trash-alt icon icon-delete"></i></a>
                                          </td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="3">Không có thể loại phim nào trong cơ sở dữ liệu.</td></tr>';
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
