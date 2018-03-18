-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2018 at 11:03 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scan`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE `company_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `web_address` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_page_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`id`, `company_name`, `web_address`, `company_address`, `shipping_address`, `company_email`, `company_phone`, `company_logo`, `company_icon`, `fb_page_link`, `created_at`, `updated_at`) VALUES
(1, 'Mediscan', 'www.mediscan.com', 'Dhaka, Bangladesh', 'Dhaka, Bangladesh', 'info@mediscan.com', '01918201201', '497250218065223.jpeg', '670250218065223.jpeg', 'https://www.facebook.com/facebook', NULL, '2018-02-25 00:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(11) NOT NULL,
  `technologist_contact` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manager_contact` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reception_contact` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `technologist_contact`, `manager_contact`, `reception_contact`, `user_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '018578444841', '017454515451', '019548545891', 9, 1, '2018-03-07 00:29:32', '2018-03-08 01:07:40'),
(2, '01871647512', '01741546565', '01964855254', 12, 1, '2018-03-14 03:33:15', '2018-03-14 03:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_assign_to_radiologist`
--

CREATE TABLE `hospital_assign_to_radiologist` (
  `id` int(11) NOT NULL,
  `radiologist_id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `pre_radiologist_id` int(11) DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Unseen,1=Seen,2=Correction',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hospital_assign_to_radiologist`
--

INSERT INTO `hospital_assign_to_radiologist` (`id`, `radiologist_id`, `entry_id`, `created_by`, `pre_radiologist_id`, `assign_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 1, 6, '2018-03-14', 0, '2018-03-14 01:22:08', '2018-03-14 01:29:15'),
(3, 3, 3, 1, NULL, '2018-03-14', 0, '2018-03-14 01:31:39', '2018-03-14 01:31:39'),
(4, 3, 5, 1, NULL, '2018-03-18', 0, '2018-03-17 22:35:51', '2018-03-17 22:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_bill_price`
--

CREATE TABLE `hospital_bill_price` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `procedure_type_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hospital_bill_price`
--

INSERT INTO `hospital_bill_price` (`id`, `hospital_id`, `procedure_type_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 30, '2018-03-07 00:29:32', '2018-03-08 01:08:29'),
(2, 1, 2, 50, '2018-03-07 00:29:32', '2018-03-08 01:08:29'),
(3, 1, 4, 120, '2018-03-07 00:29:32', '2018-03-08 01:08:29'),
(4, 2, 1, 60, '2018-03-14 03:33:15', '2018-03-14 03:33:15'),
(5, 2, 2, 70, '2018-03-14 03:33:15', '2018-03-14 03:33:15'),
(6, 2, 4, 100, '2018-03-14 03:33:15', '2018-03-14 03:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_entry`
--

CREATE TABLE `hospital_entry` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `procedure_id` int(11) NOT NULL,
  `procedure_type_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `patient_age` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `patient_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_doctor` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `clinical_history` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=Unseen,1=Seen,2=Correction',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hospital_entry`
--

INSERT INTO `hospital_entry` (`id`, `hospital_id`, `procedure_id`, `procedure_type_id`, `date`, `patient_age`, `patient_name`, `ref_doctor`, `gender`, `clinical_history`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 2, '2018-03-12', '25', NULL, 'Dr. Mizan', 'Male', 'NA', 0, '2018-03-12 07:09:38', '2018-03-12 07:09:38'),
(3, 1, 2, 2, '2018-03-12', '25', NULL, 'Dr. Rahim', 'Male', 'Feni', 0, '2018-03-12 07:12:48', '2018-03-12 07:12:48'),
(4, 1, 2, 2, '2018-03-14', '25', 'Korim Khan', 'Dr. Rohim', 'Male', 'Na', 0, '2018-03-13 23:17:09', '2018-03-13 23:19:34'),
(5, 2, 4, 1, '2018-03-14', '40', 'Rejaul Karim', 'Dr. Salama Sultana', 'Male', NULL, 0, '2018-03-14 03:39:36', '2018-03-14 03:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_entry_images`
--

CREATE TABLE `hospital_entry_images` (
  `id` int(11) NOT NULL,
  `photo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `entry_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hospital_entry_images`
--

INSERT INTO `hospital_entry_images` (`id`, `photo`, `entry_id`, `created_at`, `updated_at`) VALUES
(31, 'images/entry/2018/03/12/221120318011214.jpg', 2, '2018-03-12 07:12:14', '2018-03-12 07:12:14'),
(32, 'images/entry/2018/03/12/513120318011214.jpg', 2, '2018-03-12 07:12:14', '2018-03-12 07:12:14'),
(33, 'images/entry/2018/03/12/413120318011215.png', 2, '2018-03-12 07:12:15', '2018-03-12 07:12:15'),
(34, 'images/entry/2018/03/12/978120318011301.jpg', 3, '2018-03-12 07:13:01', '2018-03-12 07:13:01'),
(35, 'images/entry/2018/03/12/502120318011301.jpg', 3, '2018-03-12 07:13:01', '2018-03-12 07:13:01'),
(36, 'images/entry/2018/03/12/554120318011302.png', 3, '2018-03-12 07:13:02', '2018-03-12 07:13:02'),
(37, 'images/entry/2018/03/12/216120318011302.jpg', 3, '2018-03-12 07:13:02', '2018-03-12 07:13:02'),
(38, 'images/entry/2018/03/12/408120318012813.jpg', 3, '2018-03-12 07:28:13', '2018-03-12 07:28:13'),
(39, 'images/entry/2018/03/14/84140318051943.jpg', 4, '2018-03-13 23:19:44', '2018-03-13 23:19:44'),
(40, 'images/entry/2018/03/14/931140318051944.png', 4, '2018-03-13 23:19:44', '2018-03-13 23:19:44'),
(41, 'images/entry/2018/03/14/954140318052003.jpg', 4, '2018-03-13 23:20:03', '2018-03-13 23:20:03'),
(42, 'images/entry/2018/03/14/791140318093953.jpg', 5, '2018-03-14 03:39:54', '2018-03-14 03:39:54'),
(43, 'images/entry/2018/03/14/85140318093953.jpg', 5, '2018-03-14 03:39:54', '2018-03-14 03:39:54'),
(44, 'images/entry/2018/03/14/77140318093954.jpeg', 5, '2018-03-14 03:39:54', '2018-03-14 03:39:54'),
(45, 'images/entry/2018/03/14/920140318093954.png', 5, '2018-03-14 03:39:54', '2018-03-14 03:39:54'),
(46, 'images/entry/2018/03/14/48140318093954.jpg', 5, '2018-03-14 03:39:54', '2018-03-14 03:39:54'),
(47, 'images/entry/2018/03/14/446140318093954.png', 5, '2018-03-14 03:39:55', '2018-03-14 03:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_modality`
--

CREATE TABLE `hospital_modality` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `modality_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hospital_modality`
--

INSERT INTO `hospital_modality` (`id`, `hospital_id`, `modality_id`, `created_at`, `updated_at`) VALUES
(9, 1, 2, '2018-03-08 01:08:29', '2018-03-08 01:08:29'),
(10, 1, 3, '2018-03-08 01:08:29', '2018-03-08 01:08:29'),
(11, 1, 4, '2018-03-08 01:08:30', '2018-03-08 01:08:30'),
(12, 1, 5, '2018-03-08 01:08:30', '2018-03-08 01:08:30'),
(13, 2, 3, '2018-03-14 03:33:16', '2018-03-14 03:33:16'),
(14, 2, 4, '2018-03-14 03:33:16', '2018-03-14 03:33:16'),
(15, 2, 6, '2018-03-14 03:33:16', '2018-03-14 03:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_radiologist`
--

CREATE TABLE `hospital_radiologist` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `radiologist_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hospital_radiologist`
--

INSERT INTO `hospital_radiologist` (`id`, `hospital_id`, `radiologist_id`, `created_at`, `updated_at`) VALUES
(6, 1, 4, '2018-03-08 01:08:30', '2018-03-08 01:08:30'),
(7, 2, 4, '2018-03-14 03:33:16', '2018-03-14 03:33:16'),
(8, 2, 6, '2018-03-14 03:33:16', '2018-03-14 03:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serial_num` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `url`, `slug`, `serial_num`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Settings', 'settings', 'settings', 1, 1, '2018-02-25 01:11:38', '2018-02-25 01:11:38'),
(13, 'Upload Entry', 'hospital-entry', 'upload-entry', 2, 1, '2018-03-03 23:50:12', '2018-03-09 22:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `resource` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'System',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `resource`, `system`, `created_at`, `updated_at`) VALUES
(1, 'Settings', 'settings', 'Settings', 1, '2018-02-25 03:58:58', '2018-02-25 03:58:58'),
(2, 'Upload Entry', 'upload-entry', 'M', 1, '2018-03-03 23:50:24', '2018-03-09 22:40:47'),
(4, 'Permission', 'permission', 'Permission', 1, '2018-03-03 23:59:37', '2018-03-03 23:59:37'),
(5, 'Users', 'users', 'Users', 1, '2018-03-03 23:59:51', '2018-03-03 23:59:51'),
(6, 'Edit', 'edit', 'Edit', 1, '2018-03-18 01:45:48', '2018-03-18 01:45:48'),
(7, 'Delete', 'delete', 'Delete', 1, '2018-03-18 01:45:54', '2018-03-18 01:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(11, 1, 1, NULL, NULL),
(12, 2, 1, NULL, NULL),
(13, 4, 1, NULL, NULL),
(14, 5, 1, NULL, NULL),
(22, 1, 3, NULL, NULL),
(23, 2, 3, NULL, NULL),
(24, 4, 3, NULL, NULL),
(25, 1, 2, NULL, NULL),
(26, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `radiologist`
--

CREATE TABLE `radiologist` (
  `id` int(11) NOT NULL,
  `signature` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `radiologist`
--

INSERT INTO `radiologist` (`id`, `signature`, `gender`, `user_id`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'images/signature/837060318053004.png', 'Male', 8, 1, '2018-03-05 07:39:22', '2018-03-05 23:30:04'),
(4, 'images/signature/272070318053158.jpg', 'Male', 10, 1, '2018-03-06 23:31:58', '2018-03-06 23:31:58'),
(6, 'images/signature/240130318123221.jpg', 'Male', 11, 9, '2018-03-13 06:32:21', '2018-03-13 06:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `radiologist_bill_price`
--

CREATE TABLE `radiologist_bill_price` (
  `id` int(11) NOT NULL,
  `radiologist_id` int(11) NOT NULL,
  `procedure_type_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `radiologist_bill_price`
--

INSERT INTO `radiologist_bill_price` (`id`, `radiologist_id`, `procedure_type_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 30, '2018-03-13 06:32:21', '2018-03-13 06:51:18'),
(2, 6, 2, 40, '2018-03-13 06:32:21', '2018-03-13 06:51:18'),
(3, 6, 4, 50, '2018-03-13 06:32:22', '2018-03-13 06:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `radiologist_macros`
--

CREATE TABLE `radiologist_macros` (
  `id` int(11) NOT NULL,
  `radiologist_id` int(11) NOT NULL,
  `procedure_id` int(11) NOT NULL,
  `modality_id` int(11) NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `radiologist_macros`
--

INSERT INTO `radiologist_macros` (`id`, `radiologist_id`, `procedure_id`, `modality_id`, `details`, `status`, `created_at`, `updated_at`) VALUES
(2, 3, 3, 4, '<p class=\"MsoNormal\"><strong>Private:</strong> CT Scan : Ct Scan of Brain</p>\r\n<p class=\"MsoNormal\">CLINICAL INFORMATION</p>\r\n<p class=\"MsoNormal\">History pancreatic cancer. Status post aortic chemotherapy and Whipple procedure on DATE. Chronic low back</p>\r\n<p class=\"MsoNormal\">pain. Abdominal pain. Follow-up examination.</p>\r\n<p class=\"MsoNormal\">COMPARISON</p>\r\n<p class=\"MsoNormal\">Comparison is made with previous CT scan reported DATE and DATE</p>\r\n<p class=\"MsoNormal\">CONTRAST</p>\r\n<p class=\"MsoNormal\">15 mL of MultiHance was administered per protocol.</p>\r\n<p class=\"MsoNormal\">TECHNIQUE</p>\r\n<p class=\"MsoNormal\">Coronal T2-weighted axial and T2; axial T2 fat sat clear, T2 and, T2 gradient-echo, and in phase sequences;</p>\r\n<p class=\"MsoNormal\">dynamic axial T1 fat-sat post contrast additional subtraction reconstructions; coronal single shot MRCP sequences</p>\r\n<p class=\"MsoNormal\">FINDINGS</p>\r\n<p class=\"MsoNormal\">Marked hydronephrosis and hydroureter are present in the right kidney (series 12 images 19-27). Low signal</p>\r\n<p class=\"MsoNormal\">intensity foci in the proximal right ureter (series 6 image 36) likely represents flow related artifact. Possible</p>\r\n<p class=\"MsoNormal\">septations may be present in the distal right ureter (series 12 image 20). CT scan of the abdomen and pelvis with</p>\r\n<p class=\"MsoNormal\">and without contrast is recommended to evaluate for possible stone or distal obstructing lesion. Findings are new</p>\r\n<p class=\"MsoNormal\">since the previous examination. Decreased enhancement of the right kidney in comparison to the left during the</p>\r\n<p class=\"MsoNormal\">Page 2 of 2</p>\r\n<p class=\"MsoNormal\">Report approved on</p>\r\n<p class=\"MsoNormal\">NationalRad | Headquartered: Florida | Diagnostic Imaging Services: Nationwide | 877.734.6674 | www.NationalRad.com</p>\r\n<p class=\"MsoNormal\">arterial phase (series 15 image 35) may reflect a renal compromise. Stable mild pelviectasis is again noted in the</p>\r\n<p class=\"MsoNormal\">left kidney. No mass is identified in the kidneys. No masses seen along the right ureter. Postoperative changes are</p>\r\n<p class=\"MsoNormal\">seen from a distal pancreatectomy and cholecystectomy representing previous Whipple procedure. There is</p>\r\n<p class=\"MsoNormal\">dilatation of the pancreatic duct in the body and tail (series 6 images 23-20). No recurrent mass is</p>\r\n<p class=\"MsoNormal\">seen in the pancreas or anastomosis.</p>\r\n<p class=\"MsoNormal\">There is mild prominence of the biliary ducts in the left hepatic lobe (series 7 image 20). No filling defect is seen</p>\r\n<p class=\"MsoNormal\">within the common duct. Spleen and adrenal glands are unremarkable. No free fluid or lymphadenopathy seen.</p>\r\n<p class=\"MsoNormal\">No bowel obstruction is identified. Anterior abdominal hernia is again noted containing small bowel without</p>\r\n<p class=\"MsoNormal\">evidence of strangulation (series 7 image 33).</p>\r\n<p class=\"MsoNormal\">There is marked S-shaped scoliosis of the thoracolumbar spine. No metastatic bone lesions are identified.</p>\r\n<p class=\"MsoNormal\">IMPRESSION</p>\r\n<p class=\"MsoNormal\">1. Interval development of marked hydronephrosis hydroureter in the right kidney. No discrete stone or mass</p>\r\n<p class=\"MsoNormal\">in the visualized portions of the right ureter. Recommend CT scan of the abdomen and pelvis with and without</p>\r\n<p class=\"MsoNormal\">contrast for further evaluation.</p>\r\n<p class=\"MsoNormal\">2. Stable mild pelviectasis in the left kidney.</p>\r\n<p class=\"MsoNormal\">3. Postoperative change from previous Whipple procedure. No recurrent mass in the pancreas or anastomosis.</p>\r\n<p class=\"MsoNormal\">4. Mild prominence of the biliary ducts in the left hepatic lobe.</p>\r\n<p class=\"MsoNormal\">5. No lymphadenopathy or metastatic bony lesions.</p>\r\n<p class=\"MsoNormal\">6. Anterior abdominal wall hernia contains small bowel without evidence of strangulation or obstruction.</p>\r\n<p class=\"MsoNormal\">7. Marked S-shaped scoliosis of the thoracolumbar spine.</p>\r\n<p class=\"MsoNormal\">[NationalRad Radiologist]</p>\r\n<p class=\"MsoNormal\">Board Certified Radiologist</p>\r\n<p class=\"MsoNormal\">THIS REPORT WAS ELECTRONICALLY SIGNED</p>', 1, '2018-03-06 04:52:35', '2018-03-06 05:31:47'),
(3, 3, 1, 2, '<p class=\"MsoNormal\"><strong>Private:&nbsp;</strong>&nbsp;DX, Abdoman E/P</p>\r\n<p class=\"MsoNormal\">CLINICAL INFORMATION</p>\r\n<p class=\"MsoNormal\">History pancreatic cancer. Status post aortic chemotherapy and Whipple procedure on DATE. Chronic low back</p>\r\n<p class=\"MsoNormal\">pain. Abdominal pain. Follow-up examination.</p>\r\n<p class=\"MsoNormal\">COMPARISON</p>\r\n<p class=\"MsoNormal\">Comparison is made with previous CT scan reported DATE and DATE</p>\r\n<p class=\"MsoNormal\">CONTRAST</p>\r\n<p class=\"MsoNormal\">15 mL of MultiHance was administered per protocol.</p>\r\n<p class=\"MsoNormal\">TECHNIQUE</p>\r\n<p class=\"MsoNormal\">Coronal T2-weighted axial and T2; axial T2 fat sat clear, T2 and, T2 gradient-echo, and in phase sequences;</p>\r\n<p class=\"MsoNormal\">dynamic axial T1 fat-sat post contrast additional subtraction reconstructions; coronal single shot MRCP sequences</p>\r\n<p class=\"MsoNormal\">FINDINGS</p>\r\n<p class=\"MsoNormal\">Marked hydronephrosis and hydroureter are present in the right kidney (series 12 images 19-27). Low signal</p>\r\n<p class=\"MsoNormal\">intensity foci in the proximal right ureter (series 6 image 36) likely represents flow related artifact. Possible</p>\r\n<p class=\"MsoNormal\">septations may be present in the distal right ureter (series 12 image 20). CT scan of the abdomen and pelvis with</p>\r\n<p class=\"MsoNormal\">and without contrast is recommended to evaluate for possible stone or distal obstructing lesion. Findings are new</p>\r\n<p class=\"MsoNormal\">since the previous examination. Decreased enhancement of the right kidney in comparison to the left during the</p>\r\n<p class=\"MsoNormal\">Page 2 of 2</p>\r\n<p class=\"MsoNormal\">Report approved on</p>\r\n<p class=\"MsoNormal\">NationalRad | Headquartered: Florida | Diagnostic Imaging Services: Nationwide | 877.734.6674 | www.NationalRad.com</p>\r\n<p class=\"MsoNormal\">arterial phase (series 15 image 35) may reflect a renal compromise. Stable mild pelviectasis is again noted in the</p>\r\n<p class=\"MsoNormal\">left kidney. No mass is identified in the kidneys. No masses seen along the right ureter. Postoperative changes are</p>\r\n<p class=\"MsoNormal\">seen from a distal pancreatectomy and cholecystectomy representing previous Whipple procedure. There is</p>\r\n<p class=\"MsoNormal\">dilatation of the pancreatic duct in the body and tail (series 6 images 23-20). No recurrent mass is</p>\r\n<p class=\"MsoNormal\">seen in the pancreas or anastomosis.</p>\r\n<p class=\"MsoNormal\">There is mild prominence of the biliary ducts in the left hepatic lobe (series 7 image 20). No filling defect is seen</p>\r\n<p class=\"MsoNormal\">within the common duct. Spleen and adrenal glands are unremarkable. No free fluid or lymphadenopathy seen.</p>\r\n<p class=\"MsoNormal\">No bowel obstruction is identified. Anterior abdominal hernia is again noted containing small bowel without</p>\r\n<p class=\"MsoNormal\">evidence of strangulation (series 7 image 33).</p>\r\n<p class=\"MsoNormal\">There is marked S-shaped scoliosis of the thoracolumbar spine. No metastatic bone lesions are identified.</p>\r\n<p class=\"MsoNormal\">IMPRESSION</p>\r\n<p class=\"MsoNormal\">1. Interval development of marked hydronephrosis hydroureter in the right kidney. No discrete stone or mass</p>\r\n<p class=\"MsoNormal\">in the visualized portions of the right ureter. Recommend CT scan of the abdomen and pelvis with and without</p>\r\n<p class=\"MsoNormal\">contrast for further evaluation.</p>\r\n<p class=\"MsoNormal\">2. Stable mild pelviectasis in the left kidney.</p>\r\n<p class=\"MsoNormal\">3. Postoperative change from previous Whipple procedure. No recurrent mass in the pancreas or anastomosis.</p>\r\n<p class=\"MsoNormal\">4. Mild prominence of the biliary ducts in the left hepatic lobe.</p>\r\n<p class=\"MsoNormal\">5. No lymphadenopathy or metastatic bony lesions.</p>\r\n<p class=\"MsoNormal\">6. Anterior abdominal wall hernia contains small bowel without evidence of strangulation or obstruction.</p>\r\n<p class=\"MsoNormal\">7. Marked S-shaped scoliosis of the thoracolumbar spine.</p>\r\n<p class=\"MsoNormal\">[NationalRad Radiologist]</p>\r\n<p class=\"MsoNormal\">Board Certified Radiologist</p>\r\n<p class=\"MsoNormal\">THIS REPORT WAS ELECTRONICALLY SIGNED</p>', 1, '2018-03-06 05:09:26', '2018-03-06 05:29:11'),
(4, 3, 2, 2, '<p class=\"MsoNormal\"><strong>Private: Dx, Lumber Spine B/V</strong></p>\r\n<p class=\"MsoNormal\">CLINICAL INFORMATION</p>\r\n<p class=\"MsoNormal\">History pancreatic cancer. Status post aortic chemotherapy and Whipple procedure on DATE. Chronic low back</p>\r\n<p class=\"MsoNormal\">pain. Abdominal pain. Follow-up examination.</p>\r\n<p class=\"MsoNormal\">COMPARISON</p>\r\n<p class=\"MsoNormal\">Comparison is made with previous CT scan reported DATE and DATE</p>\r\n<p class=\"MsoNormal\">CONTRAST</p>\r\n<p class=\"MsoNormal\">15 mL of MultiHance was administered per protocol.</p>\r\n<p class=\"MsoNormal\">TECHNIQUE</p>\r\n<p class=\"MsoNormal\">Coronal T2-weighted axial and T2; axial T2 fat sat clear, T2 and, T2 gradient-echo, and in phase sequences;</p>\r\n<p class=\"MsoNormal\">dynamic axial T1 fat-sat post contrast additional subtraction reconstructions; coronal single shot MRCP sequences</p>\r\n<p class=\"MsoNormal\">FINDINGS</p>\r\n<p class=\"MsoNormal\">Marked hydronephrosis and hydroureter are present in the right kidney (series 12 images 19-27). Low signal</p>\r\n<p class=\"MsoNormal\">intensity foci in the proximal right ureter (series 6 image 36) likely represents flow related artifact. Possible</p>\r\n<p class=\"MsoNormal\">septations may be present in the distal right ureter (series 12 image 20). CT scan of the abdomen and pelvis with</p>\r\n<p class=\"MsoNormal\">and without contrast is recommended to evaluate for possible stone or distal obstructing lesion. Findings are new</p>\r\n<p class=\"MsoNormal\">since the previous examination. Decreased enhancement of the right kidney in comparison to the left during the</p>\r\n<p class=\"MsoNormal\">Page 2 of 2</p>\r\n<p class=\"MsoNormal\">Report approved on</p>\r\n<p class=\"MsoNormal\">NationalRad | Headquartered: Florida | Diagnostic Imaging Services: Nationwide | 877.734.6674 | www.NationalRad.com</p>\r\n<p class=\"MsoNormal\">arterial phase (series 15 image 35) may reflect a renal compromise. Stable mild pelviectasis is again noted in the</p>\r\n<p class=\"MsoNormal\">left kidney. No mass is identified in the kidneys. No masses seen along the right ureter. Postoperative changes are</p>\r\n<p class=\"MsoNormal\">seen from a distal pancreatectomy and cholecystectomy representing previous Whipple procedure. There is</p>\r\n<p class=\"MsoNormal\">dilatation of the pancreatic duct in the body and tail (series 6 images 23-20). No recurrent mass is</p>\r\n<p class=\"MsoNormal\">seen in the pancreas or anastomosis.</p>\r\n<p class=\"MsoNormal\">There is mild prominence of the biliary ducts in the left hepatic lobe (series 7 image 20). No filling defect is seen</p>\r\n<p class=\"MsoNormal\">within the common duct. Spleen and adrenal glands are unremarkable. No free fluid or lymphadenopathy seen.</p>\r\n<p class=\"MsoNormal\">No bowel obstruction is identified. Anterior abdominal hernia is again noted containing small bowel without</p>\r\n<p class=\"MsoNormal\">evidence of strangulation (series 7 image 33).</p>\r\n<p class=\"MsoNormal\">There is marked S-shaped scoliosis of the thoracolumbar spine. No metastatic bone lesions are identified.</p>\r\n<p class=\"MsoNormal\">IMPRESSION</p>\r\n<p class=\"MsoNormal\">1. Interval development of marked hydronephrosis hydroureter in the right kidney. No discrete stone or mass</p>\r\n<p class=\"MsoNormal\">in the visualized portions of the right ureter. Recommend CT scan of the abdomen and pelvis with and without</p>\r\n<p class=\"MsoNormal\">contrast for further evaluation.</p>\r\n<p class=\"MsoNormal\">2. Stable mild pelviectasis in the left kidney.</p>\r\n<p class=\"MsoNormal\">3. Postoperative change from previous Whipple procedure. No recurrent mass in the pancreas or anastomosis.</p>\r\n<p class=\"MsoNormal\">4. Mild prominence of the biliary ducts in the left hepatic lobe.</p>\r\n<p class=\"MsoNormal\">5. No lymphadenopathy or metastatic bony lesions.</p>\r\n<p class=\"MsoNormal\">6. Anterior abdominal wall hernia contains small bowel without evidence of strangulation or obstruction.</p>\r\n<p class=\"MsoNormal\">7. Marked S-shaped scoliosis of the thoracolumbar spine.</p>\r\n<p class=\"MsoNormal\">[NationalRad Radiologist]</p>\r\n<p class=\"MsoNormal\">Board Certified Radiologist</p>\r\n<p class=\"MsoNormal\">THIS REPORT WAS ELECTRONICALLY SIGNED</p>', 1, '2018-03-06 05:23:50', '2018-03-06 05:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `radiologist_speciality`
--

CREATE TABLE `radiologist_speciality` (
  `id` int(11) NOT NULL,
  `radiologist_id` int(11) NOT NULL,
  `modality_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `radiologist_speciality`
--

INSERT INTO `radiologist_speciality` (`id`, `radiologist_id`, `modality_id`, `created_at`, `updated_at`) VALUES
(20, 3, 2, '2018-03-05 23:30:04', '2018-03-05 23:30:04'),
(21, 3, 4, '2018-03-05 23:30:04', '2018-03-05 23:30:04'),
(22, 3, 5, '2018-03-05 23:30:05', '2018-03-05 23:30:05'),
(23, 3, 7, '2018-03-05 23:30:05', '2018-03-05 23:30:05'),
(24, 3, 8, '2018-03-05 23:30:05', '2018-03-05 23:30:05'),
(25, 4, 3, '2018-03-06 23:31:59', '2018-03-06 23:31:59'),
(26, 4, 6, '2018-03-06 23:31:59', '2018-03-06 23:31:59'),
(27, 4, 7, '2018-03-06 23:31:59', '2018-03-06 23:31:59'),
(28, 4, 8, '2018-03-06 23:31:59', '2018-03-06 23:31:59'),
(33, 6, 2, '2018-03-13 06:51:19', '2018-03-13 06:51:19'),
(34, 6, 6, '2018-03-13 06:51:19', '2018-03-13 06:51:19'),
(35, 6, 7, '2018-03-13 06:51:19', '2018-03-13 06:51:19'),
(36, 6, 8, '2018-03-13 06:51:19', '2018-03-13 06:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `system`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', 'Admin Area', 1, '2017-12-05 04:39:39', NULL),
(2, 'Radiologist', 'radiologist', 'Radiologist', 1, '2017-12-05 04:40:16', NULL),
(3, 'Hospital', 'hospital', 'Hospital', 1, '2017-12-05 04:40:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-12-10 08:43:12', NULL),
(5, 1, 5, NULL, NULL),
(8, 2, 8, NULL, NULL),
(9, 3, 9, NULL, NULL),
(10, 2, 10, NULL, NULL),
(11, 2, 11, NULL, NULL),
(12, 3, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `set_macros`
--

CREATE TABLE `set_macros` (
  `id` int(11) NOT NULL,
  `modality_id` int(11) NOT NULL,
  `procedure_id` int(11) NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `set_macros`
--

INSERT INTO `set_macros` (`id`, `modality_id`, `procedure_id`, `details`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '<p class=\"MsoNormal\"><strong>CLINICAL INFORMATION</strong></p>\r\n<p class=\"MsoNormal\">Assess right hip and groin pain for one year. This is associated with locking and the pain is sharp in character.</p>\r\n<p class=\"MsoNormal\">History of playing soccer.</p>\r\n<p class=\"MsoNormal\">COMPARISON</p>\r\n<p class=\"MsoNormal\">None available.</p>\r\n<p class=\"MsoNormal\">CONTRAST</p>\r\n<p class=\"MsoNormal\">Diluted gadolinium in saline.</p>\r\n<p class=\"MsoNormal\"><strong>TECHNIQUE</strong></p>\r\n<p class=\"MsoNormal\">After intraarticular injection of diluted gadolinium in saline, axial T1 fat-sat, axial PD fat-sat, coronal T1 fat-sat,</p>\r\n<p class=\"MsoNormal\">sagittal T1 fat-sat, axial oblique PD fat-sat, and coronal bilateral PD fat-sat images were obtained. This was</p>\r\n<p class=\"MsoNormal\">followed by multiple acquisitions in the coronal and sagittal plane sequentially carried out with post processing</p>\r\n<p class=\"MsoNormal\">and color mapping performed in order to obtain a T2 mapping cartigram study.</p>\r\n<p class=\"MsoNormal\">FINDINGS</p>\r\n<p class=\"MsoNormal\">HIP JOINT/LABRUM: Diluted gadolinium contrast was injected into the patient. There is no distinct evidence of</p>\r\n<p class=\"MsoNormal\">an acetabular labral tear. There is no high-grade chondral loss or delamination along the acetabular margin. The</p>\r\n<p class=\"MsoNormal\">labral morphology is maintained. The ligamentum teres shows borderline thickening. The bony anatomy does not</p>\r\n<p class=\"MsoNormal\">Page 2 of 2</p>\r\n<p class=\"MsoNormal\">Report approved on</p>\r\n<p class=\"MsoNormal\">NationalRad | Headquartered: Florida | Diagnostic Imaging Services: Nationwide | 877.734.6674 | www.NationalRad.com</p>\r\n<p class=\"MsoNormal\">reveal prominent acetabular overhang or retroversion. There is bony prominence of the anterior lateral femoral</p>\r\n<p class=\"MsoNormal\">head and neck region as well as mild lack of femoral head and neck offset. This pattern could suggest, in the</p>\r\n<p class=\"MsoNormal\">appropriate clinical setting, findings that may predispose to femoral acetabular impingement.</p>\r\n<p class=\"MsoNormal\">MUSCLES AND TENDONS: The gluteal tendons are intact. The hamstring tendon origins are intact.</p>\r\n<p class=\"MsoNormal\">BONE MARROW: There is no occult or stress fracture or evidence of AVN.</p>\r\n<p class=\"MsoNormal\">SYMPHYSIS / SI JOINTS: The bony pelvis is intact including the SI joints and symphysis pubis. With respect to</p>\r\n<p class=\"MsoNormal\">the T2 mapping study, sequential coronal and sagittal images obtained with this technique along with graded color</p>\r\n<p class=\"MsoNormal\">image analysis as well as corresponding graphing, do not reveal significant derangement or elevation of the T2</p>\r\n<p class=\"MsoNormal\">relaxation times that would indicate the presence of early chondral degeneration and collagen fiber breakdown</p>\r\n<p class=\"MsoNormal\">in this patient at this time.</p>\r\n<p class=\"MsoNormal\"><strong>IMPRESSION</strong></p>\r\n<p class=\"MsoNormal\">1. No evidence of acetabular labral tear or detachment. There is no high-grade chondral loss or delamination.</p>\r\n<p class=\"MsoNormal\">2. Mild bone alterations along the femoral head and neck region including bony prominence of the anterolateral</p>\r\n<p class=\"MsoNormal\">femoral head and neck region as well as lack of femoral head and neck offset which could predispose, in the</p>\r\n<p class=\"MsoNormal\">correct clinical setting, to changes of femoroacetabular impingement.</p>\r\n<p class=\"MsoNormal\">3. No evidence of abnormal elevation of the T2 relaxation times on the T2 mapping study to indicate early</p>\r\n<p class=\"MsoNormal\">chondral degeneration and collage fiber breakdown as discussed above.</p>\r\n<p class=\"MsoNormal\">4. Note that the patient had a Ropivacaine pain test carried out; 3 cc of Ropivacaine 0.2% were injected. The</p>\r\n<p class=\"MsoNormal\">patient\'s pain level was 6/10 prior to injection. There is only minimal diminishment of pain after Ropivacaine</p>\r\n<p class=\"MsoNormal\">injection indicating lack of response to intraarticular Ropivacaine.</p>\r\n<p class=\"MsoNormal\">5. Note that the alpha angle in this patient is mildly elevated at 61 degrees. The lateral center edge angle of</p>\r\n<p class=\"MsoNormal\">Wiberg is 26 degrees which is within the range of normal.</p>\r\n<p class=\"MsoNormal\">[NationalRad Musculoskeletal Radiologist]</p>\r\n<p class=\"MsoNormal\">Board Certified Radiologist</p>\r\n<p class=\"MsoNormal\">THIS REPORT WAS ELECTRONICALLY SIGNED</p>', 1, 1, '2018-03-04 23:03:40', '2018-03-04 23:44:42'),
(3, 2, 1, '<p class=\"MsoNormal\"><strong>Private :</strong> DX, Abdoman E/P</p>\r\n<p class=\"MsoNormal\">CLINICAL INFORMATION</p>\r\n<p class=\"MsoNormal\">History pancreatic cancer. Status post aortic chemotherapy and Whipple procedure on DATE. Chronic low back</p>\r\n<p class=\"MsoNormal\">pain. Abdominal pain. Follow-up examination.</p>\r\n<p class=\"MsoNormal\">COMPARISON</p>\r\n<p class=\"MsoNormal\">Comparison is made with previous CT scan reported DATE and DATE</p>\r\n<p class=\"MsoNormal\">CONTRAST</p>\r\n<p class=\"MsoNormal\">15 mL of MultiHance was administered per protocol.</p>\r\n<p class=\"MsoNormal\">TECHNIQUE</p>\r\n<p class=\"MsoNormal\">Coronal T2-weighted axial and T2; axial T2 fat sat clear, T2 and, T2 gradient-echo, and in phase sequences;</p>\r\n<p class=\"MsoNormal\">dynamic axial T1 fat-sat post contrast additional subtraction reconstructions; coronal single shot MRCP sequences</p>\r\n<p class=\"MsoNormal\">FINDINGS</p>\r\n<p class=\"MsoNormal\">Marked hydronephrosis and hydroureter are present in the right kidney (series 12 images 19-27). Low signal</p>\r\n<p class=\"MsoNormal\">intensity foci in the proximal right ureter (series 6 image 36) likely represents flow related artifact. Possible</p>\r\n<p class=\"MsoNormal\">septations may be present in the distal right ureter (series 12 image 20). CT scan of the abdomen and pelvis with</p>\r\n<p class=\"MsoNormal\">and without contrast is recommended to evaluate for possible stone or distal obstructing lesion. Findings are new</p>\r\n<p class=\"MsoNormal\">since the previous examination. Decreased enhancement of the right kidney in comparison to the left during the</p>\r\n<p class=\"MsoNormal\">Page 2 of 2</p>\r\n<p class=\"MsoNormal\">Report approved on</p>\r\n<p class=\"MsoNormal\">NationalRad | Headquartered: Florida | Diagnostic Imaging Services: Nationwide | 877.734.6674 | www.NationalRad.com</p>\r\n<p class=\"MsoNormal\">arterial phase (series 15 image 35) may reflect a renal compromise. Stable mild pelviectasis is again noted in the</p>\r\n<p class=\"MsoNormal\">left kidney. No mass is identified in the kidneys. No masses seen along the right ureter. Postoperative changes are</p>\r\n<p class=\"MsoNormal\">seen from a distal pancreatectomy and cholecystectomy representing previous Whipple procedure. There is</p>\r\n<p class=\"MsoNormal\">dilatation of the pancreatic duct in the body and tail (series 6 images 23-20). No recurrent mass is</p>\r\n<p class=\"MsoNormal\">seen in the pancreas or anastomosis.</p>\r\n<p class=\"MsoNormal\">There is mild prominence of the biliary ducts in the left hepatic lobe (series 7 image 20). No filling defect is seen</p>\r\n<p class=\"MsoNormal\">within the common duct. Spleen and adrenal glands are unremarkable. No free fluid or lymphadenopathy seen.</p>\r\n<p class=\"MsoNormal\">No bowel obstruction is identified. Anterior abdominal hernia is again noted containing small bowel without</p>\r\n<p class=\"MsoNormal\">evidence of strangulation (series 7 image 33).</p>\r\n<p class=\"MsoNormal\">There is marked S-shaped scoliosis of the thoracolumbar spine. No metastatic bone lesions are identified.</p>\r\n<p class=\"MsoNormal\">IMPRESSION</p>\r\n<p class=\"MsoNormal\">1. Interval development of marked hydronephrosis hydroureter in the right kidney. No discrete stone or mass</p>\r\n<p class=\"MsoNormal\">in the visualized portions of the right ureter. Recommend CT scan of the abdomen and pelvis with and without</p>\r\n<p class=\"MsoNormal\">contrast for further evaluation.</p>\r\n<p class=\"MsoNormal\">2. Stable mild pelviectasis in the left kidney.</p>\r\n<p class=\"MsoNormal\">3. Postoperative change from previous Whipple procedure. No recurrent mass in the pancreas or anastomosis.</p>\r\n<p class=\"MsoNormal\">4. Mild prominence of the biliary ducts in the left hepatic lobe.</p>\r\n<p class=\"MsoNormal\">5. No lymphadenopathy or metastatic bony lesions.</p>\r\n<p class=\"MsoNormal\">6. Anterior abdominal wall hernia contains small bowel without evidence of strangulation or obstruction.</p>\r\n<p class=\"MsoNormal\">7. Marked S-shaped scoliosis of the thoracolumbar spine.</p>\r\n<p class=\"MsoNormal\">[NationalRad Radiologist]</p>\r\n<p class=\"MsoNormal\">Board Certified Radiologist</p>\r\n<p class=\"MsoNormal\">THIS REPORT WAS ELECTRONICALLY SIGNED</p>', 1, 1, '2018-03-04 23:46:20', '2018-03-06 05:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `set_modalities`
--

CREATE TABLE `set_modalities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `set_modalities`
--

INSERT INTO `set_modalities` (`id`, `name`, `details`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'DX', 'DX', 1, 1, '2018-03-04 01:13:37', '2018-03-04 01:13:37'),
(3, 'MG', NULL, 1, 1, '2018-03-04 01:13:44', '2018-03-04 01:13:44'),
(4, 'CT Scan', NULL, 1, 1, '2018-03-04 01:13:57', '2018-03-04 04:57:19'),
(5, 'MRI', NULL, 1, 1, '2018-03-04 01:14:04', '2018-03-04 01:14:04'),
(6, 'X-ray', NULL, 1, 1, '2018-03-04 04:57:02', '2018-03-04 04:57:02'),
(7, 'Mammography', NULL, 1, 1, '2018-03-04 04:57:50', '2018-03-04 04:57:50'),
(8, 'ECG', NULL, 1, 1, '2018-03-04 04:58:01', '2018-03-04 04:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `set_procedure`
--

CREATE TABLE `set_procedure` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modality_id` int(11) NOT NULL,
  `procedure_type_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `set_procedure`
--

INSERT INTO `set_procedure` (`id`, `name`, `modality_id`, `procedure_type_id`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Abdoman E/P', 2, 1, 1, 1, '2018-03-04 01:38:16', '2018-03-04 05:30:02'),
(2, 'Lumber Spine B/V', 2, 2, 1, 1, '2018-03-04 02:22:58', '2018-03-10 00:20:07'),
(3, 'CT Scan of Brain', 4, 1, 1, 1, '2018-03-04 02:23:46', '2018-03-04 05:31:21'),
(4, 'Chest P/A', 5, 1, 1, 9, '2018-03-10 00:15:44', '2018-03-10 00:20:38'),
(5, 'Canvical', 4, 2, 1, 9, '2018-03-10 00:20:30', '2018-03-10 00:20:30'),
(6, 'Hip', 3, 2, 1, 9, '2018-03-10 00:20:55', '2018-03-10 00:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `set_procedure_type`
--

CREATE TABLE `set_procedure_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `set_procedure_type`
--

INSERT INTO `set_procedure_type` (`id`, `name`, `details`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Single Procedure', NULL, 1, 1, '2018-03-04 11:14:15', NULL),
(2, 'Both View Procedure', NULL, 1, 1, '2018-03-04 11:14:34', NULL),
(4, 'Contrast', NULL, 1, 1, '2018-03-04 11:14:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serial_num` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fk_menu_id` int(11) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `name`, `url`, `slug`, `serial_num`, `fk_menu_id`, `status`, `created_at`, `updated_at`) VALUES
(53, 'Permission', 'acl-permission', 'permission', '1', 12, 1, '2018-02-25 01:13:21', '2018-02-25 01:13:21'),
(54, 'Users', 'users', 'users', '2', 12, 1, '2018-02-25 01:13:32', '2018-03-05 00:05:17'),
(55, 'Report Entry', 'hospital-entry', 'report-entry', '1', 13, 1, '2018-03-14 03:47:01', '2018-03-14 03:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_menu`
--

CREATE TABLE `sub_sub_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `serial_num` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fk_sub_menu_id` int(11) NOT NULL,
  `fk_menu_id` int(11) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_sub_menu`
--

INSERT INTO `sub_sub_menu` (`id`, `name`, `url`, `slug`, `serial_num`, `fk_sub_menu_id`, `fk_menu_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Registration', 'users/create', 'registration', '1', 54, 12, 1, '2018-03-05 02:20:49', '2018-03-05 02:20:49'),
(2, 'Radiologist', 'radiologist', 'radiologist', '2', 54, 12, 1, '2018-03-05 02:21:42', '2018-03-05 02:21:42'),
(3, 'Hospital', 'hospital', 'hospital', '3', 54, 12, 1, '2018-03-05 02:21:59', '2018-03-05 02:21:59'),
(4, 'Admin', 'users', 'admin', '4', 54, 12, 1, '2018-03-05 02:32:42', '2018-03-05 02:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `type` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`, `address`, `status`, `type`, `remember_token`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Administrator', 'admin@smartsoft.com', '$2y$10$OvUB84nz7AncVRFebzB35.0QCkL1w9Iqx9ty0/GsvPTa21bRw5zcq', '018', 'Dhaka', 1, 1, '7BgmkXZk2zbyH3zIwRSp59O682nsFQlx9Ismc7pOvqMvQvkfunRx17YeSG02', NULL, NULL, '2018-02-25 01:50:46', NULL),
(5, 'MD Sabbir', 'sabbir@gmail.com', '$2y$10$fXeGoa10U9Rjig.X4paamOKdXDvWDvOU56uy9A52zggMyBZOxL3jG', '01811951215', 'Dhaka', 1, 1, NULL, '2018-02-25 01:35:32', '1', '2018-02-25 01:35:32', NULL),
(8, 'NM Babor', 'nmbabor50@gmail.com', '$2y$10$gHqj3EN5th7w0APrhdrZe./MRkBteAIcG8SKhiAPD9yc8hpC1OP/i', '01811951215', 'Dhaka, Bangladesh', 1, 2, '33sSoabC2cY7MKG7zVPoJKeQs4HHsjG63xcAiMaBFex9Z51EUc0x2vEcFsnM', '2018-03-05 07:28:35', '1', '2018-03-05 23:27:32', NULL),
(9, 'Saiful Islam', 'saiful@gmail.com', '$2y$10$9MfMiXlJAdpJQ/qurzDAiuE.se02mkY3NPSvP8V8CInoX2Q96Z.WS', '01811951214', 'Dhaka', 1, 3, 'RKxkdqSCAPjh0nohQRJDYwzRUa1CTKXT9zQiJWL6fx0gKpVnHwPWbbI6WCTf', '2018-03-06 06:42:45', '1', '2018-03-06 06:42:45', NULL),
(10, 'Md Rofik', 'rafik@gmail.com', '$2y$10$PhcqVb4jVV9SCBxB9qdYCehYJnTEbBFBEgtnipANUuFXttokG0ybe', '01824789514', 'Noakhali', 1, 2, NULL, '2018-03-06 23:31:33', '1', '2018-03-06 23:31:33', NULL),
(11, 'Sohel Taj', 'soheltaj@gmail.com', '$2y$10$swEMwz7IOdbBH.rncneY8e.f8I9HhJv0cjTmhjh.1FMQGDK6rmmES', '12341', 'asd', 1, 2, 'AX7S6Q4kGZgKva9j4IFQirz8C8IDZqsufMNGH6P8mVFfrjef0Vr4OzWf0iqI', '2018-03-13 06:15:27', '9', '2018-03-13 06:15:27', NULL),
(12, 'Apollo Hospital', 'apollo@gmail.com', '$2y$10$/P4iijYv5NIYzHvU1R9XHO3BEMEfrrOrPgN5sTd4EU6ZYgH3V.Jzq', '01584854', 'Dhaka', 1, 3, '3JL90A080N1lrn8XGtMDDvnOgbaXhWcBasvCZOEgIaK7vUnyH2BK1JsLWtPc', '2018-03-14 03:32:12', '1', '2018-03-14 03:32:12', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `FK_hospital_users_2` (`created_by`);

--
-- Indexes for table `hospital_assign_to_radiologist`
--
ALTER TABLE `hospital_assign_to_radiologist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hospital_assign_to_radiologist_radiologist` (`radiologist_id`),
  ADD KEY `FK_hospital_assign_to_radiologist_hospital_entry` (`entry_id`),
  ADD KEY `FK_hospital_assign_to_radiologist_users` (`created_by`),
  ADD KEY `FK_hospital_assign_to_radiologist_radiologist_2` (`pre_radiologist_id`);

--
-- Indexes for table `hospital_bill_price`
--
ALTER TABLE `hospital_bill_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hospital_bill_price_hospital` (`hospital_id`),
  ADD KEY `FK_hospital_bill_price_set_procedure_type` (`procedure_type_id`);

--
-- Indexes for table `hospital_entry`
--
ALTER TABLE `hospital_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hospital_entry_set_procedure` (`procedure_id`),
  ADD KEY `FK_hospital_entry_set_procedure_type` (`procedure_type_id`),
  ADD KEY `FK_hospital_entry_hospital` (`hospital_id`);

--
-- Indexes for table `hospital_entry_images`
--
ALTER TABLE `hospital_entry_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hospital_entry_images_hospital_entry` (`entry_id`);

--
-- Indexes for table `hospital_modality`
--
ALTER TABLE `hospital_modality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hospital_modality_hospital` (`hospital_id`),
  ADD KEY `FK_hospital_modality_set_modalities` (`modality_id`);

--
-- Indexes for table `hospital_radiologist`
--
ALTER TABLE `hospital_radiologist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hospital_radiologist_hospital` (`hospital_id`),
  ADD KEY `FK_hospital_radiologist_radiologist` (`radiologist_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_permission_role_permissions` (`permission_id`),
  ADD KEY `FK_permission_role_roles` (`role_id`);

--
-- Indexes for table `radiologist`
--
ALTER TABLE `radiologist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `FK_radiologist_users_2` (`created_by`);

--
-- Indexes for table `radiologist_bill_price`
--
ALTER TABLE `radiologist_bill_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_radiologist_bill_price_radiologist` (`radiologist_id`),
  ADD KEY `FK_radiologist_bill_price_set_procedure_type` (`procedure_type_id`);

--
-- Indexes for table `radiologist_macros`
--
ALTER TABLE `radiologist_macros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_radiologist_macros_radiologist` (`radiologist_id`),
  ADD KEY `FK_radiologist_macros_set_procedure` (`procedure_id`),
  ADD KEY `FK_radiologist_macros_set_modalities` (`modality_id`);

--
-- Indexes for table `radiologist_speciality`
--
ALTER TABLE `radiologist_speciality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_radiologist_speciality_radiologist` (`radiologist_id`),
  ADD KEY `FK_radiologist_speciality_set_modalities` (`modality_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_role_user_roles` (`role_id`),
  ADD KEY `FK_role_user_users` (`user_id`);

--
-- Indexes for table `set_macros`
--
ALTER TABLE `set_macros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_set_macros_set_modalities` (`modality_id`),
  ADD KEY `FK_set_macros_set_procedure` (`procedure_id`);

--
-- Indexes for table `set_modalities`
--
ALTER TABLE `set_modalities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_modalities_users` (`created_by`);

--
-- Indexes for table `set_procedure`
--
ALTER TABLE `set_procedure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_set_procedure_set_modalities` (`modality_id`),
  ADD KEY `FK_set_procedure_set_procedure_type` (`procedure_type_id`);

--
-- Indexes for table `set_procedure_type`
--
ALTER TABLE `set_procedure_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_set_procedure_type_users` (`created_by`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_sub_menu_menu` (`fk_menu_id`);

--
-- Indexes for table `sub_sub_menu`
--
ALTER TABLE `sub_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_sub_sub_menu_sub_menu` (`fk_sub_menu_id`),
  ADD KEY `FK_sub_sub_menu_menu` (`fk_menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `FK_users_roles` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospital_assign_to_radiologist`
--
ALTER TABLE `hospital_assign_to_radiologist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospital_bill_price`
--
ALTER TABLE `hospital_bill_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hospital_entry`
--
ALTER TABLE `hospital_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospital_entry_images`
--
ALTER TABLE `hospital_entry_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `hospital_modality`
--
ALTER TABLE `hospital_modality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hospital_radiologist`
--
ALTER TABLE `hospital_radiologist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `radiologist`
--
ALTER TABLE `radiologist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `radiologist_bill_price`
--
ALTER TABLE `radiologist_bill_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `radiologist_macros`
--
ALTER TABLE `radiologist_macros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `radiologist_speciality`
--
ALTER TABLE `radiologist_speciality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `set_macros`
--
ALTER TABLE `set_macros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `set_modalities`
--
ALTER TABLE `set_modalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `set_procedure`
--
ALTER TABLE `set_procedure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `set_procedure_type`
--
ALTER TABLE `set_procedure_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `sub_sub_menu`
--
ALTER TABLE `sub_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hospital`
--
ALTER TABLE `hospital`
  ADD CONSTRAINT `FK_hospital_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_hospital_users_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `hospital_assign_to_radiologist`
--
ALTER TABLE `hospital_assign_to_radiologist`
  ADD CONSTRAINT `FK_hospital_assign_to_radiologist_hospital_entry` FOREIGN KEY (`entry_id`) REFERENCES `hospital_entry` (`id`),
  ADD CONSTRAINT `FK_hospital_assign_to_radiologist_radiologist` FOREIGN KEY (`radiologist_id`) REFERENCES `radiologist` (`id`),
  ADD CONSTRAINT `FK_hospital_assign_to_radiologist_radiologist_2` FOREIGN KEY (`pre_radiologist_id`) REFERENCES `radiologist` (`id`),
  ADD CONSTRAINT `FK_hospital_assign_to_radiologist_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `hospital_bill_price`
--
ALTER TABLE `hospital_bill_price`
  ADD CONSTRAINT `FK_hospital_bill_price_hospital` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `FK_hospital_bill_price_set_procedure_type` FOREIGN KEY (`procedure_type_id`) REFERENCES `set_procedure_type` (`id`);

--
-- Constraints for table `hospital_entry`
--
ALTER TABLE `hospital_entry`
  ADD CONSTRAINT `FK_hospital_entry_hospital` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `FK_hospital_entry_set_procedure` FOREIGN KEY (`procedure_id`) REFERENCES `set_procedure` (`id`),
  ADD CONSTRAINT `FK_hospital_entry_set_procedure_type` FOREIGN KEY (`procedure_type_id`) REFERENCES `set_procedure_type` (`id`);

--
-- Constraints for table `hospital_entry_images`
--
ALTER TABLE `hospital_entry_images`
  ADD CONSTRAINT `FK_hospital_entry_images_hospital_entry` FOREIGN KEY (`entry_id`) REFERENCES `hospital_entry` (`id`);

--
-- Constraints for table `hospital_modality`
--
ALTER TABLE `hospital_modality`
  ADD CONSTRAINT `FK_hospital_modality_hospital` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `FK_hospital_modality_set_modalities` FOREIGN KEY (`modality_id`) REFERENCES `set_modalities` (`id`);

--
-- Constraints for table `hospital_radiologist`
--
ALTER TABLE `hospital_radiologist`
  ADD CONSTRAINT `FK_hospital_radiologist_hospital` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`id`),
  ADD CONSTRAINT `FK_hospital_radiologist_radiologist` FOREIGN KEY (`radiologist_id`) REFERENCES `radiologist` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `FK_permission_role_permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `FK_permission_role_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `radiologist`
--
ALTER TABLE `radiologist`
  ADD CONSTRAINT `FK_radiologist_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_radiologist_users_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `radiologist_bill_price`
--
ALTER TABLE `radiologist_bill_price`
  ADD CONSTRAINT `FK_radiologist_bill_price_radiologist` FOREIGN KEY (`radiologist_id`) REFERENCES `radiologist` (`id`),
  ADD CONSTRAINT `FK_radiologist_bill_price_set_procedure_type` FOREIGN KEY (`procedure_type_id`) REFERENCES `set_procedure_type` (`id`);

--
-- Constraints for table `radiologist_macros`
--
ALTER TABLE `radiologist_macros`
  ADD CONSTRAINT `FK_radiologist_macros_radiologist` FOREIGN KEY (`radiologist_id`) REFERENCES `radiologist` (`id`),
  ADD CONSTRAINT `FK_radiologist_macros_set_modalities` FOREIGN KEY (`modality_id`) REFERENCES `set_modalities` (`id`),
  ADD CONSTRAINT `FK_radiologist_macros_set_procedure` FOREIGN KEY (`procedure_id`) REFERENCES `set_procedure` (`id`);

--
-- Constraints for table `radiologist_speciality`
--
ALTER TABLE `radiologist_speciality`
  ADD CONSTRAINT `FK_radiologist_speciality_radiologist` FOREIGN KEY (`radiologist_id`) REFERENCES `radiologist` (`id`),
  ADD CONSTRAINT `FK_radiologist_speciality_set_modalities` FOREIGN KEY (`modality_id`) REFERENCES `set_modalities` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `FK_role_user_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `FK_role_user_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `set_macros`
--
ALTER TABLE `set_macros`
  ADD CONSTRAINT `FK_set_macros_set_modalities` FOREIGN KEY (`modality_id`) REFERENCES `set_modalities` (`id`),
  ADD CONSTRAINT `FK_set_macros_set_procedure` FOREIGN KEY (`procedure_id`) REFERENCES `set_procedure` (`id`);

--
-- Constraints for table `set_modalities`
--
ALTER TABLE `set_modalities`
  ADD CONSTRAINT `FK_modalities_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `set_procedure`
--
ALTER TABLE `set_procedure`
  ADD CONSTRAINT `FK_set_procedure_set_modalities` FOREIGN KEY (`modality_id`) REFERENCES `set_modalities` (`id`),
  ADD CONSTRAINT `FK_set_procedure_set_procedure_type` FOREIGN KEY (`procedure_type_id`) REFERENCES `set_procedure_type` (`id`);

--
-- Constraints for table `set_procedure_type`
--
ALTER TABLE `set_procedure_type`
  ADD CONSTRAINT `FK_set_procedure_type_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD CONSTRAINT `FK_sub_menu_menu` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `sub_sub_menu`
--
ALTER TABLE `sub_sub_menu`
  ADD CONSTRAINT `FK_sub_sub_menu_menu` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `FK_sub_sub_menu_sub_menu` FOREIGN KEY (`fk_sub_menu_id`) REFERENCES `sub_menu` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_roles` FOREIGN KEY (`type`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
