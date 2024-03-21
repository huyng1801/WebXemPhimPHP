-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 01:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_xem_phim`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `actor_id` int(11) NOT NULL,
  `actor_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actor_id`, `actor_name`) VALUES
(1, 'Nguyễn Tấn Huy'),
(2, 'Gia Cát Huy'),
(3, 'Huy Nguyễn'),
(4, 'Duy Nguyễn');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`) VALUES
(5, 'Hàn Quốc'),
(2, 'Mỹ'),
(3, 'Nhật Bản'),
(4, 'Trung Quốc'),
(1, 'Việt Nam');

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `director_id` int(11) NOT NULL,
  `director_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`director_id`, `director_name`) VALUES
(1, 'Nguyễn Tấn Huy'),
(2, 'Gia Cát Huy'),
(3, 'Huy Nguyễn'),
(4, 'Duy Nguyễn');

-- --------------------------------------------------------

--
-- Table structure for table `favorite_movies`
--

CREATE TABLE `favorite_movies` (
  `favorite_movies_id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorite_movies`
--

INSERT INTO `favorite_movies` (`favorite_movies_id`, `user_name`, `movie_id`) VALUES
(3, 'huy', 2);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`) VALUES
(4, 'Hài hước'),
(1, 'Hành động'),
(7, 'Hoạt hình'),
(2, 'Khoa học viễn tưởng'),
(5, 'Kinh dị'),
(6, 'Phiêu lưu'),
(8, 'Tài liệu'),
(9, 'Thần thoại'),
(3, 'Tình cảm');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text DEFAULT NULL,
  `release_day` date DEFAULT NULL,
  `image_link` text DEFAULT NULL,
  `directory` text DEFAULT NULL,
  `movie_status` bit(1) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `content`, `release_day`, `image_link`, `directory`, `movie_status`, `director_id`, `country_id`, `genre_id`) VALUES
