-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2025 at 03:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event-ms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_users_with_role` ()   BEGIN
    SELECT u.id, u.firstname, u.lastname, u.email, r.name AS role_name
    FROM users u
    JOIN table_rolemaping rm ON u.id = rm.users_id
    JOIN table_roles r ON rm.role_id = r.id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` enum('pending','complete') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `event_id`, `venue_id`, `date`, `customer_name`, `gmail`, `contact_number`, `address`, `status`) VALUES
(1, 1, 2, '2025-08-30', 'Azmira', 'azmira@gmail.com', '019890998', 'Uttara Dhaka', 'pending'),
(2, 1, 2, '2025-09-03', 'Azmira', 'azmira@gmail.com', '019890998', 'Uttara Dhaka', 'pending'),
(8, 13, 5, '2025-09-06', 'Lucky Akter', 'lucky@gmail.com', '90755600', 'Dhaka', 'pending'),
(9, 13, 5, '2025-09-06', 'Azmira', 'azmira@gmail.com', '019890998', 'Uttara Dhaka', 'pending'),
(10, 1, 2, '2025-08-30', 'Azmira', 'azmira@gmail.com', '019890998', 'Uttara Dhaka', 'pending'),
(12, 12, 6, '2025-08-31', 'Azmira', 'azmira@gmail.com', '019890998', 'Uttara Dhaka', 'pending'),
(13, 3, 2, '2025-08-23', 'Azmira', 'azmira@gmail.com', '019890998', 'Uttara Dhaka', 'pending'),
(14, 5, 2, '2025-08-29', 'Azmira', 'azmira@gmail.com', '019890998', 'Uttara Dhaka', 'complete'),
(15, 13, 5, '2025-09-06', 'Test', 'test@gmail.com', '907556', 'uttara', 'pending'),
(16, 12, 6, '2025-08-31', 'Test', 'test@gmail.com', '907556', 'uttara', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `event_name` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `venue_id` int(11) NOT NULL,
  `image` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `event_name`, `description`, `type`, `date`, `venue_id`, `image`) VALUES
(1, 'Wedding', 'good', 'Wedding', '2025-08-30', 2, './pages/bookingevent/uploads/pest_img.jpg'),
(3, 'Birthday party', 'good', 'Birthday', '2025-08-23', 2, 'uploads/birthday.jpg'),
(5, 'BSC workshop', 'good', 'Seminar', '2025-08-29', 2, 'uploads/workshop.jpg'),
(12, 'Wedding', '', 'Wedding', '2025-08-31', 6, 'uploads/evt_68b5b4210502d6.45938421.jpg'),
(13, 'Birthday party', 'Colorful birthday celebration with customized decoration, kids’ play zone, music, and cake arrangement. Ideal for small family gatherings', 'Birthday', '2025-09-06', 5, 'uploads/birthday.jpg'),
(14, 'BSC workshop', 'Good Experience', 'Conference', '2025-09-03', 6, 'uploads/images (2).jpg'),
(16, 'MBBS workshop', 'good', 'Seminar', '2025-09-11', 2, 'uploads/evt_68b5b3e40b5bf2.80603653.jpg'),
(17, 'Wedding', 'good', 'Wedding', '2025-09-12', 5, 'uploads/evt_68b5b55cd8b4e2.32479391.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `table_rolemaping`
--

CREATE TABLE `table_rolemaping` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `table_roles_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_roles`
--

CREATE TABLE `table_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_roles`
--

INSERT INTO `table_roles` (`id`, `name`) VALUES
(2, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(21, 'Rafia', 'islam', 'rafia@mail.com', '223355'),
(22, 'mira', 'Akter', 'admin@mail.com', '1234'),
(24, 'azmira', 'mukta', 'azmira@mail.com', '1234'),
(25, ' Mohiuddin', 'Mohi', 'mohi@mail.com', '4444'),
(28, 'sharmin', 'akter', 'sharmin@mail.com', '4444'),
(30, 'Shahadat', 'Hossain', 'shahadat@gmail.com', '7777'),
(31, 'Ayan', 'ahsan', 'ayan@gmail.com', '5678'),
(32, 'Ayan', 'ahsan', 'ayan@gmail.com', '1234'),
(33, 'Farhana', 's', 'farhana@gmail.com', '1234'),
(37, 's', 'a', 's@gmail.com', '1234'),
(38, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `capacity` varchar(100) NOT NULL,
  `rent` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `name`, `location`, `capacity`, `rent`, `description`) VALUES
(2, 'Royal Hall', 'Mirpur', '100', 5000, 'easily accessible by public transport'),
(3, 'dance club', 'uttara', '50', 10000, 'very good'),
(5, 'Momotaj Plaza', 'Dhanmondi,Dhaka', '200', 6000, 'Stage, lighting, and sound system included.'),
(6, 'Shopno convention Hall', 'Mirpur', '500', 20000, 'Spacious air-conditioned hall with a capacity of 500 guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `table_rolemaping`
--
ALTER TABLE `table_rolemaping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `table_roles_id` (`table_roles_id`);

--
-- Indexes for table `table_roles`
--
ALTER TABLE `table_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `table_rolemaping`
--
ALTER TABLE `table_rolemaping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_roles`
--
ALTER TABLE `table_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `table_rolemaping`
--
ALTER TABLE `table_rolemaping`
  ADD CONSTRAINT `table_rolemaping_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `table_rolemaping_ibfk_2` FOREIGN KEY (`table_roles_id`) REFERENCES `table_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
