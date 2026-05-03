-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2026 at 12:44 PM
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
-- Database: `eventsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `date`, `location`, `category`) VALUES
(20, 'Web Development Bootcamp', '2026-05-12', 'Lab 2', 'Programming'),
(22, 'Team Building Event', '2026-05-18', 'Main Hall', 'Skills'),
(23, 'Mobile App Development', '2026-05-20', 'Lab 3', 'Technology'),
(24, 'AI Workshop', '2026-05-10', 'Lab 1', 'Technology'),
(25, 'Cybersecurity Seminar', '2026-05-15', 'Hall A', 'Security');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `player_name` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `total_questions` int(11) DEFAULT NULL,
  `wrong_answers` int(11) DEFAULT NULL,
  `attempt_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `player_name`, `score`, `total_questions`, `wrong_answers`, `attempt_date`) VALUES
(1, 'Ali', 4, 5, 1, '2026-05-01 21:15:06'),
(2, 'Rawan', 3, 5, 2, '2026-05-01 21:15:06'),
(3, 'Sami', 5, 5, 0, '2026-05-01 21:15:06'),
(4, 'Muna', 2, 5, 3, '2026-05-01 21:15:06'),
(5, 'Ahmed', 5, 5, 0, '2026-05-01 21:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `event` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `email`, `student_id`, `event`, `notes`) VALUES
(17, 'Ali Al-Harthi', 's143786@student.squ.edu.om', '143786', 'AI Workshop', 'Interested in AI field'),
(18, 'Sara Al-Balushi', 's144786@student.squ.edu.om', '144786', 'Web Development Bootcamp', 'Loves design'),
(19, 'Ahmed Al-Rawahi', 's142376@student.squ.edu.om', '142376', 'Cybersecurity Seminar', 'Interested in security'),
(20, 'Muna Al-Kindi', 's142367@student.squ.edu.om', '142367', 'Team Building Event', 'Improve teamwork'),
(21, 'Omar Al-Hinai', 's149850@student.squ.edu.om', '149850', 'Mobile App Development', 'Wants app skills');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
