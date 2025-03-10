-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 10:48 PM
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
-- Database: `ghost_cool`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_logs`
--

CREATE TABLE `action_logs` (
  `id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `record_id` int(11) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `action_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `action_logs`
--

INSERT INTO `action_logs` (`id`, `action`, `table_name`, `record_id`, `admin_username`, `action_time`) VALUES
(1, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:27:48'),
(2, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:27:50'),
(3, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:27:50'),
(4, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:27:50'),
(5, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:29:33'),
(6, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:29:50'),
(7, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:32:44'),
(8, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:36:55'),
(9, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:37:07'),
(10, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:37:13'),
(11, 'EDIT', 'users', 1, 'admin', '2025-03-06 18:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `story` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `latitude`, `longitude`, `story`, `created_at`) VALUES
(1, 'ตำนานเตียง C', 13.79340000, 100.32220000, 'มีเรื่องเล่ากันว่า ในคืนวันที่ ๒๔ กันยายน ปีหนึ่ง มีนักศึกษาแพทย์แห่งหนึ่ง ได้อ่านหนังสือแล้วหลับไปบนเตียง C จะด้วยเหตุอันใดก็ไม่อาจทราบได้ นักศึกษาคนนั้นก็นอนเสียชีวิตไปไม่ตื่นขึ้นมาอีก และด้วยเป็นวันมหิดล หลาย ๆ คณะ ก็มีการหยุดเรียนกัน ทำให้ไม่มีคนมาช่วยเหลือนักศึกษาคนนั้นได้ กว่าจะมีคนมาพบก็ล่วงไปหลายวันแล้ว หลังจากนั้นในวันมหิดลปีต่อ ๆ มา นักศึกษาคนนั้นก็มักจะปรากฎตัวที่เตียง C เตียงเดิมที่เขาเคยนอนเสียชีวิตอยู่หลายปี และมีอีกตำนานเล่าว่านักศึกษาคนนั้นถูกรถชนเสียชีวิตขณะเดินข้ามถนนเพื่อกลับมายังหอพัก แต่อาจจะยังไม่รู้ตัวว่าตัวเองเสียชีวิตแล้ว ก็กลับมายังห้องพัก และปรากฎตัวพร้อมกับเสื้อที่เต็มไปด้วยเลือดที่ เตียง C อันเป็นเตียงประจำที่นักศึกษาคนนั้น \r\n\r\n	ส่วนเตียง C เตียงที่เกิดเหตุ จะเป็นเตียงที่อยู่ห้องไหน หอไหนนั้น ก็ต้องลองไปนอนกันดูกันนะ...', '2025-03-06 12:28:03'),
(2, 'สุสานโสเภณี', 14.10160000, 99.41700000, 'สุสานโสเภณีเป็นสถานที่ฝังศพของหญิงบริการที่เสียชีวิตโดยไร้ญาติพี่น้องรับศพกลับไป ตั้งอยู่ในจังหวัดกาญจนบุรี สถานที่แห่งนี้เต็มไปด้วยเรื่องเล่าขานเกี่ยวกับวิญญาณที่ยังคงวนเวียนอยู่ บางคนที่เดินผ่านในยามค่ำคืนเคยได้ยินเสียงสะอื้นไห้ของหญิงสาว หรือเสียงกระซิบเบาๆ ข้างหู\r\n\r\nในอดีต บริเวณนี้เคยเป็นจุดที่มีซ่องโสเภณีซึ่งเปิดให้บริการแก่ทหารและแรงงานจากต่างถิ่น หญิงสาวหลายคนถูกทอดทิ้ง ถูกทำร้าย หรือเสียชีวิตจากโรคร้ายโดยไม่มีพิธีศพที่เหมาะสม วิญญาณของพวกเธอจึงเชื่อกันว่ายังคงสิงสถิตอยู่ที่นี่\r\n\r\nผู้ที่มาเยือนบางคนเล่าว่าเคยเห็นเงาผู้หญิงในชุดไทยโบราณเดินอยู่ริมป่าช้า หรือบางครั้งปรากฏตัวให้เห็นเป็นภาพซ้อนในรูปถ่าย นอกจากนี้ บางคนที่เข้าไปในเวลากลางคืนอาจรู้สึกเย็นยะเยือกโดยไม่มีสาเหตุ หรือได้กลิ่นธูปที่ไม่มีใครจุด', '2025-03-06 12:28:03'),
(3, 'โรงพยาบาลร้างพระมงกุฎเกล้า', 13.76720000, 100.52880000, 'โรงพยาบาลร้างพระมงกุฎเกล้า เป็นสถานที่ลี้ลับที่มีเรื่องเล่าสยองขวัญมากมาย เดิมทีเคยเป็นอาคารรักษาผู้ป่วยเก่า แต่หลังจากถูกทิ้งร้าง บรรยากาศภายในกลับเต็มไปด้วยความวังเวงและน่าขนลุก\r\n\r\nมีผู้พบเห็นเงาคนเดินไปมาในห้องพักคนไข้ที่ไม่มีใครอยู่ บางคนได้ยินเสียงครวญครางและเสียงลากเตียงในช่วงกลางดึก เรื่องเล่าที่น่าสะพรึงที่สุดคือการพบเห็นหญิงสาวในชุดผู้ป่วยเดินอยู่ตามทางเดิน และเมื่อลองมองดูดีๆ กลับพบว่าเธอไม่มีเท้า\r\n\r\nบางกลุ่มที่เข้าไปสำรวจยังเล่าว่า อุณหภูมิในบางห้องลดลงอย่างรวดเร็วโดยไม่มีสาเหตุ หรือแม้แต่เสียงประตูปิดเองทั้งที่ไม่มีลมพัด นักล่าผีหลายคนเคยเข้าไปพิสูจน์และได้ยินเสียงกระซิบเรียกชื่อ ทำให้สถานที่แห่งนี้กลายเป็นอีกหนึ่งตำนานความเฮี้ยนของกรุงเทพฯ', '2025-03-06 12:28:03'),
(4, 'กุฏิร้าง 40 หลัง', 14.04090000, 99.54320000, 'กุฏิร้าง 40 หลัง ตั้งอยู่ในพื้นที่วัดร้างแห่งหนึ่งในจังหวัดกาญจนบุรี เดิมทีเป็นสถานที่พักของพระสงฆ์ แต่ต่อมาเกิดเหตุการณ์ลี้ลับและเรื่องราวชวนขนลุก จนพระและสามเณรที่จำพรรษาอยู่ต้องพากันย้ายออกไป\r\n\r\nเล่ากันว่ามีพระรูปหนึ่งมรณภาพอย่างผิดธรรมชาติในกุฏิ และตั้งแต่นั้นมา ก็มีเสียงสวดมนต์ เสียงกระดิ่ง และเงาปริศนาปรากฏขึ้นในเวลากลางคืน บางคนที่ผ่านไปใกล้เคยเห็นเงาพระยืนอยู่หน้ากุฏิ แม้ว่าจะไม่มีใครอยู่ที่นั่นก็ตาม\r\n\r\nหลายคนที่เข้าไปสำรวจมักรู้สึกหนาวเยือก ทั้งที่อากาศร้อน บางคนได้ยินเสียงกระซิบเบาๆ ข้างหู หรือได้กลิ่นธูปลอยมาโดยไม่มีใครจุด กุฏิเหล่านี้จึงกลายเป็นสถานที่ต้องห้ามสำหรับคนที่ขวัญอ่อน\r\n\r\n', '2025-03-06 15:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `place_images`
--

CREATE TABLE `place_images` (
  `id` int(20) UNSIGNED NOT NULL,
  `place_id` int(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `place_images`
--

INSERT INTO `place_images` (`id`, `place_id`, `image_url`, `uploaded_at`) VALUES
(1, 1, 'images/bed_c.jpg', '2025-03-06 12:28:12'),
(2, 1, 'images/ghost_bedroom.jpg', '2025-03-06 12:28:12'),
(3, 2, 'images/abandoned_house.jpg', '2025-03-06 12:28:12'),
(4, 3, 'images/haunted_bridge.jpg', '2025-03-06 12:28:12'),
(5, 4, 'uploads/ordertotal.png', '2025-03-06 15:07:51'),
(6, 4, 'uploads/orderid.png', '2025-03-06 15:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(20) UNSIGNED NOT NULL,
  `user_id` int(20) UNSIGNED DEFAULT NULL,
  `place_id` int(20) UNSIGNED DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `place_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 5, 'น่ากลัวมาก ขนลุกจริงๆ', '2025-03-06 12:29:43'),
