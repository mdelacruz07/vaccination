-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2026 at 11:17 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `local_vims`
--

-- --------------------------------------------------------

--
-- Table structure for table `local_data_fetcher`
--

CREATE TABLE `local_data_fetcher` (
  `id` int NOT NULL,
  `database_main_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NEW',
  `qr_id` mediumtext COLLATE utf8mb4_general_ci,
  `employmentcategory` mediumtext COLLATE utf8mb4_general_ci,
  `sub_category` mediumtext COLLATE utf8mb4_general_ci,
  `idcategory` mediumtext COLLATE utf8mb4_general_ci,
  `idnumber` mediumtext COLLATE utf8mb4_general_ci,
  `phid` mediumtext COLLATE utf8mb4_general_ci,
  `pwdid` mediumtext COLLATE utf8mb4_general_ci,
  `lastname` mediumtext COLLATE utf8mb4_general_ci,
  `firstname` mediumtext COLLATE utf8mb4_general_ci,
  `middlename` mediumtext COLLATE utf8mb4_general_ci,
  `suffix` mediumtext COLLATE utf8mb4_general_ci,
  `contact` mediumtext COLLATE utf8mb4_general_ci,
  `gender` mediumtext COLLATE utf8mb4_general_ci,
  `bday` date DEFAULT NULL,
  `brgy` mediumtext COLLATE utf8mb4_general_ci,
  `region` mediumtext COLLATE utf8mb4_general_ci,
  `province` mediumtext COLLATE utf8mb4_general_ci,
  `city` mediumtext COLLATE utf8mb4_general_ci,
  `civil_status` mediumtext COLLATE utf8mb4_general_ci,
  `employment_status` mediumtext COLLATE utf8mb4_general_ci,
  `ocupation` mediumtext COLLATE utf8mb4_general_ci,
  `agency` mediumtext COLLATE utf8mb4_general_ci,
  `current_residence` mediumtext COLLATE utf8mb4_general_ci,
  `pregnant` mediumtext COLLATE utf8mb4_general_ci,
  `nurse_response` mediumtext COLLATE utf8mb4_general_ci,
  `covid_status` mediumtext COLLATE utf8mb4_general_ci,
  `covid_exposure` mediumtext COLLATE utf8mb4_general_ci,
  `vaccination_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Not-Vaccinated',
  `reason_refusal` mediumtext COLLATE utf8mb4_general_ci,
  `if_severe_allergic` mediumtext COLLATE utf8mb4_general_ci,
  `allergy` mediumtext COLLATE utf8mb4_general_ci,
  `if_allergy` mediumtext COLLATE utf8mb4_general_ci,
  `dose_1` mediumtext COLLATE utf8mb4_general_ci,
  `dose_2` mediumtext COLLATE utf8mb4_general_ci,
  `booster` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `allergies_to_PEG` mediumtext COLLATE utf8mb4_general_ci,
  `bleeding_disorders` mediumtext COLLATE utf8mb4_general_ci,
  `if_bleeding` mediumtext COLLATE utf8mb4_general_ci,
  `symtoms` mediumtext COLLATE utf8mb4_general_ci,
  `if_receive_vaccine` mediumtext COLLATE utf8mb4_general_ci,
  `comorbidity` mediumtext COLLATE utf8mb4_general_ci,
  `consent` mediumtext COLLATE utf8mb4_general_ci,
  `defferal` mediumtext COLLATE utf8mb4_general_ci,
  `time_stamp` date DEFAULT NULL,
  `convalescent` mediumtext COLLATE utf8mb4_general_ci,
  `if_pregnant` mediumtext COLLATE utf8mb4_general_ci,
  `vaccine_name` mediumtext COLLATE utf8mb4_general_ci,
  `batch_number` mediumtext COLLATE utf8mb4_general_ci,
  `lot_number` mediumtext COLLATE utf8mb4_general_ci,
  `vaccinator_name` mediumtext COLLATE utf8mb4_general_ci,
  `prof_vaccinator` mediumtext COLLATE utf8mb4_general_ci,
  `medical_clearance` mediumtext COLLATE utf8mb4_general_ci,
  `allergy_to_vaccine` mediumtext COLLATE utf8mb4_general_ci,
  `profile_comorbidity` mediumtext COLLATE utf8mb4_general_ci,
  `encoded` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NO',
  `covid_classification` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N/A',
  `indigenous` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '02_No',
  `adverse_event` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '02_No',
  `adverse_event_cons` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N/A',
  `pwd` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '02_No',
  `sched_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' approved',
  `facility_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `encoded_by` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Unrecorded',
  `guardian` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ped_comorbid` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec_vaccine_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec_batch_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec_lot_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec_date_of_vaccination` date DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `local_data_fetcher`
--

INSERT INTO `local_data_fetcher` (`id`, `database_main_id`, `qr_id`, `employmentcategory`, `sub_category`, `idcategory`, `idnumber`, `phid`, `pwdid`, `lastname`, `firstname`, `middlename`, `suffix`, `contact`, `gender`, `bday`, `brgy`, `region`, `province`, `city`, `civil_status`, `employment_status`, `ocupation`, `agency`, `current_residence`, `pregnant`, `nurse_response`, `covid_status`, `covid_exposure`, `vaccination_status`, `reason_refusal`, `if_severe_allergic`, `allergy`, `if_allergy`, `dose_1`, `dose_2`, `booster`, `allergies_to_PEG`, `bleeding_disorders`, `if_bleeding`, `symtoms`, `if_receive_vaccine`, `comorbidity`, `consent`, `defferal`, `time_stamp`, `convalescent`, `if_pregnant`, `vaccine_name`, `batch_number`, `lot_number`, `vaccinator_name`, `prof_vaccinator`, `medical_clearance`, `allergy_to_vaccine`, `profile_comorbidity`, `encoded`, `covid_classification`, `indigenous`, `adverse_event`, `adverse_event_cons`, `pwd`, `sched_status`, `facility_id`, `encoded_by`, `guardian`, `ped_comorbid`, `sec_vaccine_name`, `sec_batch_number`, `sec_lot_number`, `sec_date_of_vaccination`, `date_added`) VALUES
(1, 'NEW', 'hW69bT76d17P32B92e17q44u52I66i35e58', '01_A1: Health Care Workers', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'VIDAJA', 'JANLEE', 'BAKOY', 'N/A', 'N/A', 'N/A', '2000-02-11', '_64517007_MANGHANOY', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-06-02', 'N/A', 'N/A', 'Pfizer', 'PCA0024', 'PCA0024', 'mark n', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', 'ALL', 'Admin Super Super', 'N/A', 'N/A', '', '', '', '2025-06-25', '2025-05-16 06:38:09'),
(2, 'NEW', 'gB58Nt74C56D59P84D34f81A82H27G12l13', '05_A5: Poor Population', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'GONZALES', 'JOSEPH', 'TAGOY', 'N/A', '09876543215', '02_Male', '2003-01-01', '_64517016_TALAPTAP', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-06-02', 'N/A', 'N/A', 'Moderna', 'LOT123', 'LOT123', 'Noberto N.', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', 'ALL', 'Admin Super Super', 'N/A', 'N/A', '', '', '', '2025-06-25', '2025-05-16 06:40:22'),
(3, 'NEW', 'UP10Bb22V41m81Z55B26P33Z56O66d74G24', '01_A1: Health Care Workers', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'DADA', 'FAFAGA', 'GADADAD', 'N/A', 'N/A', 'N/A', '2005-01-02', '_64517016_TALAPTAP', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-04', 'N/A', 'N/A', 'Pfizer', 'dada11', 'dada11', 'jan V.', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '2025-07-26', '2025-05-16 15:41:49'),
(4, 'NEW', 'Us74ow11x13O83F97T45C47g38Y16S90b87', '01_A1: Health Care Workers', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'GABRIDO', 'GINO', 'DILAGBANG', 'N/A', '09876543212', '02_Male', '2001-02-01', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-05', 'N/A', 'N/A', 'Pfizer', 'PCA2001', 'PCA2001', 'Natan N.', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '2025-07-22', '2025-05-17 01:47:11'),
(5, 'NEW', 'dc79ex48S30w99L46X57J72s86T81L93X65', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'SUANQUE', 'NEIL', 'TAN', 'N/A', 'N/A', '02_Male', '2000-02-01', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-07', 'N/A', 'N/A', 'Penta Hib', 'PCA001', 'PCA001', 'Alber', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', 'ALL', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '2025-07-21', '2025-05-21 16:44:11'),
(6, 'NEW', 'Oi10ER61J74Q12a34x57o14X39G80q63v45', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'JDASD', 'DASD', 'DASD', 'N/A', 'N/A', 'N/A', '2000-02-01', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-09', 'N/A', 'N/A', 'MMR', 'PCA0024', 'PCA0024', 'atan', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '2025-07-19', '2025-05-21 16:57:34'),
(7, 'NEW', 'hN45RY38x58q87r84b13j93e46F13N76b46', 'Pediatric', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'ADAFW', 'FAWS', 'ASDFE', 'N/A', 'N/A', 'N/A', '2000-02-02', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-09', 'N/A', 'N/A', 'Flu', 'PCA0024', 'PCA0024', 'atan', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '2025-07-19', '2025-05-21 17:04:15'),
(8, 'NEW', 'HK97hN71Y70c76W84C37n54w98l54S82P64', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'DASDA', 'DASDF', 'FASFA', 'N/A', 'N/A', 'N/A', '2000-02-11', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-09', 'N/A', 'N/A', 'BCC', 'dasd', 'dasd', 'asd', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '2025-07-19', '2025-05-21 17:25:11'),
(9, 'NEW', 'Gl16PU50N87U76R17g84w85k24l19j28M17', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'test', 'test', 'N/A', 'N/A', 'N/A', 'N/A', '2025-07-02', '', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-10', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', '', '', '', '2025-07-14', '2025-07-02 11:46:50'),
(10, 'NEW', 'Ei92oo73O54V25C30B47Q55Z70h48A35t93', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'DOE', 'JOHN', 'SMITH', 'N/A', '0935965626656565', '02_Male', '2025-07-11', '', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-02', 'N/A', 'N/A', 'Pfizer', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', 'Sinovac', 'N/A', 'N/A', '2025-06-27', '2025-07-02 13:03:26'),
(11, 'NEW', 'aY51uP63r65Z23E68x20h17f91H11g73P52', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'TEST2', 'TEST2', 'N/A', 'N/A', 'N/A', 'N/A', '2015-06-09', '_64517006_LALAGSAN', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-02', 'N/A', 'N/A', 'IPV', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', 'Penta Hib', 'N/A', 'N/A', '2025-07-14', '2025-07-02 13:09:31'),
(14, 'NEW', 'HW78uC85r36O99r43c49G39w66U86W49x53', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'SERGIO ', 'MECHLING', 'N/A', 'N/A', 'N/A', 'N/A', '1994-05-15', '_64517004_CABAGNAAN', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-08-01', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-08-20', '2025-07-02 15:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` text COLLATE utf8mb4_general_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `indigenous` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `pwd` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `guardian_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `pedia_comorbidity` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `first_dose_date` date DEFAULT NULL,
  `first_vaccine_id` int NOT NULL,
  `first_batch_no` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `first_lot_no` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `second_dose_date` date DEFAULT NULL,
  `second_vaccine_id` int NOT NULL DEFAULT '0',
  `second_batch_no` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `second_lot_no` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `vaccinator_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `first_dose` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `second_dose` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `booster` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `created_by` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_archive` int NOT NULL DEFAULT '0' COMMENT '0 not delete\r\n1 is deleted',
  `is_archive_at` datetime DEFAULT NULL,
  `is_archive_by` int NOT NULL DEFAULT '0',
  `update_by` int NOT NULL DEFAULT '0',
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `firstname`, `middlename`, `lastname`, `category`, `province`, `city`, `barangay`, `indigenous`, `pwd`, `guardian_name`, `pedia_comorbidity`, `first_dose_date`, `first_vaccine_id`, `first_batch_no`, `first_lot_no`, `second_dose_date`, `second_vaccine_id`, `second_batch_no`, `second_lot_no`, `vaccinator_name`, `first_dose`, `second_dose`, `booster`, `created_by`, `created_date`, `is_archive`, `is_archive_at`, `is_archive_by`, `update_by`, `update_at`) VALUES
(1, 'test', 'test', 'test', 'Health Care Workers', 'AGUSAN DEL SUR', 'LA PAZ', 'KASAPA II', 'No', 'No', '', '', '2026-02-16', 2, 'test', 'test', NULL, 0, '', '', 'test', 'Yes', 'No', 'No', 49, '2026-02-16 08:37:43', 0, NULL, 0, 0, NULL),
(2, 'test2', 'test2', 'test2', 'Senior Citizens', 'BULACAN', 'PANDI', 'REAL DE CACARONG', 'Yes', 'Yes', 'test2', 'test2', '2026-02-17', 7, '1', '1', NULL, 0, '', '', 'test2', 'Yes', 'No', 'No', 49, '2026-02-17 10:54:58', 0, NULL, 0, 0, NULL),
(3, 'test333333', 'test333333', 'test333333', 'Other Remaing Workforce', '', '', '', 'No', 'Yes', 'test3test333333', 'test3test333333', '2026-02-17', 7, '', '', '2026-03-17', 0, 'test333333', 'test333333', 'test3', 'Yes', 'Yes', 'Yes', 49, '2026-02-17 11:00:05', 0, NULL, 0, 49, '2026-02-17 03:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `head_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nav_bar_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nav_bar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nav_bar_text_color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `side_bar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `side_bar_text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hover_side_bar_text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hover_side_bar_text_bg` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `header_color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `header_font_color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `modal_header_color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `modal_header_font_color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `system_main_redirect` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `system_logo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `login_background_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `background_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `system_add_bg_btn_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_add_btn_border` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_add_btn_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_add_btn_size` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_delete_bg_btn_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_delete_btn_border` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_delete_btn_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_delete_btn_size` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_edit_bg_btn_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_edit_btn_border` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_edit_btn_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_edit_btn_size` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `system_libraries_date_creation` date NOT NULL,
  `system_date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_config`
--

INSERT INTO `system_config` (`id`, `title`, `head_title`, `nav_bar_title`, `nav_bar`, `nav_bar_text_color`, `side_bar`, `side_bar_text`, `hover_side_bar_text`, `hover_side_bar_text_bg`, `header_color`, `header_font_color`, `modal_header_color`, `modal_header_font_color`, `system_main_redirect`, `system_logo`, `login_background_image`, `background_image`, `system_add_bg_btn_color`, `system_add_btn_border`, `system_add_btn_color`, `system_add_btn_size`, `system_delete_bg_btn_color`, `system_delete_btn_border`, `system_delete_btn_color`, `system_delete_btn_size`, `system_edit_bg_btn_color`, `system_edit_btn_border`, `system_edit_btn_color`, `system_edit_btn_size`, `system_libraries_date_creation`, `system_date_creation`) VALUES
(1, '<b>La Castellana <br> Vaccination Record Management</b> & Forecasting System', 'Municipality Of La Castellana Vaccination System', 'MUN.LC V.A.X', '91, 116, 128', '255, 255, 255', '44, 71, 62', '255, 255, 255', '46, 43, 79', '255, 255, 255', '91, 116, 128', '255, 255, 255', '91, 116, 128', '255, 255, 255', 'pages/main/', 'CHO logo.png', 'simplebackground.jpg', 'simplebackground.jpg', '255, 255, 255', '2px solid rgb(46, 153, 0)', '46, 153, 0', '15px', '255, 255, 255', '2px solid rgb(194, 6, 0)', '194, 6, 0', '15px', '255, 255, 255', '2px solid rgb(0, 158, 161)', '0, 158, 161', '15px', '2020-11-23', '2021-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `system_facilities`
--

CREATE TABLE `system_facilities` (
  `id` int NOT NULL,
  `facility_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` mediumtext COLLATE utf8mb4_general_ci,
  `iframe_location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_facilities`
--

INSERT INTO `system_facilities` (`id`, `facility_name`, `location`, `iframe_location`, `status`, `time_stamp`) VALUES
(1, 'ABAP GYM', 'Bago City Public Library', 'pb=!1m18!1m12!1m3!1d2332.371882947235!2d122.8342667875051!3d10.534783931953106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aec7cbf915014d%3A0x6ae9860b2b4ea10d!2sBago%20City%20Public%20Library!5e0!3m2!1sen!2sph!4v1620116466358!5m2!1sen!2sph', 'IN-ACTIVE', '2021-04-25 08:28:46'),
(2, 'Bago City Hospital', 'Bago City Hospital', 'pb=!1m18!1m12!1m3!1d3922.5550303782097!2d122.8450562132247!3d10.535669912674026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aec63b2ea5facd%3A0x3100091bf8d8128d!2sBago%20City%20Hospital!5e0!3m2!1sen!2sph!4v1620118860994!5m2!1sen!2sph', 'IN-ACTIVE', '2021-04-25 08:49:29'),
(3, 'Bago City Health Office', 'Bago City Health Office', 'pb=!1m18!1m12!1m3!1d1649.2174578745844!2d122.83502969614841!3d10.538242524507131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfbcc4df1333ed49a!2sCity%20Health%20Office%20of%20Bago!5e0!3m2!1sen!2sph!4v1620118988445!5m2!1sen!2sph', 'IN-ACTIVE', '2021-05-04 09:03:59'),
(4, 'MYTMCCC', 'Brgy Poblacion', ' none', 'ACTIVE', '2021-06-11 15:13:45'),
(5, 'HINIGARAN', 'HINIGARAN', 'test', 'ACTIVE', '2025-07-02 09:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `system_nav_group`
--

CREATE TABLE `system_nav_group` (
  `id` int NOT NULL,
  `nav_group_name` varchar(255) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_nav_group`
--

INSERT INTO `system_nav_group` (`id`, `nav_group_name`, `time_stamp`) VALUES
(1, 'DASHBOARD', '2021-04-18 11:36:22'),
(2, 'SYSTEM', '2021-04-18 11:36:22'),
(9, 'OPERATION', '2021-04-24 07:05:38'),
(10, 'Reports', '2021-05-12 02:59:53'),
(11, 'VIMS', '2021-06-11 12:10:02'),
(12, 'CARDINAL', '2021-06-14 12:00:05'),
(13, 'System-Backup', '2021-07-20 04:09:41'),
(14, 'Graphical Report', '2021-07-23 03:13:51'),
(15, 'INVENTORY', '2026-02-05 06:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `system_pages`
--

CREATE TABLE `system_pages` (
  `pages_id` int NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `page_type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'nav',
  `page_icon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nav_group_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(32, 'Facilities', '../facilities/', 'nav', ' ', '9', '2021-04-25 08:21:19'),
(33, 'Vaccines', '../vaccines/', 'nav', ' ', '9', '2021-04-26 03:30:02'),
(34, 'Profiled and None Vaccine(List)', 'print_profiled_not_vaccine', 'modal', ' ', '10', '2021-07-23 03:32:42'),
(35, 'Vaccination Registration', '../registrants/', 'nav', ' ', '9', '2021-06-11 12:17:51'),
(36, 'Vims-Vas Data Allocation', '../import_data_to_vims/', 'nav', '  ', '11', '2021-06-11 06:09:13'),
(37, 'Import Data to Vims I.R', '../import_data_to_vims_ir/', 'nav', '  ', '11', '2021-05-25 02:56:08'),
(38, 'Pre Vaccination Screening', '../registered_table_data/', 'nav', '  ', '9', '2021-06-11 11:52:09'),
(39, 'Profiling Report(Graphical)', '../profiling_report/index.php', 'nav', '  ', '14', '2021-07-23 03:15:10'),
(40, 'Update Corrections', '../update_corrections/', 'nav', ' ', '11', '2021-05-25 05:23:11'),
(41, 'Data Back-up', '../emergency_back_up/', 'nav', ' ', '13', '2021-07-20 04:09:55'),
(42, 'Data Allocation', '../data_allocation/', 'nav', ' ', '13', '2021-07-20 15:09:24'),
(43, 'Post Monitoring', '../post_vaccination/', 'nav', ' ', '9', '2021-06-11 11:52:09'),
(44, 'Vims-IR Data Allocation', '../vims_ir/', 'nav', '  ', '11', '2021-06-11 12:10:18'),
(45, 'Vaccination Report(List)', 'print_monthly_vaccinated', 'modal', ' ', '10', '2021-07-23 03:32:42'),
(46, 'Vaccination Report(Graphical)', '../vaccination_report/index.php', 'nav', ' ', '14', '2021-07-23 03:15:10'),
(47, 'Check Double Entry', '../update_double_entry/', 'nav', ' ', '12', '2021-07-05 03:51:36'),
(48, 'My Easy Way and Tool', '../myeasy/', 'nav', ' ', '12', '2021-07-05 08:49:13'),
(49, 'Daily Data Allocation Report', '../reports/print_daily_allocation_report.php', 'nav', ' ', '10', '2021-07-12 03:12:12'),
(50, 'Vaccine With No 2nd Dose(List)', 'print_monthly_no_2nd', 'modal', ' ', '10', '2021-07-23 03:32:42'),
(51, 'Vaccination Scheduler', '../scheduler/', 'nav', ' ', '9', '2021-07-19 02:42:25'),
(52, 'Vaccination Matrix', '../vaccination_matrix/', 'nav', ' ', '10', '2021-07-23 03:44:26'),
(53, 'Total Vaccinated', 'print_monthly_vaccinated_by_date', 'modal', ' ', '10', '2021-08-19 01:01:00'),
(54, 'Daily Vaccination Report', 'print_monthly_vaccinated_by_date', 'modal', ' ', '10', '2021-09-26 08:46:24'),
(55, 'Check Vaccination', '../vaccination_checker/', 'nav', ' ', '9', '2021-10-02 06:24:50'),
(56, 'PIMT Vaccination List', '../vims_pimt/', 'nav', ' ', '11', '2021-10-04 06:02:01'),
(57, 'Local System Syncronization', '../sync/', 'nav', ' ', '13', '2021-10-06 16:33:42'),
(59, 'Supplier', '../supplier/', 'nav', ' ', '9', '2025-10-14 02:46:57'),
(60, 'Vaccine Inventory', '../vaccine_inventory', 'nav', ' ', '15', '2026-02-05 06:32:52'),
(61, 'Receiving', '../vaccine_receive', 'nav', ' ', '15', '2026-02-05 06:41:35'),
(62, 'Issuance', '../vaccine_issuance', 'nav', ' ', '15', '2026-02-05 06:41:35'),
(63, 'Stocks', '../vaccine_stocks', 'nav', ' ', '15', '2026-02-11 07:00:24'),
(64, 'Patients', '../vaccinees', 'nav', ' ', '9', '2026-02-13 07:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `system_page_access`
--

CREATE TABLE `system_page_access` (
  `page_access` int NOT NULL,
  `page_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nav_group_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_page_access`
--

INSERT INTO `system_page_access` (`page_access`, `page_id`, `nav_group_id`, `name`, `time_stamp`) VALUES
(1, '1,3,31,35,38,32,2,55,33,59,60,61,62,63,64', ', 1, 2, 9, 15', 'Super Admin', '2026-02-13 07:38:19'),
(14, ',1,35,36,44,39,55', ', 1, 9, 11, 14', 'Admin', '2021-11-11 00:37:36'),
(15, ',35,1', ', 1, 9', 'Encoder', '2021-05-23 14:48:54'),
(16, ',38,1', ', 9, 1', 'Pre Vaccination Screening', '2021-06-11 11:50:23'),
(17, ',1,43', ', 1, 9', 'Post Monitoring', '2021-06-11 11:51:00'),
(18, ',1,41,42', ', 1, 13', 'System Recovery And Back-Up', '2021-07-20 15:10:24'),
(19, ',1,2,34,35,36,38,39,43,44,45,46,47,48,50,52,55,54,53', ', 1, 2, 10, 9, 11, 14, 12', 'System Admin', '2021-10-06 15:17:35'),
(20, NULL, NULL, 'admin2', '2026-01-27 07:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `system_user`
--

CREATE TABLE `system_user` (
  `id` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `access` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facility_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_user`
--

INSERT INTO `system_user` (`id`, `first_name`, `middle_name`, `last_name`, `suffix`, `age`, `birthday`, `gender`, `username`, `password`, `address`, `contact`, `access`, `profile_picture`, `code`, `facility_id`, `date_added`) VALUES
(49, 'Admin', 'Super', 'Super', 'jr', '21', '1960-02-09', 'Male', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Bacolod City', '09123123', '1', 'AdminSuper.jpg', 'ALL', 'ALL', '2025-10-09 00:51:17'),
(94, 'adrian', 'campillanes', 'grapinag', ' ', '', '2000-02-01', 'Male', 'kylag2', 'a9644ff696337a48efa48b291c5852ab', ' ', ' ', '19', 'adriangrapinag.jpg', NULL, NULL, '2025-05-16 10:26:15'),
(95, 'mark', 'arana', 'nadaro', ' ', '', '2000-02-08', 'Male', 'mark1', '3c9a7a610c0a1427b823e7b31d3e653c', 'brgy. himaya hinigaran', '09463442925', '15', 'marknadaro.jpg', NULL, NULL, '2025-05-16 06:47:40'),
(96, 'janlee', 'nicolas', 'vidaja', ' ', '', '2004-05-21', 'Male', 'jan1', '0192023a7bbd73250516f069df18b500', 'brgy. quiwi hinigaran', '09630149516', '14', 'janleevidaja.jpg', 'NUctqV78hu98', NULL, '2025-05-16 10:20:20'),
(97, 'alibaba', 'C.', 'saluja', '', '', '2000-01-01', 'Male', 'alibaba1', '6ad14ba9986e3615423dfca256d04e3f', 'balbad', '', '17', 'default_avatar.png', NULL, NULL, '2025-05-20 16:00:00'),
(98, 'sin', 'ka', 'bad', '', '', '2000-01-01', 'Male', 'sin1', '6ad14ba9986e3615423dfca256d04e3f', 'sinderia', '', '16', 'default_avatar.png', NULL, NULL, '2025-05-20 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` int NOT NULL COMMENT 'Vaccine ID',
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Vaccine name (e.g., “Pfizer-BioNTech COVID-19”).',
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Vaccine type (e.g., “mRNA”, “Inactivated”).',
  `manufacturer` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Default manufacturer.',
  `dose_per_vial` int NOT NULL COMMENT 'Doses per vial.',
  `description` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Vaccine details.',
  `created_by` int NOT NULL COMMENT 'References users.id (creator of record).',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record creation timestamp.',
  `updated_at` datetime NOT NULL COMMENT 'Record update timestamp.',
  `is_archive` int NOT NULL DEFAULT '0' COMMENT '0 = not delete\r\n1 = delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `name`, `type`, `manufacturer`, `dose_per_vial`, `description`, `created_by`, `created_at`, `updated_at`, `is_archive`) VALUES
(1, 'Pfizer-BioNTech COVID-19', 'Viral Vectorz', 'Pfizerz', 1, 'Vaccine detailsz', 49, '2026-01-28 08:34:51', '2026-01-28 00:34:51', 0),
(2, 'Moderna Covid-19', 'mRNA', 'Moderna', 10, 'mRNA-based COVID-19 vaccine requiring cold storage between 2°C and 8°C.', 49, '2025-10-28 16:02:41', '2025-10-29 00:02:41', 0),
(3, 'aaaaaaaaa', 'asaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaa', 34, 'aaaaaaaaaaaa', 49, '2025-10-14 05:49:50', '2025-10-11 12:47:03', 1),
(4, 'asssss', 'ssssssssssss', 'sssssssssssss', 0, 'assssssssss', 49, '2025-10-18 06:08:14', '2025-10-11 12:51:32', 1),
(5, 'bbbbbb', 'bbbbbbbbbbbbbbb', 'bbbbbbbbb', 333, 'bbbbbbbb', 49, '2025-10-18 05:57:50', '2025-10-14 13:42:34', 1),
(6, 'asdss', 'asd', 'ads', 34, 'assd', 49, '2025-10-13 09:14:02', '2025-10-13 17:05:02', 1),
(7, 'AstraZeneca COVID-19', 'Viral Vector', 'AstraZeneca /oxford', 10, 'Adenovirus vector vaccine designed for COVID-19 prevention.', 49, '2025-10-28 16:03:48', '0000-00-00 00:00:00', 0),
(8, 'Sinovac CoronaVac', 'Inactivated', 'Sinovac Biotech', 1, 'Inactivated virus vaccine for COVID-19 stored at 2°C–8°C.', 49, '2025-10-28 16:04:39', '0000-00-00 00:00:00', 0),
(9, 'Hepatitis B Vaccine (Recombinant)', 'Recombinant', 'GlaxoSmithKline', 10, 'Vaccine for prevention of Hepatitis B infection, safe for infants and adults.', 49, '2025-10-28 16:05:46', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_inventory`
--

CREATE TABLE `vaccine_inventory` (
  `id` int NOT NULL COMMENT 'Unique identifier for each inventory record.',
  `vaccine_id` int NOT NULL COMMENT 'References the vaccines table.',
  `batch_no` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Batch or lot number from manufacturer.',
  `manufacturer` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Vaccine manufacturer name.',
  `supplier_id` int DEFAULT NULL COMMENT 'References the suppliers table.',
  `quantity_received` int NOT NULL COMMENT 'Number of doses received.',
  `quantity_available` int DEFAULT NULL COMMENT 'Current remaining stock.',
  `unit` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Unit of measurement (e.g., doses, vials).',
  `storage_location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Physical storage location (e.g., “Cold Room A”).',
  `temperature_range` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Recommended storage temperature (e.g., “2°C–8°C”).',
  `expiry_date` date NOT NULL COMMENT 'Expiration date of the batch.',
  `date_received` date NOT NULL COMMENT 'Date received.',
  `received_by` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'References users.id (person who received).',
  `status` enum('Available','Used','Expired','Damaged','Quarantined') COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Batch status.',
  `remarks` text COLLATE utf8mb4_general_ci COMMENT 'Additional notes.',
  `created_by` int NOT NULL COMMENT 'References users.id (person who created the record).',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record creation timestamp.',
  `updated_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT 'Record update timestamp.',
  `is_archive` int NOT NULL DEFAULT '0' COMMENT '0 = not deleted\r\n1 = delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccine_inventory`
--

INSERT INTO `vaccine_inventory` (`id`, `vaccine_id`, `batch_no`, `manufacturer`, `supplier_id`, `quantity_received`, `quantity_available`, `unit`, `storage_location`, `temperature_range`, `expiry_date`, `date_received`, `received_by`, `status`, `remarks`, `created_by`, `created_at`, `updated_by`, `updated_at`, `is_archive`) VALUES
(1, 7, 'test', 'test', 6, 50, 0, 'test', 'test', 'test', '2026-02-07', '2026-01-23', 'test', 'Available', 'tset', 49, '2026-01-24 07:40:51', NULL, NULL, 0),
(2, 7, 'test12', 'test12', 6, 100, 50, 'test12', 'test12', 'test12', '2026-01-15', '2025-12-30', 'test12', 'Available', 'test12', 49, '2026-01-24 07:42:43', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_issuance`
--

CREATE TABLE `vaccine_issuance` (
  `id` int NOT NULL,
  `vaccine_id` int NOT NULL COMMENT 'vaccine',
  `issued_to` int NOT NULL DEFAULT '0' COMMENT 'facility_if from facility',
  `issued_type` enum('Used','Expire','Damage','Transfer','Return') COLLATE utf8mb4_general_ci NOT NULL COMMENT 'types of out',
  `issued_date` date NOT NULL,
  `vaccinee_id` int NOT NULL DEFAULT '0' COMMENT 'vaccine_registration id',
  `quantity` int NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL COMMENT 'the one who was logged in',
  `update_by` int DEFAULT NULL COMMENT 'the one who was logged in',
  `update_date` datetime DEFAULT NULL,
  `is_archive` int NOT NULL DEFAULT '0',
  `is_archive_date` datetime DEFAULT NULL,
  `is_archive_by` int DEFAULT NULL COMMENT 'the one who was logged in'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccine_issuance`
--

INSERT INTO `vaccine_issuance` (`id`, `vaccine_id`, `issued_to`, `issued_type`, `issued_date`, `vaccinee_id`, `quantity`, `remarks`, `created_date`, `created_by`, `update_by`, `update_date`, `is_archive`, `is_archive_date`, `is_archive_by`) VALUES
(1, 2, 0, 'Used', '2026-02-16', 1, 1, 'Used for test test test as first dose', '2026-02-16 08:37:43', 49, 0, NULL, 0, NULL, NULL),
(2, 7, 0, 'Used', '2026-02-17', 2, 1, 'Used for test2 test2 test2 as first dose', '2026-02-17 10:54:58', 49, 0, NULL, 0, NULL, NULL),
(3, 7, 0, 'Used', '2026-02-17', 3, 1, 'Used for test3 test3 test3 as first dose', '2026-02-17 11:00:05', 49, 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_receive`
--

CREATE TABLE `vaccine_receive` (
  `id` int NOT NULL COMMENT 'Transaction ID.',
  `vaccine_id` int NOT NULL COMMENT 'References vaccine_inventory.id.',
  `supplier_id` int NOT NULL COMMENT 'vaccine_supplier',
  `facility_id` int NOT NULL COMMENT 'system_facilities',
  `quantity` int NOT NULL COMMENT 'Quantity moved.',
  `expiry_date` date DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Notes (e.g., reason for adjustment).',
  `created_by` int NOT NULL COMMENT 'References users.id (who logged it).',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp.',
  `is_archive` int NOT NULL DEFAULT '0' COMMENT '0 = not delete\r\n1 = is delete',
  `is_archive_at` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT 'Record update timestamp.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccine_receive`
--

INSERT INTO `vaccine_receive` (`id`, `vaccine_id`, `supplier_id`, `facility_id`, `quantity`, `expiry_date`, `remarks`, `created_by`, `created_date`, `is_archive`, `is_archive_at`, `updated_by`, `updated_at`) VALUES
(1, 9, 1, 4, 12, NULL, 's', 49, '2026-01-27 08:09:31', 1, NULL, 49, '2026-01-28 00:31:13'),
(2, 7, 1, 4, 502, NULL, 'zzzz', 49, '2026-01-28 08:45:05', 1, NULL, 49, '2026-01-28 00:53:24'),
(3, 7, 6, 5, 50, '2026-02-28', 'TESTS', 49, '2026-02-05 06:39:33', 0, NULL, 49, '2026-02-10 23:34:57'),
(4, 2, 6, 4, 50, '2026-02-28', 'test', 49, '2026-02-11 07:17:19', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_registration`
--

CREATE TABLE `vaccine_registration` (
  `id` int NOT NULL,
  `qr_id` mediumtext COLLATE utf8mb4_general_ci,
  `employmentcategory` mediumtext COLLATE utf8mb4_general_ci,
  `sub_category` mediumtext COLLATE utf8mb4_general_ci,
  `idcategory` mediumtext COLLATE utf8mb4_general_ci,
  `idnumber` mediumtext COLLATE utf8mb4_general_ci,
  `phid` mediumtext COLLATE utf8mb4_general_ci,
  `pwdid` mediumtext COLLATE utf8mb4_general_ci,
  `lastname` mediumtext COLLATE utf8mb4_general_ci,
  `firstname` mediumtext COLLATE utf8mb4_general_ci,
  `middlename` mediumtext COLLATE utf8mb4_general_ci,
  `suffix` mediumtext COLLATE utf8mb4_general_ci,
  `contact` mediumtext COLLATE utf8mb4_general_ci,
  `gender` mediumtext COLLATE utf8mb4_general_ci,
  `bday` date DEFAULT NULL,
  `brgy` mediumtext COLLATE utf8mb4_general_ci,
  `region` mediumtext COLLATE utf8mb4_general_ci,
  `province` mediumtext COLLATE utf8mb4_general_ci,
  `city` mediumtext COLLATE utf8mb4_general_ci,
  `civil_status` mediumtext COLLATE utf8mb4_general_ci,
  `employment_status` mediumtext COLLATE utf8mb4_general_ci,
  `ocupation` mediumtext COLLATE utf8mb4_general_ci,
  `agency` mediumtext COLLATE utf8mb4_general_ci,
  `current_residence` mediumtext COLLATE utf8mb4_general_ci,
  `pregnant` mediumtext COLLATE utf8mb4_general_ci,
  `nurse_response` mediumtext COLLATE utf8mb4_general_ci,
  `covid_status` mediumtext COLLATE utf8mb4_general_ci,
  `covid_exposure` mediumtext COLLATE utf8mb4_general_ci,
  `vaccination_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Not-Vaccinated',
  `reason_refusal` mediumtext COLLATE utf8mb4_general_ci,
  `if_severe_allergic` mediumtext COLLATE utf8mb4_general_ci,
  `allergy` mediumtext COLLATE utf8mb4_general_ci,
  `if_allergy` mediumtext COLLATE utf8mb4_general_ci,
  `dose_1` mediumtext COLLATE utf8mb4_general_ci,
  `dose_2` mediumtext COLLATE utf8mb4_general_ci,
  `booster` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `allergies_to_PEG` mediumtext COLLATE utf8mb4_general_ci,
  `bleeding_disorders` mediumtext COLLATE utf8mb4_general_ci,
  `if_bleeding` mediumtext COLLATE utf8mb4_general_ci,
  `symtoms` mediumtext COLLATE utf8mb4_general_ci,
  `if_receive_vaccine` mediumtext COLLATE utf8mb4_general_ci,
  `comorbidity` mediumtext COLLATE utf8mb4_general_ci,
  `consent` mediumtext COLLATE utf8mb4_general_ci,
  `defferal` mediumtext COLLATE utf8mb4_general_ci,
  `time_stamp` date DEFAULT NULL,
  `convalescent` mediumtext COLLATE utf8mb4_general_ci,
  `if_pregnant` mediumtext COLLATE utf8mb4_general_ci,
  `vaccine_name` mediumtext COLLATE utf8mb4_general_ci,
  `batch_number` mediumtext COLLATE utf8mb4_general_ci,
  `lot_number` mediumtext COLLATE utf8mb4_general_ci,
  `vaccinator_name` mediumtext COLLATE utf8mb4_general_ci,
  `prof_vaccinator` mediumtext COLLATE utf8mb4_general_ci,
  `medical_clearance` mediumtext COLLATE utf8mb4_general_ci,
  `allergy_to_vaccine` mediumtext COLLATE utf8mb4_general_ci,
  `profile_comorbidity` mediumtext COLLATE utf8mb4_general_ci,
  `encoded` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NO',
  `covid_classification` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N/A',
  `indigenous` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '02_No',
  `adverse_event` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '02_No',
  `adverse_event_cons` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N/A',
  `pwd` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '02_No',
  `sched_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT ' approved',
  `facility_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `encoded_by` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Unrecorded',
  `guardian` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ped_comorbid` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec_vaccine_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sec_batch_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sec_lot_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sec_date_of_vaccination` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccine_registration`
--

INSERT INTO `vaccine_registration` (`id`, `qr_id`, `employmentcategory`, `sub_category`, `idcategory`, `idnumber`, `phid`, `pwdid`, `lastname`, `firstname`, `middlename`, `suffix`, `contact`, `gender`, `bday`, `brgy`, `region`, `province`, `city`, `civil_status`, `employment_status`, `ocupation`, `agency`, `current_residence`, `pregnant`, `nurse_response`, `covid_status`, `covid_exposure`, `vaccination_status`, `reason_refusal`, `if_severe_allergic`, `allergy`, `if_allergy`, `dose_1`, `dose_2`, `booster`, `allergies_to_PEG`, `bleeding_disorders`, `if_bleeding`, `symtoms`, `if_receive_vaccine`, `comorbidity`, `consent`, `defferal`, `time_stamp`, `convalescent`, `if_pregnant`, `vaccine_name`, `batch_number`, `lot_number`, `vaccinator_name`, `prof_vaccinator`, `medical_clearance`, `allergy_to_vaccine`, `profile_comorbidity`, `encoded`, `covid_classification`, `indigenous`, `adverse_event`, `adverse_event_cons`, `pwd`, `sched_status`, `facility_id`, `encoded_by`, `guardian`, `ped_comorbid`, `sec_vaccine_name`, `sec_batch_number`, `sec_lot_number`, `sec_date_of_vaccination`, `date_added`, `date_updated`) VALUES
(1, 'hW69bT76d17P32B92e17q44u52I66i35e58', '01_A1: Health Care Workers', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'VIDAJA', 'JANLEE', 'BAKOY', 'N/A', 'N/A', 'N/A', '2000-02-11', '_64517007_MANGHANOY', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-05-16', 'N/A', 'N/A', 'Pfizer', 'PCA0024', 'PCA0024', 'mark n', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', 'ALL', 'Admin Super Super', 'N/A', 'N/A', '', '', '', '', '2025-05-16 06:38:09', '2025-05-16 06:38:09'),
(2, 'gB58Nt74C56D59P84D34f81A82H27G12l13', '05_A5: Poor Population', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'GONZALES', 'JOSEPH', 'TAGOY', 'N/A', '09876543215', '02_Male', '2003-01-01', '_64517016_TALAPTAP', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-05-16', 'N/A', 'N/A', 'Moderna', 'LOT123', 'LOT123', 'Noberto N.', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', 'ALL', 'Admin Super Super', 'N/A', 'N/A', '', '', '', '', '2025-05-16 06:40:22', '2025-05-16 06:41:16'),
(3, 'UP10Bb22V41m81Z55B26P33Z56O66d74G24', '01_A1: Health Care Workers', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'DADA', 'FAFAGA', 'GADADAD', 'N/A', 'N/A', 'N/A', '2005-01-02', '_64517016_TALAPTAP', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-05-16', 'N/A', 'N/A', 'Pfizer', 'dada11', 'dada11', 'jan V.', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '', '2025-05-16 15:41:49', '2025-05-16 15:41:49'),
(4, 'Us74ow11x13O83F97T45C47g38Y16S90b87', '01_A1: Health Care Workers', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'GABRIDO', 'GINO', 'DILAGBANG', 'N/A', '09876543212', '02_Male', '2001-02-01', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-05-17', 'N/A', 'N/A', 'Pfizer', 'PCA2001', 'PCA2001', 'Natan N.', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '', '2025-05-17 01:47:11', '2025-05-17 01:48:53'),
(5, 'dc79ex48S30w99L46X57J72s86T81L93X65', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'SUANQUE', 'NEIL', 'TAN', 'N/A', 'N/A', '02_Male', '2000-02-01', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-05-22', 'N/A', 'N/A', 'Penta Hib', 'PCA001', 'PCA001', 'Alber', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', 'ALL', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '', '2025-05-21 16:44:11', '2025-05-21 16:58:33'),
(6, 'Oi10ER61J74Q12a34x57o14X39G80q63v45', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'JDASD', 'DASD', 'DASD', 'N/A', 'N/A', 'N/A', '2000-02-01', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-05-22', 'N/A', 'N/A', 'MMR', 'PCA0024', 'PCA0024', 'atan', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '', '2025-05-21 16:57:34', '2025-05-21 16:57:34'),
(7, 'hN45RY38x58q87r84b13j93e46F13N76b46', 'Pediatric', 'ADULTS', 'N/A', 'N/A', 'N/A', 'N/A', 'ADAFW', 'FAWS', 'ASDFE', 'N/A', 'N/A', 'N/A', '2000-02-02', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-05-22', 'N/A', 'N/A', 'Flu', 'PCA0024', 'PCA0024', 'atan', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '', '2025-05-21 17:04:15', '2025-05-21 17:04:15'),
(8, 'HK97hN71Y70c76W84C37n54w98l54S82P64', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'DASDA', 'DASDF', 'FASFA', 'N/A', 'N/A', 'N/A', '2000-02-11', '_64517001_BIAKNABATO', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-05-22', 'N/A', 'N/A', 'BCC', 'dasd', 'dasd', 'asd', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', '', 'janlee nicolas vidaja', 'N/A', 'N/A', '', '', '', '', '2025-05-21 17:25:11', '2025-05-21 17:25:11'),
(9, 'Gl16PU50N87U76R17g84w85k24l19j28M17', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '', '', 'N/A', 'N/A', 'N/A', 'N/A', '2025-07-02', '', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-02', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', '', '', '', '', '2025-07-02 11:46:50', '2025-07-02 11:46:50'),
(10, 'Ei92oo73O54V25C30B47Q55Z70h48A35t93', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'DOE', 'JOHN', 'SMITH', 'N/A', '0935965626656565', '02_Male', '2025-07-11', '', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-01', 'N/A', 'N/A', 'Pfizer', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', 'Sinovac', 'N/A', 'N/A', '', '2025-07-02 13:03:26', '2025-07-02 13:03:26'),
(11, 'aY51uP63r65Z23E68x20h17f91H11g73P52', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'TEST2', 'TEST2', 'N/A', 'N/A', 'N/A', 'N/A', '2015-06-09', '_64517006_LALAGSAN', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-07-07', 'N/A', 'N/A', 'IPV', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', 'Penta Hib', 'N/A', 'N/A', '2025-07-14', '2025-07-02 13:09:31', '2025-07-02 13:09:31'),
(12, 'YL15Uh30T61h12P86B62k49d16o83U95q83', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'TEST', 'TEST', 'N/A', 'N/A', 'N/A', 'N/A', '2025-06-30', '_64517004_CABAGNAAN', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-08-06', 'N/A', 'N/A', 'Pfizer', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-08-22', '2025-07-02 14:39:27', '2025-07-02 14:39:27'),
(13, 'wS25DX81T37X41v93h78k28e99Y38C25C51', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'MECHLING', 'SERGIO', 'N/A', 'N/A', 'N/A', 'N/A', '1994-05-15', '_64517005_CAMANDAG', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-08-01', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-07-21', '2025-07-02 15:02:44', '2025-07-02 15:02:44'),
(14, 'HW78uC85r36O99r43c49G39w66U86W49x53', 'Adults', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'SERGIO ', 'MECHLING', 'N/A', 'N/A', 'N/A', 'N/A', '1994-05-15', '_64517004_CABAGNAAN', '06_Western_Visayas', '_0645_NEGROS_OCCIDENTAL', '_64517_LA_CASTELLANA', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, 'N/A', 'N/A', 'Not-Vaccinated', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '01_Yes', '02_No', '2025-08-01', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'YES', 'N/A', '02_No', '02_No', '02_No', '02_No', ' approved', ' ', 'Admin Super Super', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '2025-08-20', '2025-07-02 15:06:37', '2025-07-02 15:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_supplier`
--

CREATE TABLE `vaccine_supplier` (
  `id` int NOT NULL COMMENT 'Supplier ID',
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Supplier name',
  `contact_person` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Supplier contact person',
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Contact number',
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Contact email',
  `address` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Supplier address',
  `created_by` int NOT NULL COMMENT 'References users.id (creator of record).',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `is_archive` int NOT NULL DEFAULT '0' COMMENT '0 = not deleted\r\n1 = deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccine_supplier`
--

INSERT INTO `vaccine_supplier` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `created_by`, `created_at`, `updated_at`, `is_archive`) VALUES
(1, 'Johnsons', 'John sons', '0936482646', 'test@gmail.com', 'Bgry. Mambuloc Bacolod City', 49, '2025-10-14 03:11:41', NULL, 0),
(2, 'Moderna', 'Moderna', '09123456789', 'john@gmail.com', 'Moderna Inc.', 49, '2025-10-14 04:15:25', '2025-10-29 00:09:50', 0),
(3, 'zzzzzzzz', 'zzzzzzzz', '22222222222', 'zzzzzzzz@gmail.com', 'zzzzzzzz', 49, '2025-10-14 04:23:37', '2025-10-14 13:45:12', 1),
(4, 'Sinovac', 'Sinovac', '09113236564', 'sinovac@gmail.com', 'SinovacINc', 49, '2025-10-28 16:10:41', NULL, 0),
(5, 'Pfizer-BioNTech', 'Pfizer', '09595656562', 'pfizer@gmail.com', 'BionTech', 49, '2025-10-28 16:11:45', NULL, 0),
(6, 'AstraZeneca', 'Astroboy', '09895656722', 'astroboy@gmail.com', 'Astro City', 49, '2025-10-28 16:12:55', NULL, 0),
(7, 'test122', 'test1', '09264562636', 'test@gmail.com', 'test1', 49, '2026-01-24 07:46:49', '2026-01-28 00:34:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vims_vas_12`
--

CREATE TABLE `vims_vas_12` (
  `id` int NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pwd_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `indigenous` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `region` text COLLATE utf8mb4_general_ci,
  `province` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `brgy` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bday` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deferral` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reason_for_deferral` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vaccination_date` date DEFAULT NULL,
  `vaccine_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `batch_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lot_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bakuna_center` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vaccinator_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `1st_dose` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `2nd_dose` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `booster` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adverse_event` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adverse_event_condition` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guardian` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ped_comorbid` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `R` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vims_vas_12`
--

INSERT INTO `vims_vas_12` (`id`, `category`, `unique_id`, `pwd_id`, `indigenous`, `lastname`, `firstname`, `middlename`, `suffix`, `contact`, `region`, `province`, `city`, `brgy`, `gender`, `bday`, `deferral`, `reason_for_deferral`, `vaccination_date`, `vaccine_name`, `batch_number`, `lot_number`, `bakuna_center`, `vaccinator_name`, `1st_dose`, `2nd_dose`, `booster`, `adverse_event`, `adverse_event_condition`, `guardian`, `ped_comorbid`, `R`) VALUES
(5, 'A1', 'BAGOCITY1', 'N', 'N', 'VIDAJA', 'JANLEE', 'BAKOY', 'N/A', 'N/A', 'REGION VI (WESTERN VISAYAS)', '064500000Negros Occidental', '064517000La Castellana', '  MANGHANOY', 'M', '2000-02-11', 'N', 'N', '2025-05-16', 'Pfizer', 'PCA0024', 'PCA0024', 'ALL', 'mark n', 'Y', 'N', 'N/A', 'N', 'N', 'N/A', 'N/A', 'N/A'),
(6, 'A5', 'BAGOCITY2', 'N', 'N', 'GONZALES', 'JOSEPH', 'TAGOY', 'N/A', '09876543215', 'REGION VI (WESTERN VISAYAS)', '064500000Negros Occidental', '064517000La Castellana', '  TALAPTAP', 'M', '2003-01-01', 'N', 'N', '2025-05-16', 'Moderna', 'LOT123', 'LOT123', 'ALL', 'Noberto N.', 'N', 'Y', 'N/A', 'N', 'N', 'N/A', 'N/A', 'N/A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `local_data_fetcher`
--
ALTER TABLE `local_data_fetcher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccine_inventory`
--
ALTER TABLE `vaccine_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccine_issuance`
--
ALTER TABLE `vaccine_issuance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccine_receive`
--
ALTER TABLE `vaccine_receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccine_registration`
--
ALTER TABLE `vaccine_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccine_supplier`
--
ALTER TABLE `vaccine_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vims_vas_12`
--
ALTER TABLE `vims_vas_12`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `local_data_fetcher`
--
ALTER TABLE `local_data_fetcher`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_facilities`
--
ALTER TABLE `system_facilities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `system_nav_group`
--
ALTER TABLE `system_nav_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `system_pages`
--
ALTER TABLE `system_pages`
  MODIFY `pages_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `system_page_access`
--
ALTER TABLE `system_page_access`
  MODIFY `page_access` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `system_user`
--
ALTER TABLE `system_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Vaccine ID', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vaccine_inventory`
--
ALTER TABLE `vaccine_inventory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each inventory record.', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vaccine_issuance`
--
ALTER TABLE `vaccine_issuance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vaccine_receive`
--
ALTER TABLE `vaccine_receive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Transaction ID.', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vaccine_registration`
--
ALTER TABLE `vaccine_registration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vaccine_supplier`
--
ALTER TABLE `vaccine_supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Supplier ID', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vims_vas_12`
--
ALTER TABLE `vims_vas_12`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
