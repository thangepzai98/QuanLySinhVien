-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 24, 2020 lúc 09:26 AM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webbanhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: disable, 1: active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'xiaomi', 1, '2020-03-28 13:50:46', '2020-04-22 12:28:18'),
(2, 'samsung', 1, '2020-03-28 13:50:53', '2020-04-22 12:28:12'),
(3, 'iphone', 1, '2020-03-28 13:50:58', '2020-04-22 12:28:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_03_01_142712_create_categories_table', 1),
(4, '2020_03_28_203759_create_products_table', 2),
(5, '2020_03_30_222545_create_product_details_table', 2),
(6, '2020_04_05_140313_create_users_table', 3),
(7, '2020_04_06_142746_create_password_resets_table', 4),
(8, '2020_04_14_202521_create_orders_table', 5),
(9, '2020_04_14_203954_create_order_details_table', 6),
(11, '2020_04_21_161443_create_product_votes_table', 7),
(12, '2020_04_27_165312_create_sliders_table', 8),
(14, '2020_05_01_155536_create_posts_table', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` tinyint(4) NOT NULL COMMENT '1: Tiền mặt, 2: Online',
  `order_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: disable, 1: active',
  `is_processed` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `payment_method`, `order_code`, `name`, `email`, `phone`, `address`, `status`, `is_processed`, `created_at`, `updated_at`) VALUES
