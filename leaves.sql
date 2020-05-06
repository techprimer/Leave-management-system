-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 05:46 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leaves`
--

-- --------------------------------------------------------

--
-- Table structure for table `casual_leave`
--

CREATE TABLE `casual_leave` (
  `LEAVE_ID` int(255) NOT NULL,
  `EMP_NO` varchar(255) NOT NULL,
  `type_of_day` varchar(255) NOT NULL,
  `atd_emp_no` varchar(255) NOT NULL,
  `atd_emp_name` varchar(255) NOT NULL,
  `half_day_date` date NOT NULL,
  `permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casual_leave`
--

INSERT INTO `casual_leave` (`LEAVE_ID`, `EMP_NO`, `type_of_day`, `atd_emp_no`, `atd_emp_name`, `half_day_date`, `permission`) VALUES
(169, '13652yash', 'full-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '0000-00-00', 'tetr'),
(170, '13652yash', 'full-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '0000-00-00', 'tetr'),
(171, '13652yash', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-28', 'nikhil'),
(172, '13652yash', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-28', 'nikhil'),
(173, '13652yash', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-28', 'nikhil'),
(174, '13652yash', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-28', 'nikhil'),
(175, '13652yash', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-28', 'nikhil'),
(176, '13652yash', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-28', 'nikhil'),
(177, '13652yash', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-27', 'srtgjrk'),
(178, '13652yash', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-27', 'rstt'),
(179, '13652yash', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-27', 'rstt'),
(180, '101', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-01-29', 'nikhil'),
(211, '101', 'half-day', '123', 'nikhil ss jhakaria - INFORMATION TECHNOLOGY', '2020-01-31', 'nikhil'),
(213, '101', 'full-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '0000-00-00', 'nikhil'),
(214, '101', 'full-day', '', '', '0000-00-00', ''),
(215, '101', 'full-day', '', '', '0000-00-00', ''),
(216, '101', 'full-day', '', '', '0000-00-00', ''),
(217, '101', 'full-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '0000-00-00', ''),
(218, '101', 'full-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '0000-00-00', 'dgfd'),
(222, '101', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-02-12', 'gcdbsjd'),
(228, '101', 'half-day', '101', 'neel s patel - INFORMATION TECHNOLOGY', '2020-02-04', 'ffzgay');

-- --------------------------------------------------------

--
-- Table structure for table `coff`
--

CREATE TABLE `coff` (
  `LEAVE_ID` int(255) NOT NULL,
  `EMP_NO` varchar(255) NOT NULL,
  `type_of_day` varchar(255) NOT NULL,
  `atd_emp_no` varchar(255) NOT NULL,
  `atd_emp_name` varchar(255) NOT NULL,
  `half_day_date` date NOT NULL,
  `permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crdt_leave`
--

CREATE TABLE `crdt_leave` (
  `EMP_NO` varchar(255) NOT NULL,
  `LEAVE_ID` int(11) NOT NULL,
  `credit_date` date NOT NULL,
  `credit_time` varchar(255) NOT NULL,
  `s_time` time NOT NULL,
  `e_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crdt_leave`
--

INSERT INTO `crdt_leave` (`EMP_NO`, `LEAVE_ID`, `credit_date`, `credit_time`, `s_time`, `e_time`) VALUES
('123', 33, '2020-01-14', 'NaN', '09:09:00', '09:09:00'),
('13652yash', 34, '2020-01-13', 'NaN', '09:09:00', '09:09:00'),
('123', 97, '2020-01-16', '4', '09:09:00', '13:30:00'),
('123', 98, '2020-01-16', '3', '09:00:00', '12:00:00'),
('123', 99, '2020-01-16', '1', '09:00:00', '10:00:00'),
('123', 100, '2020-01-16', '2', '09:00:00', '11:00:00'),
('123', 101, '2020-01-16', '1', '09:00:00', '11:00:00'),
('101', 229, '2020-02-04', '2', '09:09:00', '11:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `medical_leave`
--

CREATE TABLE `medical_leave` (
  `EMP_NO` varchar(255) NOT NULL,
  `LEAVE_ID` varchar(255) NOT NULL,
  `certi` varchar(255) NOT NULL,
  `atd_emp_no` varchar(255) NOT NULL,
  `atd_emp_name` varchar(255) NOT NULL,
  `add_ress` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medical_leave`
