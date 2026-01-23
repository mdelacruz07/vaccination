-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2021 at 11:12 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_registration_scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `head_title` varchar(255) NOT NULL,
  `nav_bar_title` varchar(255) DEFAULT NULL,
  `nav_bar` varchar(255) NOT NULL,
  `nav_bar_text_color` varchar(255) NOT NULL,
  `side_bar` varchar(255) NOT NULL,
  `side_bar_text` varchar(255) NOT NULL,
  `hover_side_bar_text` varchar(255) NOT NULL,
  `hover_side_bar_text_bg` varchar(255) NOT NULL,
  `header_color` varchar(255) NOT NULL,
  `header_font_color` varchar(255) NOT NULL,
  `modal_header_color` varchar(255) NOT NULL,
  `modal_header_font_color` varchar(255) NOT NULL,
  `system_main_redirect` varchar(255) NOT NULL,
  `system_logo` varchar(255) NOT NULL,
  `login_background_image` varchar(255) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `system_add_bg_btn_color` varchar(255) DEFAULT NULL,
  `system_add_btn_border` varchar(255) DEFAULT NULL,
  `system_add_btn_color` varchar(255) DEFAULT NULL,
  `system_add_btn_size` varchar(255) DEFAULT NULL,
  `system_delete_bg_btn_color` varchar(255) DEFAULT NULL,
  `system_delete_btn_border` varchar(255) DEFAULT NULL,
  `system_delete_btn_color` varchar(255) DEFAULT NULL,
  `system_delete_btn_size` varchar(255) DEFAULT NULL,
  `system_edit_bg_btn_color` varchar(255) DEFAULT NULL,
  `system_edit_btn_border` varchar(255) DEFAULT NULL,
  `system_edit_btn_color` varchar(255) DEFAULT NULL,
  `system_edit_btn_size` varchar(255) DEFAULT NULL,
  `system_libraries_date_creation` date NOT NULL,
  `system_date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_config`
--

