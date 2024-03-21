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
                <h1>Thêm thể loại</h1>

                <!-- Form thêm thể loại phim -->
                <div class="form-container">
                    <form action="process_add_genre.php" method="post">
                        <div>
                            <label for="genre_name">Tên thể loại:</label>
                            <input type="text" id="genre_name" name="genre_name" required>
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
