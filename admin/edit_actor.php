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

            <main>
                <h1>Chỉnh sửa diễn viên</h1>

                <?php
                include 'db_connection.php';

                if (isset($_GET["id"])) {
                    $actor_id = $_GET["id"];

                    $sql = "SELECT * FROM actors WHERE actor_id = ?";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("i", $actor_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows === 1) {
                            $row = $result->fetch_assoc();
                            $actor_name = $row["actor_name"];
                        } else {
                            echo "Không tìm thấy diễn viên.";
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

                <!-- Form sửa đổi diễn viên -->
                <div class="form-container">
                    <form action="process_edit_actor.php" method="post">
                        <input type="hidden" name="actor_id" value="<?php echo $actor_id; ?>">
                        <div>
                            <label for="actor_name">Tên Diễn viên:</label>
                            <input type="text" id="actor_name" name="actor_name" value="<?php echo $actor_name; ?>" required>
                        </div>
                        <div class="button-center">
                        <button type="submit" class="button">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                        <a href="actor.php"  class="button"><i class="fas fa-arrow-left"></i> Trở về</a>
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