INSERT INTO `system_config` (`id`, `title`, `head_title`, `nav_bar_title`, `nav_bar`, `nav_bar_text_color`, `side_bar`, `side_bar_text`, `hover_side_bar_text`, `hover_side_bar_text_bg`, `header_color`, `header_font_color`, `modal_header_color`, `modal_header_font_color`, `system_main_redirect`, `system_logo`, `login_background_image`, `background_image`, `system_add_bg_btn_color`, `system_add_btn_border`, `system_add_btn_color`, `system_add_btn_size`, `system_delete_bg_btn_color`, `system_delete_btn_border`, `system_delete_btn_color`, `system_delete_btn_size`, `system_edit_bg_btn_color`, `system_edit_btn_border`, `system_edit_btn_color`, `system_edit_btn_size`, `system_libraries_date_creation`, `system_date_creation`) VALUES
(1, '<b>Bago City Online <br>Vaccine Registration</b>', 'Bago City Online Vaccine Registration Management for Covid 19', 'BAGO CITY O.V.R.M', '138, 201, 0', '255, 255, 255', '44, 71, 62', '255, 255, 255', '46, 43, 79', '255, 255, 255', '138, 201, 0', '255, 255, 255', '138, 201, 0', '255, 255, 255', 'pages/main/', 'CHO logo.png', 'simplebackground.jpg', 'simplebackground.jpg', '255, 255, 255', '2px solid rgb(46, 153, 0)', '46, 153, 0', '15px', '255, 255, 255', '2px solid rgb(194, 6, 0)', '194, 6, 0', '15px', '255, 255, 255', '2px solid rgb(0, 158, 161)', '0, 158, 161', '15px', '2020-11-23', '2021-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `system_facilities`
--

CREATE TABLE `system_facilities` (
  `id` int(11) NOT NULL,
  `facility_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `iframe_location` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_facilities`
--

INSERT INTO `system_facilities` (`id`, `facility_name`, `location`, `iframe_location`, `status`, `time_stamp`) VALUES
(1, 'AVAP GYM', 'Brgy Poblacion', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d693.4175639735997!2d122.8343939936058!3d10.535121543553398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aec7cbf915014d%3A0x6ae9860b2b4ea10d!2sBago%20City%20Public%20Library!5e0!3m2!1sen!2sph!4', 'ACTIVE', '2021-04-25 08:28:46'),
(2, 'Sample', 'Bago CIytsds', '..///!@#$$%%###&*&*GHGJ', 'IN-ACTIVE', '2021-04-25 08:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `system_nav_group`
--

CREATE TABLE `system_nav_group` (
  `id` int(255) NOT NULL,
  `nav_group_name` varchar(255) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_nav_group`
--

INSERT INTO `system_nav_group` (`id`, `nav_group_name`, `time_stamp`) VALUES
(1, 'DASHBOARD', '2021-04-18 11:36:22'),
(2, 'SYSTEM', '2021-04-18 11:36:22'),
(9, 'OPERATION', '2021-04-24 07:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `system_pages`
--

CREATE TABLE `system_pages` (
  `pages_id` int(11) NOT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `page_link` varchar(255) DEFAULT NULL,
  `page_type` varchar(255) DEFAULT 'nav',
  `page_icon` varchar(255) DEFAULT NULL,
  `nav_group_id` varchar(255) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_pages`
--

INSERT INTO `system_pages` (`pages_id`, `page_name`, `page_link`, `page_type`, `page_icon`, `nav_group_id`, `time_stamp`) VALUES
(1, 'Home', '../dashboard/', 'nav', '     ', '1', '2021-04-24 04:24:30'),
(2, 'Users', '../user/', 'nav', '    ', '2', '2021-04-24 04:24:47'),
(3, 'System Configuration', '../config/', 'nav', '     ', '2', '2021-04-24 04:24:32'),
(4, 'System Logs', '../logs/', 'nav', '      ', '2', '2021-04-24 04:24:31'),
(30, 'Schedule', '../schedule/', 'nav', ' ', '9', '2021-04-24 07:06:07'),
(31, 'Accounts', '../accounts/', 'nav', ' ', '9', '2021-04-24 07:36:36'),
(32, 'Facilities', '../facilities/', 'nav', ' ', '9', '2021-04-25 08:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `system_page_access`
--

CREATE TABLE `system_page_access` (
  `page_access` int(11) NOT NULL,
  `page_id` varchar(255) DEFAULT NULL,
  `nav_group_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_page_access`
--

INSERT INTO `system_page_access` (`page_access`, `page_id`, `nav_group_id`, `name`, `time_stamp`) VALUES
(1, '1,2,3,4,30,31,32', ', 1, 2, 9', 'Super Admins', '2021-04-25 08:22:00'),
(14, ',1,31,30,32', ', 1, 9', 'Admin', '2021-04-25 08:21:30'),
(15, NULL, NULL, 'Nurse', '2021-04-24 07:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `system_user`
--

CREATE TABLE `system_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `age` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `access` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_user`
--

INSERT INTO `system_user` (`id`, `first_name`, `middle_name`, `last_name`, `suffix`, `age`, `birthday`, `gender`, `username`, `password`, `address`, `contact`, `access`, `profile_picture`, `code`, `date_added`) VALUES
(49, 'Admin', 'Super', 'Super', 'jr', '21', '1960-02-09', 'Male', 'super.admin', '0192023a7bbd73250516f069df18b500', 'Bacolod City', '09123123', '1', 'AdminSuper.jpg', NULL, '2021-04-24 07:38:01'),
(54, 'asdasd', 'dasdas', 'Sample', 'asd', '', '2021-04-02', 'Male', 'admin', '0192023a7bbd73250516f069df18b500', 'Bacolod City', '0915543662', '14', 'asdasdSample.jpg', NULL, '2021-04-24 07:37:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_facilities`
--
ALTER TABLE `system_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_nav_group`
--
ALTER TABLE `system_nav_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_pages`
--
ALTER TABLE `system_pages`
  ADD PRIMARY KEY (`pages_id`);

--
-- Indexes for table `system_page_access`
--
ALTER TABLE `system_page_access`
  ADD PRIMARY KEY (`page_access`);

--
-- Indexes for table `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `system_facilities`
--
ALTER TABLE `system_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_nav_group`
--
ALTER TABLE `system_nav_group`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `system_pages`
--
ALTER TABLE `system_pages`
  MODIFY `pages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `system_page_access`
--
ALTER TABLE `system_page_access`
  MODIFY `page_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `system_user`
--
ALTER TABLE `system_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;