-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 05:00 AM
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
-- Database: `ase230final`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_when` datetime NOT NULL DEFAULT current_timestamp(),
  `last_modified` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `title`, `description`, `created_by`, `is_public`, `created_when`, `last_modified`) VALUES
(1, 'Project1!', 'First project on the conestep account', 1, 1, '2024-12-06 19:49:12', '2024-12-08 21:31:43'),
(3, 'colsoncoleproj24', 'this is colson cole first project!!!!', 4, 1, '2024-12-07 18:40:11', '2024-12-07 19:01:24'),
(7, 'My First Project!', 'This is my first project!!!', 6, 1, '2024-12-08 19:01:11', '2024-12-08 19:25:09'),
(10, 'Project 2', 'conesteps 2nd project', 1, 1, '2024-12-08 19:08:04', '2024-12-08 19:25:20'),
(11, 'Secret Project', 'This is for Davis only!', 6, 0, '2024-12-08 19:10:15', '2024-12-08 21:31:47'),
(14, 'three', 'threre', 1, 0, '2024-12-08 22:18:11', '2024-12-08 22:18:11'),
(15, 'Test Project 1', 'Public One', 8, 1, '2024-12-08 22:32:56', '2024-12-08 22:32:56'),
(17, 'Private Project', 'private', 8, 0, '2024-12-08 22:33:55', '2024-12-08 22:33:55'),
(18, 'Test Project 1', 'regegwfwfwger', 9, 1, '2024-12-08 22:58:39', '2024-12-08 22:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'conner', 'stephens', 'conesteps', 'connerstephens52@gmail.com', '$2y$10$.JkA5/M2M5IL5M/2Z41nieKaOD9ymNbwfxp2MOHVkXfVZvGfMVWAe', 1),
(3, 'Jeff', 'Bezos', 'JeffBezos2024', 'JeffBezos2024@gmail.com', '$2y$10$V2G3Zn23VybvlnHPIZ2pzeFYyKu1.nWtVReinXCrFNSO4QoP8nk2u', 0),
(4, 'colson', 'cole', 'colsoncole2024', 'colsoncole2024@gmail.com', '$2y$10$K8bT4x3AxSiOzErqAJyrA.extziTrwL9rEMRm11LOu8jo6lUhWYNu', 0),
(5, 'dante', 'basket', 'danebasket2024', 'danebasket2024@gmail.com', '$2y$10$11tudixfVrwPCz9/tPEZo.TF/RItn0vWmIPzSkDyhbAfu.yQ3SlGG', 1),
(6, 'davis', 'frizz', 'davisfrizz2024', 'davisfrizz2024@gmail.com', '$2y$10$Xnaq5BEwh.yVVSyvVFXSSu4qz0XrUt1uPXqdljEDp69u/7.MjVO5q', 0),
(7, 'PJ', 'Brand', 'PJBrand', 'PJBrand@gmail.com', '$2y$10$CRHC2vaMAD3Amof98P9nO.jHXoTyZ8HhUvzNW7nPMqfltmCS/aDSm', 0),
(8, 'Test', 'Account', 'Test123', 'Test123@gmail.com', '$2y$10$qsWTpkKqw3fHzz/2FSWq4e8YufDpXvO.RsNzkXYhY6PNtvCXHRtMS', 0),
(9, 'Test', 'Admin', 'TestAdmin123', 'TestAdmin123@gmail.com', '$2y$10$xp7lValNPFevVzFV8L6C3eiXPgI8bIIPRxTZjmrUt0mIBf18z7gj6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
