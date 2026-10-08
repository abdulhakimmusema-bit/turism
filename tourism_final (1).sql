-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2026 at 09:35 PM
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
-- Database: `tourism_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$3iH0T/1J1eVXoFtxZsznNOmZw5Kk5yfx5N33opvJyfYJnVSJMRaNK');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `travel_date` date NOT NULL,
  `travelers` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('Pending','Confirmed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `package_id`, `travel_date`, `travelers`, `total_price`, `status`, `created_at`) VALUES
(3, 2, 1, '2025-11-26', 1, 2500.00, 'Confirmed', '2025-11-24 20:24:44'),
(5, 1, 2, '2025-11-25', 13, 39000.00, 'Confirmed', '2025-11-25 19:38:57'),
(6, 1, 3, '2025-11-25', 1, 2800.00, 'Confirmed', '2025-11-25 20:33:22'),
(7, 1, 1, '2025-11-28', 1, 2500.00, 'Pending', '2025-11-29 19:20:25'),
(8, 6, 2, '2025-12-03', 1, 3000.00, 'Confirmed', '2025-12-02 08:15:07'),
(9, 6, 2, '2025-12-04', 1, 3000.00, 'Confirmed', '2025-12-02 08:18:43'),
(10, 7, 2, '2025-12-05', 2, 6000.00, 'Confirmed', '2025-12-03 19:23:03'),
(11, 8, 1, '2025-12-03', 2, 5000.00, 'Confirmed', '2025-12-07 12:25:18'),
(12, 8, 2, '2025-12-03', 1, 3000.00, 'Confirmed', '2025-12-07 12:29:44'),
(13, 9, 1, '2025-12-10', 2, 5000.00, 'Confirmed', '2025-12-23 15:11:28'),
(14, 10, 1, '2026-01-08', 2, 500.00, 'Confirmed', '2026-01-06 20:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) DEFAULT 'unread',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `status`, `submitted_at`) VALUES
(1, 'abdulhakim musema mustefa', 'abdulhakimmusema9@gmail.com', 'gfgffgg', 'unread', '2026-01-06 19:48:06'),
(2, 'abdu', 'abdulhakimmusema9727@gmail.com', 'hhhhhhhhh', 'unread', '2026-01-06 19:48:54'),
(3, 'abdu', 'abdulhakimmusema9727@gmail.com', 'hhhhhhhhh', 'unread', '2026-01-06 19:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_name`, `description`, `price`, `image_file`) VALUES
(1, 'የስልጤ ባህል ሙዚየም', 'የስልጤ ባህል ሙዚየም በወራቤ ከተማ የሚገኝና የህዝቡን ታሪካዊ እሴቶች፣ ጥበብና ወጎች በአንድ ላይ አሰባስቦ የያዘ ታላቅ የቅርስ ማዕከል ነው። ሙዚየሙ የብሔረሰቡን ጥንታዊ የአኗኗር ዘይቤ፣ ባህላዊ የቤት አሰራር ጥበብ፣ አልባሳትና ቁሳቁሶችን ለጎብኚዎች በዝርዝር ያስተዋውቃል። ከታሪካዊ ቅርሶች ባለፈ፣ የማህበረሰቡን ማንነት ለትውልድ ለማስተላለፍና ለቱሪዝም መስህብነት ትልቅ አስተዋጽኦ ያበረክታል። ይህ ማዕከል የጥናትና ምርምር ምንጭ በመሆንም ያገለግላል።', 250.00, 'muziyem.webp'),
(2, 'ወራቤ ከተማ የወንዝ ዳርቻ ፓርክ ', 'ወራቤ ከተማ የወንዝ ዳርቻ ፓርክ የወንዙን ተፈጥሯዊ ውበት በመጠበቅ ለነዋሪዎች ምቹ የመዝናኛ አማራጭ ለመፍጠር የታለመ ዘመናዊ ፕሮጀክት ነው። ፓርኩ ሰፊ አረንጓዴ ስፍራዎችን፣ ለእግር ጉዞ የሚሆኑ ጽዱ መንገዶችን፣ የመቀመጫ ቦታዎችንና ማራኪ የፎቶ ቀረጻ ስፍራዎችን ይዟል።ይህ የከተማዋን ውበት ከመጨመር ባለፈ፣ የአካባቢ ብክለትን በመከላከል ንጹህ አየርን ይፈጥራል። ወራቤን ለቱሪስቶች ሳቢና ለነዋሪዎቿ ምቹ በማድረግ ረገድ ትልቅ ሚና ያለው ማራኪ መዳረሻ ነው።', 300.00, 'wenz2.jpeg'),
(3, 'የስልጤ አባያ ሐይቅ ', 'የስልጤ አባያ ሐይቅ  በስልጤ ዞን ላንፉሮ ወረዳ የሚገኝና አስደናቂ የተፈጥሮ ውበት ያለው መዳረሻ ነው። ሐይቁ ለተለያዩ የውሃ ላይ አእዋፋት፣ ለአሳ ዝርያዎችና ለዱር እንስሳት መራቢያ በመሆን ያገለግላል። በውስጡ የሚገኙት ደሴቶችና በዙሪያው ያለው ለምለም ተፈጥሮ ለጀልባ ጉዞና ለሽርሽር በጣም ተመራጭ ያደርገዋል። ይህ ሐይቅ የአካባቢውን ስነ-ምህዳር ከመጠበቁም በላይ ለቱሪዝም ዕድገትና ለነዋሪዎች የሥራ ዕድል ፈጠራ ከፍተኛ ፋይዳ ያለው የተፈጥሮ ስጦታ ነው።', 200.00, 'abaya.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `amount`, `payment_date`) VALUES
(3, 3, 2500.00, '2025-11-24 23:24:57'),
(5, 5, 39000.00, '2025-11-25 22:39:00'),
(6, 6, 2800.00, '2025-11-29 22:20:33'),
(7, 8, 3000.00, '2025-12-02 11:15:46'),
(8, 9, 3000.00, '2025-12-02 11:18:58'),
(9, 10, 6000.00, '2025-12-03 22:23:20'),
(10, 11, 5000.00, '2025-12-07 15:26:50'),
(11, 12, 3000.00, '2025-12-07 15:29:57'),
(12, 13, 5000.00, '2025-12-23 18:11:43'),
(13, 14, 500.00, '2026-01-06 23:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'abdu aa bb', 'abdulhakimmusema9727@gmail.com', '$2y$10$7g7nhfLxN9en9z5MCEoqgetbOvnauKVyE9m7oERmlz.JOqK1uYNHS', '2025-11-23 07:26:51'),
(2, 'muba', 'abdulhakimmusema27@gmail.com', '$2y$10$1jdUH6R2VwsswjXW4uZUx.um93X0d322XpzeawBgy/kvcOaMGKeEe', '2025-11-24 20:23:54'),
(4, 'hussen', 'abdulhakimmusema972@gmail.com', '$2y$10$Huo5DTa8STMttWdbvCNwTOTwvbn0GyhWO.mMN2Dh7Kl75JXqTbn2i', '2025-11-26 07:39:06'),
(5, 'asdf', 'abdulhakimmusema9@gmail.com', '$2y$10$kwS2GgrF95Genjqw0DMVOefBLaUF3okd4iJGHy/evXUNJDojwHSy2', '2025-11-29 19:19:31'),
(6, 'admin', 'abdulhakimmusem7@gmail.com', '$2y$10$bpneH3OtiI21a8O.rHpq5e0FTOAU6ikLcA3KVQ6VZShF5IPWrotuK', '2025-12-02 08:14:16'),
(7, 'hus', 'abdulhakimmuse@gmail.com', '$2y$10$awfR2vOnksYVxaLbcGzKX.g5t7MPMpss5FeiZrHDpg19EhYgXKrQa', '2025-12-03 19:22:12'),
(8, 'abdu12', 'abdulhakimmu@gmail.com', '$2y$10$HivZqANNoeXn522oeIh6Wed/kZYOdIi9cuOiZXkrVzq3GQd9AuRby', '2025-12-07 12:22:30'),
(9, 'admin', 'admin@gmail.com', '$2y$10$8elk3x5jd023Z34qLO.ei.qJt3vaGEhazewqDgSWkyZDooJy3xgEC', '2025-12-23 15:10:10'),
(10, 'a', 'a@gmail.com', '$2y$10$U9YqATSgtuLnKVxudk14veHkmP3Z6z1tJbS15HjvBpPJpZtSEDs.K', '2026-01-06 20:24:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `booking_id` (`booking_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
