-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 08:03 PM
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
-- Database: `asdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `studenttbl`
--

CREATE TABLE `studenttbl` (
  `id` int(11) NOT NULL,
  `student_lrn` varchar(255) NOT NULL,
  `student_fname` varchar(255) NOT NULL,
  `student_mname` varchar(255) NOT NULL,
  `student_lname` varchar(255) NOT NULL,
  `student_birthdate` date NOT NULL,
  `student_gender` varchar(255) NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `student_phoneno` varchar(11) NOT NULL,
  `fingerprint_id` int(11) NOT NULL,
  `add_fingerid` int(11) NOT NULL,
  `del_fingerid` int(11) NOT NULL,
  `fingerprint_select` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studenttbl`
--

INSERT INTO `studenttbl` (`id`, `student_lrn`, `student_fname`, `student_mname`, `student_lname`, `student_birthdate`, `student_gender`, `student_address`, `student_phoneno`, `fingerprint_id`, `add_fingerid`, `del_fingerid`, `fingerprint_select`) VALUES
(1, '123456789012', 'John', 'Dew', 'Doe', '2000-08-04', 'Male', 'Hacker Street, IT City', '12345678901', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachertbl`
--

CREATE TABLE `teachertbl` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachertbl`
--

INSERT INTO `teachertbl` (`id`, `username`, `password`) VALUES
(1, 'teacher', '8d788385431273d11e8b43bb78f3aa41');

-- --------------------------------------------------------

--
-- Table structure for table `timeinouttbl`
--

CREATE TABLE `timeinouttbl` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `date` date NOT NULL,
  `fingerprint_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studenttbl`
--
ALTER TABLE `studenttbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachertbl`
--
ALTER TABLE `teachertbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeinouttbl`
--
ALTER TABLE `timeinouttbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `studenttbl`
--
ALTER TABLE `studenttbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teachertbl`
--
ALTER TABLE `teachertbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timeinouttbl`
--
ALTER TABLE `timeinouttbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
