SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

--
-- Database: azmirakh_pos_project
--

/* ==============================
   STORED PROCEDURE (FIXED)
   ============================== */

DELIMITER $$

DROP PROCEDURE IF EXISTS get_users_with_role $$

CREATE PROCEDURE get_users_with_role ()
BEGIN
    SELECT 
        u.id,
        u.firstname,
        u.lastname,
        u.email,
        r.name AS role_name
    FROM users u
    JOIN table_rolemaping rm ON u.id = rm.users_id
    JOIN table_roles r ON rm.table_roles_id = r.id;
END $$

DELIMITER ;

/* ==============================
   TABLE: booking
   ============================== */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `booking` VALUES
(1,1,2,'2025-08-30','Azmira','azmira@gmail.com','019890998','Uttara Dhaka','pending'),
(2,1,2,'2025-09-03','Azmira','azmira@gmail.com','019890998','Uttara Dhaka','pending'),
(8,13,5,'2025-09-06','Lucky Akter','lucky@gmail.com','90755600','Dhaka','pending'),
(9,13,5,'2025-09-06','Azmira','azmira@gmail.com','019890998','Uttara Dhaka','pending'),
(10,1,2,'2025-08-30','Azmira','azmira@gmail.com','019890998','Uttara Dhaka','pending'),
(12,12,6,'2025-08-31','Azmira','azmira@gmail.com','019890998','Uttara Dhaka','pending'),
(13,3,2,'2025-08-23','Azmira','azmira@gmail.com','019890998','Uttara Dhaka','pending'),
(14,5,2,'2025-08-29','Azmira','azmira@gmail.com','019890998','Uttara Dhaka','complete'),
(15,13,5,'2025-09-06','Test','test@gmail.com','907556','uttara','pending'),
(16,12,6,'2025-08-31','Test','test@gmail.com','907556','uttara','complete');

/* ==============================
   TABLE: categories
   ============================== */

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* ==============================
   TABLE: event
   ============================== */

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `event_name` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `venue_id` int(11) NOT NULL,
  `image` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* ==============================
   TABLE: table_rolemaping
   ============================== */

CREATE TABLE `table_rolemaping` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `table_roles_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* ==============================
   TABLE: table_roles
   ============================== */

CREATE TABLE `table_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `table_roles` VALUES (2,'customer');

/* ==============================
   TABLE: users
   ============================== */

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* ==============================
   TABLE: venue
   ============================== */

CREATE TABLE `venue` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `capacity` varchar(100) NOT NULL,
  `rent` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
