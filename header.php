<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web xem phim</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="center">
                <nav>
                    <ul class="navigation">
                        <li class="main-category"><a href="index.php">Trang chủ</a></li>
                        <li class="main-category">
                            <a href="javascript:void(0);">Thể loại <i class="fas fa-solid fa-caret-down"></i></a>
                            <ul class="sub-categories">
                                <li><a href="index.php"><i class="fas fa-solid fa-caret-right"></i> Tất cả</a></li>
                                <?php
                                include 'db_connection.php';
                                $sql = "SELECT * FROM genres";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<li><a href='javascript:void(0);' onclick='loadMoviesByGenre(\"" . $row['genre_name'] . "\")'><i class='fas fa-solid fa-caret-right'></i> " . $row['genre_name'] . "</a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="main-category">
                            <a href="javascript:void(0);">Quốc gia <i class="fas fa-solid fa-caret-down"></i></a>
                            <ul class="sub-categories">
                                <li><a href='index.php'><i class='fas fa-solid fa-caret-right'></i> Tất cả</a></li>
                                <?php
                                $sql = "SELECT * FROM countries";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<li><a href='javascript:void(0);' onclick='loadMoviesByCountry(\"" . $row['country_name'] . "\")'><i class='fas fa-solid fa-caret-right'></i> " . $row['country_name'] . "</a></li>";
                                    }
                                }
                                $conn->close();
                                ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="search-bar">
                <div class="group-search-bar">
                <input type="text" class="search-input" id="search" placeholder="Nhập nội dung cần tìm">
                <button class="search-btn" onclick="searchMovies()"><i class="fas fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
            <div class="icon-bar">
                <button class="icon" onclick="historyMovies()"><i class="fas fa-solid fa-clock-rotate-left"></i></button>
                <button class="icon" onclick="favoriteMovies()"><i class="fas fa-heart"></i></button>
                <button class="icon" onclick="logout()"><i class="fas fa-sign-out-alt"></i></button>
            </div>
    </header>