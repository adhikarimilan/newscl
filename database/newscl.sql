-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2020 at 03:06 AM
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
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `gender`, `active`, `password`, `remember_token`, `verification_code`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'milan Adk', 'milan123ma70@gmail.com', 0, 0, '$2y$10$vJMe7osJxUtLr5tMJElT8Od2dQed/ywY6UNxpRgANrVeMNvqLR/7i', 'H10IPMQgArqGx2l0fLp2J7EiDrVGszboDje1cUX1vs5RZH4VQFcr5yb0m5oI', NULL, NULL, '2019-12-30 18:15:00', '2020-09-23 23:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_till` date DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `teacher_id`, `name`, `submitted_till`, `description`, `file`, `class_id`, `created_at`, `updated_at`, `section_id`) VALUES
(1, 7, 'Mac Machine', '2020-09-25', 'fddfs', 'uploads/assignments/assignment3163-20200922_080758.pdf', 9, '2020-09-22 01:01:54', '2020-09-22 02:22:58', NULL),
(2, 8, 'new assignment', '2020-10-23', 'new desc', 'uploads/assignments/assignment4027-20200922_040303.pdf', 7, '2020-09-22 10:18:03', '2020-10-05 07:06:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookcategories`
--

CREATE TABLE `bookcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookcategories`
--

INSERT INTO `bookcategories` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(5, 'CS', 'great cate', NULL, '2020-09-05 01:41:35', '2020-09-14 01:45:12'),
(6, 'Civil', 'civil engineering bk', NULL, '2020-09-08 23:34:03', '2020-09-08 23:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `rack_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchased_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `pic`, `author`, `stock`, `rack_no`, `category_id`, `purchased_at`, `created_at`, `updated_at`) VALUES
(1, 'Programming in C', 'uploads/books/9451-2020-0905-05-1599303918.jpg', 'Balagurusamy', 10, '1', 5, '2020-09-03', '2020-09-05 04:17:23', '2020-09-13 04:00:08'),
(2, 'C++', NULL, 'Balagurusamy', 10, '1', 5, '2020-09-02', '2020-09-05 04:46:10', '2020-09-05 04:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 30,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `description`, `shift`, `order`, `active`, `image`, `class_teacher_id`, `created_at`, `updated_at`) VALUES
(6, 'Nursery', 'this is class nursery', '1', 30, 1, NULL, NULL, '2020-04-18 00:17:50', '2020-07-16 23:12:40'),
(7, 'LKG', 'lower kids group', '1', 3, 1, NULL, 7, '2020-04-19 03:40:19', '2020-04-19 03:41:57'),
(8, 'class 1', 'this is class 1 guys', '1', 12, 1, NULL, NULL, '2020-07-22 03:17:25', '2020-07-22 03:17:25'),
(9, 'Class 2', 'class two', '1', 1, 1, NULL, NULL, '2020-09-08 09:44:35', '2020-09-26 00:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts` datetime DEFAULT NULL,
  `ends` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extrasubs`
--

CREATE TABLE `extrasubs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_hour` int(11) DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extrasub_student`
--

CREATE TABLE `extrasub_student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `extrasub_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issuebooks`
--

CREATE TABLE `issuebooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isteacher` tinyint(1) NOT NULL DEFAULT 0,
  `returned` tinyint(1) NOT NULL DEFAULT 0,
  `book_id` bigint(20) UNSIGNED DEFAULT NULL,
  `issued_at` date NOT NULL,
  `return_bef` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issuebooks`
--

INSERT INTO `issuebooks` (`id`, `student_id`, `teacher_id`, `isteacher`, `returned`, `book_id`, `issued_at`, `return_bef`) VALUES
(5, '5', NULL, 0, 0, 1, '2020-09-06', '2020-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_01_09_082137_create_admins_table', 1),
(5, '2020_01_09_082138_create_admin_password_resets_table', 1),
(6, '2020_01_11_164657_create_subjects_table', 1),
(7, '2020_01_11_164712_create_classes_table', 1),
(8, '2020_01_11_164809_create_parents_table', 1),
(9, '2020_01_11_164906_create_students_table', 1),
(10, '2020_01_11_165213_create_student_parent_table', 1),
(11, '2020_01_11_165405_create_teachers_table', 1),
(12, '2020_01_11_170016_create_assignments_table', 2),
(13, '2020_01_11_170257_create_chats_table', 2),
(14, '2020_01_11_170602_create_extrasubs_table', 2),
(15, '2020_01_12_064825_create_exams_table', 2),
(16, '2020_01_13_122027_create_studentattendances_table', 2),
(17, '2020_01_13_122256_create_teacherattendances_table', 2),
(18, '2020_01_13_134706_create_schoolevents_table', 2),
(19, '2020_04_10_102220_create_downloads_table', 2),
(20, '2020_04_10_102451_create_galleries_table', 2),
(21, '2020_04_10_103125_create_notifications_table', 2),
(22, '2020_04_15_095743_create_parent_password_resets', 3),
(23, '2020_04_15_102637_create_teacher_password_resets', 3),
(24, '2020_04_15_102727_create_student_password_resets', 3),
(25, '2020_04_16_061109_create_sections_table', 3),
(26, '2020_04_16_070123_create_extrasub_student_table', 3),
(27, '2020_40_16_132354_add_class_id_to_students', 3),
(28, '2020_09_04_050731_create_bookcategories_table', 4),
(29, '2020_09_04_055759_create_books_table', 4),
(30, '2020_09_04_060608_create_issuebooks_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `name`, `gender`, `address`, `occupation`, `avatar`, `active`, `email`, `contact`, `email_verified_at`, `password`, `verification_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Donald Trump', 2, 'Brt', 'farmer', 'uploads/parents/6805-2020-0904-04-1599240610.jpg', 1, 'trump@us.us', '987654321', NULL, 'ckz', NULL, NULL, '2019-12-30 18:15:00', '2020-09-04 11:45:10'),
(9, 'Lionel Messi', 0, 'Brt', 'Player', 'uploads/parents/7617-2020-0924-24-1600962956.jpg', 1, 'milan123ma70@gmail.com', '9876543210', NULL, '$2y$10$uX6fSHqWS.vwg/yxbsN0beNsCcGeOm33izW1B.lqUNkyuzV4JPCRG', NULL, 'Dr8j6PwdIkpLjaAiKXtEXUCbShcMo99k897NkeBF3g3us5OwhiBagdE3w2yr', '2020-09-06 09:31:59', '2020-09-24 10:10:56'),
(10, 'Christiano Ronaldo', 0, 'Brt', 'Player', 'uploads/parents/4410-2020-0906-06-1599406011.jpg', 1, 'milan1230@gmail.com', '9876543210', NULL, 'milanadk', NULL, NULL, '2020-09-06 09:41:28', '2020-09-06 09:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `parent_password_resets`
--

CREATE TABLE `parent_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('milan123ma70@gmail.com', '$2y$10$05EGF/eZV.pgATX2o0OqI.sLXkFejiCE6doCb9BhNMIqT7lRHjw1y', '2020-09-23 09:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `schoolevents`
--

CREATE TABLE `schoolevents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `class_id`, `created_at`, `updated_at`) VALUES
(7, 'small', 7, '2020-04-19 03:43:11', '2020-04-19 03:43:11'),
(8, 'large', 7, '2020-04-19 03:43:11', '2020-04-19 03:43:11'),
(10, 'nur1', 6, '2020-04-21 02:16:51', '2020-04-21 02:16:51'),
(11, 'nur2', 6, '2020-04-21 02:16:51', '2020-04-21 02:16:51');

-- --------------------------------------------------------

--
-- Table structure for table `studentattendances`
--

CREATE TABLE `studentattendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `class_id` bigint(20) DEFAULT NULL,
  `section_id` bigint(20) DEFAULT NULL,
  `present` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentattendances`
--

INSERT INTO `studentattendances` (`id`, `student_id`, `class_id`, `section_id`, `present`, `created_at`, `updated_at`) VALUES
(3, 5, 7, 7, 1, '2020-07-28 09:39:08', '2020-07-28 09:39:08'),
(4, 6, 7, NULL, 0, '2020-07-28 09:39:08', '2020-07-28 10:38:09'),
(5, 8, 7, 7, 1, '2020-07-28 09:39:08', '2020-07-28 10:38:09'),
(6, 5, 7, 7, 1, '2020-08-13 10:13:28', '2020-08-13 10:13:28'),
(7, 6, 7, NULL, 0, '2020-08-13 10:13:28', '2020-08-13 10:13:28'),
(8, 8, 7, 7, 1, '2020-08-13 10:13:28', '2020-08-13 10:13:28'),
(9, 9, 7, 10, 1, '2020-09-03 02:45:40', '2020-09-03 02:45:40'),
(10, 5, 7, 7, 0, '2020-09-03 02:45:40', '2020-09-03 02:45:40'),
(11, 6, 7, NULL, 1, '2020-09-03 02:45:40', '2020-09-03 02:45:40'),
(12, 8, 7, 7, 1, '2020-09-03 02:45:41', '2020-09-03 02:45:41'),
(13, 9, 7, 10, 0, '2020-09-06 03:28:27', '2020-09-06 03:28:27'),
(14, 5, 7, 7, 1, '2020-09-06 03:28:27', '2020-09-06 03:28:27'),
(15, 6, 7, NULL, 1, '2020-09-06 03:28:27', '2020-09-06 03:28:27'),
(16, 8, 7, 7, 1, '2020-09-06 03:28:27', '2020-09-06 03:28:27'),
(17, 14, 7, 7, 0, '2020-09-06 03:28:27', '2020-09-06 03:28:27'),
(18, 7, 8, NULL, 0, '2020-09-06 05:45:01', '2020-09-06 05:45:01'),
(19, 3, 7, NULL, 1, '2020-09-06 05:45:01', '2020-09-06 05:45:01'),
(20, 9, 7, 10, 1, '2020-09-08 01:44:24', '2020-09-08 01:44:24'),
(21, 5, 7, 7, 1, '2020-09-08 01:44:25', '2020-09-08 01:44:25'),
(22, 6, 7, NULL, 0, '2020-09-08 01:44:25', '2020-09-08 02:18:23'),
(23, 8, 7, 7, 1, '2020-09-08 01:44:25', '2020-09-08 01:44:25'),
(24, 14, 7, 7, 1, '2020-09-08 01:44:25', '2020-09-08 01:44:25'),
(25, 9, 7, 10, 1, '2020-09-14 02:42:42', '2020-09-14 02:42:42'),
(26, 5, 7, 7, 0, '2020-09-14 02:42:42', '2020-09-14 02:42:42'),
(27, 6, 7, NULL, 1, '2020-09-14 02:42:42', '2020-09-14 02:42:42'),
(28, 8, 7, 7, 0, '2020-09-14 02:42:42', '2020-09-14 02:42:42'),
(29, 14, 7, 7, 1, '2020-09-14 02:42:42', '2020-09-14 02:42:42'),
(30, 9, 7, 10, 1, '2020-09-22 09:07:49', '2020-09-22 09:07:49'),
(31, 5, 7, 7, 0, '2020-09-22 09:07:49', '2020-09-22 09:07:49'),
(32, 6, 7, NULL, 1, '2020-09-22 09:07:49', '2020-09-22 09:07:49'),
(33, 8, 7, 7, 0, '2020-09-22 09:07:49', '2020-09-22 09:07:49'),
(34, 14, 7, 7, 1, '2020-09-22 09:07:49', '2020-09-22 09:07:49'),
(35, 9, 7, 10, 1, '2020-09-24 01:18:45', '2020-09-24 01:18:45'),
(36, 5, 7, 7, 1, '2020-09-24 01:18:45', '2020-09-24 01:18:45'),
(37, 6, 7, NULL, 0, '2020-09-24 01:18:45', '2020-09-24 01:18:45'),
(38, 8, 7, 7, 1, '2020-09-24 01:18:45', '2020-09-24 01:18:45'),
(39, 14, 7, 7, 1, '2020-09-24 01:18:45', '2020-09-24 01:18:45'),
(40, 9, 7, 10, 1, '2020-09-25 04:08:25', '2020-09-25 04:08:25'),
(41, 3, 7, NULL, 1, '2020-09-25 04:08:25', '2020-09-25 04:08:25'),
(42, 5, 7, 7, 0, '2020-09-25 04:08:25', '2020-09-25 04:08:25'),
(43, 6, 7, NULL, 1, '2020-09-25 04:08:26', '2020-09-25 04:08:26'),
(44, 8, 7, 7, 1, '2020-09-25 04:08:26', '2020-09-25 04:08:26'),
(45, 14, 7, 7, 0, '2020-09-25 04:08:26', '2020-09-25 04:08:26'),
(46, 9, 7, 10, 1, '2020-09-25 23:40:57', '2020-09-25 23:40:57'),
(47, 3, 7, NULL, 1, '2020-09-25 23:40:57', '2020-09-25 23:40:57'),
(48, 5, 7, 7, 1, '2020-09-25 23:40:57', '2020-09-25 23:40:57'),
(49, 6, 7, NULL, 0, '2020-09-25 23:40:58', '2020-09-25 23:40:58'),
(50, 8, 7, 7, 1, '2020-09-25 23:40:58', '2020-09-25 23:40:58'),
(51, 14, 7, 7, 1, '2020-09-25 23:40:58', '2020-09-25 23:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob_bs` date DEFAULT NULL,
  `dob_ad` date DEFAULT NULL,
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL,
  `roll_no` int(11) DEFAULT NULL,
  `per_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `dob_bs`, `dob_ad`, `bio`, `gender`, `roll_no`, `per_address`, `temp_address`, `faculty`, `avatar`, `active`, `email`, `contact`, `email_verified_at`, `verification_code`, `password`, `remember_token`, `created_at`, `updated_at`, `class_id`, `section_id`) VALUES
(3, 'Hemraz Dhakal', '2054-09-04', '1997-12-19', 'loves makes life lives', 0, 11, 'ktm', 'Brt', NULL, 'uploads/students/8576-2020-0906-06-1599388841.png', 1, 'milan123ma70@gmail.com', '9876543210', NULL, NULL, '$2y$10$GCFUZS1/cdLICCa6Lnaj0OL0pi2.WY2JtO74iexa/xSHtMqZkNsOO', NULL, '2020-04-17 21:50:36', '2020-10-05 09:47:07', 7, NULL),
(5, 'JY STHA', '0000-00-00', NULL, NULL, 2, 12, 'Govindapur', 'Brt', NULL, NULL, 1, 'milan123ma7@gmail.com', '9876543210', NULL, NULL, NULL, NULL, '2020-04-21 02:17:40', '2020-04-21 02:18:16', 7, 7),
(6, 'Mahesh kalu', NULL, NULL, NULL, 2, 12, 'brt', 'Brt', NULL, NULL, 1, 'milan123ma70@gma.com', '9876543210', NULL, NULL, '$2y$10$ckox0Ey/bYTpART.3KKYaucivhr4ds5cRKEt9xTWPP14jamK.gOcC', NULL, '2020-07-22 01:03:35', '2020-07-22 01:03:35', 7, NULL),
(7, 'Makar lal', NULL, NULL, NULL, 1, 10, 'nepla', 'Brt', NULL, NULL, 1, 'milan123ma@gmail.com', '9876543210', NULL, NULL, '$2y$10$odRFS2vRH2gi/LN94/nvI.Qd.DQsDmgt6V9u0MmyyZ3uUD4TiQle2', NULL, '2020-07-22 03:21:15', '2020-07-22 03:28:00', 8, NULL),
(8, 'Mac Mach', NULL, NULL, NULL, 2, 12, NULL, 'Brt', NULL, NULL, 1, 'milan123ma0@gmail.com', '9876543210', NULL, NULL, '$2y$10$4n2xUnYA4sW9GZM0DW8a2uZ5Q4tNPANF8/YCi4.ir6gD2HHzp.UXa', NULL, '2020-07-22 03:28:37', '2020-07-22 03:28:37', 7, 7),
(9, 'JY ST', NULL, NULL, NULL, 2, NULL, NULL, 'Brt', NULL, NULL, 1, 'milan123m@gmail.com', '9876543210', NULL, NULL, NULL, NULL, '2020-07-22 03:30:02', '2020-07-28 08:37:30', 7, 10),
(14, 'Manish Pal', NULL, NULL, NULL, 2, 15, 'brt', 'Brt', NULL, 'uploads/students/3754-2020-0904-04-1599239751.jpg', 1, 'milan12ma0@gmail.com', '9876543220', NULL, NULL, NULL, NULL, '2020-09-04 11:30:51', '2020-09-04 11:30:51', 7, 7),
(15, 'Raman Yadav', NULL, NULL, NULL, 2, 2, 'Biratnagar', 'Brt', NULL, 'uploads/students/3629-2020-0908-08-1599581363.jpg', 1, 'milan13m@gmail.com', '9876543210', NULL, NULL, NULL, NULL, '2020-09-08 10:23:56', '2020-09-08 10:24:24', 9, NULL),
(17, 'Manish Pal', NULL, NULL, NULL, 0, 2, 'brt', 'Brt', NULL, 'uploads/students/4478-2020-0908-08-1599581628.jpg', 1, 'milan123ma70a@gmail.com', '9876543210', NULL, NULL, 'milanadk', NULL, '2020-09-08 10:28:48', '2020-09-08 10:28:48', 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_parent`
--

CREATE TABLE `student_parent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `relation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_parent`
--

INSERT INTO `student_parent` (`id`, `parent_id`, `student_id`, `relation`, `created_at`, `updated_at`) VALUES
(20, 1, 6, 'Father', '2020-09-03 09:54:08', '2020-09-03 09:54:08'),
(22, 9, 3, 'Father', '2020-09-06 09:35:21', '2020-09-06 09:35:21'),
(25, 1, 5, 'Mother', '2020-09-07 03:11:24', '2020-09-07 03:11:24'),
(26, 9, 15, 'Father', '2020-09-25 03:31:31', '2020-09-25 03:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `student_password_resets`
--

CREATE TABLE `student_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_hour` int(11) DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 30,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacherattendances`
--

CREATE TABLE `teacherattendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `present` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacherattendances`
--

INSERT INTO `teacherattendances` (`id`, `teacher_id`, `present`, `created_at`, `updated_at`) VALUES
(5, 7, 1, '2020-07-21 10:39:12', '2020-09-08 01:39:25'),
(6, 8, 1, '2020-07-21 10:39:12', '2020-09-08 02:13:24'),
(7, 7, 1, '2020-07-22 10:40:44', '2020-07-22 10:40:44'),
(8, 8, 0, '2020-07-22 10:40:44', '2020-07-22 10:40:44'),
(9, 7, 1, '2020-07-24 01:37:26', '2020-07-24 01:37:26'),
(10, 8, 1, '2020-07-24 01:37:26', '2020-07-24 01:37:26'),
(11, 7, 1, '2020-07-28 03:38:26', '2020-07-28 03:38:26'),
(12, 8, 1, '2020-07-28 03:38:26', '2020-07-28 03:38:26'),
(25, 7, 1, '2020-09-08 01:28:05', '2020-09-08 02:18:53'),
(26, 8, 0, '2020-09-08 01:28:05', '2020-09-08 02:18:44'),
(27, 7, 0, '2020-09-13 20:50:26', '2020-09-13 20:50:43'),
(28, 8, 1, '2020-09-13 20:50:26', '2020-09-13 20:50:36'),
(29, 7, 1, '2020-09-26 03:12:55', '2020-09-26 03:14:07'),
(30, 8, 1, '2020-09-26 03:12:55', '2020-09-26 03:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL,
  `dob_bs` date DEFAULT NULL,
  `dob_ad` date DEFAULT NULL,
  `per_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temp_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 30,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `bio`, `gender`, `dob_bs`, `dob_ad`, `per_address`, `temp_address`, `education`, `faculty`, `avatar`, `post`, `type`, `active`, `email`, `contact`, `email_verified_at`, `password`, `remember_token`, `order`, `created_at`, `updated_at`) VALUES
(7, 'Mac Machine', NULL, 0, NULL, NULL, 'nepla', 'Brt', 'Msc in quantum phy', 'Science', 'uploads/teachers/3597-2020-0904-04-1599238233.jpg', 'Engineer', NULL, 1, 'milan123@tt', '98765432105', NULL, NULL, NULL, 30, '2020-04-17 22:52:26', '2020-09-04 11:05:33'),
(8, 'Milan Kumar Adhikari', NULL, 1, '2054-09-04', '1997-12-19', 'brt', 'Brt', 'Masters in Economics', 'Management', 'uploads/teachers/3957-2020-0926-26-1601097877.jpg', 'Marketing Manager', NULL, 1, 'milan123ma70@gmail.com', '9876543210', NULL, '$2y$10$TuikKNbSRsOegk/SE0EVquGgrIV7VV.nZVr9EUFD9KN4k5QTUUWFa', 'DApaeBtGCkpC02EccncKeP1cR7gQ4hxD2yM7eHyyRrkxmETd2Q3A0MGyA0UM', 30, '2020-07-16 22:40:46', '2020-09-26 01:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_password_resets`
--

CREATE TABLE `teacher_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_password_resets`
--

INSERT INTO `teacher_password_resets` (`email`, `token`, `created_at`) VALUES
('milan123ma70@gmail.com', '$2y$10$leQY9wsWRi0yCC2At9vSvOReArT75wMyTg41yEIS8Mle/ThqvxJX2', '2020-09-23 23:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'milan', 'milan123ma70@gmail.com', '2020-04-16 18:15:00', '$2y$10$nUuSkJO4.Z4JNhdUzINyR./S8i9FDRf23aZXAfAaaAvUD1Ic2YmMS', NULL, '2019-12-30 18:15:00', '2019-11-28 18:15:00'),
(2, 'cvxcb', 'milan123@tt', NULL, 'vcxc c', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_verification_code_unique` (`verification_code`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`),
  ADD KEY `admin_password_resets_token_index` (`token`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignments_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `bookcategories`
--
ALTER TABLE `bookcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extrasubs`
--
ALTER TABLE `extrasubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extrasubs_class_id_foreign` (`class_id`);

--
-- Indexes for table `extrasub_student`
--
ALTER TABLE `extrasub_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extrasub_student_extrasub_id_foreign` (`extrasub_id`),
  ADD KEY `extrasub_student_student_id_foreign` (`student_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuebooks`
--
ALTER TABLE `issuebooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issuebooks_book_id_foreign` (`book_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parents_email_unique` (`email`),
  ADD UNIQUE KEY `parents_verification_code_unique` (`verification_code`);

--
-- Indexes for table `parent_password_resets`
--
ALTER TABLE `parent_password_resets`
  ADD KEY `parent_password_resets_email_index` (`email`),
  ADD KEY `parent_password_resets_token_index` (`token`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `schoolevents`
--
ALTER TABLE `schoolevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_class_id_foreign` (`class_id`);

--
-- Indexes for table `studentattendances`
--
ALTER TABLE `studentattendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentattendances_student_id_foreign` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_verification_code_unique` (`verification_code`),
  ADD KEY `students_class_id_foreign` (`class_id`),
  ADD KEY `students_section_id_foreign` (`section_id`);

--
-- Indexes for table `student_parent`
--
ALTER TABLE `student_parent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_parent_parent_id_foreign` (`parent_id`),
  ADD KEY `student_parent_student_id_foreign` (`student_id`);

--
-- Indexes for table `student_password_resets`
--
ALTER TABLE `student_password_resets`
  ADD KEY `student_password_resets_email_index` (`email`),
  ADD KEY `student_password_resets_token_index` (`token`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacherattendances`
--
ALTER TABLE `teacherattendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacherattendances_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_contact_unique` (`contact`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`);

--
-- Indexes for table `teacher_password_resets`
--
ALTER TABLE `teacher_password_resets`
  ADD KEY `teacher_password_resets_email_index` (`email`),
  ADD KEY `teacher_password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookcategories`
--
ALTER TABLE `bookcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extrasubs`
--
ALTER TABLE `extrasubs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extrasub_student`
--
ALTER TABLE `extrasub_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issuebooks`
--
ALTER TABLE `issuebooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schoolevents`
--
ALTER TABLE `schoolevents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `studentattendances`
--
ALTER TABLE `studentattendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student_parent`
--
ALTER TABLE `student_parent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacherattendances`
--
ALTER TABLE `teacherattendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `bookcategories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `extrasubs`
--
ALTER TABLE `extrasubs`
  ADD CONSTRAINT `extrasubs_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `extrasub_student`
--
ALTER TABLE `extrasub_student`
  ADD CONSTRAINT `extrasub_student_extrasub_id_foreign` FOREIGN KEY (`extrasub_id`) REFERENCES `extrasubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `extrasub_student_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `issuebooks`
--
ALTER TABLE `issuebooks`
  ADD CONSTRAINT `issuebooks_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `studentattendances`
--
ALTER TABLE `studentattendances`
  ADD CONSTRAINT `studentattendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `students_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `student_parent`
--
ALTER TABLE `student_parent`
  ADD CONSTRAINT `student_parent_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_parent_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacherattendances`
--
ALTER TABLE `teacherattendances`
  ADD CONSTRAINT `teacherattendances_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
