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
                <h1>Thêm đạo diễn</h1>

                <!-- Form thêm đạo diễn -->
                <div class="form-container">
                    <form action="process_add_director.php" method="post">
                        <div>
                            <label for="director_name">Tên đạo diễn:</label>
                            <input type="text" id="director_name" name="director_name" required>
                        </div>
                        <div class="button-center">
                        <button type="submit" class="btn">
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
