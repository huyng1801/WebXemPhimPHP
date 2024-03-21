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

            <main">

                <h1>Danh sách quốc gia</h1>
                <button class="button" onclick="location.href='add_country.php'">
                    <i class="fas fa-plus"></i> Thêm quốc gia
                </button>
                <!-- Country List Table -->
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên quốc gia</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Your PHP code to populate the table goes here -->
                            <?php
                            // Include your database connection code here
                            include 'db_connection.php';

                            // Truy vấn để lấy danh sách các quốc gia
                            $sql = "SELECT * FROM countries ORDER BY country_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td  class="center">' . $row['country_id'] . '</td>';
                                    echo '<td  class="center">' . $row['country_name'] . '</td>';
                                    echo '<td class="center">
                                            <a href="edit_country.php?id=' . $row['country_id'] . '"><i class="fas fa-edit icon icon-edit"></i></a>
                                            <a href="process_delete_country.php?id=' . $row['country_id'] . '"><i class="fas fa-trash-alt icon icon-delete"></i></a>
                                          </td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="3">Không có quốc gia nào trong cơ sở dữ liệu.</td></tr>';
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