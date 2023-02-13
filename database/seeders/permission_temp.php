-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 03:23 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petrol-pump-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'user_create', NULL, NULL, NULL),
(3, 'user_edit', NULL, NULL, NULL),
(4, 'user_show', NULL, NULL, NULL),
(5, 'user_delete', NULL, NULL, NULL),
(6, 'user_access', NULL, NULL, NULL),
(7, 'fuel_edit', NULL, NULL, NULL),
(8, 'fuel_access', NULL, NULL, NULL),
(9, 'fuel_management_access', NULL, NULL, NULL),
(10, 'attachement_access', NULL, NULL, NULL),
(11, 'report_editing_access', NULL, NULL, NULL),
(12, 'shift_management_access', NULL, NULL, NULL),
(13, 'discount_management_access', NULL, NULL, NULL),
(14, 'reading_management_access', NULL, NULL, NULL),
(15, 'transaction_management_access', NULL, NULL, NULL),
(16, 'billing_management_access', NULL, NULL, NULL),
(17, 'expense_management_access', NULL, NULL, NULL),
(18, 'bank_statement_management_access', NULL, NULL, NULL),
(19, 'tank_access', NULL, NULL, NULL),
(20, 'vendor_create', NULL, NULL, NULL),
(21, 'vendorFuel_access', NULL, NULL, NULL),
(22, 'client_access', NULL, NULL, NULL),
(23, 'order_access', NULL, NULL, NULL),
(24, 'role_access', NULL, NULL, NULL),
(25, 'permission_access', NULL, NULL, NULL),
(26, 'reports_access', NULL, NULL, NULL),
(27, 'petrol_station_management', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