(75, 1, 1, 'JAV17623', 'pham anh thang', 'thang@gmail.com', '0345419777', 'do son', 1, 1, '2020-05-10 14:49:04', '2020-05-11 07:26:31'),
(76, 1, 1, 'JAV77572', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 1, 0, '2020-05-14 13:11:46', '2020-05-14 13:11:46'),
(77, 1, 2, 'JAV36725', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 0, 0, '2020-06-18 09:26:36', '2020-06-18 09:26:36'),
(78, 1, 2, 'JAV38022', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 0, 0, '2020-06-18 09:30:39', '2020-06-18 09:30:39'),
(79, 1, 1, 'JAV58381', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 1, 0, '2020-06-24 08:09:25', '2020-06-24 08:09:25'),
(82, 1, 1, 'JAV31875', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 1, 0, '2020-06-25 09:52:06', '2020-06-25 09:52:06'),
(83, 1, 1, 'JAV90577', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 1, 1, '2020-06-25 09:52:29', '2020-06-26 08:49:51'),
(84, 1, 1, 'JAV64854', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 1, 0, '2020-07-12 13:41:15', '2020-07-12 13:41:15'),
(85, 1, 2, 'JAV34144', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 0, 0, '2020-07-12 13:41:34', '2020-07-12 13:41:34'),
(86, 1, 2, 'JAV70086', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 1, 0, '2020-07-12 13:42:22', '2020-07-12 13:42:59'),
(87, 1, 1, 'JAV00026', 'thang pham', 'thang@gmail.com', '43534', 'qdsd', 1, 0, '2020-07-27 02:49:45', '2020-07-27 02:49:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_detail_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_detail_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(2, 75, 2102, 1, 19864849, '2020-05-10 14:49:04', '2020-05-10 14:49:04'),
(3, 75, 2066, 1, 16634222, '2020-05-10 14:49:04', '2020-05-10 14:49:04'),
(4, 75, 2078, 2, 11436613, '2020-05-10 14:49:04', '2020-05-10 14:49:04'),
(5, 76, 2102, 1, 19864849, '2020-05-14 13:11:46', '2020-05-14 13:11:46'),
(6, 77, 2102, 1, 19864849, '2020-06-18 09:26:36', '2020-06-18 09:26:36'),
(7, 78, 2102, 1, 19864849, '2020-06-18 09:30:39', '2020-06-18 09:30:39'),
(8, 79, 2090, 1, 18713687, '2020-06-24 08:09:25', '2020-06-24 08:09:25'),
(11, 82, 2063, 1, 13449032, '2020-06-25 09:52:06', '2020-06-25 09:52:06'),
(12, 83, 2082, 1, 3946749, '2020-06-25 09:52:29', '2020-06-25 09:52:29'),
(13, 84, 2098, 1, 9268395, '2020-07-12 13:41:15', '2020-07-12 13:41:15'),
(14, 85, 2090, 1, 18713687, '2020-07-12 13:41:35', '2020-07-12 13:41:35'),
(15, 86, 2090, 1, 18713687, '2020-07-12 13:42:22', '2020-07-12 13:42:22'),
(16, 87, 2102, 1, 19864849, '2020-07-27 02:49:45', '2020-07-27 02:49:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `image`, `content`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Với Qualcomm, 5G không chỉ dành cho điện thoại mà còn cả PC', 'voi-qualcomm-5g-khong-chi-danh-cho-dien-thoai-ma-con-ca-pc', '/photos/shares/111.jpg', '<h2 style=\"font-style:normal; text-align:justify\">Qualcomm đang c&oacute; kế hoạch để trở th&agrave;nh nh&agrave; sản xuất đầu ti&ecirc;n c&ocirc;ng bố c&aacute;c&nbsp;PC&nbsp;hỗ trợ&nbsp;5G&nbsp;bằng hai vũ kh&iacute; b&iacute; mật l&agrave; modem Snapdragon X55 v&agrave; bộ xử l&yacute; PC Snapdragon 8cx. Tại&nbsp;MWC 2019, ch&uacute;ng ta sẽ c&oacute; c&aacute;i nh&igrave;n cụ thể hơn về c&aacute;ch m&agrave; hai c&ocirc;ng nghệ kết hợp để tạo ra nền tảng PC hỗ trợ 5G đầu ti&ecirc;n.</h2>\r\n\r\n<h3 style=\"color:#323c3f; font-style:normal; text-align:justify\"><strong>Snapdragon X55 v&agrave; Snapdragon 8cx</strong></h3>\r\n\r\n<p style=\"text-align:justify\">So với c&aacute;c PC x86 truyền thống được trang bị chip xử l&yacute; Intel hay AMD, &ldquo;PC lu&ocirc;n kết nối&rdquo; tập trung ph&aacute;t triển v&agrave;o thiết kế gọn nhẹ, hiện đại h&oacute;a v&agrave; thời lượng sử dụng l&acirc;u hơn. Nhưng sự kết nối lu&ocirc;n l&agrave; ưu ti&ecirc;n h&agrave;ng đầu của PC Qualcomm.</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"\" src=\"http://127.0.0.1:8000/photos/shares/qualcomm8cx_800x533.jpg\" style=\"height:533px; width:800px\" /></p>\r\n\r\n<p style=\"text-align:justify\">Snapdragon 8cx được thiết kế chạy tr&ecirc;n&nbsp;Windows 10&nbsp;của Microsoft tr&ecirc;n một thiết bị hỗ trợ ARM. Khi những PC lu&ocirc;n kết nối trang bị chip 8cx được t&iacute;ch hợp cả modem X55 th&igrave; sẽ khiến tốc độ internet trở n&ecirc;n nhanh hơn. Nền tảng PC lu&ocirc;n kết nối n&agrave;y sẽ c&oacute; thời lượng sử dụng khoảng 20 giờ đồng hồ.</p>\r\n\r\n<h3 style=\"color:#323c3f; font-style:normal; text-align:justify\"><strong>Thay đổi c&aacute;ch người d&ugrave;ng sử dụng PC</strong></h3>\r\n\r\n<p style=\"text-align:justify\">Tốc độ Internet trở n&ecirc;n nhanh hơn th&igrave; người d&ugrave;ng sẽ được trải nghiệm 5G dựa tr&ecirc;n kho dữ liệu đ&aacute;m m&acirc;y. V&igrave; 5G c&oacute; độ trễ thấp v&agrave; băng th&ocirc;ng lớn n&ecirc;n kho dữ liệu đ&aacute;m m&acirc;y sẽ bắt đầu hoạt động giống như kho lưu trữ trong ổ cứng PC.</p>', 1, '2020-05-02 13:45:07', '2020-05-03 11:16:10'),
(3, '534534', '534534', '/photos/shares/banner.jpg', '<p>34534</p>', 1, '2020-05-03 11:28:31', '2020-05-03 11:30:13'),
(4, '34543345', '34543345', '/photos/shares/111.jpg', '<p>34534345</p>', 0, '2020-05-03 11:28:52', '2020-05-03 11:28:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci,
  `introduction` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `rate` double(2,1) NOT NULL DEFAULT '0.0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `image`, `sku_code`, `details`, `introduction`, `status`, `rate`, `created_at`, `updated_at`) VALUES
(940, 3, 'ok', 'rerum-deserunt-hic-sequi-perspiciatis-molestiae', '/photos/shares/iphone11-pro-max.jpg', 'KKBILNHC', NULL, NULL, 1, 4.0, '2020-04-29 13:55:43', '2020-04-29 13:55:43'),
(941, 3, 'Autem natus quia.', 'autem-natus-quia', '/photos/shares/redmi-note-8a.jpg', 'HLADERAI', NULL, NULL, 1, 2.0, '2020-04-29 13:55:43', '2020-04-29 13:55:43'),
(942, 3, 'Itaque ad eveniet et.', 'itaque-ad-eveniet-et', '/photos/shares/redmi-k30-5g-blue.jpg', 'GEMJJAW3', NULL, NULL, 1, 0.0, '2020-04-29 13:55:43', '2020-04-29 13:55:43'),
(943, 3, 'Qui cumque dolorum neque.', 'qui-cumque-dolorum-neque', '/photos/shares/redmi-note-8a.jpg', 'BLMYSTJTIU9', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(944, 3, 'Qui occaecati ratione.', 'qui-occaecati-ratione', '/photos/shares/redmi-k30-5g-blue.jpg', 'JZGMFTLGLR0', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(945, 3, 'Velit doloremque vitae fuga asperiores.', 'velit-doloremque-vitae-fuga-asperiores', '/photos/shares/s10-5g.jpg', 'NQNTGB6GYO2', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(946, 3, 'Omnis et ipsum quia beatae.', 'omnis-et-ipsum-quia-beatae', '/photos/shares/blue.jpg', 'OFBDEGTL', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(947, 3, 'Aliquid ea laboriosam officia ab.', 'aliquid-ea-laboriosam-officia-ab', '/photos/shares/iphone11-pro-max.jpg', 'GPQAARF7PI7', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(948, 3, 'Totam ut quidem et.', 'totam-ut-quidem-et', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'UXMSBYS55SZ', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(949, 3, 'Ipsam qui ut.', 'ipsam-qui-ut', '/photos/shares/samsung-s10.jpg', 'HARFZX85UUJ', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(950, 3, 'Velit rem laboriosam est.', 'velit-rem-laboriosam-est', '/photos/shares/samsung-note-10-plus-2.jpg', 'SXOKIPODTFL', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(951, 3, 'Iusto perferendis non voluptatum voluptas.', 'iusto-perferendis-non-voluptatum-voluptas', '/photos/shares/redmi-note-8a.jpg', 'JXCLYZ368ES', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(952, 3, 'Soluta voluptatibus praesentium.', 'soluta-voluptatibus-praesentium', '/photos/shares/iphone-7-plus-jetblack.jpg', 'MCMXFL26', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(953, 3, 'Libero sit assumenda omnis.', 'libero-sit-assumenda-omnis', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 'ANTBDV1C6SB', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(954, 3, 'Rerum facilis dicta qui perspiciatis.', 'rerum-facilis-dicta-qui-perspiciatis', '/photos/shares/iphone-7-plus-jetblack.jpg', 'ESVBHWDTMBE', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(955, 3, 'Quam et est laboriosam deserunt.', 'quam-et-est-laboriosam-deserunt', '/photos/shares/sliver.jpg', 'MFAJLT5P5OB', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(956, 3, 'Quisquam adipisci accusamus magnam numquam.', 'quisquam-adipisci-accusamus-magnam-numquam', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'JGTHPBG5', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(957, 3, 'Reprehenderit doloremque et officia dolorum facere.', 'reprehenderit-doloremque-et-officia-dolorum-facere', '/photos/shares/mi-cc9e-blue.jpg', 'XKOAXOPL', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(958, 3, 'Ea maiores eius consectetur nihil.', 'ea-maiores-eius-consectetur-nihil', '/photos/shares/samsung-s10.jpg', 'XBEDMCNNJUD', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(959, 3, 'Id atque corporis cupiditate.', 'id-atque-corporis-cupiditate', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'DVELSNAZP7Y', NULL, NULL, 1, 0.0, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(960, 3, 'Perspiciatis reiciendis quasi velit illo.', 'perspiciatis-reiciendis-quasi-velit-illo', '/photos/shares/sliver.jpg', 'BDPIRWVNADK', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(961, 3, 'Similique alias nemo harum enim.', 'similique-alias-nemo-harum-enim', '/photos/shares/blue.jpg', 'VEVACF0C0EQ', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(962, 3, 'Nulla maxime quasi alias molestias.', 'nulla-maxime-quasi-alias-molestias', '/photos/shares/iphone-7-plus-jetblack.jpg', 'XFKWMDSZ', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(963, 3, 'Eveniet quam quis et maiores.', 'eveniet-quam-quis-et-maiores', '/photos/shares/redmi-note-8a.jpg', 'KRODIV1W9L4', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(964, 3, 'Magnam eos atque perferendis.', 'magnam-eos-atque-perferendis', '/photos/shares/mi-cc9e-blue.jpg', 'UEYZUMID', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(965, 3, 'Aut harum suscipit maiores velit.', 'aut-harum-suscipit-maiores-velit', '/photos/shares/blue.jpg', 'FFVULWW32LW', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(966, 3, 'Voluptatem sed ea quia distinctio.', 'voluptatem-sed-ea-quia-distinctio', '/photos/shares/6.jpg', 'LAXVBBJI', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(967, 3, 'Optio eius aspernatur aut impedit.', 'optio-eius-aspernatur-aut-impedit', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 'TGNDSWNR57U', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(968, 3, 'Qui est alias aut rerum.', 'qui-est-alias-aut-rerum', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 'TBPWRT78', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(969, 3, 'Et ut ut aut tempore.', 'et-ut-ut-aut-tempore', '/photos/shares/sliver.jpg', 'AZLZJHNX', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(970, 3, 'Neque cumque est itaque quae.', 'neque-cumque-est-itaque-quae', '/photos/shares/mi-cc9e-blue.jpg', 'TWHUOWO7', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(971, 3, 'Qui temporibus ut nihil.', 'qui-temporibus-ut-nihil', '/photos/shares/sliver.jpg', 'YFKQMNKU', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(972, 3, 'Veniam recusandae corrupti.', 'veniam-recusandae-corrupti', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 'VXAAFE2W', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(973, 3, 'Odit fugit sed totam sed.', 'odit-fugit-sed-totam-sed', '/photos/shares/iphone11-pro-max.jpg', 'CDJVYLTTZYA', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(974, 3, 'Voluptatum eius ducimus sit nihil.', 'voluptatum-eius-ducimus-sit-nihil', '/photos/shares/6.jpg', 'TBVAKM3T7SU', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(975, 3, 'Sequi sint ut quo.', 'sequi-sint-ut-quo', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'OGBPJBZ5QHZ', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(976, 3, 'Placeat sed voluptatem voluptatem.', 'placeat-sed-voluptatem-voluptatem', '/photos/shares/iphone-7-plus-jetblack.jpg', 'YBUZUMIB', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(977, 3, 'Voluptas tenetur est et.', 'voluptas-tenetur-est-et', '/photos/shares/iphone-7-plus-jetblack.jpg', 'ITSMWUN9', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(978, 3, 'Voluptatem quia unde iusto iste.', 'voluptatem-quia-unde-iusto-iste', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 'QMSIJY7C', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(979, 3, 'Quas qui aperiam quis iure aut.', 'quas-qui-aperiam-quis-iure-aut', '/photos/shares/samsung-s10.jpg', 'KVVZUU24', NULL, NULL, 1, 0.0, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(980, 3, 'Ut repellat velit.', 'ut-repellat-velit', '/photos/shares/5.jpg', 'ASHNBDQY7AE', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(981, 3, 'Iste pariatur optio qui officia.', 'iste-pariatur-optio-qui-officia', '/photos/shares/samsung-note-10-plus-2.jpg', 'MOJGTVLX', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(982, 3, 'Ipsam non eveniet laboriosam.', 'ipsam-non-eveniet-laboriosam', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 'YPYXFA885WB', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(983, 3, 'Assumenda et et excepturi fugit ea.', 'assumenda-et-et-excepturi-fugit-ea', '/photos/shares/6.jpg', 'ISVMPLNY', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(984, 3, 'Quia animi non illum provident.', 'quia-animi-non-illum-provident', '/photos/shares/5.jpg', 'YKOCTA9D1LI', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(985, 3, 'Tempore suscipit quaerat consequatur.', 'tempore-suscipit-quaerat-consequatur', '/photos/shares/cool-black.jpg', 'POHGSRSY', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(986, 3, 'Sapiente deserunt voluptatem excepturi non.', 'sapiente-deserunt-voluptatem-excepturi-non', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 'GKXVTC8VI0R', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(987, 3, 'Dolor incidunt iste dicta.', 'dolor-incidunt-iste-dicta', '/photos/shares/samsung-s10.jpg', 'XXSLXQ4C', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(988, 3, 'Et natus qui recusandae quos ex.', 'et-natus-qui-recusandae-quos-ex', '/photos/shares/s10-5g.jpg', 'JBJQFP28', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(989, 3, 'Est qui debitis aut dolores non.', 'est-qui-debitis-aut-dolores-non', '/photos/shares/samsung-note-10-plus-2.jpg', 'XBLPEA9YGNH', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(990, 3, 'Voluptatem quia optio molestiae.', 'voluptatem-quia-optio-molestiae', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 'ISJUIYISNPB', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(991, 3, 'Enim corporis repudiandae sed.', 'enim-corporis-repudiandae-sed', '/photos/shares/iphone-7-plus-jetblack.jpg', 'QNMHIGI5NL8', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(992, 3, 'Temporibus vitae omnis voluptatum.', 'temporibus-vitae-omnis-voluptatum', '/photos/shares/blue.jpg', 'FXIQLH3C8IR', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(993, 3, 'Unde tempore inventore nihil.', 'unde-tempore-inventore-nihil', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'ZRKRJLFE', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(994, 3, 'Corporis dolor quibusdam soluta iure ratione.', 'corporis-dolor-quibusdam-soluta-iure-ratione', '/photos/shares/redmi-note-8a.jpg', 'THONARLF', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(995, 3, 'Illum voluptatem tempora distinctio.', 'illum-voluptatem-tempora-distinctio', '/photos/shares/blue.jpg', 'SZBHWQ2D7Y1', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(996, 3, 'Iusto laudantium repudiandae.', 'iusto-laudantium-repudiandae', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'QCWRCT1XRJV', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(997, 3, 'Nesciunt earum nulla.', 'nesciunt-earum-nulla', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'KTFOTDO3', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(998, 3, 'Quidem et corporis aut quasi dolores.', 'quidem-et-corporis-aut-quasi-dolores', '/photos/shares/mi-cc9e-blue.jpg', 'VEINZYGK483', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(999, 3, 'Voluptatem iusto eaque dolores accusantium non.', 'voluptatem-iusto-eaque-dolores-accusantium-non', '/photos/shares/redmi-k30-5g-blue.jpg', 'FGGXDD5H', NULL, NULL, 1, 0.0, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1000, 3, 'Consequatur quasi laudantium.', 'consequatur-quasi-laudantium', '/photos/shares/6.jpg', 'GARKTDKG8TH', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1001, 3, 'Consequuntur laboriosam incidunt possimus voluptatem.', 'consequuntur-laboriosam-incidunt-possimus-voluptatem', '/photos/shares/mi-cc9e-blue.jpg', 'FHBHVHVOUZV', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1002, 3, 'Voluptatem omnis sapiente rerum inventore.', 'voluptatem-omnis-sapiente-rerum-inventore', '/photos/shares/redmi-note-8a.jpg', 'UBKOJQHO', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1003, 3, 'Voluptatem aut sint reiciendis sed et.', 'voluptatem-aut-sint-reiciendis-sed-et', '/photos/shares/5.jpg', 'JFGUFGMRZ0L', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1004, 3, 'Necessitatibus vel odit consequatur.', 'necessitatibus-vel-odit-consequatur', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'ICSTHYXWVUY', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1005, 3, 'Pariatur molestiae ex aut.', 'pariatur-molestiae-ex-aut', '/photos/shares/iphone-7-plus-jetblack.jpg', 'OZZASQ7A', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1006, 3, 'Consequatur vel ratione voluptatibus.', 'consequatur-vel-ratione-voluptatibus', '/photos/shares/iphone11-pro-max.jpg', 'CBQBZAEO', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1007, 3, 'Quasi error a ut.', 'quasi-error-a-ut', '/photos/shares/mi-cc9e-blue.jpg', 'QBEZHINR', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1008, 3, 'Doloribus ab nihil.', 'doloribus-ab-nihil', '/photos/shares/sliver.jpg', 'QARYVIXI', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1009, 3, 'Earum accusantium et cupiditate veritatis sed.', 'earum-accusantium-et-cupiditate-veritatis-sed', '/photos/shares/redmi-note-8a.jpg', 'ZERLZHRV', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1010, 3, 'Voluptas veniam consequatur.', 'voluptas-veniam-consequatur', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 'BDJQWD4B', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1011, 3, 'Optio et laborum quasi in labore.', 'optio-et-laborum-quasi-in-labore', '/photos/shares/iphone11-pro-max.jpg', 'HSJKON6G', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1012, 3, 'Quis qui libero nihil qui delectus.', 'quis-qui-libero-nihil-qui-delectus', '/photos/shares/blue.jpg', 'DLZGOXZPHZ4', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1013, 3, 'Provident nulla inventore delectus ut.', 'provident-nulla-inventore-delectus-ut', '/photos/shares/mi-cc9e-blue.jpg', 'CMDNLGW5', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1014, 3, 'Non accusantium laboriosam nesciunt.', 'non-accusantium-laboriosam-nesciunt', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'BFYJPJKC', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1015, 3, 'Voluptatibus ad omnis odio esse explicabo.', 'voluptatibus-ad-omnis-odio-esse-explicabo', '/photos/shares/s10-5g.jpg', 'DYPEWYXL', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1016, 3, 'Veritatis et qui est.', 'veritatis-et-qui-est', '/photos/shares/blue.jpg', 'FVGHKXPX', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1017, 3, 'Aut consequatur deleniti aut corrupti.', 'aut-consequatur-deleniti-aut-corrupti', '/photos/shares/iphone-7-plus-jetblack.jpg', 'ELRYBRKAK30', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1018, 3, 'Ipsum quia iusto harum laudantium.', 'ipsum-quia-iusto-harum-laudantium', '/photos/shares/iphone11-pro-max.jpg', 'KJBQIJGB94Y', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1019, 3, 'Rerum unde corporis eos quisquam.', 'rerum-unde-corporis-eos-quisquam', '/photos/shares/samsung-note-10-plus-2.jpg', 'ISCTPNF2', NULL, NULL, 1, 0.0, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1020, 3, 'Illo possimus porro esse ad.', 'illo-possimus-porro-esse-ad', '/photos/shares/blue.jpg', 'PMLNTDE0P03', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1021, 3, 'Voluptatibus voluptas tempore.', 'voluptatibus-voluptas-tempore', '/photos/shares/samsung-s10.jpg', 'UXGZFEFY', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1022, 3, 'Assumenda dolorem labore id.', 'assumenda-dolorem-labore-id', '/photos/shares/5.jpg', 'FVUBIY8KTRP', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1023, 3, 'Voluptate quia voluptates deserunt ratione voluptas.', 'voluptate-quia-voluptates-deserunt-ratione-voluptas', '/photos/shares/redmi-note-8a.jpg', 'EDYHZV6XDL6', NULL, NULL, 1, 4.8, '2020-04-29 13:55:54', '2020-06-23 08:27:09'),
(1024, 3, 'Eius ut voluptatum enim voluptates.', 'eius-ut-voluptatum-enim-voluptates', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 'JRPHRI37SYO', NULL, NULL, 1, 2.0, '2020-04-29 13:55:54', '2020-04-30 14:21:53'),
(1025, 3, 'Doloremque alias quia omnis.', 'doloremque-alias-quia-omnis', '/photos/shares/blue.jpg', 'RQFFOGS7YJT', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-04-30 14:20:44'),
(1026, 3, 'Rerum itaque doloribus ut et dignissimos.', 'rerum-itaque-doloribus-ut-et-dignissimos', '/photos/shares/mi-cc9e-blue.jpg', 'OIGXOCHX', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1027, 3, 'Vitae eaque temporibus impedit consectetur.', 'vitae-eaque-temporibus-impedit-consectetur', '/photos/shares/s10-5g.jpg', 'NFCWLVOFB3Z', NULL, NULL, 1, 5.0, '2020-04-29 13:55:54', '2020-05-14 13:24:52'),
(1028, 3, 'Beatae iste minus mollitia.', 'beatae-iste-minus-mollitia', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 'EZXXAWPO', NULL, NULL, 1, 5.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1029, 3, 'Quasi sed nobis voluptatem ullam.', 'quasi-sed-nobis-voluptatem-ullam', '/photos/shares/blue.jpg', 'JXBSTRHJAH3', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1030, 3, 'Et est velit inventore.', 'et-est-velit-inventore', '/photos/shares/6.jpg', 'EORQIPGL', NULL, NULL, 1, 5.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1031, 3, 'Excepturi eligendi tempore et ex est.', 'excepturi-eligendi-tempore-et-ex-est', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 'UBXKXKC4', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1032, 3, 'Qui ullam ex voluptatibus laborum aliquam.', 'qui-ullam-ex-voluptatibus-laborum-aliquam', '/photos/shares/redmi-k30-5g-blue.jpg', 'ZUKBUOX7XES', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1033, 3, 'Nemo qui eveniet provident quidem.', 'nemo-qui-eveniet-provident-quidem', '/photos/shares/samsung-note-10-plus-2.jpg', 'ONPYTAC8PO2', NULL, NULL, 1, 4.5, '2020-04-29 13:55:54', '2020-04-30 14:20:07'),
(1034, 3, 'Consequatur et ipsam deserunt dolorum.', 'consequatur-et-ipsam-deserunt-dolorum', '/photos/shares/redmi-note-8a.jpg', 'TGJGKQLJHM7', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(1035, 3, 'Doloremque modi enim et.', 'doloremque-modi-enim-et', '/photos/shares/iphone11-pro-max.jpg', 'XWDPZJ0E90W', NULL, NULL, 1, 2.5, '2020-04-29 13:55:54', '2020-06-25 08:59:20'),
(1036, 3, 'Placeat nam iste reiciendis sapiente.', 'placeat-nam-iste-reiciendis-sapiente', '/photos/shares/6.jpg', 'FSMZTH6H8KQ', NULL, NULL, 0, 0.0, '2020-04-29 13:55:54', '2020-06-25 08:59:18'),
(1037, 3, 'Recusandae necessitatibus tempora a voluptatibus et.', 'recusandae-necessitatibus-tempora-a-voluptatibus-et', '/photos/shares/s10-5g.jpg', 'PYTQIF9E', NULL, NULL, 1, 0.0, '2020-04-29 13:55:54', '2020-06-25 08:59:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `import_quantity` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `import_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `promotion_price` int(11) DEFAULT NULL,
  `promotion_start_date` date DEFAULT NULL,
  `promotion_end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `color`, `image`, `import_quantity`, `quantity`, `import_price`, `sale_price`, `promotion_price`, `promotion_start_date`, `promotion_end_date`, `created_at`, `updated_at`) VALUES
(1730, 940, 'quidem', '/photos/shares/cool-black.jpg', 100, 100, 2919070, 3919070, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1731, 940, 'eum', '/photos/shares/sliver.jpg', 100, 100, 18498930, 19498930, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1732, 940, 'sequi', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 16976995, 17976995, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1733, 940, 'asperiores', '/photos/shares/redmi-note-8a.jpg', 100, 100, 11273813, 12273813, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1734, 941, 'autem', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 13064997, 14064997, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1735, 941, 'qui', '/photos/shares/5.jpg', 100, 100, 9404998, 10404998, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1736, 941, 'assumenda', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 5164696, 6164696, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1737, 941, 'et', '/photos/shares/5.jpg', 100, 100, 15167420, 16167420, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1738, 942, 'ea', '/photos/shares/5.jpg', 100, 100, 13112907, 14112907, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1739, 942, 'maxime', '/photos/shares/blue.jpg', 100, 100, 8459837, 9459837, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1740, 942, 'laudantium', '/photos/shares/samsung-s10.jpg', 100, 100, 5273686, 6273686, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1741, 942, 'dolore', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 6769846, 7769846, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1742, 943, 'possimus', '/photos/shares/sliver.jpg', 100, 100, 13578495, 14578495, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1743, 943, 'animi', '/photos/shares/5.jpg', 100, 100, 13408809, 14408809, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1744, 943, 'illum', '/photos/shares/cool-black.jpg', 100, 100, 6883747, 7883747, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1745, 943, 'unde', '/photos/shares/redmi-note-8a.jpg', 100, 100, 7887265, 8887265, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1746, 944, 'sunt', '/photos/shares/redmi-note-8a.jpg', 100, 100, 9352525, 10352525, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1747, 944, 'vel', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 9992124, 10992124, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1748, 944, 'quia', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 9956178, 10956178, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1749, 944, 'quo', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 5468255, 6468255, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1750, 945, 'nemo', '/photos/shares/sliver.jpg', 100, 100, 16618392, 17618392, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1751, 945, 'id', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 9039648, 10039648, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1752, 945, 'omnis', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 7560766, 8560766, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1753, 945, 'necessitatibus', '/photos/shares/6.jpg', 100, 100, 10963140, 11963140, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1754, 946, 'quae', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 13884375, 14884375, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1755, 946, 'blanditiis', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 13883432, 14883432, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1756, 946, 'laboriosam', '/photos/shares/6.jpg', 100, 100, 10541367, 11541367, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1757, 946, 'est', '/photos/shares/cool-black.jpg', 100, 100, 4730335, 5730335, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1758, 947, 'voluptatem', '/photos/shares/samsung-s10.jpg', 100, 100, 19752067, 20752067, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1759, 947, 'ut', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 9098115, 10098115, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1760, 947, 'iure', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 11012126, 12012126, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1761, 947, 'sed', '/photos/shares/6.jpg', 100, 100, 13721097, 14721097, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1762, 948, 'cumque', '/photos/shares/redmi-note-8a.jpg', 100, 100, 13838379, 14838379, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1763, 948, 'natus', '/photos/shares/cool-black.jpg', 100, 100, 6462928, 7462928, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1764, 948, 'praesentium', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 9645007, 10645007, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1765, 948, 'minus', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 15227475, 16227475, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1766, 949, 'dolorum', '/photos/shares/samsung-s10.jpg', 100, 100, 7159832, 8159832, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1767, 949, 'deleniti', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 13473092, 14473092, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1768, 949, 'neque', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 2735276, 3735276, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1769, 949, 'harum', '/photos/shares/5.jpg', 100, 100, 2796991, 3796991, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1770, 950, 'laborum', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 19198164, 20198164, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1771, 950, 'in', '/photos/shares/sliver.jpg', 100, 100, 10394690, 11394690, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1772, 950, 'facere', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 13614755, 14614755, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1773, 950, 'totam', '/photos/shares/s10-5g.jpg', 100, 100, 3158466, 4158466, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1774, 951, 'velit', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 18477969, 19477969, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1775, 951, 'molestiae', '/photos/shares/s10-5g.jpg', 100, 100, 16616728, 17616728, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1776, 951, 'ducimus', '/photos/shares/sliver.jpg', 100, 100, 18888029, 19888029, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1777, 951, 'nisi', '/photos/shares/sliver.jpg', 100, 100, 15814780, 16814780, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1778, 952, 'incidunt', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 11996762, 12996762, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1779, 952, 'enim', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 13935941, 14935941, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1780, 952, 'quis', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 19478621, 20478621, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1781, 952, 'temporibus', '/photos/shares/sliver.jpg', 100, 100, 4076258, 5076258, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1782, 953, 'expedita', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 17268480, 18268480, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1783, 953, 'nobis', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 8898693, 9898693, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1784, 953, 'dolores', '/photos/shares/6.jpg', 100, 100, 19040898, 20040898, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1785, 953, 'impedit', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 4057755, 5057755, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1786, 954, 'eligendi', '/photos/shares/6.jpg', 100, 100, 8956691, 9956691, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1787, 954, 'fugiat', '/photos/shares/s10-5g.jpg', 100, 100, 19445770, 20445770, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1788, 954, 'voluptas', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 8515342, 9515342, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1789, 954, 'fuga', '/photos/shares/redmi-note-8a.jpg', 100, 100, 2248775, 3248775, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1790, 955, 'reiciendis', '/photos/shares/blue.jpg', 100, 100, 10414881, 11414881, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1791, 955, 'iusto', '/photos/shares/blue.jpg', 100, 100, 16352344, 17352344, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1792, 955, 'minima', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 3587934, 4587934, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1793, 955, 'error', '/photos/shares/s10-5g.jpg', 100, 100, 3896123, 4896123, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1794, 956, 'saepe', '/photos/shares/samsung-s10.jpg', 100, 100, 10803136, 11803136, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1795, 956, 'aut', '/photos/shares/cool-black.jpg', 100, 100, 11856651, 12856651, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1796, 956, 'ratione', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 5356609, 6356609, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1797, 956, 'atque', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 18886085, 19886085, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1798, 957, 'repudiandae', '/photos/shares/5.jpg', 100, 100, 17600965, 18600965, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1799, 957, 'commodi', '/photos/shares/samsung-s10.jpg', 100, 100, 13770779, 14770779, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1800, 957, 'explicabo', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 16860503, 17860503, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1801, 957, 'voluptatum', '/photos/shares/redmi-note-8a.jpg', 100, 100, 4884763, 5884763, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1802, 958, 'delectus', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 18237791, 19237791, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1803, 958, 'adipisci', '/photos/shares/s10-5g.jpg', 100, 100, 4834883, 5834883, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1804, 958, 'accusantium', '/photos/shares/s10-5g.jpg', 100, 100, 8614120, 9614120, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1805, 958, 'perspiciatis', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 1109665, 2109665, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1806, 959, 'nesciunt', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 18951826, 19951826, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1807, 959, 'tempore', '/photos/shares/cool-black.jpg', 100, 100, 19961800, 20961800, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1808, 959, 'doloribus', '/photos/shares/samsung-s10.jpg', 100, 100, 6379231, 7379231, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1809, 959, 'consequatur', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 7421617, 8421617, NULL, NULL, NULL, '2020-04-29 13:55:44', '2020-04-29 13:55:44'),
(1810, 960, 'ea', '/photos/shares/redmi-note-8a.jpg', 100, 100, 11376150, 12376150, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1811, 960, 'illo', '/photos/shares/s10-5g.jpg', 100, 100, 12785505, 13785505, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1812, 960, 'et', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 17321403, 18321403, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1813, 960, 'accusamus', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 7338886, 8338886, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1814, 961, 'aspernatur', '/photos/shares/5.jpg', 100, 100, 9072401, 10072401, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1815, 961, 'veniam', '/photos/shares/blue.jpg', 100, 100, 4877999, 5877999, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1816, 961, 'modi', '/photos/shares/6.jpg', 100, 100, 17362333, 18362333, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1817, 961, 'quod', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 2154473, 3154473, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1818, 962, 'occaecati', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 4444187, 5444187, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1819, 962, 'corporis', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 3692637, 4692637, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1820, 962, 'eos', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 18434586, 19434586, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1821, 962, 'ut', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 6196118, 7196118, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1822, 963, 'ipsum', '/photos/shares/redmi-note-8a.jpg', 100, 100, 11479347, 12479347, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1823, 963, 'praesentium', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 14186100, 15186100, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1824, 963, 'consectetur', '/photos/shares/samsung-s10.jpg', 100, 100, 5834694, 6834694, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1825, 963, 'repudiandae', '/photos/shares/blue.jpg', 100, 100, 7692269, 8692269, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1826, 964, 'ad', '/photos/shares/blue.jpg', 100, 100, 9134408, 10134408, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1827, 964, 'unde', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 9564194, 10564194, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1828, 964, 'ducimus', '/photos/shares/blue.jpg', 100, 100, 1811547, 2811547, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1829, 964, 'in', '/photos/shares/blue.jpg', 100, 100, 6916444, 7916444, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1830, 965, 'mollitia', '/photos/shares/s10-5g.jpg', 100, 100, 4147381, 5147381, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1831, 965, 'cum', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 13113126, 14113126, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1832, 965, 'repellat', '/photos/shares/redmi-note-8a.jpg', 100, 100, 18470137, 19470137, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1833, 965, 'consequatur', '/photos/shares/redmi-note-8a.jpg', 100, 100, 7586882, 8586882, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1834, 966, 'quia', '/photos/shares/cool-black.jpg', 100, 100, 3566402, 4566402, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1835, 966, 'doloremque', '/photos/shares/5.jpg', 100, 100, 6819559, 7819559, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1836, 966, 'adipisci', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 14016091, 15016091, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1837, 966, 'dignissimos', '/photos/shares/samsung-s10.jpg', 100, 100, 17009606, 18009606, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1838, 967, 'dolores', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 5387789, 6387789, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1839, 967, 'aperiam', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 2899214, 3899214, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1840, 967, 'sit', '/photos/shares/redmi-note-8a.jpg', 100, 100, 10723004, 11723004, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1841, 967, 'sapiente', '/photos/shares/blue.jpg', 100, 100, 1219271, 2219271, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1842, 968, 'iure', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 18498739, 19498739, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1843, 968, 'perferendis', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 4557079, 5557079, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1844, 968, 'qui', '/photos/shares/samsung-s10.jpg', 100, 100, 10276288, 11276288, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1845, 968, 'accusantium', '/photos/shares/cool-black.jpg', 100, 100, 16293617, 17293617, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1846, 969, 'quibusdam', '/photos/shares/5.jpg', 100, 100, 14413879, 15413879, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1847, 969, 'voluptatem', '/photos/shares/sliver.jpg', 100, 100, 4972296, 5972296, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1848, 969, 'aut', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 19714773, 20714773, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1849, 969, 'saepe', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 3694715, 4694715, NULL, NULL, NULL, '2020-04-29 13:55:48', '2020-04-29 13:55:48'),
(1850, 970, 'nobis', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 2948917, 3948917, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1851, 970, 'voluptate', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 4461521, 5461521, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1852, 970, 'dolor', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 9849179, 10849179, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1853, 970, 'voluptas', '/photos/shares/blue.jpg', 100, 100, 2682679, 3682679, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1854, 971, 'sunt', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 4427813, 5427813, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1855, 971, 'deserunt', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 6929228, 7929228, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1856, 971, 'quo', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 11422765, 12422765, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1857, 971, 'nihil', '/photos/shares/blue.jpg', 100, 100, 19033073, 20033073, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1858, 972, 'minima', '/photos/shares/redmi-note-8a.jpg', 100, 100, 6051053, 7051053, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1859, 972, 'velit', '/photos/shares/s10-5g.jpg', 100, 100, 2507226, 3507226, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1860, 972, 'eum', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 3702617, 4702617, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1861, 972, 'illum', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 11118053, 12118053, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1862, 973, 'ullam', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 12044380, 13044380, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1863, 973, 'est', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 8861177, 9861177, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1864, 973, 'blanditiis', '/photos/shares/6.jpg', 100, 100, 5029663, 6029663, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1865, 973, 'placeat', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 13797513, 14797513, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1866, 974, 'facere', '/photos/shares/5.jpg', 100, 100, 6130876, 7130876, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1867, 974, 'quidem', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 12915071, 13915071, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1868, 974, 'quas', '/photos/shares/cool-black.jpg', 100, 100, 13403270, 14403270, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1869, 974, 'alias', '/photos/shares/s10-5g.jpg', 100, 100, 6031384, 7031384, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1870, 975, 'vel', '/photos/shares/6.jpg', 100, 100, 8808110, 9808110, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1871, 975, 'itaque', '/photos/shares/5.jpg', 100, 100, 14120259, 15120259, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1872, 975, 'possimus', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 16580435, 17580435, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1873, 975, 'delectus', '/photos/shares/samsung-s10.jpg', 100, 100, 3141874, 4141874, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1874, 976, 'temporibus', '/photos/shares/samsung-s10.jpg', 100, 100, 9551793, 10551793, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1875, 976, 'maxime', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 16627482, 17627482, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1876, 976, 'hic', '/photos/shares/sliver.jpg', 100, 100, 11084875, 12084875, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1877, 976, 'rerum', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 6290542, 7290542, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1878, 977, 'amet', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 5665909, 6665909, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1879, 977, 'quasi', '/photos/shares/6.jpg', 100, 100, 15369030, 16369030, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1880, 977, 'eligendi', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 19092466, 20092466, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1881, 977, 'quae', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 12201723, 13201723, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1882, 978, 'sequi', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 18956799, 19956799, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1883, 978, 'laudantium', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 14979264, 15979264, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1884, 978, 'laborum', '/photos/shares/redmi-note-8a.jpg', 100, 100, 18888425, 19888425, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1885, 978, 'dicta', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 14236424, 15236424, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1886, 979, 'aliquam', '/photos/shares/s10-5g.jpg', 100, 100, 5270854, 6270854, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1887, 979, 'dolore', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 19563167, 20563167, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1888, 979, 'atque', '/photos/shares/6.jpg', 100, 100, 15896893, 16896893, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1889, 979, 'vitae', '/photos/shares/5.jpg', 100, 100, 5010285, 6010285, NULL, NULL, NULL, '2020-04-29 13:55:49', '2020-04-29 13:55:49'),
(1890, 980, 'fugit', '/photos/shares/sliver.jpg', 100, 100, 14529234, 15529234, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1891, 980, 'omnis', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 8812505, 9812505, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1892, 980, 'quia', '/photos/shares/s10-5g.jpg', 100, 100, 18897335, 19897335, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1893, 980, 'reiciendis', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 9761661, 10761661, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1894, 981, 'voluptatem', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 16475142, 17475142, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1895, 981, 'ea', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 6964150, 7964150, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1896, 981, 'et', '/photos/shares/cool-black.jpg', 100, 100, 10410431, 11410431, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1897, 981, 'sed', '/photos/shares/s10-5g.jpg', 100, 100, 16646688, 17646688, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1898, 982, 'nostrum', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 6900844, 7900844, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1899, 982, 'dolorem', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 1099153, 2099153, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1900, 982, 'deserunt', '/photos/shares/sliver.jpg', 100, 100, 1987354, 2987354, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1901, 982, 'accusamus', '/photos/shares/blue.jpg', 100, 100, 9751408, 10751408, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1902, 983, 'temporibus', '/photos/shares/sliver.jpg', 100, 100, 15198527, 16198527, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1903, 983, 'dolores', '/photos/shares/5.jpg', 100, 100, 19139034, 20139034, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1904, 983, 'magni', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 7346873, 8346873, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1905, 983, 'veritatis', '/photos/shares/samsung-s10.jpg', 100, 100, 5997589, 6997589, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1906, 984, 'nam', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 18859539, 19859539, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1907, 984, 'aut', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 5054940, 6054940, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1908, 984, 'non', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 14630252, 15630252, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1909, 984, 'illum', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 12095455, 13095455, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1910, 985, 'illo', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 7826609, 8826609, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1911, 985, 'optio', '/photos/shares/s10-5g.jpg', 100, 100, 13305269, 14305269, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1912, 985, 'aliquam', '/photos/shares/cool-black.jpg', 100, 100, 15225576, 16225576, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1913, 985, 'ut', '/photos/shares/redmi-note-8a.jpg', 100, 100, 4569687, 5569687, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1914, 986, 'alias', '/photos/shares/6.jpg', 100, 100, 3324679, 4324679, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1915, 986, 'eum', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 11622397, 12622397, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1916, 986, 'qui', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 12932007, 13932007, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1917, 986, 'voluptatibus', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 11516392, 12516392, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1918, 987, 'in', '/photos/shares/samsung-s10.jpg', 100, 100, 2585156, 3585156, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1919, 987, 'doloremque', '/photos/shares/6.jpg', 100, 100, 7533721, 8533721, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1920, 987, 'est', '/photos/shares/cool-black.jpg', 100, 100, 17355559, 18355559, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1921, 987, 'unde', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 6498244, 7498244, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1922, 988, 'quidem', '/photos/shares/sliver.jpg', 100, 100, 16801976, 17801976, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1923, 988, 'rerum', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 11682396, 12682396, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1924, 988, 'voluptas', '/photos/shares/6.jpg', 100, 100, 12632092, 13632092, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1925, 988, 'sapiente', '/photos/shares/cool-black.jpg', 100, 100, 7771803, 8771803, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1926, 989, 'enim', '/photos/shares/cool-black.jpg', 100, 100, 16790440, 17790440, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1927, 989, 'laborum', '/photos/shares/cool-black.jpg', 100, 100, 13867717, 14867717, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1928, 989, 'debitis', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 3755796, 4755796, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1929, 989, 'consequatur', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 7921825, 8921825, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1930, 990, 'minus', '/photos/shares/s10-5g.jpg', 100, 100, 7980816, 8980816, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1931, 990, 'ullam', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 12888358, 13888358, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1932, 990, 'necessitatibus', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 6630601, 7630601, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1933, 990, 'minima', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 4183766, 5183766, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1934, 991, 'eligendi', '/photos/shares/s10-5g.jpg', 100, 100, 3984951, 4984951, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1935, 991, 'aspernatur', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 11782854, 12782854, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1936, 991, 'repellendus', '/photos/shares/redmi-note-8a.jpg', 100, 100, 7693147, 8693147, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1937, 991, 'nulla', '/photos/shares/cool-black.jpg', 100, 100, 13022924, 14022924, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1938, 992, 'ipsam', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 15218587, 16218587, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1939, 992, 'perferendis', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 4711713, 5711713, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1940, 992, 'adipisci', '/photos/shares/samsung-s10.jpg', 100, 100, 1128881, 2128881, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1941, 992, 'commodi', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 5363733, 6363733, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1942, 993, 'tempora', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 1237154, 2237154, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1943, 993, 'ratione', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 3886004, 4886004, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1944, 993, 'occaecati', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 4703583, 5703583, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1945, 993, 'quam', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 6278322, 7278322, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1946, 994, 'nihil', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 1973872, 2973872, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1947, 994, 'vel', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 13702334, 14702334, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1948, 994, 'modi', '/photos/shares/5.jpg', 100, 100, 3806534, 4806534, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1949, 994, 'voluptate', '/photos/shares/6.jpg', 100, 100, 13026002, 14026002, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1950, 995, 'porro', '/photos/shares/cool-black.jpg', 100, 100, 15409399, 16409399, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1951, 995, 'at', '/photos/shares/redmi-note-8a.jpg', 100, 100, 18429058, 19429058, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1952, 995, 'exercitationem', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 8944892, 9944892, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1953, 995, 'fugiat', '/photos/shares/cool-black.jpg', 100, 100, 6355681, 7355681, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1954, 996, 'nisi', '/photos/shares/samsung-s10.jpg', 100, 100, 16134869, 17134869, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1955, 996, 'dolor', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 6467605, 7467605, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1956, 996, 'velit', '/photos/shares/5.jpg', 100, 100, 13391624, 14391624, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1957, 996, 'assumenda', '/photos/shares/5.jpg', 100, 100, 14348397, 15348397, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1958, 997, 'iste', '/photos/shares/samsung-s10.jpg', 100, 100, 5977946, 6977946, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1959, 997, 'quae', '/photos/shares/blue.jpg', 100, 100, 13725077, 14725077, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1960, 997, 'labore', '/photos/shares/6.jpg', 100, 100, 10471709, 11471709, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1961, 997, 'consectetur', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 11621920, 12621920, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1962, 998, 'itaque', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 11428165, 12428165, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1963, 998, 'architecto', '/photos/shares/sliver.jpg', 100, 100, 7047295, 8047295, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1964, 998, 'culpa', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 8628719, 9628719, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1965, 998, 'ducimus', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 17396000, 18396000, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1966, 999, 'similique', '/photos/shares/blue.jpg', 100, 100, 6053724, 7053724, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1967, 999, 'nobis', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 1147487, 2147487, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1968, 999, 'numquam', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 17299873, 18299873, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1969, 999, 'laudantium', '/photos/shares/blue.jpg', 100, 100, 11780672, 12780672, NULL, NULL, NULL, '2020-04-29 13:55:50', '2020-04-29 13:55:50'),
(1970, 1000, 'optio', '/photos/shares/redmi-note-8a.jpg', 100, 100, 15292672, 16292672, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1971, 1000, 'corporis', '/photos/shares/blue.jpg', 100, 100, 7789833, 8789833, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1972, 1000, 'esse', '/photos/shares/5.jpg', 100, 100, 8297503, 9297503, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1973, 1000, 'sed', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 6107177, 7107177, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1974, 1001, 'incidunt', '/photos/shares/samsung-s10.jpg', 100, 100, 16981503, 17981503, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1975, 1001, 'qui', '/photos/shares/samsung-s10.jpg', 100, 100, 7666148, 8666148, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1976, 1001, 'rerum', '/photos/shares/cool-black.jpg', 100, 100, 15020018, 16020018, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1977, 1001, 'non', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 17702813, 18702813, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1978, 1002, 'distinctio', '/photos/shares/sliver.jpg', 100, 100, 7996099, 8996099, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1979, 1002, 'enim', '/photos/shares/5.jpg', 100, 100, 5919679, 6919679, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1980, 1002, 'velit', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 11339948, 12339948, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1981, 1002, 'sit', '/photos/shares/sliver.jpg', 100, 100, 16900052, 17900052, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1982, 1003, 'harum', '/photos/shares/blue.jpg', 100, 100, 10596900, 11596900, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1983, 1003, 'quia', '/photos/shares/5.jpg', 100, 100, 13893839, 14893839, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1984, 1003, 'ut', '/photos/shares/5.jpg', 100, 100, 4805089, 5805089, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1985, 1003, 'libero', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 15411500, 16411500, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1986, 1004, 'error', '/photos/shares/samsung-s10.jpg', 100, 100, 16541862, 17541862, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1987, 1004, 'dolorem', '/photos/shares/blue.jpg', 100, 100, 2884422, 3884422, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1988, 1004, 'minus', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 17483392, 18483392, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1989, 1004, 'dolorum', '/photos/shares/5.jpg', 100, 100, 2644316, 3644316, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1990, 1005, 'architecto', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 13422844, 14422844, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1991, 1005, 'debitis', '/photos/shares/blue.jpg', 100, 100, 13259911, 14259911, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1992, 1005, 'dicta', '/photos/shares/s10-5g.jpg', 100, 100, 8566949, 9566949, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1993, 1005, 'omnis', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 8297940, 9297940, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1994, 1006, 'et', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 6581164, 7581164, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1995, 1006, 'a', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 5936548, 6936548, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1996, 1006, 'consequuntur', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 12360107, 13360107, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1997, 1006, 'facilis', '/photos/shares/s10-5g.jpg', 100, 100, 2293346, 3293346, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1998, 1007, 'eos', '/photos/shares/redmi-note-8a.jpg', 100, 100, 16619367, 17619367, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(1999, 1007, 'voluptatum', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 11334584, 12334584, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2000, 1007, 'excepturi', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 18757343, 19757343, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2001, 1007, 'aut', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 15905284, 16905284, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2002, 1008, 'cumque', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 11341425, 12341425, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2003, 1008, 'assumenda', '/photos/shares/samsung-s10.jpg', 100, 100, 16962059, 17962059, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2004, 1008, 'illum', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 7998313, 8998313, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2005, 1008, 'quas', '/photos/shares/s10-5g.jpg', 100, 100, 11893160, 12893160, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2006, 1009, 'nesciunt', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 10726670, 11726670, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2007, 1009, 'unde', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 18249411, 19249411, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2008, 1009, 'quo', '/photos/shares/cool-black.jpg', 100, 100, 4663359, 5663359, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2009, 1009, 'molestias', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 5524542, 6524542, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2010, 1010, 'adipisci', '/photos/shares/samsung-s10.jpg', 100, 100, 5298245, 6298245, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2011, 1010, 'quibusdam', '/photos/shares/6.jpg', 100, 100, 18178099, 19178099, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2012, 1010, 'est', '/photos/shares/samsung-s10.jpg', 100, 100, 6810542, 7810542, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2013, 1010, 'delectus', '/photos/shares/5.jpg', 100, 100, 19901775, 20901775, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2014, 1011, 'alias', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 2309846, 3309846, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2015, 1011, 'voluptas', '/photos/shares/s10-5g.jpg', 100, 100, 14405820, 15405820, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2016, 1011, 'dolores', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 3423794, 4423794, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2017, 1011, 'deserunt', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 16737815, 17737815, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2018, 1012, 'possimus', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 15569048, 16569048, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2019, 1012, 'tempore', '/photos/shares/sliver.jpg', 100, 100, 1977209, 2977209, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2020, 1012, 'id', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 18891773, 19891773, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2021, 1012, 'impedit', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 15677511, 16677511, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2022, 1013, 'fugiat', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 15184941, 16184941, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2023, 1013, 'repellat', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 19249371, 20249371, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2024, 1013, 'ea', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 6638408, 7638408, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2025, 1013, 'nisi', '/photos/shares/6.jpg', 100, 100, 6327394, 7327394, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2026, 1014, 'earum', '/photos/shares/redmi-note-8a.jpg', 100, 100, 1549923, 2549923, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2027, 1014, 'repellendus', '/photos/shares/redmi-note-8a.jpg', 100, 100, 3308685, 4308685, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2028, 1014, 'perspiciatis', '/photos/shares/5.jpg', 100, 100, 12151186, 13151186, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2029, 1014, 'natus', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 6016594, 7016594, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2030, 1015, 'laboriosam', '/photos/shares/6.jpg', 100, 100, 10274062, 11274062, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2031, 1015, 'voluptatem', '/photos/shares/redmi-note-8a.jpg', 100, 100, 5208195, 6208195, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2032, 1015, 'repudiandae', '/photos/shares/s10-5g.jpg', 100, 100, 2601979, 3601979, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2033, 1015, 'modi', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 12595852, 13595852, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2034, 1016, 'cupiditate', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 2306372, 3306372, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2035, 1016, 'expedita', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 16839474, 17839474, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2036, 1016, 'labore', '/photos/shares/6.jpg', 100, 100, 14963632, 15963632, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2037, 1016, 'reprehenderit', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 13752069, 14752069, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2038, 1017, 'molestiae', '/photos/shares/6.jpg', 100, 100, 9963469, 10963469, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2039, 1017, 'quae', '/photos/shares/cool-black.jpg', 100, 100, 5077222, 6077222, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2040, 1017, 'ullam', '/photos/shares/cool-black.jpg', 100, 100, 7125690, 8125690, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2041, 1017, 'quos', '/photos/shares/sliver.jpg', 100, 100, 3700577, 4700577, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2042, 1018, 'quis', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 9147646, 10147646, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2043, 1018, 'iure', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 14003966, 15003966, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2044, 1018, 'tenetur', '/photos/shares/blue.jpg', 100, 100, 16286450, 17286450, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2045, 1018, 'soluta', '/photos/shares/5.jpg', 100, 100, 12971577, 13971577, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2046, 1019, 'consequatur', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 9414494, 10414494, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2047, 1019, 'amet', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 7240460, 8240460, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2048, 1019, 'praesentium', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 19567213, 20567213, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2049, 1019, 'provident', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 12950537, 13950537, NULL, NULL, NULL, '2020-04-29 13:55:52', '2020-04-29 13:55:52'),
(2050, 1020, 'amet', '/photos/shares/cool-black.jpg', 100, 100, 2341807, 3341807, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2051, 1020, 'facere', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 13050813, 14050813, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2052, 1020, 'omnis', '/photos/shares/cool-black.jpg', 100, 100, 7459431, 8459431, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2053, 1020, 'voluptatem', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 4376239, 5376239, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2054, 1021, 'libero', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 4962978, 5962978, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2055, 1021, 'magni', '/photos/shares/redmi-note-8a.jpg', 100, 100, 17553373, 18553373, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2056, 1021, 'voluptate', '/photos/shares/redmi-note-8a.jpg', 100, 100, 3671289, 4671289, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2057, 1021, 'eum', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 7011238, 8011238, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2058, 1022, 'aliquam', '/photos/shares/redmi-note-8a.jpg', 100, 100, 2444183, 3444183, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2059, 1022, 'modi', '/photos/shares/s10-5g.jpg', 100, 100, 12537706, 13537706, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54');
INSERT INTO `product_details` (`id`, `product_id`, `color`, `image`, `import_quantity`, `quantity`, `import_price`, `sale_price`, `promotion_price`, `promotion_start_date`, `promotion_end_date`, `created_at`, `updated_at`) VALUES
(2060, 1022, 'dolores', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 15542502, 16542502, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2061, 1022, 'et', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 7752172, 8752172, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2062, 1023, 'atque', '/photos/shares/blue.jpg', 100, 100, 14146843, 15146843, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2063, 1023, 'exercitationem', '/photos/shares/iphone11-pro-max.jpg', 100, 99, 12449032, 13449032, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-06-25 09:52:06'),
(2064, 1023, 'est', '/photos/shares/5.jpg', 100, 100, 3380185, 4380185, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2065, 1023, 'numquam', '/photos/shares/5.jpg', 100, 100, 15028649, 16028649, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2066, 1024, 'aperiam', '/photos/shares/6.jpg', 100, 99, 15634222, 16634222, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-05-10 14:49:04'),
(2067, 1024, 'expedita', '/photos/shares/sliver.jpg', 100, 100, 4536810, 5536810, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2068, 1024, 'quos', '/photos/shares/mi-cc9e-blue.jpg', 100, 100, 11702676, 12702676, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2069, 1024, 'at', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 100, 14116980, 15116980, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2070, 1025, 'eos', '/photos/shares/s10-5g.jpg', 100, 100, 9781290, 10781290, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2071, 1025, 'adipisci', '/photos/shares/samsung-s10.jpg', 100, 100, 2760587, 3760587, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2072, 1025, 'eligendi', '/photos/shares/blue.jpg', 100, 100, 19694359, 20694359, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2073, 1025, 'sed', '/photos/shares/blue.jpg', 100, 100, 4363296, 5363296, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2074, 1026, 'sapiente', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 8876722, 9876722, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2075, 1026, 'minima', '/photos/shares/redmi-note-8a.jpg', 100, 100, 8412481, 9412481, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2076, 1026, 'sint', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 12437374, 13437374, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2077, 1026, 'nihil', '/photos/shares/cool-black.jpg', 100, 100, 11917526, 12917526, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2078, 1027, 'architecto', '/photos/shares/cool-black.jpg', 100, 94, 10436613, 11436613, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-06-25 09:42:32'),
(2079, 1027, 'repellat', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 16033189, 17033189, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2080, 1027, 'blanditiis', '/photos/shares/blue.jpg', 100, 100, 2624570, 3624570, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2081, 1027, 'quod', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 5336692, 6336692, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2082, 1028, 'dolorum', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 99, 2946749, 3946749, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-06-25 09:52:29'),
(2083, 1028, 'commodi', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 4248759, 5248759, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2084, 1028, 'odit', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 19199900, 20199900, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2085, 1028, 'incidunt', '/photos/shares/6.jpg', 100, 100, 19383711, 20383711, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2086, 1029, 'ducimus', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 3445958, 4445958, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2087, 1029, 'aut', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 3858070, 4858070, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2088, 1029, 'ea', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 13881505, 14881505, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2089, 1029, 'sit', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 18183667, 19183667, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2090, 1030, 'velit', '/photos/shares/xiaomi-redmi-note-8-pro.jpg', 100, 97, 17713687, 18713687, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-07-12 13:42:59'),
(2091, 1030, 'cupiditate', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 10311187, 11311187, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2092, 1030, 'magnam', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 12461064, 13461064, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2093, 1030, 'non', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 1413901, 2413901, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2094, 1031, 'vero', '/photos/shares/xiaomi-mi-8-lite-hong.jpg', 100, 100, 4197824, 5197824, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2095, 1031, 'quibusdam', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 4075846, 5075846, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2096, 1031, 'doloribus', '/photos/shares/5.jpg', 100, 100, 1442252, 2442252, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2097, 1031, 'vel', '/photos/shares/blue.jpg', 100, 100, 10024879, 11024879, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2098, 1032, 'dolorem', '/photos/shares/s10-5g.jpg', 100, 99, 8268395, 9268395, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-07-12 13:41:15'),
(2099, 1032, 'illo', '/photos/shares/samsung-s10.jpg', 100, 100, 13652430, 14652430, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2100, 1032, 'doloremque', '/photos/shares/samsung-s10.jpg', 100, 100, 3270562, 4270562, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2101, 1032, 'facilis', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 16690546, 17690546, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2102, 1033, 'aspernatur', '/photos/shares/sliver.jpg', 100, 97, 18864849, 19864849, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-07-27 02:49:45'),
(2103, 1033, 'ipsam', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 19575822, 20575822, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2104, 1033, 'voluptas', '/photos/shares/xiaomi-black-shark-2-pro-1.jpg', 100, 100, 3222261, 4222261, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2105, 1033, 'earum', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 4777068, 5777068, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2106, 1034, 'veritatis', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 6016342, 7016342, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2107, 1034, 'quia', '/photos/shares/redmi-note-8a.jpg', 100, 100, 19412180, 20412180, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2108, 1034, 'sunt', '/photos/shares/5.jpg', 100, 100, 2503562, 3503562, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2109, 1034, 'quam', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 8011500, 9011500, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2110, 1035, 'ut', '/photos/shares/5.jpg', 100, 100, 7087434, 8087434, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2111, 1035, 'porro', '/photos/shares/5.jpg', 100, 100, 9678404, 10678404, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2112, 1035, 'occaecati', '/photos/shares/iphone11-pro-max.jpg', 100, 100, 19129600, 20129600, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2113, 1035, 'nam', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 9684562, 10684562, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2114, 1036, 'ipsa', '/photos/shares/redmi-k30-5g-blue.jpg', 100, 100, 6152015, 7152015, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2115, 1036, 'voluptatum', '/photos/shares/cool-black.jpg', 100, 100, 11583068, 12583068, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2116, 1036, 'ex', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 4125430, 5125430, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2117, 1036, 'tenetur', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 3233497, 4233497, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2118, 1037, 'rerum', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 14316735, 15316735, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2119, 1037, 'nesciunt', '/photos/shares/redmi-note-8a.jpg', 100, 100, 4011190, 5011190, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2120, 1037, 'impedit', '/photos/shares/samsung-note-10-plus-2.jpg', 100, 100, 15511437, 16511437, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54'),
(2121, 1037, 'deleniti', '/photos/shares/iphone-7-plus-jetblack.jpg', 100, 100, 19080626, 20080626, NULL, NULL, NULL, '2020-04-29 13:55:54', '2020-04-29 13:55:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_votes`
--

CREATE TABLE `product_votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double(2,1) NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_votes`
--

INSERT INTO `product_votes` (`id`, `product_id`, `name`, `email`, `rate`, `content`, `created_at`, `updated_at`) VALUES
(10, 1033, 'thang pham', 'thang@gmail.com', 4.5, '2323rewwe', '2020-04-30 14:20:07', '2020-04-30 14:20:07'),
(11, 1025, 'thang pham', 'thang@gmail.com', 5.0, 'sadasd', '2020-04-30 14:20:44', '2020-04-30 14:20:44'),
(12, 1024, 'thang pham', 'thang@gmail.com', 5.0, 'qưeqwe', '2020-04-30 14:21:53', '2020-04-30 14:21:53'),
(13, 1027, 'thang pham', 'thang@gmail.com', 5.0, '123', '2020-05-14 13:24:52', '2020-05-14 13:24:52'),
(14, 1023, 'Người Tình Mùa Đông', 'chiataydi@gmail.com', 4.5, 'Hàng tốt, chất lượng miễn chê!!!', '2020-06-23 08:26:29', '2020-06-23 08:26:29'),
(15, 1023, 'Nguyễn Văn Tèo', 'TeoLaAnh@gmail.com', 5.0, 'Sản phẩm rất xịn :))', '2020-06-23 08:27:09', '2020-06-23 08:27:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `order`, `link`, `status`, `created_at`, `updated_at`) VALUES
(2, '/photos/shares/banner.jpg', 2, NULL, 1, '2020-04-27 14:30:59', '2020-05-04 09:13:36'),
(3, '/photos/shares/k30-3-pro.jpg', 1, NULL, 1, '2020-05-01 08:19:36', '2020-05-14 13:15:21'),
(4, '/photos/shares/k30banner-2.jpg', 1, 'https://mobilecity.vn/', 1, '2020-05-01 08:19:53', '2020-05-14 13:15:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '0: nữ, 1: nam',
  `avatar_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1: admin, 2: member',
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_register` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1: Gmail, 2: Google, 3: Facebook',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: disable, 1: active',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `gender`, `avatar_image`, `type`, `social_id`, `type_register`, `status`, `password`, `active_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'minhanh2000xzc@gmail.com', NULL, NULL, NULL, NULL, 1, '', '', 1, '$2y$10$WBcHFwlvSP2lSBBF7rIx6.4A8i/azSlGZd1ij6Uo9lPSmTzbkAhH6', NULL, 'SYYAUql5o79mE0LilB1yuZvht2qKKGYfpHZC4NewSasaX2tCKoS7aVLlTqER', '2020-04-05 07:29:05', '2020-04-07 09:07:37'),
(2, 'thang pham', 'thang@gmail.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$FymnUjyTVdJu8IGE/ITSm.NAd/ZkoNfv0jUCa3BZPUsAdvMXFou4S', NULL, NULL, '2020-04-20 03:20:26', '2020-04-20 03:20:26'),
(3, 'fdfdsfd', 'admin@gmail.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$bRKqsElo.VQGrEcGji5kjOXP5/xy0oH4cAxviaQXZ2rJMcMDyfsq6', NULL, NULL, '2020-04-20 03:23:03', '2020-04-20 03:23:03'),
(4, 'yuamikami', 'yuamikami@gmail.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$vsd.gZJz8MdplB8o26aQHuZZt3iYiwYK/hZjEQo7VFuGORYDucds2', NULL, NULL, '2020-04-20 06:23:13', '2020-04-20 06:23:13'),
(5, 'phamanhthang', 'thangdeptrai@gmail.com', '0345419777', NULL, NULL, NULL, 2, '', '', 0, '$2y$10$2dh69F2PK/cChRho7PRPquvJiwTYX/kGd9uKJitZa4IlafTSdzbWS', NULL, NULL, '2020-04-20 08:33:12', '2020-04-28 03:08:48'),
(6, 'adaf', 'thangzzz@gmail.com', '0345419666', NULL, NULL, NULL, 2, '', '', 1, '$2y$10$JAKxCkyRzUUk0ndgG5PAFOwSKrURI2OLWS1Yl8ehRTr7C3.aZ2tCC', NULL, NULL, '2020-04-28 03:09:28', '2020-04-28 03:09:28'),
(14, 'Wellington Raynor', 'isadore32@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:20:15', '2020-04-28 15:20:15'),
(15, 'Dr. Laverna Gleichner', 'jaida.rodriguez@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(16, 'Jessy Bernier', 'kaden51@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(17, 'Haskell Gulgowski', 'efren.schuppe@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(18, 'Miss Marlene Gutmann', 'mathias68@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(19, 'Armand Hessel', 'armani.hayes@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(20, 'Robin Hauck', 'gweissnat@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(21, 'Beth Lebsack', 'aaliyah09@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(22, 'Mrs. Kristy Streich II', 'victoria.hane@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(23, 'Desiree Vandervort', 'rowan.jacobs@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(24, 'Efren Wolff', 'eva33@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(25, 'Miss Oleta Ondricka', 'sbeer@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(26, 'Demarco Hodkiewicz', 'emmett.feil@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(27, 'Ms. Clare Weimann', 'rosalee19@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(28, 'Miss Emma Murray', 'vgoldner@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(29, 'Mr. Geovanni Rowe DDS', 'rpfeffer@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(30, 'Prof. Shea Stark', 'louvenia93@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(31, 'Pansy McDermott V', 'fbogan@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(32, 'Mr. Misael Koepp Sr.', 'raynor.leilani@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(33, 'Grayson Schamberger', 'adolfo.hickle@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(34, 'Jayme Haag', 'rcartwright@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(35, 'Prof. Soledad Sipes PhD', 'clovis.toy@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(36, 'Phoebe Bogisich', 'rickey13@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(37, 'Mr. Adelbert Bode DVM', 'bhamill@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(38, 'Virginie Schowalter', 'kamren.hane@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(39, 'Dr. Brandon Parker III', 'alexzander63@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(40, 'Arjun Kemmer', 'cormier.kenneth@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(41, 'Randall Marks', 'stephany47@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(42, 'Freeman Ledner', 'fkihn@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(43, 'Julio Gibson IV', 'carroll.adriel@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(44, 'Dr. Jayson Doyle I', 'emily.funk@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:26', '2020-04-28 15:23:26'),
(45, 'Mr. Dylan Monahan DVM', 'genevieve38@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(46, 'Ms. Isabelle Wintheiser MD', 'upton.favian@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(47, 'Brandi Kulas', 'monty.batz@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(48, 'Mr. Jarret Koss Jr.', 'schultz.keenan@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(49, 'Nestor Leuschke', 'chelsie.bergstrom@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(50, 'Dena Wiza', 'elvera.witting@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(51, 'Mylene Ondricka', 'ralph.bergstrom@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(52, 'Miss Celestine Zboncak', 'pbashirian@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(53, 'Charles Borer', 'leffler.wanda@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(54, 'Dr. Robyn Maggio Sr.', 'damion.hettinger@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(55, 'Eddie Gleichner I', 'heber.homenick@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(56, 'Meaghan Hammes', 'kemard@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(57, 'Geovanni Russel', 'cleta91@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(58, 'Hubert Bayer', 'bwintheiser@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(59, 'Maida Wilkinson', 'newell.koch@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(60, 'Jamie Padberg', 'fthompson@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(61, 'Lia Gutmann', 'rogahn.vida@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(62, 'Ezekiel Volkman', 'ndach@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(63, 'Sarah Fritsch', 'kyundt@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(64, 'Jamar Kohler', 'donnell.dubuque@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(65, 'Michelle Gusikowski', 'thuel@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(66, 'Diego Abbott PhD', 'ssporer@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(67, 'Amelia Corkery', 'isobel44@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(68, 'Darrin Bernier', 'kwisoky@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(69, 'Eleazar Cruickshank MD', 'eschoen@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(70, 'General Herman', 'oleta84@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(71, 'Julie Sauer', 'rkling@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(72, 'Maribel Koepp III', 'king44@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(73, 'Michelle Rath', 'gtorp@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(74, 'Kelly Robel', 'cristal.paucek@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(75, 'Dr. Hubert Skiles', 'luettgen.griffin@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(76, 'Ms. Madelyn Gutkowski', 'block.elissa@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(77, 'Moriah Hauck', 'murl.medhurst@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(78, 'Betty Bayer PhD', 'sporer.shanon@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(79, 'Eusebio Bednar II', 'odubuque@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(80, 'Alize Gislason', 'velda.eichmann@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(81, 'Odessa Rowe', 'cummings.dave@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(82, 'Adelle Nikolaus', 'riley12@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(83, 'Ms. Rhea Balistreri', 'iklein@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(84, 'Dr. Sonya Lind', 'maggio.liliane@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(85, 'Prof. Hobart Nikolaus DDS', 'laisha98@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(86, 'Zola Mohr', 'tristin46@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(87, 'Vladimir Beier', 'tremaine.rice@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(88, 'Kendall Wiza', 'jbayer@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(89, 'Danny Cummings', 'alda17@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(90, 'Bernie Greenfelder', 'hmacejkovic@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(91, 'Lucio Mann', 'toni52@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(92, 'Aylin Bogisich DDS', 'marilyne07@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(93, 'Sammy Reichel DDS', 'lang.sylvester@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(94, 'Prof. Kobe Balistreri II', 'eichmann.colleen@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(95, 'Orland Barrows', 'bridgette.runolfsson@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(96, 'Emmanuelle Mayer', 'ahmad.leffler@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(97, 'Jewell Will', 'tconroy@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(98, 'Dr. Damion Heaney DVM', 'kuhic.terrell@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(99, 'Cathrine Flatley', 'bergstrom.kyla@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(100, 'Bernadette Dare', 'leta.ohara@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(101, 'Emelia Hirthe I', 'mbreitenberg@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(102, 'Mr. Rasheed Gutkowski MD', 'juanita.rath@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(103, 'Abdullah Goodwin', 'marianna.ziemann@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(104, 'Ms. Edna Price Sr.', 'elyssa32@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(105, 'Jonatan Carroll', 'trystan.ratke@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(106, 'Kaden Kub', 'runte.roel@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(107, 'Gretchen Daugherty', 'eyost@example.com', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(108, 'Tyra Cassin', 'leila.oconner@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(109, 'Lilly Hirthe', 'haley.lambert@example.net', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(110, 'Mr. Rudolph Cummings', 'hagenes.earl@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(111, 'Gunner Kris', 'ressie.nienow@example.org', NULL, NULL, NULL, NULL, 2, '', '', 1, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-04-28 15:23:27'),
(112, 'Nicolette Wisoky II', 'okon.sage@example.org', NULL, NULL, NULL, NULL, 2, '', '', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-05-14 13:16:01'),
(113, 'Petra Bosco', 'norwood.collier@example.org', NULL, NULL, NULL, NULL, 2, '', '', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-05-14 13:16:00'),
(114, 'Mrs. May Feeney PhD', 'ubradtke@example.net', NULL, NULL, NULL, NULL, 2, '', '', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', NULL, NULL, '2020-04-28 15:23:27', '2020-05-14 13:16:05'),
(118, 'thangdeptraihihi', 'thang3333@gmail.com', '0345419111', NULL, NULL, NULL, 2, NULL, '1', 0, '$2y$10$ElaE0qIYdBFIVIZOEF4J0uSl7adAXejPj8g7fDrOyEYBRRc6raSdW', NULL, NULL, '2020-05-04 02:36:19', '2020-05-14 13:15:58'),
(120, 'Anh Thang', 'thangepzai98@gmail.com', NULL, NULL, NULL, NULL, 2, '2604487273204850', '3', 1, NULL, NULL, 'dRX3RoASlJ1ycVqq9llLQImg0GkeyiHQRyAbpdvQuB1IvGLrZNd8IhNmAWlx', '2020-05-04 07:06:04', '2020-05-04 07:06:04');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_detail_id_foreign` (`product_detail_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku_code` (`sku_code`),
  ADD KEY `product_category_id_foreign` (`category_id`) USING BTREE;

--
-- Chỉ mục cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `product_votes`
--
ALTER TABLE `product_votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_votes_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1038;

--
-- AUTO_INCREMENT cho bảng `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2122;

--
-- AUTO_INCREMENT cho bảng `product_votes`
--
ALTER TABLE `product_votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_detail_id_foreign` FOREIGN KEY (`product_detail_id`) REFERENCES `product_details` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_votes`
--
ALTER TABLE `product_votes`
  ADD CONSTRAINT `product_votes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
