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
                <h1>Thêm quốc gia</h1>

                <!-- Form thêm quốc gia -->
                <div class="form-container">
                    <form action="process_add_country.php" method="post">
                        <div>
                            <label for="country_name">Tên quốc gia:</label>
                            <input type="text" id="country_name" name="country_name" required>
                        </div>
                        <div class="button-center">
                        <button type="submit" class="button">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                        <a href="country.php"  class="button"><i class="fas fa-arrow-left"></i> Trở về</a>
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