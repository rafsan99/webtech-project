-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2020 at 10:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online school management system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pass`) VALUES
(1, 'afid', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `book_id` int(255) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`book_id`, `book_name`, `book_status`) VALUES
(6, 'Intro to Chemistry', 'NotAvailable'),
(8, 'Intro to Physics', 'available'),
(9, 'Intro to Bangla', 'available'),
(10, 'Intro to English', 'NotAvailable'),
(11, 'Intro to Math', 'NotAvailable');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `sub_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `t_id` int(10) NOT NULL,
  `timing` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`sub_id`, `title`, `description`, `t_id`, `timing`) VALUES
(23, 'Az', 'Az', 1, '2020-05-11 08:35:41'),
(23, 'Lab Work', 'Lab Exam in Next Sunday!!', 1, '2020-05-11 08:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE `routine` (
  `sub_id` int(255) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `start_day` varchar(255) NOT NULL,
  `end_day` varchar(255) NOT NULL,
  `timing` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `t_id` int(255) NOT NULL,
  `t_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`sub_id`, `sub_name`, `start_day`, `end_day`, `timing`, `class`, `t_id`, `t_name`) VALUES
(7, 'Math', 'Saturday', 'Thursday', '10:00-11:00AM', '6', 22, 'Abul Kalam'),
(12, 'Biology', 'Saturday', 'Thursday', '11:00-12:00PM', '7', 1, 'Azwad'),
(16, 'Math', 'Saturday', 'Thursday', '9:00-10:00AM', '8', 1, 'Afid Azwad'),
(17, 'chemistry', 'Saturday', 'Thursday', '2:00-3:00PM', '6', 2, 'Azwad'),
(18, 'chemistry', 'Saturday', 'Thursday', '12:00-1:00PM', '9', 2, 'Azwad'),
(19, 'Math', 'Saturday', 'Thursday', '1:00-2:00PM', '7', 2, 'Azwad'),
(21, 'Math', 'Saturday', 'Thursday', '11:00-12:00PM', '10', 1, 'Afid Azwad'),
(25, 'chemistry', 'Saturday', 'Thursday', '1:00-2:00PM', '10', 22, 'Abul Kalam'),
(29, 'Biology', 'Saturday', 'Thursday', '9:00-10:00AM', '10', 22, 'Abul Kalam');

-- --------------------------------------------------------

--
-- Table structure for table `school_notice`
--

CREATE TABLE `school_notice` (
  `notice_id` int(255) NOT NULL,
  `notice_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_notice`
--

INSERT INTO `school_notice` (`notice_id`, `notice_title`, `description`, `datetime`) VALUES
(7, 'ACCOUNTS CLEARANCE', 'If any student has due balance at the accounts and is willing to clear their dues, they can complete their payment at any branch of the Dhaka Bank Ltd. throughout the country. As per government decision, Banking hour is from 10 AM – 12 PM during this crisis period (until further notice).', '2020-04-20 14:15:05'),
(8, 'ONLINE MAJOR DECLARATION OF STUDENTS', 'Students can submit their application for major declaration online (as usual). This semester the processing of their major declaration application will also be done online within 24 hours. Students are not required to submit the hard copy of their online application. If the online application is not processed within 24 hours, please contact respective program director by email.', '2020-04-20 14:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_id` int(255) NOT NULL,
  `st_name` varchar(255) NOT NULL,
  `st_pass` varchar(255) NOT NULL DEFAULT '12345',
  `st_email` varchar(255) NOT NULL,
  `st_address` varchar(255) NOT NULL,
  `st_phone` varchar(255) NOT NULL,
  `st_dob` date NOT NULL,
  `st_dept` int(10) DEFAULT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_occu` varchar(255) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_occu` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `blood_group` varchar(100) NOT NULL,
  `class` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `st_name`, `st_pass`, `st_email`, `st_address`, `st_phone`, `st_dob`, `st_dept`, `f_name`, `f_occu`, `m_name`, `m_occu`, `nationality`, `age`, `gender`, `blood_group`, `class`) VALUES
(5, 'Azwad', '12345', 'afid@gmail.com', 'F Block, Bashundhara, Dhaka', '01685723256', '1999-09-23', 0, 'Kafayet Ullah', 'Late', 'Ireen Parvin', 'Housewife', 'Bangladeshi', '23', '', 'O+', '8');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(255) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `sub_class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `sub_name`, `sub_class`) VALUES
(7, 'Math', '6'),
(12, 'Biology', '7'),
(16, 'Math', '8'),
(17, 'chemistry', '6'),
(18, 'chemistry', '9'),
(19, 'Math', '7'),
(20, 'Math', '9'),
(21, 'Math', '10'),
(23, 'chemistry', '7'),
(24, 'chemistry', '8'),
(25, 'chemistry', '10'),
(26, 'Biology', '6'),
(27, 'Biology', '8'),
(29, 'Biology', '10'),
(30, 'Math', '8');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_id` int(255) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `t_pass` varchar(255) NOT NULL DEFAULT '123456',
  `t_email` varchar(255) NOT NULL,
  `t_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `t_name`, `t_pass`, `t_email`, `t_phone`) VALUES
(1, 'Afid Azwad', '123456', 'mdazwad22@gmail.com', '01857528424'),
(2, 'Azwad', '12345', 'afid@gmail.com', '01857528424'),
(22, 'Abul Kalam', '123456', 'kalam@gmail.com', '12345671111'),
(23, 'Rafsan', '123456', 'rafsan@gmail.com', '4345354545');

-- --------------------------------------------------------

--
-- Table structure for table `teachers_consulting`
--

CREATE TABLE `teachers_consulting` (
  `t_id` int(20) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `email` varchar(20) NOT NULL,
  `room` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers_consulting`
--

INSERT INTO `teachers_consulting` (`t_id`, `t_name`, `email`, `room`, `time`) VALUES
(1, 'Afid Azwad', 'mdazwad22@gmail.com', '1110', '3:00-4:00PM'),
(2, 'Azwad', 'afid@gmail.com', '1210', '8:00-9:00AM'),
(23, 'Rafsan', 'rafsan@gmail.com', '1310', '3:00-4:00PM'),
(22, 'Abul Kalam', 'kalam@gmail.com', '1410', '8:00-9:00AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice` ADD FULLTEXT KEY `description` (`description`);

--
-- Indexes for table `routine`
--
ALTER TABLE `routine`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `teacher_id` (`t_id`);

--
-- Indexes for table `school_notice`
--
ALTER TABLE `school_notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `book_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `school_notice`
--
ALTER TABLE `school_notice`
  MODIFY `notice_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `st_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `routine`
--
ALTER TABLE `routine`
  ADD CONSTRAINT `routine_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`sub_id`),
  ADD CONSTRAINT `routine_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`t_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