(2, 2, 1, 4, 'เข้าไปแล้วรู้สึกแปลกๆ เหมือนมีคนมอง', '2025-03-06 12:29:43'),
(3, 3, 2, 3, 'ยังไม่เจออะไร แต่บรรยากาศวังเวง', '2025-03-06 12:29:43'),
(4, 1, 3, 5, 'ตรงกับตำนานเป๊ะๆ เสียงร้องชัดเจนมาก', '2025-03-06 12:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `review_votes`
--

CREATE TABLE `review_votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(20) UNSIGNED DEFAULT NULL,
  `review_id` int(20) UNSIGNED DEFAULT NULL,
  `vote` enum('like','dislike') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `review_votes`
--

INSERT INTO `review_votes` (`id`, `user_id`, `review_id`, `vote`) VALUES
(6, 2, 1, 'like'),
(7, 3, 1, 'dislike'),
(9, 2, 3, 'like'),
(10, 3, 4, 'dislike'),
(17, 1, 2, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `role`, `created_at`) VALUES
(1, 'ghost_hunter', 'ghosthunter@example.com', '456123', NULL, 'user', '2025-03-06 12:29:32'),
(2, 'fearless_guy', 'fearless@example.com', '123456', NULL, 'user', '2025-03-06 12:29:32'),
(3, 'spirit_seeker', 'spiritseeker@example.com', '123789', NULL, 'user', '2025-03-06 12:29:32'),
(4, 'admin', 'admin@gmail.com', '00000000', NULL, 'admin', '2025-03-06 18:59:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_logs`
--
ALTER TABLE `action_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place_images`
--
ALTER TABLE `place_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_id` (`place_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `review_votes`
--
ALTER TABLE `review_votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_logs`
--
ALTER TABLE `action_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `place_images`
--
ALTER TABLE `place_images`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `review_votes`
--
ALTER TABLE `review_votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `place_images`
--
ALTER TABLE `place_images`
  ADD CONSTRAINT `place_images_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
