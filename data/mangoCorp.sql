-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2017 at 01:54 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mangoCorp`
--
CREATE DATABASE IF NOT EXISTS mangoCorp;
USE mangoCorp;
-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('32bb32997b400eed11631da9bcdfdc41a6a6b2e3', '::1', 1491203610, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313230333631303b),
('1b03ade4a5c31e31b9b45308d002653b02d8ab67', '::1', 1491204009, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313230343030393b),
('41b1dc04586a49ffccc39de068b038aee79e804a', '::1', 1491204617, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313230343631373b),
('b3a7673df87a1a961c7eab743c48d91556657408', '::1', 1491204312, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313230343331323b),
('7f9b5c98978655aff99b2c0e10c0f4cfca1a52f2', '::1', 1491205057, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313230353035373b),
('b2be3f0412cb20d832a784f5e9f7d5740e085afd', '::1', 1491205682, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313230353638323b),
('010eff0027c63671eacb9a460f74179f923dd888', '::1', 1491209325, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313230393332353b),
('2e261dadc2151ec4e343131640fa2942618ac1cd', '::1', 1491209564, 0x5f5f63695f6c6173745f726567656e65726174657c693a313439313230393332353b);

-- --------------------------------------------------------

--
-- Table structure for table `Histories`
--

DROP TABLE IF EXISTS `Histories`;
CREATE TABLE `Histories` (
  `id` int(11) NOT NULL,
  `transactionType` varchar(10) NOT NULL,
  `value` int(11) NOT NULL,
  `dateTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Histories`
--

INSERT INTO `Histories` (`id`, `transactionType`, `value`, `dateTime`) VALUES
(0, 'Buy Box', -100, '2017-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `Parts`
--

DROP TABLE IF EXISTS `Parts`;
CREATE TABLE `Parts` (
  `id` int(11) NOT NULL,
  `caCode` varchar(8) NOT NULL,
  `model` varchar(1) NOT NULL,
  `piece` int(11) NOT NULL,
  `plant` varchar(20) NOT NULL,
  `dateTime` date NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Parts`
--

INSERT INTO `Parts` (`id`, `caCode`, `model`, `piece`, `plant`, `dateTime`, `used`) VALUES
(0, '45AF89FS', 'a', 1, 'mango', '2017-04-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Robots`
--

DROP TABLE IF EXISTS `Robots`;
CREATE TABLE `Robots` (
  `id` int(11) NOT NULL,
  `topCode` varchar(8) NOT NULL,
  `torsoCode` varchar(8) NOT NULL,
  `bottomCode` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Histories`
--
ALTER TABLE `Histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Parts`
--
ALTER TABLE `Parts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `caCode` (`caCode`);

--
-- Indexes for table `Robots`
--
ALTER TABLE `Robots`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
