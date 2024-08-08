-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 04:11 AM
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
-- Database: `cubicle_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `idnum` varchar(20) NOT NULL,
  `cubicle_num` varchar(20) NOT NULL,
  `stat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `fname`, `lname`, `idnum`, `cubicle_num`, `stat`) VALUES
(55, 'Edison', 'Esberto', '19-0051', 'pc-left 1', 'at-desk'),
(56, 'Marco Paulo', 'Burgos', '21-02185', 'cubicle 11', 'at-desk'),
(57, 'Marc Ace', 'Legaspi', '22-0387', 'cubicle 10', 'at-desk'),
(58, 'Abigail', 'Velasco', '23-0448', 'cubicle 9', 'at-desk'),
(61, 'Vincent', 'Rivera', '19-0054', 'Dean-3', 'at-desk'),
(63, 'Jhay', 'Loyola', '19-0042', 'pc-left 11', 'absent'),
(64, 'Felix', 'Huerte', '24-0042', 'cubicle 6', 'absent'),
(68, 'Jeruz', 'Claudel', '24-02569', 'cubicle 7', 'absent'),
(69, 'Daniel Ivonh', 'Ingco', '23-0449', 'cubicle 12', 'absent'),
(70, 'Merly', 'Matibag', '20-02103', 'cubicle 13', 'absent'),
(71, 'Joel', 'Cuadra', '20-0122', 'pc-left 2', 'absent'),
(72, 'Lucky', 'Alcala', '22-02300', 'cubicle 14', 'absent'),
(73, 'Kaycee', 'Ragusta', '22-02398', 'cubicle 16', 'absent'),
(74, 'Ma. Kathleen', 'Duran', '23-0452', 'cubicle 51', 'absent'),
(75, 'Myra', 'Flordeliza', '21-0267', 'cubicle 49', 'absent'),
(76, 'Paul Vincent', 'Jose', '23-02461', 'cubicle 59', 'absent'),
(77, 'Felipe', 'Mundaca', '23-0446', 'cubicle 1', 'absent'),
(78, 'Clara Vanessa', 'de Castro', '22-0416', 'cubicle 18', 'absent'),
(79, 'Marjualita Theresa', 'Malapo', '19-0045', 'pc-left 10', 'absent'),
(80, 'Alliana', 'Ablan', '21-0281', 'pc-left 6', 'absent'),
(81, 'Jude Thaddeus', 'Bartolome', '22-0292', 'pc-left 5', 'absent'),
(82, 'Milpert John', 'Marato', '24-02565', 'pc-left 4', 'absent'),
(83, 'Ma. Christina', 'Galdo', '21-0287', 'cubicle 20', 'absent'),
(84, 'Marina', 'Justiniani', '20-0129', 'cubicle 28', 'absent'),
(85, 'Devota Normita', 'Comia', '19-0074', 'cubicle 29', 'absent'),
(86, 'Ronel', 'Aligam', '23-0486', 'cubicle 43', 'absent'),
(87, 'Melencia Rosario', 'Coronel', '21-02201', 'cubicle 44', 'absent'),
(88, 'Kim Renzelberg', 'Licerio', '22-0385', 'cubicle 65', 'absent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
