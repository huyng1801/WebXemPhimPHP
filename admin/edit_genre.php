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
                <h1>Chỉnh sửa thể loại</h1>

                <?php
                include 'db_connection.php';

                if (isset($_GET["id"])) {
                    $genre_id = $_GET["id"];

                    $sql = "SELECT * FROM genres WHERE genre_id = ?";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("i", $genre_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows === 1) {
                            $row = $result->fetch_assoc();
                            $genre_name = $row["genre_name"];
                        } else {
                            echo "Không tìm thấy thể loại phim.";
                            $stmt->close();
                            $conn->close();
                            exit;
                        }

                        $stmt->close();
                    } else {
                        echo "Lỗi khi chuẩn bị truy vấn.";
                        $conn->close();
                        exit;
                    }
                } else {
                    echo "Thiếu tham số ID.";
                    $conn->close();
                    exit;
                }
                ?>

                <!-- Form sửa đổi thể loại phim -->
                <div class="form-container">
                    <form action="process_edit_genre.php" method="post">
                        <input type="hidden" name="genre_id" value="<?php echo $genre_id; ?>">
                        <div>
                            <label for="genre_name">Tên thể loại:</label>
                            <input type="text" id="genre_name" name="genre_name" value="<?php echo $genre_name; ?>" required>
                        </div>
                        <div class="button-center">
                        <button type="submit" class="button">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                        <a href="genre.php"  class="button"><i class="fas fa-arrow-left"></i> Trở về</a>
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
