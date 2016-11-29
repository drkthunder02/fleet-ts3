/**
 * Author:  Chris Mancuso
 * Created: December 2016
 */

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fleet-ts3`
--

-- --------------------------------------------------------

--
-- Table structure for table `Configuration`
--

CREATE TABLE IF NOT EXISTS `TS3Configuration` (
    `ts3_server` varchar(100) NOT NULL,
    `ts3_username` varchar(100) NOT NULL,
    `ts3_password` varchar(100) NOT NULL,
    `ts3_port` varchar(10) NOT NULL,
    `ts3_address` varchar(250) NOT NULL,
    `ts3_sq_port` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for `CrestConfiguration` (This store server info and not CrestVariables needed in other functions)
--

CREATE TABLE IF NOT EXISTS `CrestConfiguration` (
    `clientid` varchar(100) NOT NULL,
    `secret` varchar(100) NOT NULL,
    `callback_url` varchar(250) NOT NULL,
    `useragent` varchar(250) NOT NULL,
    `redirect_uri` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for `CrestVariables`
--

CREATE TABLE IF NOT EXISTS `CrestVariables` (
    `FleetID` int(11) NOT NULL,
    `AuthToken` varchar(250) NOT NULL,
    `AuthTokenExpiry` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `Fleet`
--

CREATE TABLE IF NOT EXISTS `Fleet` (
    `FleetID` int(11) NOT NULL,
    `FleetName` varchar(250) NOT NULL,
    `TS3ChannelName` varchar(200) NOT NULL,
    `TS3ChannelID` varchar(10) NOT NULL,
    `FleetBoss` varchar(250) NOT NULL,
    `FleetActive` tinyint (1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `FleetMembers`
--

CREATE TABLE IF NOT EXISTS `FleetMembers` (
    `Character` varchar(100) NOT NULL,
    `FleetRole` int(1) NOT NULL,
    `TS3Role` int(3) DEFAULT NULL,
    `TS3UniqueID` varchar(100) DEFAULT NULL,
    `FleetID` int(11) NOT NULL,
    PRIMARY KEY (`Character`),
    UNIQUE KEY `Character` (`Character`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Table structure for table `TS3Roles`
--

CREATE TABLE IF NOT EXISTS `TS3Roles` (
    `index` int(11) NOT NULL AUTO_INCREMENT,
    `RoleName` varchar(50) NOT NULL,
    `RoleNumber` int(3) NOT NULL,
    PRIMARY KEY (`index`),
    UNIQUE KEY `index` (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `TS3Channels`
--

CREATE TABLE IF NOT EXISTS `TS3Channels` (
    `index` int(11) NOT NULL AUTO_INCREMENT,
    `ChannelID` int(5) NOT NULL,
    `ChannelName` varchar(50) NOT NULL,
    PRIMARY KEY (`index`),
    UNIQUE KEY `index` (`index`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;