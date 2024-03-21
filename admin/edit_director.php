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
                <h1>Chỉnh sửa đạo diễn</h1>

                <!-- Form chỉnh sửa đạo diễn -->
                <div class="form-container">
                    <?php
                    include 'db_connection.php';

                    // Kiểm tra xem có tham số ID của đạo diễn được truyền qua URL không
                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                        $director_id = $_GET['id'];

                        // Truy vấn để lấy thông tin của đạo diễn dựa trên ID
                        $sql = "SELECT * FROM directors WHERE director_id = $director_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $director_name = $row['director_name'];
                        } else {
                            // Hiển thị thông báo nếu không tìm thấy đạo diễn
                            echo 'Không tìm thấy đạo diễn.';
                            exit;
                        }
                    } else {
                        // Hiển thị thông báo nếu không có tham số ID hoặc ID không hợp lệ
                        echo 'Yêu cầu không hợp lệ.';
                        exit;
                    }

                    // Đóng kết nối với CSDL
                    $conn->close();
                    ?>

                    <form action="process_edit_director.php" method="post">
                        <input type="hidden" name="director_id" value="<?php echo $director_id; ?>">
                        <div>
                            <label for="director_name">Tên đạo diễn:</label>
                            <input type="text" class="form-control" id="director_name" name="director_name" value="<?php echo $director_name; ?>" required>
                        </div>
                        <div class="button-center">
                        <button type="submit" class="button">
                            <i class="fas fa-save"></i> Lưu <!-- Thay đổi biểu tượng ở đây -->
                        </button>
                        <a href="director.php"  class="button"><i class="fas fa-arrow-left"></i> Trở về</a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        <?php include 'assets/js/main.js'; ?>
    </script>
</body>
</html>
