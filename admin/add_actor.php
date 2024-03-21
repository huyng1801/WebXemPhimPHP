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
                <h1>Thêm diễn viên</h1>

                <!-- Form thêm diễn viên -->
                <div class="form-container">
                    <form action="process_add_actor.php" method="post">
                        <div>
                            <label for="actor_name">Tên diễn viên:</label>
                            <input type="text" id="actor_name" name="actor_name" required>
                        </div>
                       <div class="button-center">
                       <button type="submit" class="button">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                        <a href="actor.php" class="button"><i class="fas fa-arrow-left"></i> Trở về</a>
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