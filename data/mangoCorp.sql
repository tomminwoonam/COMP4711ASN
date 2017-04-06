--
-- Database: `mangocorp`
--
-- This is the basic SQL file that has been updated whenever necessary
-- 
-- @autor Ntori
-- version 4
--
CREATE DATABASE IF NOT EXISTS `mangocorp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mangocorp`;

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

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

DROP TABLE IF EXISTS `histories`;
CREATE TABLE `histories` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `transactionType` varchar(20) NOT NULL,
  `value` int(11) NOT NULL,
  `dateTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
CREATE TABLE `parts` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `caCode` varchar(8) NOT NULL,
  `model` varchar(1) NOT NULL,
  `piece` int(11) NOT NULL,
  `plant` varchar(20) NOT NULL,
  `dateTime` date NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `robots`
--

DROP TABLE IF EXISTS `robots`;
CREATE TABLE `robots` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `botCode` varchar(15) NOT NULL,
  `topCode` varchar(8) NOT NULL,
  `torsoCode` varchar(8) NOT NULL,
  `bottomCode` varchar(8) NOT NULL,
  `topId` varchar(2) NOT NULL,
  `torsoId` varchar(2) NOT NULL,
  `bottomId` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `secrets`
--

DROP TABLE IF EXISTS `secrets`;
CREATE TABLE `secrets` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `type` varchar(15) NOT NULL,
  `value` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secrets`
--

INSERT INTO `secrets` (`id`, `type`, `value`) VALUES
(0, 'apiKey', '??????'),
(1, 'partsCount', '0'),
(2, 'botCount', '0'),
(3, 'token', '1c96d5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histories`
--
-- ALTER TABLE `histories`
--    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts`
--
-- ALTER TABLE `parts`
--   ADD PRIMARY KEY (`id`),
--   ADD UNIQUE KEY `caCode` (`caCode`);

--
-- Indexes for table `robots`
--
-- ALTER TABLE `robots`
--   ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secrets`
--
-- ALTER TABLE `secrets`
--   ADD PRIMARY KEY (`id`);
