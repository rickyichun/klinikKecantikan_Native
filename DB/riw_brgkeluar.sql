-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 10:34 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `riw_brgkeluar`
--

CREATE TABLE `riw_brgkeluar` (
  `id` int(11) NOT NULL,
  `idtrx` varchar(50) NOT NULL,
  `idbarang` varchar(50) NOT NULL,
  `qtyout` varchar(100) NOT NULL,
  `iduser` int(20) NOT NULL,
  `ket` text NOT NULL,
  `tglupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riw_brgkeluar`
--

INSERT INTO `riw_brgkeluar` (`id`, `idtrx`, `idbarang`, `qtyout`, `iduser`, `ket`, `tglupdate`) VALUES
(1, '14', '12', '60', 1, '', '2024-01-24 16:20:58'),
(2, '14', '11', '8', 1, '', '2024-01-24 16:20:58'),
(3, '14', '10', '20', 1, '', '2024-01-24 16:20:58'),
(4, '14', '23', '100', 1, '', '2024-01-24 16:20:58'),
(5, '14', '30', '2', 1, '', '2024-01-24 16:20:58'),
(6, '14', '24', '4', 1, '', '2024-01-24 16:20:58'),
(7, '14', '36', '2', 1, '', '2024-01-24 16:20:58'),
(8, '14', '5', '2', 1, '', '2024-01-24 16:20:58'),
(9, '14', '31', '8', 1, '', '2024-01-24 16:20:58'),
(10, '14', '13', '4', 1, '', '2024-01-24 16:20:58'),
(11, '14', '28', '20', 1, '', '2024-01-24 16:20:58'),
(12, '14', '15', '8', 1, '', '2024-01-24 16:20:58'),
(13, '14', '12', '60', 1, '', '2024-01-24 16:23:22'),
(14, '14', '11', '8', 1, '', '2024-01-24 16:23:22'),
(15, '14', '10', '20', 1, '', '2024-01-24 16:23:22'),
(16, '14', '23', '100', 1, '', '2024-01-24 16:23:22'),
(17, '14', '30', '2', 1, '', '2024-01-24 16:23:22'),
(18, '14', '24', '4', 1, '', '2024-01-24 16:23:22'),
(19, '14', '36', '2', 1, '', '2024-01-24 16:23:22'),
(20, '14', '5', '2', 1, '', '2024-01-24 16:23:22'),
(21, '14', '31', '8', 1, '', '2024-01-24 16:23:22'),
(22, '14', '13', '4', 1, '', '2024-01-24 16:23:22'),
(23, '14', '28', '20', 1, '', '2024-01-24 16:23:22'),
(24, '14', '15', '8', 1, '', '2024-01-24 16:23:22'),
(25, '14', '12', '60', 1, '', '2024-01-24 16:31:12'),
(26, '14', '11', '8', 1, '', '2024-01-24 16:31:12'),
(27, '14', '10', '20', 1, '', '2024-01-24 16:31:12'),
(28, '14', '23', '100', 1, '', '2024-01-24 16:31:12'),
(29, '14', '30', '2', 1, '', '2024-01-24 16:31:12'),
(30, '14', '24', '4', 1, '', '2024-01-24 16:31:12'),
(31, '14', '36', '2', 1, '', '2024-01-24 16:31:12'),
(32, '14', '5', '2', 1, '', '2024-01-24 16:31:12'),
(33, '14', '31', '8', 1, '', '2024-01-24 16:31:12'),
(34, '14', '13', '4', 1, '', '2024-01-24 16:31:12'),
(35, '14', '28', '20', 1, '', '2024-01-24 16:31:12'),
(36, '14', '15', '8', 1, '', '2024-01-24 16:31:12'),
(37, '14', '12', '60', 3, '', '2024-01-25 14:04:10'),
(38, '14', '11', '8', 3, '', '2024-01-25 14:04:10'),
(39, '14', '10', '20', 3, '', '2024-01-25 14:04:10'),
(40, '14', '23', '100', 3, '', '2024-01-25 14:04:10'),
(41, '14', '30', '2', 3, '', '2024-01-25 14:04:10'),
(42, '14', '24', '4', 3, '', '2024-01-25 14:04:10'),
(43, '14', '36', '2', 3, '', '2024-01-25 14:04:10'),
(44, '14', '5', '2', 3, '', '2024-01-25 14:04:10'),
(45, '14', '31', '8', 3, '', '2024-01-25 14:04:10'),
(46, '14', '13', '4', 3, '', '2024-01-25 14:04:10'),
(47, '14', '28', '20', 3, '', '2024-01-25 14:04:10'),
(48, '14', '15', '8', 3, '', '2024-01-25 14:04:10'),
(49, '14', '1', '500', 3, '', '2024-01-25 14:04:10'),
(50, '14', '29', '1', 3, '', '2024-01-25 14:04:10'),
(51, '14', '21', '5', 3, '', '2024-01-25 14:04:10'),
(52, '14', '33', '5', 3, '', '2024-01-25 14:04:10'),
(53, '14', '10', '4', 3, '', '2024-01-25 14:04:10'),
(54, '14', '7', '3', 3, '', '2024-01-25 14:04:10'),
(55, '14', '12', '60', 3, '', '2024-01-25 14:05:11'),
(56, '14', '11', '8', 3, '', '2024-01-25 14:05:11'),
(57, '14', '10', '20', 3, '', '2024-01-25 14:05:11'),
(58, '14', '23', '100', 3, '', '2024-01-25 14:05:11'),
(59, '14', '30', '2', 3, '', '2024-01-25 14:05:11'),
(60, '14', '24', '4', 3, '', '2024-01-25 14:05:11'),
(61, '14', '36', '2', 3, '', '2024-01-25 14:05:11'),
(62, '14', '5', '2', 3, '', '2024-01-25 14:05:11'),
(63, '14', '31', '8', 3, '', '2024-01-25 14:05:11'),
(64, '14', '13', '4', 3, '', '2024-01-25 14:05:11'),
(65, '14', '28', '20', 3, '', '2024-01-25 14:05:11'),
(66, '14', '15', '8', 3, '', '2024-01-25 14:05:11'),
(67, '14', '1', '500', 3, '', '2024-01-25 14:05:11'),
(68, '14', '29', '1', 3, '', '2024-01-25 14:05:11'),
(69, '14', '21', '5', 3, '', '2024-01-25 14:05:11'),
(70, '14', '33', '5', 3, '', '2024-01-25 14:05:11'),
(71, '14', '10', '4', 3, '', '2024-01-25 14:05:11'),
(72, '14', '7', '3', 3, '', '2024-01-25 14:05:11'),
(73, '14', '12', '60', 3, '', '2024-01-25 14:05:22'),
(74, '14', '11', '8', 3, '', '2024-01-25 14:05:22'),
(75, '14', '10', '20', 3, '', '2024-01-25 14:05:22'),
(76, '14', '23', '100', 3, '', '2024-01-25 14:05:22'),
(77, '14', '30', '2', 3, '', '2024-01-25 14:05:22'),
(78, '14', '24', '4', 3, '', '2024-01-25 14:05:22'),
(79, '14', '36', '2', 3, '', '2024-01-25 14:05:22'),
(80, '14', '5', '2', 3, '', '2024-01-25 14:05:22'),
(81, '14', '31', '8', 3, '', '2024-01-25 14:05:22'),
(82, '14', '13', '4', 3, '', '2024-01-25 14:05:22'),
(83, '14', '28', '20', 3, '', '2024-01-25 14:05:22'),
(84, '14', '15', '8', 3, '', '2024-01-25 14:05:22'),
(85, '14', '1', '500', 3, '', '2024-01-25 14:05:22'),
(86, '14', '29', '1', 3, '', '2024-01-25 14:05:22'),
(87, '14', '21', '5', 3, '', '2024-01-25 14:05:22'),
(88, '14', '33', '5', 3, '', '2024-01-25 14:05:22'),
(89, '14', '10', '4', 3, '', '2024-01-25 14:05:22'),
(90, '14', '7', '3', 3, '', '2024-01-25 14:05:22'),
(91, '14', '12', '60', 3, '', '2024-01-25 14:18:15'),
(92, '14', '11', '8', 3, '', '2024-01-25 14:18:15'),
(93, '14', '10', '20', 3, '', '2024-01-25 14:18:15'),
(94, '14', '23', '100', 3, '', '2024-01-25 14:18:15'),
(95, '14', '30', '2', 3, '', '2024-01-25 14:18:15'),
(96, '14', '24', '4', 3, '', '2024-01-25 14:18:15'),
(97, '14', '36', '2', 3, '', '2024-01-25 14:18:15'),
(98, '14', '5', '2', 3, '', '2024-01-25 14:18:15'),
(99, '14', '31', '8', 3, '', '2024-01-25 14:18:15'),
(100, '14', '13', '4', 3, '', '2024-01-25 14:18:15'),
(101, '14', '28', '20', 3, '', '2024-01-25 14:18:15'),
(102, '14', '15', '8', 3, '', '2024-01-25 14:18:15'),
(103, '14', '1', '500', 3, '', '2024-01-25 14:18:15'),
(104, '14', '29', '1', 3, '', '2024-01-25 14:18:15'),
(105, '14', '21', '5', 3, '', '2024-01-25 14:18:15'),
(106, '14', '33', '5', 3, '', '2024-01-25 14:18:15'),
(107, '14', '10', '4', 3, '', '2024-01-25 14:18:15'),
(108, '14', '7', '3', 3, '', '2024-01-25 14:18:15'),
(109, '14', '12', '60', 3, '', '2024-01-25 16:15:38'),
(110, '14', '11', '8', 3, '', '2024-01-25 16:15:38'),
(111, '14', '10', '20', 3, '', '2024-01-25 16:15:38'),
(112, '14', '23', '100', 3, '', '2024-01-25 16:15:38'),
(113, '14', '30', '2', 3, '', '2024-01-25 16:15:38'),
(114, '14', '24', '4', 3, '', '2024-01-25 16:15:38'),
(115, '14', '36', '2', 3, '', '2024-01-25 16:15:38'),
(116, '14', '5', '2', 3, '', '2024-01-25 16:15:38'),
(117, '14', '31', '8', 3, '', '2024-01-25 16:15:38'),
(118, '14', '13', '4', 3, '', '2024-01-25 16:15:38'),
(119, '14', '28', '20', 3, '', '2024-01-25 16:15:38'),
(120, '14', '15', '8', 3, '', '2024-01-25 16:15:38'),
(121, '14', '1', '500', 3, '', '2024-01-25 16:15:38'),
(122, '14', '29', '1', 3, '', '2024-01-25 16:15:38'),
(123, '14', '21', '5', 3, '', '2024-01-25 16:15:38'),
(124, '14', '33', '5', 3, '', '2024-01-25 16:15:38'),
(125, '14', '10', '4', 3, '', '2024-01-25 16:15:38'),
(126, '14', '7', '3', 3, '', '2024-01-25 16:15:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `riw_brgkeluar`
--
ALTER TABLE `riw_brgkeluar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `riw_brgkeluar`
--
ALTER TABLE `riw_brgkeluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;