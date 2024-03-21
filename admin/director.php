<!DOCTYPE html>
<html lang="vi">
<?php
include 'head.php'; // Include your header
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

            <main">

                <h1>Danh sách đạo diễn</h1>
                <button class="button" onclick="location.href='add_director.php'">
                    <i class="fas fa-plus"></i> Thêm đạo diễn
                </button>
                <!-- Director List Table -->
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên đạo diễn</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'db_connection.php';

                            // Truy vấn để lấy danh sách các đạo diễn
                            $sql = "SELECT * FROM directors ORDER BY director_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td  class="center">' . $row['director_id'] . '</td>';
                                    echo '<td  class="center">' . $row['director_name'] . '</td>';
                                    echo '<td class="center">
                                            <a href="edit_director.php?id=' . $row['director_id'] . '"><i class="fas fa-edit icon icon-edit"></i></a>
                                            <a href="process_delete_director.php?id=' . $row['director_id'] . '"><i class="fas fa-trash-alt icon icon-delete"></i></a>
                                          </td  class="center">';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="3">Không có đạo diễn nào trong cơ sở dữ liệu.</td></tr>';
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
