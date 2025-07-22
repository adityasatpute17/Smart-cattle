-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2025 at 04:55 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cowfarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cattle`
--

CREATE TABLE IF NOT EXISTS `cattle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cattlename` varchar(50) NOT NULL,
  `cattletype` varchar(30) NOT NULL,
  `breed` varchar(30) NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `lifecycle_Status` varchar(30) NOT NULL,
  `milking` varchar(20) NOT NULL,
  `Health_Status` varchar(30) NOT NULL,
  `ReproductionStatus` varchar(50) NOT NULL,
  `Lastheat` date NOT NULL,
  `LastAI` date NOT NULL,
  `Lastcalving` date NOT NULL,
  `PashuAadhar` varchar(50) NOT NULL,
  `Weight` int(11) NOT NULL,
  `IdentificationMark` varchar(100) NOT NULL,
  `Mother` varchar(50) NOT NULL,
  `Father` varchar(50) NOT NULL,
  `Calf Detail` varchar(50) NOT NULL,
  `calfname` varchar(100) NOT NULL,
  `sex` varchar(11) NOT NULL,
  `calfbdate` date NOT NULL,
  `calffather` varchar(50) NOT NULL,
  `Dry Off Date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `cattle`
--

INSERT INTO `cattle` (`id`, `cattlename`, `cattletype`, `breed`, `Date_Of_Birth`, `lifecycle_Status`, `milking`, `Health_Status`, `ReproductionStatus`, `Lastheat`, `LastAI`, `Lastcalving`, `PashuAadhar`, `Weight`, `IdentificationMark`, `Mother`, `Father`, `Calf Detail`, `calfname`, `sex`, `calfbdate`, `calffather`, `Dry Off Date`) VALUES
(4, 'nandini', 'Cow', 'HF Cross', '2020-07-19', 'adult', 'lactating', 'Not Good', 'open', '2023-12-31', '2023-12-31', '2024-01-01', '11111211', 11111, '1111', 'jy cross', 'bife hf', '111111', '', 'Female', '0000-00-00', '11111111', '0000-00-00'),
(5, 'nova', 'Cow', 'HF Cross', '2024-03-03', 'calf', '', 'Good', '', '0000-00-00', '0000-00-00', '0000-00-00', '123456', 120, 'no', 'nandini', 'bife', '', '', '', '0000-00-00', '', '0000-00-00'),
(6, 'panjab', 'cow', 'HF', '2018-11-02', 'adult', 'lactating', 'Bad', 'pregnant', '2024-11-06', '2024-07-06', '2024-12-01', '12345678', 500, 'wwww', 'no', 'not', 'jinu', '', 'Female', '2024-12-01', 'bife', '2025-07-03'),
(10, 'sharvi', 'cow', 'HF', '2024-08-26', 'calf', '', 'Good', '', '0000-00-00', '0000-00-00', '0000-00-00', '12345567', 90, 'black', 'mothikarvad', 'amul', '', '', '', '0000-00-00', '', '0000-00-00'),
(12, 'gargi', 'cow', 'HF', '2024-09-26', 'calf', '', 'Good', '', '0000-00-00', '0000-00-00', '0000-00-00', '134242543', 60, 'sdf', 'ganga', 'ABS Tornado', '', '', '', '0000-00-00', '', '0000-00-00'),
(13, 'gauri', 'cow', 'HF', '2018-12-12', 'adult', 'lactating', 'Good', 'open', '2025-10-12', '2024-12-12', '2211-12-11', '123123123123', 123, 'adasdsd', 'asssss', 'sssss', 'asassas', 'asassas', 'Male', '2222-12-22', 'adia', '0000-00-00'),
(14, '2vasru', 'cow', 'HF', '2016-12-12', 'adult', 'dry', 'Good', 'open', '1212-12-12', '2024-01-01', '2222-12-21', '121223223', 300, 'bbbb', 'naaaaaaaaa', 'naaaaaaaaa', 'sonali', 'sonali', 'Male', '1222-12-11', 'naaaa', '0000-00-00'),
(15, 'sonali', 'cow', 'HF', '1212-12-12', 'heifer', '', 'Good', 'pregnant', '2112-12-12', '2024-02-12', '0000-00-00', '212121212121', 123, 'asdfff', 'asdsd', 'fsdfdf', '', '', '', '0000-00-00', '', '0000-00-00'),
(29, 'mothi', 'cow', 'HF', '0000-00-00', 'adult', 'lactating', 'Good', 'open', '2024-12-31', '2024-12-29', '0000-00-00', '', 0, '', '', '', '', '', '--Choose--', '0000-00-00', '', '2025-07-17'),
(30, 'radha', 'cow', 'HF', '0000-00-00', 'adult', 'lactating', 'Good', 'pregnant', '2024-12-31', '2024-12-29', '0000-00-00', '', 0, '', '', '', '', '', '--Choose--', '0000-00-00', '', '2025-08-06'),
(40, 'chandra', 'cow', 'HF', '0000-00-00', 'adult', 'lactating', 'Good', 'open', '2024-10-12', '2024-10-12', '0000-00-00', '', 0, '', '', '', '', '', '--Choose--', '0000-00-00', '', '2025-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `cattle_removals`
--

CREATE TABLE IF NOT EXISTS `cattle_removals` (
  `id` int(11) NOT NULL DEFAULT '0',
  `removaldate` date NOT NULL,
  `reason` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cattle_removals`
--

INSERT INTO `cattle_removals` (`id`, `removaldate`, `reason`) VALUES
(11, '2023-12-12', 'other');

-- --------------------------------------------------------

--
-- Table structure for table `farm_setup`
--

CREATE TABLE IF NOT EXISTS `farm_setup` (
  `Low_milk` int(11) NOT NULL,
  `milkingUnit` varchar(11) NOT NULL,
  `period_post_calving` int(11) NOT NULL,
  `Calf_to_Heiferg` int(11) NOT NULL,
  `Pregnancy_Period` int(11) NOT NULL,
  `1st_Pregnancy_Check` int(11) NOT NULL,
  `2nd_Pregnancy_Check` int(11) NOT NULL,
  `Dry_off_period` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farm_setup`
--

INSERT INTO `farm_setup` (`Low_milk`, `milkingUnit`, `period_post_calving`, `Calf_to_Heiferg`, `Pregnancy_Period`, `1st_Pregnancy_Check`, `2nd_Pregnancy_Check`, `Dry_off_period`) VALUES
(50, 'litres', 60, 6, 280, 60, 90, 60);

-- --------------------------------------------------------

--
-- Table structure for table `milk_records`
--

CREATE TABLE IF NOT EXISTS `milk_records` (
  `cattle_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `session1` int(11) NOT NULL,
  `session2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `mobile_number`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Aditya', 'Satpute', '+917498278720', 'Noknok@123', 'User', 'Active', '2025-01-19 08:18:16'),
(2, 'aniket', 'satpute', '+917972605332', '1234', 'User', 'Active', '2025-03-28 15:22:38'),
(3, 'Radhaakrushna', 'satpute', '+919763598805', '123456789', 'User', 'Active', '2025-07-18 04:44:51');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
