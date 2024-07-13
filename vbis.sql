-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 01:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vbis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Ratko', 'ratko123');

-- --------------------------------------------------------

--
-- Table structure for table `concert`
--

CREATE TABLE `concert` (
  `concert_id` int(11) NOT NULL,
  `concert_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `starts_at` date NOT NULL,
  `concert_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `concert`
--

INSERT INTO `concert` (`concert_id`, `concert_name`, `description`, `starts_at`, `concert_status`, `price`) VALUES
(1, 'Imagine Dragons', 'SECURE YOUR TICKETS IN TIME', '2024-08-20', 'active', 100),
(2, 'Maneskin', 'SECURE YOUR TICKETS IN TIME', '2024-07-20', 'active', 120),
(3, 'Lana Del Rey', 'SECURE YOUR TICKETS IN TIME', '2024-09-06', 'active', 110),
(4, 'ColdPlay', 'SECURE YOUR TICKETS IN TIME', '2024-09-09', 'active', 80),
(5, 'Twenty One Pilots', 'SECURE YOUR TICKETS IN TIME', '2024-11-20', 'active', 90),
(6, 'Raf Camora', 'SECURE YOUR TICKETS IN TIME', '2024-12-02', 'inactive', 100),
(7, 'Rammstein', 'SECURE YOUR TICKETS IN TIME', '2024-10-05', 'inactive', 130);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(10) UNSIGNED NOT NULL,
  `ime_prezime` varchar(64) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `korisnicko_ime` varchar(64) DEFAULT NULL,
  `starts_at` date NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `concert_name` varchar(255) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `ime_prezime`, `email`, `korisnicko_ime`, `starts_at`, `id_korisnika`, `concert_name`, `price`) VALUES
