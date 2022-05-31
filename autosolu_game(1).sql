-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2022 at 12:33 AM
-- Server version: 10.3.34-MariaDB-log-cll-lve
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autosolu_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_money`
--

CREATE TABLE `add_money` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refference_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_money`
--

INSERT INTO `add_money` (`id`, `user_id`, `phone`, `customer_number`, `payment_method`, `amount`, `refference_no`, `transaction_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '0196900503555', '904949338355', 'bkash', '100055', '1838473627255', '1231231231555', '0', '2021-02-02 09:33:09', '2021-02-02 09:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE `bonuses` (
  `id` int(11) NOT NULL,
  `ref_bonus` varchar(255) DEFAULT NULL,
  `reg_bonus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contests`
--

CREATE TABLE `contests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `game_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `participants` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `close` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contests`
--

INSERT INTO `contests` (`id`, `game_id`, `game_code`, `title`, `date`, `time`, `status`, `amount`, `first`, `second`, `third`, `participants`, `joining_link`, `room_no`, `description`, `close`, `created_at`, `updated_at`) VALUES
(1, 1, '123', 'qweq', '2022-05-31', '12:22 AM', 1, '12', '12', '23', '34', '12', '12', '12', 'assad', 0, '2022-05-31 11:02:55', '2022-05-31 12:26:32'),
(2, 1, 'dsjfhdsfghyuj', 'gfhgfh', '2022-06-09', '12:17 AM', 1, 'gfhgfh', '1000', '500', '200', '20', 'https://play.google.com/store/apps/details?id=', '52825', 'gfhgfhgfhgfh', 0, '2022-05-31 12:18:11', '2022-05-31 12:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `contest_ratings`
--

CREATE TABLE `contest_ratings` (
  `id` int(11) UNSIGNED NOT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `star` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contest_ratings`
--

INSERT INTO `contest_ratings` (`id`, `contest_id`, `user_id`, `star`, `comments`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '5', 'good', '2021-01-11 10:09:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contest_subscriptions`
--

CREATE TABLE `contest_subscriptions` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ID_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contest_winners`
--

CREATE TABLE `contest_winners` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `winning_amount` int(11) DEFAULT NULL,
  `kill` int(11) DEFAULT NULL,
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
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) UNSIGNED NOT NULL,
  `game_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `game_name`, `package_name`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Free Fire', 'com.dts.freefireth', 'game_images/e0WYj1608656631.jpg', '2020-12-22 11:03:53', NULL),
(2, 'Ludo', 'com.gameberry.ludo.star2', 'game_images/JHchK1608656644.jpg', '2020-12-22 11:04:04', NULL);

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
(0, '2020_12_21_150845_create_contests_table', 18),
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_20_195106_create_sliders_table', 1),
(5, '2020_12_21_142435_create_games_table', 1),
(6, '2020_12_21_144437_create_trends_table', 1),
(16, '2020_12_25_161321_create_test_models_table', 5),
(20, '2020_12_26_143129_create_package_requests_table', 7),
(28, '2021_01_11_064325_create_contest_ratings_table', 11),
(30, '2021_01_11_173737_create_payments_table', 12),
(31, '2020_12_26_122245_create_packages_table', 13),
(32, '2020_12_23_172401_create_with_draws_table', 14),
(33, '2020_12_23_184620_create_add_money_table', 15),
(38, '2020_12_21_190207_create_contest_subscriptions_table', 17),
(39, '2020_12_22_171905_create_contest_winners_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `diamond` double DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `image`, `game_id`, `title`, `amount`, `diamond`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'package_images/Uexaf1654015953.png', 1, 'asdasd', 231, 321, 'sdasd', 1, '2022-05-31 10:52:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_requests`
--

CREATE TABLE `package_requests` (
  `id` int(11) UNSIGNED NOT NULL,
  `pakage_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `username_email_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_requests`
--

INSERT INTO `package_requests` (`id`, `pakage_id`, `user_id`, `amount`, `username_email_contact`, `password`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 500, 'asdasd', 'asdasdasd', '1', NULL, '2021-02-02 13:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `number`, `type`, `description`, `created_at`, `updated_at`) VALUES
(2, '738535338323', 'rocket', 'Rocket Number', NULL, NULL),
(3, '894839375532', 'nagad', 'Nogod Number', NULL, NULL),
(4, '2342342342432', 'bkash', 'Testing Number', '2021-01-12 10:52:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'slider_images/pb4HA1654020988.png', '2022-05-31 12:16:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trends`
--

INSERT INTO `trends` (`id`, `title`, `description`, `game_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'asdsad', 1, 'trend_images/YTsWC1654016547.png', '2022-05-31 11:02:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `winning_amount` double DEFAULT 0,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ban_day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `image`, `department`, `semester`, `profession`, `details`, `amount`, `winning_amount`, `referral_code`, `ban`, `ban_day`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fahim', 'demo@game.com', '01969005035', NULL, '$2y$10$e8Q0yJTcq8f8MRdN0tmF1.bGd72nIMapNaB1FuH47b3zN81ozRNxm', 'admin', 'profile_images/aU8Ni1608906639.jpg', 'CSE', '4', NULL, NULL, 1366796, 9549, '123', '0', NULL, NULL, '2020-12-22 10:54:01', '2022-05-31 12:28:21'),
(2, 'Fahad', 'fahad@gmail.com', '01969005036', NULL, '$2y$10$WPpbKnptKIsRI9G3kAPS.u63V14tDOZtptpP8kWYZ9a2ihbWZGPta', NULL, NULL, 'asdas', '12', 'dede', 'efef', -1375280, 0, '123', '0', NULL, NULL, '2020-12-22 14:20:36', '2022-05-31 12:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `with_draws`
--

CREATE TABLE `with_draws` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refference_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `with_draws`
--

INSERT INTO `with_draws` (`id`, `user_id`, `phone`, `customer_number`, `payment_method`, `amount`, `refference_no`, `transaction_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, '9049493383', 'bkash', '1000', '18384736272', NULL, '2', '2021-01-13 10:00:23', '2022-05-31 12:28:21'),
(3, 1, NULL, '9049493383', 'bkash', '1000', '18384736272', NULL, '0', '2021-01-13 10:00:31', NULL),
(4, 1, '2342342342432', '9049493383', 'bkash', '1000', '18384736272', NULL, '1', '2021-01-13 10:00:33', '2022-05-31 12:28:08'),
(5, 1, NULL, '9049493383', 'bkash', '1000', '18384736272', NULL, '2', '2021-01-13 10:00:37', '2021-01-13 10:33:25'),
(6, 1, '01969005035', '9049493383', 'bkash', '1000', '18384736272', '12312123123', '1', '2021-01-13 10:01:04', '2022-05-31 12:28:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_money`
--
ALTER TABLE `add_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contests`
--
ALTER TABLE `contests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest_ratings`
--
ALTER TABLE `contest_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest_subscriptions`
--
ALTER TABLE `contest_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest_winners`
--
ALTER TABLE `contest_winners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_requests`
--
ALTER TABLE `package_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trends`
--
ALTER TABLE `trends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `with_draws`
--
ALTER TABLE `with_draws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_money`
--
ALTER TABLE `add_money`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contests`
--
ALTER TABLE `contests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contest_ratings`
--
ALTER TABLE `contest_ratings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contest_subscriptions`
--
ALTER TABLE `contest_subscriptions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contest_winners`
--
ALTER TABLE `contest_winners`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package_requests`
--
ALTER TABLE `package_requests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trends`
--
ALTER TABLE `trends`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `with_draws`
--
ALTER TABLE `with_draws`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
