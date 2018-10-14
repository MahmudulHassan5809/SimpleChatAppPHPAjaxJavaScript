-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2018 at 05:40 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messanger_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `clean`
--

CREATE TABLE `clean` (
  `id` int(11) NOT NULL,
  `clean_message_id` int(11) NOT NULL,
  `clean_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clean`
--

INSERT INTO `clean` (`id`, `clean_message_id`, `clean_user_id`) VALUES
(1, 4, 9),
(2, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `msg_type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `msg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `msg_type`, `user_id`, `msg_time`) VALUES
(1, 'whats up', 'text', 9, '2018-10-13 19:30:21'),
(2, 'Please COme Online', 'text', 9, '2018-10-13 19:30:44'),
(3, 'i am new User', 'text', 9, '2018-10-13 19:30:49'),
(4, 'Hello How Are You', 'text', 10, '2018-10-13 20:40:03'),
(5, 'Hwy', 'text', 10, '2018-10-13 20:41:34'),
(6, '../upload/message/8d18605ceb.png', 'png', 9, '2018-10-14 09:39:36'),
(7, '../upload/message/b41132d824.png', 'png', 10, '2018-10-14 10:07:34'),
(8, 'hello', 'text', 9, '2018-10-14 10:26:43'),
(9, 'What Are You Doing?', 'text', 10, '2018-10-14 11:58:40'),
(10, 'hey', 'text', 9, '2018-10-14 12:00:19'),
(11, 'hi', 'text', 9, '2018-10-14 12:13:20'),
(12, '../upload/message/a6db61103a.png', 'png', 10, '2018-10-14 12:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `clean_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `image`, `status`, `clean_status`) VALUES
(9, 'Mahmudul', 'mahmudul.hassan240@gmail.com', '$2y$10$5DDt9M7FH61mUoLY8NHZFuz90lsnzKWRAjyEqigv/.tTddmJwAyCS', 'upload/profile/20e7937c07.png', 1, 1),
(10, 'Muhin', 'muhin@gmail.com', '$2y$10$I1Rb5AaJ.92lg4Tb3SEliuUvJ1gTS76rcd/7X98HBJoAiNjgU/fVq', 'upload/profile/5717d3e875.png', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clean`
--
ALTER TABLE `clean`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clean`
--
ALTER TABLE `clean`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
