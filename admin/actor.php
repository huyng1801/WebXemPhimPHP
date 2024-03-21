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
            <main>
                <h1>Danh sách diễn viên</h1>
                <button class="button" onclick="location.href='add_actor.php'">
                    <i class="fas fa-plus"></i> Thêm diễn viên
                </button>
                <!-- Actor List Table -->
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Diễn viên</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            include 'db_connection.php';

                            // Truy vấn để lấy danh sách các diễn viên
                            $sql = "SELECT * FROM actors ORDER BY actor_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td  class="center">' . $row['actor_id'] . '</td>';
                                    echo '<td  class="center">' . $row['actor_name'] . '</td>';
                                    echo '<td class="center">
                                            <a href="edit_actor.php?id=' . $row['actor_id'] . '"><i class="fas fa-edit icon icon-edit"></i></a>
                                            <a href="process_delete_actor.php?id=' . $row['actor_id'] . '"><i class="fas fa-trash-alt icon icon-delete"></i></a>
                                          </td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="3">Không có diễn viên nào trong cơ sở dữ liệu.</td></tr>';
                            }

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