--

INSERT INTO `medical_leave` (`EMP_NO`, `LEAVE_ID`, `certi`, `atd_emp_no`, `atd_emp_name`, `add_ress`, `file_path`) VALUES
('123', '142', 'Yes', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'dsvdj', ''),
('123', '144', 'Yes', '123', 'nikhil ss jhakaria - INFORMATION TECHNOLOGY', 'sdsf', 'nikhil_23-01-20.pdf'),
('123', '145', 'Yes', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'hhvg', 'nikhil_23-01-20.pdf'),
('13652yash', '146', 'Yes', '123', 'nikhil ss jhakaria - INFORMATION TECHNOLOGY', 'DNJ', 'nikhil_23-01-20.pdf'),
('101', '161', 'No', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'fsgfshdb', ''),
('101', '181', 'Yes', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'vffhbdgf', 'nikhil_23-01-20.pdf'),
('101', '191', 'Yes', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'fhjfj', ''),
('101', '193', 'Yes', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'fhjfj', 'nikhil_23-01-20.pdf'),
('101', '194', 'Yes', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'fhjfj', 'nikhil_23-01-20.pdf'),
('101', '196', 'Yes', '', '', '', 'Array'),
('101', '197', 'Yes', '', '', '', 'nikhil_23-01-20.pdf'),
('101', '198', 'Yes', '', '', '', 'nikhil_23-01-20.pdf'),
('101', '199', 'Yes', '', '', '', 'files/nikhil_23-01-20.pdf1580233189.pdf'),
('101', '200', 'Yes', '', '', '', ''),
('101', '201', 'Yes', '', '', '', ''),
('101', '202', 'Yes', '', '', '', '1'),
('101', '203', 'Yes', '', '', '', 'files/nikhil_23-01-20.pdf'),
('101', '204', 'Yes', '', '', '', 'files/pending work.docx'),
('123', '205', 'Yes', '', '', '', 'nikhil_23-01-20.pdf'),
('123', '206', 'Yes', '', '', '', 'files/nikhil_23-01-20-123-206.pdf'),
('123', '207', 'Yes', '', '', '', 'files/nikhil_23-01-20---123-207.pdf'),
('101', '208', 'Yes', '', '', '', 'files/nikhil_23-01-20---101-208.pdf'),
('101', '210', 'Yes', '', '', '', 'files/nikhil_23-01-20---101-210.pdf'),
('101', '212', 'No', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'vssfg', 'files/---101-212.'),
('13652yash', '219', 'No', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'gfdg', 'files/---13652yash-219.'),
('101', '220', 'No', '101', 'neel s patel - INFORMATION TECHNOLOGY', 'yugug', 'files/---101-220.');

-- --------------------------------------------------------

--
-- Table structure for table `mt_dept_mst`
--

