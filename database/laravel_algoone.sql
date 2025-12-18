-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2025 at 10:57 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_algoone`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cta_sections`
--

CREATE TABLE `cta_sections` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cta_sections`
--

INSERT INTO `cta_sections` (`id`, `title`, `description`, `button_text`, `button_link`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ready to Start Trading?', 'Join hundreds of traders who trust AlgoOne with their prop firm accounts.', 'Create Free Account', '#', 1, '2025-12-18 03:41:03', '2025-12-18 04:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hero_sections`
--

CREATE TABLE `hero_sections` (
  `id` bigint UNSIGNED NOT NULL,
  `badge_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traders_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_cta_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signin_cta_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `myfxbook_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payout_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `primary_cta_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signin_cta_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `myfxbook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payout_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_sections`
--

INSERT INTO `hero_sections` (`id`, `badge_text`, `title`, `description`, `rating`, `traders_count`, `primary_cta_text`, `signin_cta_text`, `myfxbook_text`, `payout_text`, `is_active`, `created_at`, `updated_at`, `primary_cta_link`, `signin_cta_link`, `myfxbook_link`, `payout_link`) VALUES
(1, 'WE ONLY MAKE MONEY WHEN YOU MAKE MONEY', '<span class=\"block mb-2\">Professional</span><span class=\"block bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 bg-clip-text text-transparent\">Prop Firm Trading</span>', 'We pass your prop firm challenges with precision and get you funded. Zero risk - if we fail, we refund you + $500.', '5.0 Rating', '500+ traders', 'Start Trading Now', 'Sign In', 'Check Myfxbook', 'Check Payouts', 1, '2025-12-18 01:12:35', '2025-12-18 01:18:40', '/', '/sign-in', '/official-myfxbooks', '/payout');

-- --------------------------------------------------------

--
-- Table structure for table `how_it_works_sections`
--

CREATE TABLE `how_it_works_sections` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step1_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step1_description` text COLLATE utf8mb4_unicode_ci,
  `step1_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step2_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step2_description` text COLLATE utf8mb4_unicode_ci,
  `step2_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step3_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step3_description` text COLLATE utf8mb4_unicode_ci,
  `step3_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `how_it_works_sections`
--

INSERT INTO `how_it_works_sections` (`id`, `title`, `subtitle`, `step1_title`, `step1_description`, `step1_image`, `step2_title`, `step2_description`, `step2_image`, `step3_title`, `step3_description`, `step3_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'How It Works', 'Three simple steps to success', 'Get Your Challenge', '<p>Purchase a prop firm challenge from a trusted firm. We cover 30% of the challenge fee to reduce your upfront cost.</p>', 'uploads/how_it_works/1766049810_step1_image.png', 'We Pass It', 'Our expert traders pass your challenge with precision and discipline. If we fail, you get a full refund + $500 guarantee.', 'uploads/how_it_works/1766049810_step2_image.png', 'Get Your Payout', 'You receive your payout from the prop firm. We take 30% of what you take home – only when you profit.', 'uploads/how_it_works/1766049810_step3_image.png', 1, '2025-12-18 02:36:02', '2025-12-18 03:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_17_065808_create_trading_accounts_table', 2),
(5, '2025_12_18_053008_create_topbars_table', 3),
(6, '2025_12_18_070552_create_hero_sections_table', 4),
(9, '2025_12_18_071454_add_links_to_hero_sections_table', 5),
(10, '2025_12_18_072111_create_signal_sections_table', 6),
(11, '2025_12_18_083453_create_how_it_works_sections_table', 7),
(12, '2025_12_18_084929_create_results_sections_table', 8),
(13, '2025_12_18_090505_create_why_choose_sections_table', 9),
(14, '2025_12_18_093002_create_referral_sections_table', 10),
(15, '2025_12_18_094032_create_cta_sections_table', 11),
(16, '2025_12_18_101820_create_site_settings_table', 12),
(17, '2025_12_18_103439_add_favicon_to_site_settings_table', 13),
(18, '2025_12_18_103544_add_favicon_to_site_settings_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_sections`
--

CREATE TABLE `referral_sections` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `tiers` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_sections`
--

INSERT INTO `referral_sections` (`id`, `title`, `subtitle`, `button_text`, `button_link`, `is_active`, `tiers`, `created_at`, `updated_at`) VALUES
(1, 'Referral Program', 'Earn free funding and revenue share by referring traders.', 'Learn More About Referrals', '/referrals-public', 1, '[{\"icon\": \"assets/image/group.png\", \"name\": \"Basic Tier\", \"range\": \"0-2 referrals\", \"benefits\": [{\"icon\": \"assets/image/gift (2).png\", \"text\": \"Get the same account size your referral receives\"}, {\"icon\": \"assets/image/trend (4).png\", \"text\": \"Earn 10% of every payout\"}], \"badge_icon\": null, \"badge_text\": null}, {\"icon\": \"assets/image/crown (1).png\", \"name\": \"Premium Tier\", \"range\": \"2-5 referrals\", \"benefits\": [{\"icon\": \"assets/image/gift (1).png\", \"text\": \"FREE <span class=\\\"text-blue-600 font-bold\\\">$100K</span> account bonus\"}, {\"icon\": \"assets/image/trend (3).png\", \"text\": \"Earn <span class=\\\"text-blue-600 font-bold\\\">15%</span> of every payout\"}], \"badge_icon\": null, \"badge_text\": \"POPULAR\"}, {\"icon\": \"assets/image/flash (1).png\", \"name\": \"Platinum\", \"range\": \"5+ referrals\", \"benefits\": [{\"icon\": \"assets/image/wallet (1).png\", \"text\": \"<span class=\\\"font-bold text-amber-600\\\">50% off</span> funding increases\"}, {\"icon\": \"assets/image/gift (1).png\", \"text\": \"FREE <span class=\\\"font-bold text-amber-600\\\">$200K</span> account\"}, {\"icon\": \"assets/image/crown (1).png\", \"text\": \"Priority managed accounts\"}], \"badge_icon\": \"assets/image/diamond.png\", \"badge_text\": \"ELITE\"}]', '2025-12-18 03:30:42', '2025-12-18 03:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `results_sections`
--

CREATE TABLE `results_sections` (
  `id` bigint UNSIGNED NOT NULL,
  `badge_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disclaimer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_subtext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_total_gain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_balance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_daily` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_monthly` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_drawdown` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_profit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_deposits` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc1_platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_subtext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_total_gain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_balance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_daily` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_monthly` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_drawdown` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_profit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_deposits` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc2_platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_subtext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_total_gain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_balance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_daily` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_monthly` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_drawdown` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_profit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_deposits` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc3_platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary_title` text COLLATE utf8mb4_unicode_ci,
  `summary_description` text COLLATE utf8mb4_unicode_ci,
  `view_results_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_results_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `myfxbook_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `myfxbook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payout_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payout_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results_sections`
--

INSERT INTO `results_sections` (`id`, `badge_text`, `title`, `subtitle`, `disclaimer`, `acc1_name`, `acc1_subtext`, `acc1_total_gain`, `acc1_balance`, `acc1_daily`, `acc1_monthly`, `acc1_drawdown`, `acc1_profit`, `acc1_deposits`, `acc1_platform`, `acc2_name`, `acc2_subtext`, `acc2_total_gain`, `acc2_balance`, `acc2_daily`, `acc2_monthly`, `acc2_drawdown`, `acc2_profit`, `acc2_deposits`, `acc2_platform`, `acc3_name`, `acc3_subtext`, `acc3_total_gain`, `acc3_balance`, `acc3_daily`, `acc3_monthly`, `acc3_drawdown`, `acc3_profit`, `acc3_deposits`, `acc3_platform`, `summary_title`, `summary_description`, `view_results_text`, `view_results_link`, `myfxbook_text`, `myfxbook_link`, `payout_text`, `payout_link`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Performance Tracking', 'Proven Track Record', 'Real accounts, real results. All our trading performance is third-party tracked and monitored.', '\"All results shown are from virtual demo accounts and do not represent real profits or guaranteed returns.\"', 'Account #1', 'Verified', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Account #2', 'Verified', '+325.97%', '$136,250.22', '0.08%', '2.51%', '3.51%', '$240,980.38', '$250,000.00', 'Blueberry MT5', 'Account #3', 'Verified', '+56.26%', '$110,904.26', '0.21%', '4.03%', '2.89%', '$420,115.63', '$1,139,530.06', 'ICMarkets MT4', 'Over <span class=\"bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent\">$815K</span> in Demo Performance', 'Our algorithms have generated consistent returns across multiple virtual demo accounts. Track our verified performance and see real results.', 'View All Results', '#', 'Check Myfxbook', '#', 'Check Payouts', '#', 1, '2025-12-18 02:50:25', '2025-12-18 03:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lzJ5pfDn2jX6it4puoIXbjqmtzaKfoalOe7hGykv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXlhNXllZUJ2clBDdXVuNVpYVmx4WWk1UjdMVlJhc2p5eENnb1JKcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9saXZlLXJlc3VsdHMiO3M6NToicm91dGUiO3M6MjE6ImZyb250ZW5kLmxpdmUtcmVzdWx0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766054912),
('STaLVUx3m4svpFNOlzD5ztvhFab8QmYkcr6M0vAc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQ1dqMW1Ic2tFN1FGWnZJWnpuY0FVeUNKbFBvWDZtNjJPT3o3UklIOSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vYWxnb29uZS50ZXN0L2FkbWluL3NpdGUtc2V0dGluZ3MiO3M6NToicm91dGUiO3M6MjU6ImFkbWluLnNpdGUtc2V0dGluZ3MuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2NjAzNjU0Njt9fQ==', 1766054786);

-- --------------------------------------------------------

--
-- Table structure for table `signal_sections`
--

CREATE TABLE `signal_sections` (
  `id` bigint UNSIGNED NOT NULL,
  `badge_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `win_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `risk_reward` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_market` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_different_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `why_different_text` text COLLATE utf8mb4_unicode_ci,
  `join_button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signal_sections`
--

INSERT INTO `signal_sections` (`id`, `badge_text`, `title`, `description`, `win_rate`, `risk_reward`, `primary_market`, `why_different_title`, `why_different_text`, `join_button_text`, `join_button_link`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'FREE SIGNALS CHANNEL', '<p>Elite Trading Signals<br><span class=\"bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent\">Completely Free</span></p>', '<p><span style=\"font-size: 18px;\">Join our exclusive signals channel where we share professional </span></p><p><span style=\"font-size: 18px;\">GBPJPY trades with an exceptional track record.</span></p>', '80%', '1:3', 'GBPJPY', 'Why We\'re Different', '<p>While others charge hundreds or thousands for signal services, we believe everyone deserves a fair opportunity to start somewhere with trading. Our consistently profitable signals are shared completely free because we know that success in trading shouldn\'t be locked behind paywalls. Join thousands of traders who trust our analysis and execution on GBPJPY – one of the most reliable currency pairs with excellent volatility and liquidity.</p>', 'Join Free Signals Now', '/', 1, '2025-12-18 01:21:46', '2025-12-18 02:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legal_disclaimer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_title`, `logo`, `favicon`, `copyright_text`, `legal_disclaimer`, `created_at`, `updated_at`) VALUES
(1, 'AlgoOne', 'uploads/settings/logo-1766054667.png', 'uploads/settings/favicon-1766054581.png', '© 2025 AlgoOne. All rights reserved.', '<strong class=\"text-white/80\">LEGAL DISCLAIMER</strong> — Notwithstanding any representations, warranties, or statements to the contrary contained herein or elsewhere, all quantitative performance indicators, statistical analyses, trading results, and any associated data visualizations or informational content displayed are NON-FACTUAL and constitute hypothetical simulations exclusively for demonstrative purposes. No actual transactions occur on this platform, and past performance is not indicative of future results.', '2025-12-18 04:19:45', '2025-12-18 04:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `topbars`
--

CREATE TABLE `topbars` (
  `id` bigint UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topbars`
--

INSERT INTO `topbars` (`id`, `content`, `extra_content`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'LIMITED TIME: We\'re covering <span class=\"underline font-bold\">30% of fees</span>', '+ Most prop firms have BOGO offers!', 1, '2025-12-17 23:31:18', '2025-12-17 23:31:18');

-- --------------------------------------------------------

--
-- Table structure for table `trading_accounts`
--

CREATE TABLE `trading_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_gain` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `daily_gain` decimal(8,2) NOT NULL DEFAULT '0.00',
  `monthly_gain` decimal(8,2) NOT NULL DEFAULT '0.00',
  `drawdown` decimal(8,2) NOT NULL DEFAULT '0.00',
  `profit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `deposits` decimal(15,2) NOT NULL DEFAULT '0.00',
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chart_data` json DEFAULT NULL,
  `chart_labels` json DEFAULT NULL,
  `risk_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'low',
  `description` text COLLATE utf8mb4_unicode_ci,
  `myfxbook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `display_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trading_accounts`
--

INSERT INTO `trading_accounts` (`id`, `account_number`, `total_gain`, `balance`, `daily_gain`, `monthly_gain`, `drawdown`, `profit`, `deposits`, `platform`, `chart_data`, `chart_labels`, `risk_level`, `description`, `myfxbook_url`, `is_verified`, `is_featured`, `status`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'Account #1', 154.63, 252124.82, 0.71, 14.86, 3.91, 154639.72, 100000.00, 'ICMarkets MT4', '[0, 45, 85, 125, 154.63]', '[\"Jul \'23\", \"Sep \'23\", \"Nov \'23\", \"Jan \'24\", \"Apr \'24\"]', 'low', 'Conservative trading strategy with excellent risk management.', NULL, 1, 1, 'active', 1, '2025-12-17 01:01:57', '2025-12-17 01:01:57'),
(2, 'Account #2', 325.97, 136250.22, 0.08, 2.51, 3.51, 240980.38, 250000.00, 'Blueberry MT5', '[0, 35, 95, 200, 325.97]', '[\"Jul \'23\", \"Sep \'23\", \"Nov \'23\", \"Jan \'24\", \"Apr \'24\"]', 'medium', 'Balanced approach with moderate risk exposure.', NULL, 1, 1, 'active', 2, '2025-12-17 01:01:57', '2025-12-17 01:01:57'),
(3, 'Account #3', 56.26, 110904.26, 0.21, 4.03, 2.89, 420115.63, 1139530.06, 'ICMarkets MT4', '[0, 15, 30, 45, 56.26]', '[\"Jul \'23\", \"Sep \'23\", \"Nov \'23\", \"Jan \'24\", \"Apr \'24\"]', 'low', 'Ultra-conservative strategy with minimal drawdown.', NULL, 1, 1, 'active', 3, '2025-12-17 01:01:57', '2025-12-17 01:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user','trader') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `status`, `phone`, `address`, `city`, `state`, `zip`, `country`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md. Fakhrul Islam Talukder', 'fakhrulislamtalukder@gmail.com', NULL, '$2y$12$T2c7jyNVe1XIjg7Rkt0Aoup2Z2RGqlNEbZi8OEtothsKrhhMgBE8S', 'admin', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-16 23:40:27', '2025-12-16 23:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_sections`
--

CREATE TABLE `why_choose_sections` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card1_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card1_description` text COLLATE utf8mb4_unicode_ci,
  `card1_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card2_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card2_description` text COLLATE utf8mb4_unicode_ci,
  `card2_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card3_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card3_description` text COLLATE utf8mb4_unicode_ci,
  `card3_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card4_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card4_description` text COLLATE utf8mb4_unicode_ci,
  `card4_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card5_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card5_description` text COLLATE utf8mb4_unicode_ci,
  `card5_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card6_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card6_description` text COLLATE utf8mb4_unicode_ci,
  `card6_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why_choose_sections`
--

INSERT INTO `why_choose_sections` (`id`, `title`, `subtitle`, `card1_title`, `card1_description`, `card1_image`, `card2_title`, `card2_description`, `card2_image`, `card3_title`, `card3_description`, `card3_image`, `card4_title`, `card4_description`, `card4_image`, `card5_title`, `card5_description`, `card5_image`, `card6_title`, `card6_description`, `card6_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Why Choose AlgoOne?', 'Risk-free trading management you can trust', 'Zero Risk Guarantee', 'We cover 30% of your challenge fee. If we fail to pass, we refund everything plus $500.', 'uploads/why_choose/card1_1766049588.png', 'MYFXBook Verified.', 'All our trading results are third-party tracked with full transparency and accountability on demo accounts.', 'uploads/why_choose/card2_1766049564.png', 'Real-Time Tracking', 'Monitor your account performance 24/7 through our intuitive dashboard.', 'uploads/why_choose/card3_1766049564.png', 'Educational Resources', 'Access exclusive trading education videos and materials to learn alongside us', 'uploads/why_choose/card4_1766049564.png', 'Performance-Based Model', 'We only take 30% of your profits. No profits? No fees. Our interests are perfectly aligned', 'uploads/why_choose/card5_1766049564.png', 'Institutional Grade Trading', 'Hedge fund quality algorithms and risk management systems protecting every trade', 'uploads/why_choose/card6_1766049564.png', 1, '2025-12-18 03:05:40', '2025-12-18 03:21:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cta_sections`
--
ALTER TABLE `cta_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hero_sections`
--
ALTER TABLE `hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `how_it_works_sections`
--
ALTER TABLE `how_it_works_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `referral_sections`
--
ALTER TABLE `referral_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results_sections`
--
ALTER TABLE `results_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `signal_sections`
--
ALTER TABLE `signal_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topbars`
--
ALTER TABLE `topbars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trading_accounts`
--
ALTER TABLE `trading_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trading_accounts_account_number_unique` (`account_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `why_choose_sections`
--
ALTER TABLE `why_choose_sections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cta_sections`
--
ALTER TABLE `cta_sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hero_sections`
--
ALTER TABLE `hero_sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `how_it_works_sections`
--
ALTER TABLE `how_it_works_sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `referral_sections`
--
ALTER TABLE `referral_sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `results_sections`
--
ALTER TABLE `results_sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signal_sections`
--
ALTER TABLE `signal_sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `topbars`
--
ALTER TABLE `topbars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trading_accounts`
--
ALTER TABLE `trading_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `why_choose_sections`
--
ALTER TABLE `why_choose_sections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