(2, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-08-20', 16, 'Imagine Dragons', 100),
(4, 'Ivona Broceta', 'ivona@gmail.com', 'ivona', '2024-07-20', 16, 'Maneskin', 120),
(5, 'Ivona Broceta', 'ivona@gmail.com', 'ivona', '2024-09-09', 16, 'ColdPlay', 80),
(6, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-11-20', 16, 'Twenty One Pilots', 90),
(7, 'Nikola Ivanovic', 'nikola@gmail.com', 'Nikola', '2024-08-20', 14, 'Imagine Dragons', 100),
(8, 'Nikola Ivanovic', 'nikola@gmail.com', 'Nikola', '2024-09-06', 14, 'Lana Del Rey', 110),
(9, 'Nikola Ivanovic', 'nikola@gmail.com', 'Nikola', '2024-11-20', 14, 'Twenty One Pilots', 90),
(10, 'Petar Petrovic', 'Petar@gmail.com', 'Petar', '2024-07-20', 17, 'Maneskin', 120),
(11, 'Petar Petrovic', 'Petar@gmail.com', 'Petar', '2024-09-09', 17, 'ColdPlay', 80),
(12, 'Uros Urosevic', 'Uros@gmail.com', 'Uros', '2024-09-09', 18, 'ColdPlay', 80),
(13, 'Uros Urosevic', 'Uros@gmail.com', 'Uros', '2024-11-20', 18, 'Twenty One Pilots', 90),
(14, 'Uros Urosevic', 'Uros@gmail.com', 'Uros', '2024-11-20', 18, 'Twenty One Pilots', 90),
(15, 'Milan Zivkovic', 'Milan@gmail.com', 'Milan', '2024-07-20', 19, 'Maneskin', 120),
(16, 'Milan Zivkovic', 'Milan@gmail.com', 'Milan', '2024-09-06', 19, 'Lana Del Rey', 110),
(17, 'Matija Matic', 'matija@gmail.com', 'Matija', '2024-09-09', 20, 'ColdPlay', 80),
(18, 'Isidora Jankovic', 'isidora@gmail.com', 'Isidora', '2024-09-06', 21, 'Lana Del Rey', 110),
(19, 'Isidora Jankovic', 'isidora@gmail.com', 'Isidora', '2024-08-20', 21, 'Imagine Dragons', 100),
(20, 'Isidora Jankovic', 'isidora@gmail.com', 'Isidora', '2024-09-09', 21, 'ColdPlay', 80),
(21, 'Isidora Jankovic', 'isidora@gmail.com', 'Isidora', '2024-09-09', 21, 'ColdPlay', 80),
(22, 'Ratko Broceta', 'ratko@gmail.com', 'Ratko', '2024-07-20', 22, 'Maneskin', 120),
(23, 'Ratko Broceta', 'ratko@gmail.com', 'Ratko', '2024-11-20', 22, 'Twenty One Pilots', 90),
(24, 'Nikola Simic', 'simic@gmail.com', 'Simic', '2024-09-06', 23, 'Lana Del Rey', 110),
(25, 'Jovan Stefanovic', 'jovan@gmail.com', 'Jovan', '2024-08-20', 24, 'Imagine Dragons', 100),
(26, 'Jovan Stefanovic', 'jovan@gmail.com', 'Jovan', '2024-07-20', 24, 'Maneskin', 120),
(27, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-07-20', 16, 'Maneskin', 120),
(28, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-07-20', 16, 'Maneskin', 120),
(29, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-07-20', 16, 'Maneskin', 120),
(30, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-07-20', 16, 'Maneskin', 120),
(31, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-07-20', 16, 'Maneskin', 120),
(32, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-09-06', 16, 'Lana Del Rey', 110),
(33, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-09-06', 16, 'Lana Del Rey', 110),
(34, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-09-06', 16, 'Lana Del Rey', 110),
(35, 'Ivona Broceta', 'ivona@gmail.com', 'Ivona', '2024-07-20', 16, 'Maneskin', 120),
(37, 'Raki', 'raki@gmail.com', 'raki', '2024-09-06', 28, 'Lana Del Rey', 110);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `broj_telefona` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL,
  `datum_kreiranja` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `korisnicko_ime`, `email`, `broj_telefona`, `password`, `datum_kreiranja`) VALUES
(14, 'Nikola', 'nikola@gmail.com', '1234567890', '$2y$10$hLqIcQCjNVFW/1e4XQUfHeOOL/IIz8GCQ9tCTuN78fYHLV30P7JM.', '2024-05-19'),
(16, 'Ivona', 'ivona@gmail.com', '0648918512', '$2y$10$KKZeVsqj3N7tYXsbfwx0V.t6kxxTFL9NaN19CNaAkWWy8E5X5TvTe', '2024-05-20'),
(17, 'Petar', 'Petar@gmail.com', '987654321', '$2y$10$y/wlAj7KXzj3kXmUCYEjA.wJGG/2NxMyR.ZdDVNaA8yyKi4dW2mT6', '2024-06-23'),
(18, 'Uros', 'Uros@gmail.com', '069557203', '$2y$10$Ch4gzzBAAuRcw/NbQ.VX5ucoh0Cww6THzKSJvEYOsCpb4kzyDna.C', '2024-06-23'),
(19, 'Milan', 'Milan@gmail.com', '062134587', '$2y$10$eylfPKM5ix4xMMlQEWzDmO2lGGm9pGUvZQNz7yMep/5RDEp4PVtD2', '2024-06-23'),
(20, 'Matija', 'matija@gmail.com', '0691145786', '$2y$10$XyxNLDnRJhydH4bjlIOGs.P0I73Vui4p6mUbgZ0XECeCv/zI7yPDm', '2024-05-05'),
(21, 'Isidora', 'isidora@gmail.com', '064976123', '$2y$10$pg7Pd6SPjv44f1A2.tXYeeArKNITZLFvqLjrDPGSX1usprvbLItZ.', '2024-06-23'),
(22, 'Ratko ', 'ratko@gmail.com', '0668057402', '$2y$10$d1CjdZ5pziPWjfn/saReiuUTEs2vfY53e4jdG23fCEmzWuBnIY72S', '2024-04-23'),
(23, 'Nikola', 'simic@gmail.com', '066896431', '$2y$10$94dnK3AYzCRa1Cu1vzwIOetXczad74UNJflE9GrfRXnwAECuCiU4O', '2024-06-23'),
(24, 'Jovan', 'jovan@gmail.com', '063224576', '$2y$10$zJ.L1eILgnXMjQNGlDGN0e59PHUqrGQRxod9dKXs/mrJSgPlUM3xi', '2024-04-23'),
(25, 'boban', 'boban@gmail.com', '065432876', '$2y$10$vxpO103XfCFtJYENY6i37OrirVT67IkNDLFhPbR829tD94AXeXITe', '2024-06-23'),
(28, 'RAKISILA', 'raki@gmail.com', '123456789', '$2y$10$S2/fMdYUV3Ig39WZ7TRfQ.avtLujcBbMLmv7WTM8qoOqo0iqjfQv.', '2024-06-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`concert_id`),
  ADD KEY `idx_concert_name` (`concert_name`),
  ADD KEY `idx_starts_at` (`starts_at`),
  ADD KEY `idx_price` (`price`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_reservation_user` (`id_korisnika`),
  ADD KEY `idx_reservation_concert_name` (`concert_name`),
  ADD KEY `idx_reservation_starts_at` (`starts_at`),
  ADD KEY `idx_reservation_price` (`price`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `concert`
--
ALTER TABLE `concert`
  MODIFY `concert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_concert` FOREIGN KEY (`concert_name`) REFERENCES `concert` (`concert_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_price` FOREIGN KEY (`price`) REFERENCES `concert` (`price`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_starts_at` FOREIGN KEY (`starts_at`) REFERENCES `concert` (`starts_at`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_user` FOREIGN KEY (`id_korisnika`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
