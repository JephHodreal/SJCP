-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 09:22 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_church`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement_details`
--

CREATE TABLE `announcement_details` (
  `post_id` int(11) NOT NULL,
  `announce_image` varchar(255) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement_details`
--

INSERT INTO `announcement_details` (`post_id`, `announce_image`, `event_name`, `event_date`, `event_time`, `description`) VALUES
(1, 'ramos.jpg', 'Araw ng kapanganakan ni Jesus', '2023-12-25', '15:07:59', ' LAST NA '),
(2, 'ramos.jpg', 'Sabay sabay na salubungin ang Bagong Taon', '2023-12-31', '14:41:20', ' Happy New Year ');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_details`
--

CREATE TABLE `appointment_details` (
  `appointment_id` int(40) NOT NULL,
  `referenceNum` varchar(13) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(60) NOT NULL,
  `date_appointed` date NOT NULL,
  `time_appointed` time NOT NULL,
  `event_date` date NOT NULL,
  `event_timeStart` time NOT NULL,
  `event_timeEnd` time NOT NULL,
  `appointment_type` varchar(30) NOT NULL,
  `appointment_status` varchar(15) NOT NULL,
  `reason` varchar(300) NOT NULL,
  `recorded` text NOT NULL DEFAULT '\'No\''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_details`
--

INSERT INTO `appointment_details` (`appointment_id`, `referenceNum`, `name`, `email`, `date_appointed`, `time_appointed`, `event_date`, `event_timeStart`, `event_timeEnd`, `appointment_type`, `appointment_status`, `reason`, `recorded`) VALUES
(470, 'SJCP63120957', 'sampleWEDDING', 'sampleWEDDING@yahoo.com', '2024-01-04', '03:38:48', '2024-02-10', '09:00:00', '10:15:00', 'Wedding', 'Pending', '', 'no'),
(471, 'SJCP84362159', 'sampleiNTENTIN', 'sampleINTENTION@yahoo.com', '2024-01-04', '03:39:41', '2024-02-10', '06:00:00', '00:00:00', 'Mass Intention', 'Pending', '', 'no'),
(472, 'SJCP49613780', 'sampleBAPTISM', 'sampleBAPTISM@yahoo.com', '2024-01-04', '03:44:53', '2024-02-10', '15:00:00', '15:45:00', 'Baptism', 'Pending', '', 'no'),
(473, 'SJCP43062179', 'sampleFUNERAL', 'sampleFUNERAL@yahoo.com', '2024-01-04', '03:52:37', '2024-02-10', '13:00:00', '00:00:00', 'Funeral Mass/Blessing', 'Pending', '', 'no'),
(474, 'SJCP31420758', 'sample2', 'sample2@yahoo.com', '2024-01-04', '03:56:35', '2024-03-10', '00:00:00', '00:00:00', 'House Blessing', 'Pending', '', 'no'),
(475, 'SJCP91475028', 'sample2', 'sample2@yahoo.com', '2024-01-04', '03:57:36', '2024-04-23', '00:00:00', '00:00:00', 'Car Blessing', 'Pending', '', 'no'),
(476, 'SJCP84075213', 'sample2', 'sample2@yahoo.com', '2024-01-04', '03:58:08', '2024-03-17', '00:00:00', '00:00:00', 'Motorcycle Blessing', 'Pending', '', 'no'),
(477, 'SJCP06795142', 'sample2', 'sample2@yahoo.com', '2024-01-04', '03:59:10', '2024-03-19', '00:00:00', '00:00:00', 'Store Blessing', 'Pending', '', 'no'),
(478, 'SJCP69034581', 'sampleDOCUMENT', 'sampleDOCUMENT@yahoo.com', '2024-01-04', '04:01:16', '2024-04-05', '00:00:00', '00:00:00', 'Baptismal Certificate', 'Pending', '', 'no'),
(479, 'SJCP67185943', 'sampleDOCUMENT', 'sampleDOCUMENT@yahoo.com', '2024-01-04', '04:05:15', '2024-04-10', '00:00:00', '00:00:00', 'Wedding Certificate', 'Pending', '', 'no'),
(480, 'SJCP25417380', 'sampleDOCUMENT', 'sampleDOCUMENT@yahoo.com', '2024-01-04', '04:07:57', '2024-02-14', '00:00:00', '00:00:00', 'Confirmation Certificate', 'Pending', '', 'no'),
(481, 'SJCP59061832', 'sampleDOCUMENT', 'sampleDOCUMENT@yahoo.com', '2024-01-04', '04:10:11', '2024-04-19', '00:00:00', '00:00:00', 'Good Moral Certificate', 'Pending', '', 'no'),
(482, 'SJCP31759406', 'sampleDOCUMENT', 'sampleDOCUMENT@yahoo.com', '2024-01-04', '04:13:53', '2024-03-16', '00:00:00', '00:00:00', 'Permit and No Record', 'Pending', '', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `baptism_details`
--

CREATE TABLE `baptism_details` (
  `baptism_id` int(40) NOT NULL,
  `foreign_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_timeStart` time NOT NULL,
  `event_timeEnd` time NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `midName` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(120) NOT NULL,
  `address` varchar(120) NOT NULL,
  `contNum` varchar(13) NOT NULL,
  `fatherName` varchar(100) NOT NULL,
  `fatherPob` varchar(120) NOT NULL,
  `motherName` varchar(100) NOT NULL,
  `motherPob` varchar(120) NOT NULL,
  `marriage_type` varchar(40) NOT NULL,
  `godfathName` varchar(100) NOT NULL,
  `godfathAddress` varchar(120) NOT NULL,
  `godmothName` varchar(100) NOT NULL,
  `godmothAddress` varchar(120) NOT NULL,
  `bapPsa` varchar(50) NOT NULL,
  `bapContract` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `baptism_details`
--

INSERT INTO `baptism_details` (`baptism_id`, `foreign_id`, `event_date`, `event_timeStart`, `event_timeEnd`, `lastName`, `firstName`, `midName`, `gender`, `dob`, `pob`, `address`, `contNum`, `fatherName`, `fatherPob`, `motherName`, `motherPob`, `marriage_type`, `godfathName`, `godfathAddress`, `godmothName`, `godmothAddress`, `bapPsa`, `bapContract`) VALUES
(88, 472, '2024-02-10', '15:00:00', '15:45:00', 'Beckham', 'Louise', 'Manson', 'Male', '1988-08-19', 'Cavite', 'Diego Silang Brgy. Ususan, Taguig City', '9452357278', 'Gary Beckham', 'Batangas City', 'Fiona Beckham', 'Makati City', 'Catholic Marriage', 'Charlie Monroe', 'Taguig City', 'Vickie Robinsons', 'Makati City', 'POPUP_ APPOINTMENT LIST-CANCELED.png', 'POPUP_ APPOINTMENT LIST-CANCELED.png');

-- --------------------------------------------------------

--
-- Table structure for table `blessing_details`
--

CREATE TABLE `blessing_details` (
  `blessing_id` int(40) NOT NULL,
  `foreign_id` varchar(11) NOT NULL,
  `contact_num` varchar(13) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `blessing_type` varchar(20) NOT NULL,
  `address` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blessing_details`
--

INSERT INTO `blessing_details` (`blessing_id`, `foreign_id`, `contact_num`, `event_date`, `event_time`, `blessing_type`, `address`) VALUES
(82, '474', '9465789224', '2024-03-10', '00:00:00', 'House Blessing', ''),
(83, '475', '9565785734', '2024-04-23', '00:00:00', 'Car Blessing', ''),
(84, '476', '9363782472', '2024-03-17', '00:00:00', 'Motorcycle Blessing', ''),
(85, '477', '9357385748', '2024-03-19', '00:00:00', 'Store Blessing', '13 Atis St. Brgy. PInagsama, Taguig City');

-- --------------------------------------------------------

--
-- Table structure for table `document_request_details`
--

CREATE TABLE `document_request_details` (
  `docreq_id` int(40) NOT NULL,
  `foreign_id` int(11) NOT NULL,
  `claim_date` date NOT NULL,
  `documentType` varchar(50) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `middleName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `dob` date NOT NULL,
  `fatherName` varchar(100) NOT NULL,
  `motherName` varchar(100) NOT NULL,
  `contactNum` varchar(13) NOT NULL,
  `purpose` varchar(120) NOT NULL,
  `address` varchar(150) NOT NULL,
  `birthcert` varchar(50) NOT NULL,
  `barangaycert` varchar(50) NOT NULL,
  `kawancert` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document_request_details`
--

INSERT INTO `document_request_details` (`docreq_id`, `foreign_id`, `claim_date`, `documentType`, `firstName`, `middleName`, `lastName`, `dob`, `fatherName`, `motherName`, `contactNum`, `purpose`, `address`, `birthcert`, `barangaycert`, `kawancert`) VALUES
(74, 478, '2024-04-05', 'Baptismal Certificate', 'Aaronn', '', 'Paredes', '2019-09-13', 'Alden Paredes', 'Debie Paredes', '9343548674', 'School requirement', '', 'POPUP_ APPOINTMENT LIST-CANCELED.png', '', ''),
(75, 479, '2024-04-10', 'Wedding Certificate', 'Josephine', 'Santos', 'Abad', '1978-07-23', 'Nathaniel Abad', 'Cristina Abad', '9568453767', 'Wedding Requirement', '', 'APPOINTMENT LIST_ACCEPTED_CONFIRMCANCEL.png', '', ''),
(76, 480, '2024-02-14', 'Confirmation Certificate', 'Roger', 'Aguinaldo', 'Abalos', '1983-06-17', 'Arturo Abalos', 'Annalyn Abalos', '9567837348', 'Wedding Requirement', '', 'POPUP_ APPOINTMENT LIST-CANCELED.png', '', ''),
(77, 481, '2024-04-19', 'Good Moral Certificate', 'Althea', 'Agustin', 'Batumbakal', '1991-08-08', '', '', '9473584758', 'Board Exam Requirement', '', 'POPUP_ APPOINTMENT LIST-CANCELED.png', 'MIDFI-POPUP_ APPOINTMENT LIST-CANCEL2.png', 'MIDFI-POPUP_ APPOINTMENT LIST-CANCEL2.png'),
(78, 482, '2024-03-16', 'Permit and No Record', 'Mary Joy', 'Canosa', 'Bautista', '1994-01-09', '', '', '9856643446', 'Baptism at another church', '289 Aguirre Avenue, B.F. Homes, Makati City', 'POPUP_ APPOINTMENT LIST-CANCELED.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `funeral_details`
--

CREATE TABLE `funeral_details` (
  `funeral_id` int(40) NOT NULL,
  `foreign_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_timeStart` time NOT NULL,
  `event_timeEnd` time NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `middleName` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `deathDate` date NOT NULL,
  `age` int(11) NOT NULL,
  `deathCause` varchar(120) NOT NULL,
  `internmentDate` date NOT NULL,
  `cemeteryPlace` varchar(120) NOT NULL,
  `informLast` varchar(40) NOT NULL,
  `informFirst` varchar(40) NOT NULL,
  `informMid` varchar(40) NOT NULL,
  `contNum` varchar(13) NOT NULL,
  `address` varchar(120) NOT NULL,
  `sacrament` varchar(3) NOT NULL,
  `burial` varchar(6) NOT NULL,
  `deathCert` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `funeral_details`
--

INSERT INTO `funeral_details` (`funeral_id`, `foreign_id`, `event_date`, `event_timeStart`, `event_timeEnd`, `lastName`, `firstName`, `middleName`, `gender`, `deathDate`, `age`, `deathCause`, `internmentDate`, `cemeteryPlace`, `informLast`, `informFirst`, `informMid`, `contNum`, `address`, `sacrament`, `burial`, `deathCert`) VALUES
(71, 473, '2024-02-10', '13:00:00', '00:00:00', 'White', 'Robert', '', 'Male', '2024-01-03', 54, 'Heart desease', '2024-02-03', 'Manila American Cemetery and Memorial', 'Swift', 'Taylor', '', '9994217590', 'Taguig City', 'Yes', 'Casket', 'POPUP_ APPOINTMENT LIST-CANCELED.png');

-- --------------------------------------------------------

--
-- Table structure for table `login_admininfo`
--

CREATE TABLE `login_admininfo` (
  `adminid` int(3) NOT NULL,
  `adminUsern` varchar(60) NOT NULL,
  `adminPass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_admininfo`
--

INSERT INTO `login_admininfo` (`adminid`, `adminUsern`, `adminPass`) VALUES
(1, 'adminUsername1', 'd1d6056aefda8b65792b33dd2c5f27163de596f37203fa6f9968d375326ccd55'),
(2, 'adminUsername2', '62b04c371146a1bde051fc7db82e0af4b3b36968e262c63ef655c6201be0a83e'),
(3, 'adminUsername3', '72373bc765921fa4f0c6789a81e9ad3270142fb8d732135c7994913cc075c019'),
(4, 'adminUsername4', '6ad8a81a1ef44a3ceae4630fd013719219b5d35b832bc0f5d28885cb64e82b59'),
(5, 'adminUsername5', '719d70bbc336aa7135b71bff8c5574b3579f2251c2b3fe1a8286c80bffed2a61');

-- --------------------------------------------------------

--
-- Table structure for table `login_userinfo`
--

CREATE TABLE `login_userinfo` (
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contactNum` varchar(13) NOT NULL,
  `user_password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_userinfo`
--

INSERT INTO `login_userinfo` (`firstName`, `lastName`, `email`, `contactNum`, `user_password`) VALUES
('Gentle', 'Woman', 'gentlewoman@gmail.com', '09950580869', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
('Jelika ', 'Palad', 'jelikapalad@gmail.com', '+630995058086', '936a185caaa266bb9cbe981e9e05cb78cd732b0b3280eb944412bb6f8f8f07af'),
('Mary Niel', 'Ma-apni', 'kagaminerin693@gmail.com', '+639994217590', 'ac55f97bfad9000ad5d26f338f3e789ed03e0ac106c3bbd280b688b68dacfd13');

-- --------------------------------------------------------

--
-- Table structure for table `mass_intention_details`
--

CREATE TABLE `mass_intention_details` (
  `intention_id` int(40) NOT NULL,
  `foreign_id` int(11) NOT NULL,
  `contactNum` varchar(13) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `purpose` varchar(120) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mass_intention_details`
--

INSERT INTO `mass_intention_details` (`intention_id`, `foreign_id`, `contactNum`, `event_date`, `event_time`, `purpose`, `name`) VALUES
(75, 471, '9999999999', '2024-02-10', '06:00:00', 'Thanksgiving', 'Mary niel Ma-apni');

-- --------------------------------------------------------

--
-- Table structure for table `record_baptism_details`
--

CREATE TABLE `record_baptism_details` (
  `baptism_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `middleName` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(120) NOT NULL,
  `address` varchar(120) NOT NULL,
  `contactNum` varchar(13) NOT NULL,
  `fatherName` varchar(100) NOT NULL,
  `father_pob` varchar(120) NOT NULL,
  `motherName` varchar(100) NOT NULL,
  `mother_pob` varchar(120) NOT NULL,
  `marriage_type` varchar(40) NOT NULL,
  `godfatherName` varchar(100) NOT NULL,
  `godfather_address` varchar(120) NOT NULL,
  `godmotherName` varchar(100) NOT NULL,
  `godmother_address` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_baptism_details`
--

INSERT INTO `record_baptism_details` (`baptism_id`, `event_date`, `event_time`, `lastName`, `firstName`, `middleName`, `gender`, `dob`, `pob`, `address`, `contactNum`, `fatherName`, `father_pob`, `motherName`, `mother_pob`, `marriage_type`, `godfatherName`, `godfather_address`, `godmotherName`, `godmother_address`) VALUES
(1, '2024-01-25', '10:00:00', 'Chavez', 'Keann', '', 'Male', '2011-07-17', 'Taguig City', ' Sedcco Building Prada Corner Legazpi Street Legazpi Village 1200, Makati City', '9123456789', 'Alden Chavez', 'Quezon City', 'Debbie Chavez', 'Muntinlupa City', 'Catholic Marriage', 'Dexter Santos', 'Taguig City', 'Anna Roxas', 'Makati City'),
(2, '2024-02-08', '11:00:00', 'Del Rosario', 'Althea', 'Dimaapi', 'Female', '2021-03-05', 'Makati City', ' 14-D The World Center, 330 Sen Gil Puyat Avenue, Makati City', '9478454645', 'Jacob Del Rosario', 'Quezon City', 'Theresa Del Rosario', 'Las Pinas City', 'Catholic Marriage', 'John Mark Enriquez', 'Quezon City', 'Veronica Antonio', 'Makati CIty'),
(3, '2024-02-12', '09:00:00', 'Magno', 'Lovely', 'Fernandez', 'Female', '2022-02-10', 'Paranaque City', '2257 Pasong Tamo, Makati City', '9745672567', 'Rommel Magno', 'Makati City', 'Jasmine Magno', 'Batangas City', 'Civil Marriage', 'Angelo Rosales', 'Taguig City', 'Angelica Santos', 'Makati City');

-- --------------------------------------------------------

--
-- Table structure for table `record_confirmation_details`
--

CREATE TABLE `record_confirmation_details` (
  `confirmation_id` int(11) NOT NULL,
  `confirmation_date` date NOT NULL,
  `confirmation_time` time NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `middleName` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(120) NOT NULL,
  `placeof_baptism` varchar(120) NOT NULL,
  `dateof_baptism` date NOT NULL,
  `fatherName` varchar(100) NOT NULL,
  `motherName` varchar(100) NOT NULL,
  `contactNum` varchar(13) NOT NULL,
  `address` varchar(120) NOT NULL,
  `godfatherName` varchar(100) NOT NULL,
  `godmotherName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_confirmation_details`
--

INSERT INTO `record_confirmation_details` (`confirmation_id`, `confirmation_date`, `confirmation_time`, `lastName`, `firstName`, `middleName`, `gender`, `dob`, `pob`, `placeof_baptism`, `dateof_baptism`, `fatherName`, `motherName`, `contactNum`, `address`, `godfatherName`, `godmotherName`) VALUES
(4, '2024-01-20', '11:00:00', 'Ilagan', 'Alex', 'Fernandez', 'Male', '2000-01-21', 'Laguna', 'La Paz, Makati City', '2001-02-10', 'Alejandro Ilagan', 'Dolores Ilagan', '9563568356', 'Greenbelt 3, Esperanza Street, Ayala Center, Makati City', 'Alan Ramos', 'Monique Burilla'),
(5, '2021-03-05', '09:00:00', 'Abad', 'Hazel Joy', 'Mendoza', 'Female', '1988-03-02', 'Batangas City', 'Makati City', '2000-09-19', 'Raul Abad', 'Ma. Theresa Abad', '9456785658', '1180 Vito Cruz Extension, Makati City', 'Albert San Jose', 'Sarah Geronimo'),
(6, '2019-09-12', '09:00:00', 'Perez', 'Andrei', 'Mendoza', 'Male', '1999-03-02', 'Taguig City', 'Taguig City', '1999-09-19', 'Jason Perez', 'Gloria Perez', '9456785658', '2482 Alexander Street, San Isidro, Makati City', 'Antonio Cruz', 'Maribel Delos reyes');

-- --------------------------------------------------------

--
-- Table structure for table `record_funeral_details`
--

CREATE TABLE `record_funeral_details` (
  `funeral_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `middleName` varchar(40) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date_of_death` date NOT NULL,
  `age` int(3) NOT NULL,
  `cause_of_death` varchar(120) NOT NULL,
  `date_of_interment` date NOT NULL,
  `place_of_cemetery` varchar(120) NOT NULL,
  `informLast` varchar(40) NOT NULL,
  `informFirst` varchar(40) NOT NULL,
  `informMid` varchar(40) NOT NULL,
  `contactNum` varchar(13) NOT NULL,
  `address` varchar(100) NOT NULL,
  `sacrament` varchar(3) NOT NULL,
  `burial` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_funeral_details`
--

INSERT INTO `record_funeral_details` (`funeral_id`, `event_date`, `event_time`, `lastName`, `firstName`, `middleName`, `gender`, `date_of_death`, `age`, `cause_of_death`, `date_of_interment`, `place_of_cemetery`, `informLast`, `informFirst`, `informMid`, `contactNum`, `address`, `sacrament`, `burial`) VALUES
(7, '2024-01-10', '08:00:00', 'Reyes', 'Gabriel', 'Santos', 'Male', '2024-01-01', 40, 'Diabetes mellitus', '2024-01-03', 'Manila South Cemetery', 'Salazar', 'Bettina', 'Salvador', '9456785658', '11/F Ayala Life-Fgu Center 6811 Ayala Avenue 1200, Makati City', 'Yes', 'Casket'),
(8, '2024-01-15', '08:00:00', 'Perez', 'Faye', 'Suarez', 'Female', '2024-01-05', 35, 'Chronic lower respiratory diseases', '2024-01-05', 'Makati Catholic Cemetery', 'Perez', 'Gloria', 'Suarez', '9456785658', '1 Carlos Drive Corner 2nd Avenue, Taguig City', 'Yes', 'Urn'),
(9, '2024-01-21', '13:00:00', 'Tolentino', 'Andrea', 'Dimaapi', 'Female', '2024-01-12', 39, 'Malignant Neoplasms', '2024-01-18', 'Makati Catholic Cemetery', 'Trinidad', 'Camille', 'Torres', '9456785658', '340 A. Amang Rodriguez Ave. Manggahan, Pasig City', 'Yes', 'Casket');

-- --------------------------------------------------------

--
-- Table structure for table `record_wedding_details`
--

CREATE TABLE `record_wedding_details` (
  `wedding_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `groom_lastName` varchar(40) NOT NULL,
  `groom_firstName` varchar(40) NOT NULL,
  `groom_middleName` varchar(40) NOT NULL,
  `groom_contactNum` varchar(13) NOT NULL,
  `groom_dob` date NOT NULL,
  `groom_pob` varchar(120) NOT NULL,
  `groom_address` varchar(120) NOT NULL,
  `groom_fatherName` varchar(100) NOT NULL,
  `groom_motherName` varchar(100) NOT NULL,
  `groom_religion` varchar(50) NOT NULL,
  `bride_lastName` varchar(40) NOT NULL,
  `bride_firstName` varchar(40) NOT NULL,
  `bride_middleName` varchar(40) NOT NULL,
  `bride_contactNum` varchar(13) NOT NULL,
  `bride_dob` date NOT NULL,
  `bride_pob` varchar(120) NOT NULL,
  `bride_address` varchar(120) NOT NULL,
  `bride_fatherName` varchar(100) NOT NULL,
  `bride_motherName` varchar(100) NOT NULL,
  `bride_religion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wedding_details`
--

CREATE TABLE `wedding_details` (
  `wedding_id` int(40) NOT NULL,
  `foreign_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_timeStart` time NOT NULL,
  `event_timeEnd` time NOT NULL,
  `groom_lName` varchar(40) NOT NULL,
  `groom_fName` varchar(40) NOT NULL,
  `groom_midName` varchar(40) NOT NULL,
  `groom_conNum` varchar(13) NOT NULL,
  `groom_dob` date NOT NULL,
  `groom_pob` varchar(120) NOT NULL,
  `groom_address` varchar(120) NOT NULL,
  `groom_father` varchar(100) NOT NULL,
  `groom_mother` varchar(100) NOT NULL,
  `groom_religion` varchar(50) NOT NULL,
  `groom_idpic` varchar(50) NOT NULL,
  `groom_psa` varchar(50) NOT NULL,
  `groom_cenomar` varchar(50) NOT NULL,
  `groom_baptism` varchar(50) NOT NULL,
  `groom_confirm` varchar(50) NOT NULL,
  `bride_lName` varchar(40) NOT NULL,
  `bride_fName` varchar(40) NOT NULL,
  `bride_midName` varchar(40) NOT NULL,
  `bride_conNum` varchar(13) NOT NULL,
  `bride_dob` date NOT NULL,
  `bride_pob` varchar(120) NOT NULL,
  `bride_address` varchar(120) NOT NULL,
  `bride_father` varchar(100) NOT NULL,
  `bride_mother` varchar(100) NOT NULL,
  `bride_religion` varchar(50) NOT NULL,
  `bride_idpic` varchar(50) NOT NULL,
  `bride_psa` varchar(50) NOT NULL,
  `bride_cenomar` varchar(50) NOT NULL,
  `bride_baptism` varchar(50) NOT NULL,
  `bride_confirm` varchar(50) NOT NULL,
  `couples_contract` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wedding_details`
--

INSERT INTO `wedding_details` (`wedding_id`, `foreign_id`, `event_date`, `event_timeStart`, `event_timeEnd`, `groom_lName`, `groom_fName`, `groom_midName`, `groom_conNum`, `groom_dob`, `groom_pob`, `groom_address`, `groom_father`, `groom_mother`, `groom_religion`, `groom_idpic`, `groom_psa`, `groom_cenomar`, `groom_baptism`, `groom_confirm`, `bride_lName`, `bride_fName`, `bride_midName`, `bride_conNum`, `bride_dob`, `bride_pob`, `bride_address`, `bride_father`, `bride_mother`, `bride_religion`, `bride_idpic`, `bride_psa`, `bride_cenomar`, `bride_baptism`, `bride_confirm`, `couples_contract`) VALUES
(79, 470, '2024-02-10', '09:00:00', '10:15:00', 'Dela Cruz', 'Juan', 'Tomas', '9994217590', '2000-03-10', 'Taguig City', 'Taguig City', 'Joseph Dela Cruz', 'Maria Tomas', 'Catholic', 'ERD (2).png', 'ERD (2).png', 'ERD (2).png', 'ERD (2).png', 'ERD (2).png', 'San Pedro', 'Juana', 'Agustin', '9452357278', '2000-04-10', 'Taguig City', 'MB 20 unit 202 BCDA pamayanang Diego Silang Brgy. Ususan, Taguig', 'Francis San Pedro', 'Teresa Agustin', 'Iglesia ni Cristo', 'POPUP_ APPOINTMENT LIST-CANCELED.png', 'POPUP_ APPOINTMENT LIST-CANCELED.png', 'POPUP_ APPOINTMENT LIST-CANCELED.png', 'POPUP_ APPOINTMENT LIST-CANCELED.png', 'POPUP_ APPOINTMENT LIST-CANCELED.png', 'POPUP_ APPOINTMENT LIST-CANCELED.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement_details`
--
ALTER TABLE `announcement_details`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `appointment_details`
--
ALTER TABLE `appointment_details`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `baptism_details`
--
ALTER TABLE `baptism_details`
  ADD PRIMARY KEY (`baptism_id`);

--
-- Indexes for table `blessing_details`
--
ALTER TABLE `blessing_details`
  ADD PRIMARY KEY (`blessing_id`);

--
-- Indexes for table `document_request_details`
--
ALTER TABLE `document_request_details`
  ADD PRIMARY KEY (`docreq_id`);

--
-- Indexes for table `funeral_details`
--
ALTER TABLE `funeral_details`
  ADD PRIMARY KEY (`funeral_id`);

--
-- Indexes for table `login_admininfo`
--
ALTER TABLE `login_admininfo`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `login_userinfo`
--
ALTER TABLE `login_userinfo`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `mass_intention_details`
--
ALTER TABLE `mass_intention_details`
  ADD PRIMARY KEY (`intention_id`);

--
-- Indexes for table `record_baptism_details`
--
ALTER TABLE `record_baptism_details`
  ADD PRIMARY KEY (`baptism_id`);

--
-- Indexes for table `record_confirmation_details`
--
ALTER TABLE `record_confirmation_details`
  ADD PRIMARY KEY (`confirmation_id`);

--
-- Indexes for table `record_funeral_details`
--
ALTER TABLE `record_funeral_details`
  ADD PRIMARY KEY (`funeral_id`);

--
-- Indexes for table `record_wedding_details`
--
ALTER TABLE `record_wedding_details`
  ADD PRIMARY KEY (`wedding_id`);

--
-- Indexes for table `wedding_details`
--
ALTER TABLE `wedding_details`
  ADD PRIMARY KEY (`wedding_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement_details`
--
ALTER TABLE `announcement_details`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment_details`
--
ALTER TABLE `appointment_details`
  MODIFY `appointment_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;

--
-- AUTO_INCREMENT for table `baptism_details`
--
ALTER TABLE `baptism_details`
  MODIFY `baptism_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `blessing_details`
--
ALTER TABLE `blessing_details`
  MODIFY `blessing_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `document_request_details`
--
ALTER TABLE `document_request_details`
  MODIFY `docreq_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `funeral_details`
--
ALTER TABLE `funeral_details`
  MODIFY `funeral_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `login_admininfo`
--
ALTER TABLE `login_admininfo`
  MODIFY `adminid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mass_intention_details`
--
ALTER TABLE `mass_intention_details`
  MODIFY `intention_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `record_baptism_details`
--
ALTER TABLE `record_baptism_details`
  MODIFY `baptism_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `record_confirmation_details`
--
ALTER TABLE `record_confirmation_details`
  MODIFY `confirmation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `record_funeral_details`
--
ALTER TABLE `record_funeral_details`
  MODIFY `funeral_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `record_wedding_details`
--
ALTER TABLE `record_wedding_details`
  MODIFY `wedding_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wedding_details`
--
ALTER TABLE `wedding_details`
  MODIFY `wedding_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