(1, 'PT Tại Gia', 'Nữ đại gia thành đạt tìm PT tại gia với mong muốn lấy lại sức khỏe vóc dáng, nhưng ngoài phục vụ cuộc sống còn nhiều mặt trái về gym vấn luôn tồn tại với những dục vọng cá nhân, long tham tiền bạc, hạnh phúc gia đình, thử thách chàng PT chân chính vượt qua.', '2023-01-15', 'https://i.ytimg.com/vi/BXB39-jD3z4/maxresdefault.jpg ', 'https://www.youtube.com/embed/BXB39-jD3z4?si=32re_rqI3RaN446h', b'1', 1, 2, 3),
(2, 'Gái Gymer yêu nhầm Trai Giang Hồ', 'Thu là 1 cô gái gymer yêu nhầm Huy (Duy Nguyễn đóng) là tay giang hồ khét tiếng quận 6, kinh hoàng với những phi vụ đẩm máu tranh giành địa bàn giữa các thế lực xã hội đen. Phim chứa nhiều từ ngữ dung tục và bạo lực không thích hợp lứa tuổi vị thành niên.', '2023-02-20', 'https://i.ytimg.com/vi/UGzVu0bVCRs/maxresdefault.jpg', 'https://www.youtube.com/embed/UGzVu0bVCRs?si=XEqgLPDr8lOo_oN9', b'1', 2, 1, 4),
(3, 'Đấu La Đại Lục', 'Đệ tử ngoại môn Đường Tam của Đường Môn, vì học trộm bí kíp của nội môn mà bị Đường Môn bài xích, Đường Tam nhảy xuống vực để tỏ rõ ý chí nhưng không chết mà còn được bước vào một thế giới khác với một thân khác, một thế giới thuộc võ về được - là gọi Đại đấu La Lục. Nơi này không có ma pháp, không có đấu khí, không có võ thuật, nhưng lại có võ hồn kỳ thần. Ở nơi này, vào lúc 6 tuổi, đều sẽ ở trong điện võ hồn lệnh võ hồn thức tỉnh. Võ hồn có động vật, có thực vật, có thể đồ vật, chúng có phụ trợ mọi người sinh hoạt hằng ngày. Đó là một vài võ hồn biệt biệt xuất sắc có thể dùng để tu luyện đồng thời có thể tiến hành chiến đấu, nghiệp chức này trên Đấu La Đại là chức vụ Lục nhất nghiệp mạnh mẽ, cũng là vinh quang nhất —— Linh sư.', '2023-03-25', 'https://play-lh.googleusercontent.com/yvMsoDiXA6jkUFsW5HLQi54rhkufgMMJte4i2o7D7FuznzLIsmyEzUsweZgDfipzMg', 'https://www.youtube.com/embed/324vfLaJr60?si=IRDiBFFB83wCMt97', b'1', 3, 3, 2),
(4, 'Đấu phá thương khung', 'Nội dung phim 4', '2023-04-10', 'data:image/jpeg;base64,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', 'https://www.youtube.com/embed/3P0e4d18CzU?si=vaiykzzgh8DbU1Wr', b'1', 4, 4, 5),
(5, 'Đấu phá thương khung', 'Đấu Phá Thương Khung kể về Tiêu Viêm là một võ giả trẻ có năng khiếu dị bẩm. Năm 9 tuổi, mẹ cậu bị truy sát đến chết, cha cậu giấu bặt chuyện này, Tiêu Viêm gìn giữ chiếc nhẫn mẹ để lại như báu vật không bao giờ rời. Công lực của Tiêu Viêm mãi đến năm 15 tuổi vẫn chưa có tiến triển, gia tộc có hôn ước với cậu từ lâu cũng đến để thoái hôn, khiến Tiêu gia phải chịu nỗi nhục to lớn. Tiêu Viêm một lần tình cờ đánh thức được chủ nhân chiếc nhẫn là Dược Trần lão nhân, dưới sự giúp đỡ của ông, võ công của Tiêu Viêm tiến bộ thần tốc, đồng thời biết được chủ mưu giết hại mẹ mình.<br>\r\nTiêu Viêm vào học viện Gia Nam học kỹ nghệ, tại đây quen biết được rất nhiều thầy tốt bạn hiền, lại một lần nữa thu hút sự chú ý của kẻ thù. Trong một lần tu luyện, Tiêu Viêm bị hại, sau khi thoát được cái chết, phát hiện gia tộc đã gặp tai họa ngập đầu. Vì muốn trả mối thù giết mẹ, đồng thời vì chính nghĩa giang hồ, Tiêu Viêm chọn cách một mình thách thức thế lực tà ác. Cuối cùng liên thủ với nữ hiệp Tiêu Huân Nhi, chung tay chiến thắng cường địch.', '2023-05-03', 'https://img.meta.com.vn/Data/image/2021/11/01/lich-chieu-dau-pha-khung-thuong-al.jpg', 'https://www.youtube.com/embed/3P0e4d18CzU?si=Amwn5ngmrTld7zMZ', b'1', 1, 2, 1),
(6, 'Đặc vụ X', 'Bộ phim đi sâu vào thế giới của gián điệp, các mưu mô, và những trận đánh ác liệt. Những pha hành động đầy kịch tính, những cuộc đấu khẩu thông minh, và sự phát triển của nhân vật chính tạo nên một câu chuyện hấp dẫn và đầy thách thức.', '2023-07-19', 'https://i.ytimg.com/vi/mCnAvjTZCvg/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLDsuiZf3roSpoxP1dK0ANxMFuHzYA', 'https://www.youtube.com/embed/mCnAvjTZCvg?si=UJZoFR1Iag8-qO5i', b'1', 3, 1, 2),
(8, 'Thôn nghèo', 'Bộ phim xoay quanh câu chuyện về một ngôi làng nhỏ nằm trong một vùng quê nghèo, nơi mà cuộc sống của người dân phụ thuộc vào nông nghiệp và những công việc lao động vất vả. Những nhân vật chính trong phim là những người dân bình thường, từ những nông dân chăm chỉ, thợ thủ công đến những người phụ nữ chăm sóc gia đình.', '2023-09-05', 'https://i.ytimg.com/vi/8gUD4yl3V5s/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLATlKywT6bR4Fm4_F3BjewqqC9Uow', 'https://www.youtube.com/embed/8gUD4yl3V5s?si=igrotaSMXRkARJKw', b'1', 1, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `movie_actors`
--

CREATE TABLE `movie_actors` (
  `movie_actors_id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `actor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movie_views`
--

CREATE TABLE `movie_views` (
  `movie_views_id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `view_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_views`
--

INSERT INTO `movie_views` (`movie_views_id`, `user_name`, `movie_id`, `view_time`) VALUES
(2, 'huy', 2, '2024-01-14 01:06:31'),
(3, 'huy', 4, '2024-01-14 01:06:37'),
(5, 'huy', 2, '2024-01-18 07:04:10'),
(7, 'huy', 4, '2024-01-18 08:25:43'),
(8, 'huy', 3, '2024-01-18 08:43:12'),
(9, 'huy', 2, '2024-01-18 08:45:21'),
(10, 'huy', 4, '2024-01-18 08:46:09'),
(11, 'huy', 2, '2024-01-18 08:48:34'),
(12, 'huy', 5, '2024-01-18 08:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `user_password`, `user_role`) VALUES
('admin', '$2y$10$ue7ourCSNveSeNrn73UekuFwi0k8KbQkSdqALF475zPhZyUn4Xeja', 'admin'),
('huy', '$2y$10$3ZKaIpKGMm3.KvWgkn3ttuHU3bZ69iEhNwzWrfFzdJT4vLQUQLMFq', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `user_ratings_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ratings`
--

INSERT INTO `user_ratings` (`user_ratings_id`, `rating`, `user_name`, `movie_id`) VALUES
(1, 4, 'huy', 2),
(2, 3, 'huy', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`),
  ADD UNIQUE KEY `country_name` (`country_name`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `favorite_movies`
--
ALTER TABLE `favorite_movies`
  ADD PRIMARY KEY (`favorite_movies_id`),
  ADD KEY `fk_favorite_movies_users` (`user_name`),
  ADD KEY `fk_favorite_movies_movies` (`movie_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `genre_name` (`genre_name`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `fk_movies_directors` (`director_id`),
  ADD KEY `fk_movies_genres` (`genre_id`),
  ADD KEY `fk_movies_countries` (`country_id`);

--
-- Indexes for table `movie_actors`
--
ALTER TABLE `movie_actors`
  ADD PRIMARY KEY (`movie_actors_id`),
  ADD KEY `fk_movie_actors_movies` (`movie_id`),
  ADD KEY `fk_movie_actors_actors` (`actor_id`);

--
-- Indexes for table `movie_views`
--
ALTER TABLE `movie_views`
  ADD PRIMARY KEY (`movie_views_id`),
  ADD KEY `fk_movieviews_users` (`user_name`),
  ADD KEY `fk_movieviews_movies` (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`);

--
-- Indexes for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD PRIMARY KEY (`user_ratings_id`),
  ADD KEY `fk_user_ratings_users` (`user_name`),
  ADD KEY `fk_user_ratings_movies` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `director_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `favorite_movies`
--
ALTER TABLE `favorite_movies`
  MODIFY `favorite_movies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `movie_actors`
--
ALTER TABLE `movie_actors`
  MODIFY `movie_actors_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_views`
--
ALTER TABLE `movie_views`
  MODIFY `movie_views_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `user_ratings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorite_movies`
--
ALTER TABLE `favorite_movies`
  ADD CONSTRAINT `fk_favorite_movies_movies` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favorite_movies_users` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `fk_movies_countries` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_movies_directors` FOREIGN KEY (`director_id`) REFERENCES `directors` (`director_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_movies_genres` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE;

--
-- Constraints for table `movie_actors`
--
ALTER TABLE `movie_actors`
  ADD CONSTRAINT `fk_movie_actors_actors` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`actor_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_movie_actors_movies` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;

--
-- Constraints for table `movie_views`
--
ALTER TABLE `movie_views`
  ADD CONSTRAINT `fk_movieviews_movies` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_movieviews_users` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE;

--
-- Constraints for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD CONSTRAINT `fk_user_ratings_movies` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_ratings_users` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
