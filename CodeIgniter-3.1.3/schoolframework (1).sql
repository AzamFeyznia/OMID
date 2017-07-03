-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2017 at 12:59 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `schoolframework`
--

-- --------------------------------------------------------

--
-- Table structure for table `sysaccounts`
--

CREATE TABLE IF NOT EXISTS `sysaccounts` (
  `SysAccountId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'شناسه اکانت سیستم ',
  `ActiveEmail` varchar(45) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'ایمیل فعال',
  `Disabled` enum('NO','YES') COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'فعال/ غیرفعال',
  `ExpireDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'تاریخ انقضا',
  `UserName` varchar(60) COLLATE utf8_persian_ci NOT NULL COMMENT 'نام کاربری',
  `Pswd1` varchar(100) COLLATE utf8_persian_ci NOT NULL COMMENT 'پسورد1',
  `Pswd2` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'پسورد2',
  `PswdShouldBeChanged` enum('YES','NO') COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'پسورد بایستی عوض شود',
  `PersonTypeId` enum('ADMIN','TEACHER','STUDENT','STAFF') COLLATE utf8_persian_ci NOT NULL COMMENT 'شناسه نوع فرد',
  `PersonId` int(11) NOT NULL COMMENT 'شناسه فرد',
  PRIMARY KEY (`SysAccountId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='اطلاعات اکانتها' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sysaccounts`
--

INSERT INTO `sysaccounts` (`SysAccountId`, `ActiveEmail`, `Disabled`, `ExpireDate`, `UserName`, `Pswd1`, `Pswd2`, `PswdShouldBeChanged`, `PersonTypeId`, `PersonId`) VALUES
(1, 'azam.feyznia@gmail.com', 'NO', '2017-02-09 17:44:11', 'Azam.Feyznia', '10470c3b4b1fed12c3baac014be15fac67c6e815', NULL, 'NO', 'STUDENT', 1),
(2, 'test@gmail.com', 'NO', '2017-02-10 07:29:58', 'Milad.Ranaei', '3915da4d2d16dd5a69b6204cacb8a2a1d9e79f34', NULL, 'NO', 'ADMIN', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sysaudit`
--

CREATE TABLE IF NOT EXISTS `sysaudit` (
  `RecId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'شناسه رکورد',
  `UserId` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'شناسه کاربر',
  `Action` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'عمل انجام شده',
  `IPAddress` bigint(20) DEFAULT NULL COMMENT 'آدرس IP',
  PRIMARY KEY (`RecId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='اطلاعات حسابرسی سیستم' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
