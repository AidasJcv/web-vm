-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 16, 2019 at 06:01 AM
-- Server version: 5.7.28
-- PHP Version: 5.6.40-0+deb8u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `user_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `vm_user_order`
--

CREATE TABLE IF NOT EXISTS `vm_user_order` (
  `id` int(11) NOT NULL,
  `vmname` varchar(255) NOT NULL,
  `cpuamount` int(11) NOT NULL,
  `ramamount` int(11) NOT NULL,
  `storageamount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vm_user_order`
--
ALTER TABLE `vm_user_order`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vm_user_order`
--
ALTER TABLE `vm_user_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Sample data for table `vm_user_order`
--

INSERT INTO `vm_user_order` (`vmname`, `cpuamount`, `ramamount`, `storageamount`) VALUES
('VM1', 2, 2048, 100),
('VM2', 4, 4096, 250),
('VM3', 6, 8192, 500);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