CREATE TABLE `mt_dept_mst` (
  `dept_id` int(255) NOT NULL,
  `dept_nm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_dept_mst`
--

INSERT INTO `mt_dept_mst` (`dept_id`, `dept_nm`) VALUES
(1, 'ADMINISTRATION'),
(2, 'NON-TEACHING'),
(3, 'CONSTRUCTION'),
(4, 'COMPUTER'),
(5, 'ELECTRONICS'),
(6, 'HUMANITIES S.S.'),
(7, 'MECHANICALS'),
(8, 'INFORMATION TECHNOLOGY'),
(9, 'OTHERS'),
(10, 'MATHS'),
(11, 'LIBRARY'),
(12, 'COMMUNICATION SKILLS'),
(13, 'PHYSICS'),
(14, 'CHEMISTRY'),
(15, 'ENGINEERING SCIENCE'),
(16, 'ELECTRONICS & TELECOMMUNICATION');

-- --------------------------------------------------------

--
-- Table structure for table `mt_emp`
--

CREATE TABLE `mt_emp` (
  `EMP_NO` varchar(500) NOT NULL,
  `F_NAME` varchar(500) NOT NULL,
  `M_NAME` varchar(500) NOT NULL,
  `L_NAME` varchar(500) NOT NULL,
  `MOTHER_NAME` varchar(500) NOT NULL,
  `EMP_NM` varchar(500) NOT NULL,
  `EDN_QUALIFICATIONS` varchar(500) NOT NULL,
  `ADDRESS` varchar(500) NOT NULL,
  `PHONE` varchar(500) NOT NULL,
  `MOBILE_NO` varchar(500) NOT NULL,
  `EMAIL_ID` varchar(500) NOT NULL,
  `PASSWORD` varchar(500) NOT NULL,
  `DOB` datetime(6) NOT NULL,
  `PAN_NO` varchar(500) NOT NULL,
  `AADHAR_CARD_NO` varchar(500) NOT NULL,
  `DEPT_ID` int(255) NOT NULL,
  `PAYTP_ID` int(255) NOT NULL,
  `GRADE_ID` int(255) NOT NULL,
  `EMP_TYPE` char(255) NOT NULL,
  `M_F` char(255) NOT NULL,
  `DESIGNATION` varchar(255) NOT NULL,
  `DEPARTMENT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_emp`
--

INSERT INTO `mt_emp` (`EMP_NO`, `F_NAME`, `M_NAME`, `L_NAME`, `MOTHER_NAME`, `EMP_NM`, `EDN_QUALIFICATIONS`, `ADDRESS`, `PHONE`, `MOBILE_NO`, `EMAIL_ID`, `PASSWORD`, `DOB`, `PAN_NO`, `AADHAR_CARD_NO`, `DEPT_ID`, `PAYTP_ID`, `GRADE_ID`, `EMP_TYPE`, `M_F`, `DESIGNATION`, `DEPARTMENT`) VALUES
('101', 'neel', 's', 'patel', 'jagruti', 'neel', 'b.tech', 'ghatkopar', '9998524512', '955622236655', 'nikhil.jakharia@sakec.ac.in', '122', '0000-00-00 00:00:00.000000', '101', '12121212121212', 8, 54, 5, 'g', 'm', 'employee', 'INFORMATION TECHNOLOGY'),
('102', 'yash', 's', 'badra', 'jagruti', 'neel', 'b.tech', 'ghatkopar', '9998524512', '955622236655', 'nikhil.jakharia@sakec.ac.in', '102', '0000-00-00 00:00:00.000000', '102', '12121212121212', 8, 54, 5, 'g', 'm', 'employee', 'COMPUTER'),
('123', 'nikhil', 'ss', 'jhakaria', 'dfj', 'jdsf', 'dfff', 'fdfdf', 'dfdfdf', 'fdfdf', 'nikhil.jakharia@sakec.ac.in', 'sdfdddddd', '0000-00-00 00:00:00.000000', '123hod', 'errrrr', 8, 123, 5, 'G', 'f', 'hod', 'INFORMATION TECHNOLOGY'),
('13652yash', 'yash', 'shankar', 'patel', 'jaguruti', 'yash', 'b.e', 'ghatkopar', '256235654', '9653278585', 'nikhil.jakharia@sakec.ac.in', 'djfhj', '0000-00-00 00:00:00.000000', 'abcd13652', '123456789102', 8, 13652, 5, 'G', 'abc', 'principal', 'INFORMATION TECHNOLOGY');

-- --------------------------------------------------------

--
-- Table structure for table `mt_grade_mst`
--

CREATE TABLE `mt_grade_mst` (
  `ID` int(255) NOT NULL,
  `GRADE_ID` int(255) NOT NULL,
  `DESIGNATION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_grade_mst`
--

INSERT INTO `mt_grade_mst` (`ID`, `GRADE_ID`, `DESIGNATION`) VALUES
(25, 1, 'Lecturer'),
(24, 2, 'Sr. Lecture'),
(25, 3, 'Assistant Professor (V)'),
(26, 4, 'Professor'),
(27, 5, 'Vice Principal	'),
(28, 6, 'Principal(V)'),
(30, 7, 'Lecturer (Sr. Scale)'),
(30, 8, 'Asst. Professor(V)'),
(19, 9, 'Lecturer (Sr. Scale)'),
(22, 10, 'Professor(Adhoc)');

-- --------------------------------------------------------

--
-- Table structure for table `mt_leave`
--

CREATE TABLE `mt_leave` (
  `LEAVE_ID` int(255) NOT NULL,
  `EMP_NO` varchar(255) NOT NULL,
  `L_FROM` date NOT NULL,
  `L_TO` date NOT NULL,
  `NO_OF_DAYS` decimal(65,1) NOT NULL,
  `APPLIED_ON` date NOT NULL,
  `REASON` varchar(255) NOT NULL,
  `L_TYPE` varchar(255) NOT NULL,
  `HOD_APPROVED` varchar(255) NOT NULL,
  `HOD_APPROVED_DATE` datetime(6) NOT NULL,
  `HOD_REMARKS` varchar(255) NOT NULL,
  `HOD_APP_ID` varchar(255) NOT NULL,
  `PRINCIPAL_APPROVED` varchar(255) NOT NULL,
  `PRINCIPAL_APPROVED_DATE` datetime(6) NOT NULL,
  `PRINCIPAL_REMARKS` varchar(255) NOT NULL,
  `PR_APP_ID` varchar(255) NOT NULL,
  `ATD_YR_ID` int(255) NOT NULL,
  `USER_ID` int(255) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `Cancel_Flg` char(255) NOT NULL,
  `TRN_DATE` datetime(6) NOT NULL,
  `FN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_leave`
--

INSERT INTO `mt_leave` (`LEAVE_ID`, `EMP_NO`, `L_FROM`, `L_TO`, `NO_OF_DAYS`, `APPLIED_ON`, `REASON`, `L_TYPE`, `HOD_APPROVED`, `HOD_APPROVED_DATE`, `HOD_REMARKS`, `HOD_APP_ID`, `PRINCIPAL_APPROVED`, `PRINCIPAL_APPROVED_DATE`, `PRINCIPAL_REMARKS`, `PR_APP_ID`, `ATD_YR_ID`, `USER_ID`, `Remarks`, `Cancel_Flg`, `TRN_DATE`, `FN`) VALUES
(224, '101', '0000-00-00', '0000-00-00', '0.0', '2020-02-01', 'xvzmsdf', 'outside official work', 'Pending', '0000-00-00 00:00:00.000000', '', '', 'Pending', '0000-00-00 00:00:00.000000', '', '', 0, 0, 'hsdbgjg', '', '0000-00-00 00:00:00.000000', ''),
(225, '101', '0000-00-00', '0000-00-00', '0.0', '2020-02-01', 'dsfvvjdvh', 'outside official work', 'Pending', '0000-00-00 00:00:00.000000', '', '', 'Pending', '0000-00-00 00:00:00.000000', '', '', 0, 0, 'dfgjfsd', '', '0000-00-00 00:00:00.000000', ''),
(226, '101', '0000-00-00', '0000-00-00', '0.0', '2020-02-01', 'dsfvvjdvh', 'outside official work', 'Pending', '0000-00-00 00:00:00.000000', '', '', 'Pending', '0000-00-00 00:00:00.000000', '', '', 0, 0, 'dfgjfsd', '', '0000-00-00 00:00:00.000000', ''),
(227, '101', '2020-02-19', '2020-02-19', '1.0', '2020-02-01', 'jdfgsf', 'outside official work', 'Approved', '2020-02-02 00:00:00.000000', '', '101', 'Approved', '2020-02-02 00:00:00.000000', '', '101', 0, 0, 'gfsjf', '', '0000-00-00 00:00:00.000000', ''),
(228, '101', '2020-02-04', '2020-02-05', '1.5', '2020-02-02', 'not feeling well', 'lwp', 'Approved', '2020-02-02 00:00:00.000000', '', '101', 'Approved', '2020-02-02 00:00:00.000000', '', '101', 0, 0, '', '', '0000-00-00 00:00:00.000000', 'half-day'),
(229, '101', '2020-02-04', '2020-02-04', '2.0', '2020-02-02', 'hgnldgj', 'credit work', 'Approved', '2020-02-02 00:00:00.000000', '', '123', 'Approved', '2020-02-02 00:00:00.000000', '', '123', 0, 0, '', '', '0000-00-00 00:00:00.000000', '');

-- --------------------------------------------------------

--
-- Table structure for table `other_than_casual`
--

CREATE TABLE `other_than_casual` (
  `EMP_NO` varchar(500) NOT NULL,
  `LEAVE_ID` int(225) NOT NULL,
  `probation` varchar(255) NOT NULL,
  `el_from` date NOT NULL,
  `el_to` date NOT NULL,
  `hp_from` date NOT NULL,
  `hp_to` date NOT NULL,
  `eo_from` date NOT NULL,
  `eo_to` date NOT NULL,
  `add_ress` varchar(255) NOT NULL,
  `atd_emp_no` varchar(11) NOT NULL,
  `atd_emp_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `other_than_casual`
--

INSERT INTO `other_than_casual` (`EMP_NO`, `LEAVE_ID`, `probation`, `el_from`, `el_to`, `hp_from`, `hp_to`, `eo_from`, `eo_to`, `add_ress`, `atd_emp_no`, `atd_emp_name`) VALUES
('13652yash', 136, 'G', '2020-01-09', '2020-01-10', '2020-01-09', '2020-01-10', '2020-01-09', '2020-01-10', 'aksdjbf', '123', 'nikhil');

-- --------------------------------------------------------

--
-- Table structure for table `outside_official_work`
--

CREATE TABLE `outside_official_work` (
  `EMP_NO` varchar(500) NOT NULL,
  `LEAVE_ID` int(255) NOT NULL,
  `DATE_1` date NOT NULL,
  `TIME_1` time(6) NOT NULL,
  `VENUE_1` varchar(500) NOT NULL,
  `TYPE_OF_WORK` varchar(500) NOT NULL,
  `DETAILS_OF_WORK` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outside_official_work`
--

INSERT INTO `outside_official_work` (`EMP_NO`, `LEAVE_ID`, `DATE_1`, `TIME_1`, `VENUE_1`, `TYPE_OF_WORK`, `DETAILS_OF_WORK`) VALUES
('123', 11, '2020-01-30', '09:09:00.000000', 'earw', 'e3rw3', ' wrtwe45r'),
('123', 12, '2020-01-30', '09:09:00.000000', 'earw', 'e3rw3', ' wrtwe45r'),
('123', 13, '2020-01-29', '09:09:00.000000', 'aerwae', 'sdtrs', ' etswyt'),
('13652yash', 14, '2020-01-17', '09:09:00.000000', 'efsdg', 'etg', ' rdsg'),
('123', 28, '2020-01-13', '09:09:00.000000', 'ftgdxg', 'sdgsdr', ''),
('123', 28, '2020-01-14', '00:00:00.000000', 'fgf', 'fdxhg', ''),
('101', 221, '2020-02-03', '09:09:00.000000', 'sdjgsj', 'cas', ''),
('101', 223, '2020-02-11', '09:09:00.000000', 'dgxgfgc', 'xdfg', ''),
('101', 224, '2020-02-11', '09:09:00.000000', 'dgxgfgc', 'xdfg', ''),
('101', 225, '2020-02-11', '09:09:00.000000', 'hjffsfs', 'dsfsf', ''),
('101', 226, '2020-02-11', '09:09:00.000000', 'hjffsfs', 'dsfsf', 'dsfvvjdvh'),
('101', 227, '2020-02-19', '09:09:00.000000', 'sdfg', 'jgcadfd', 'jdfgsf');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `skill` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill`, `status`) VALUES
(1, 'javascript', 0),
(2, 'js', 0),
(3, 'jquery', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`) VALUES
(2, 'nj', 'nikhil', 'ffkjasfogfshfo'),
(3, 'hp', 'harsh', 'ffkdfdsadhkb'),
(3, 'rs', 'rajveer', 'ffkjasksdfogfshfo');

-- --------------------------------------------------------

--
-- Table structure for table `vacation`
--

CREATE TABLE `vacation` (
  `EMP_NO` varchar(500) NOT NULL,
  `vsn1 from` date NOT NULL,
  `vsn1 to` date NOT NULL,
  `vsn2 from` date NOT NULL,
  `vsn2 to` date NOT NULL,
  `vsn3 from` date NOT NULL,
  `vsn3 to` date NOT NULL,
  `LEAVE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mt_dept_mst`
--
ALTER TABLE `mt_dept_mst`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `mt_emp`
--
ALTER TABLE `mt_emp`
  ADD PRIMARY KEY (`EMP_NO`);

--
-- Indexes for table `mt_grade_mst`
--
ALTER TABLE `mt_grade_mst`
  ADD PRIMARY KEY (`GRADE_ID`);

--
-- Indexes for table `mt_leave`
--
ALTER TABLE `mt_leave`
  ADD PRIMARY KEY (`LEAVE_ID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mt_leave`
--
ALTER TABLE `mt_leave`
  MODIFY `LEAVE_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
