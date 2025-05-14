
-- Table structure for table `cache`
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `cache`
INSERT INTO `cache` VALUES('laravel_cache_1b6453892473a467d07372d45eb05abc2031647a','i:1;','1747196126');
INSERT INTO `cache` VALUES('laravel_cache_1b6453892473a467d07372d45eb05abc2031647a:timer','i:1747196126;','1747196126');

-- Table structure for table `cache_locks`
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table structure for table `comments`
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `comments`
INSERT INTO `comments` VALUES('2','ádasd','2','1','2025-05-14 02:47:02','2025-05-14 02:47:02');
INSERT INTO `comments` VALUES('5','adssssss','2','1','2025-05-14 03:04:26','2025-05-14 03:04:26');
INSERT INTO `comments` VALUES('6','Xin chào tôi là tôi đi code dạo','2','1','2025-05-14 03:54:26','2025-05-14 03:54:26');
INSERT INTO `comments` VALUES('7','được của nó đấy','3','1','2025-05-14 03:57:43','2025-05-14 03:57:43');
INSERT INTO `comments` VALUES('8','Ối dồi oi','4','1','2025-05-14 04:15:13','2025-05-14 04:15:13');

-- Table structure for table `failed_jobs`
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table structure for table `job_batches`
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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table structure for table `jobs`
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table structure for table `migrations`
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `migrations`
INSERT INTO `migrations` VALUES('1','0001_01_01_000000_create_users_table','1');
INSERT INTO `migrations` VALUES('2','0001_01_01_000001_create_cache_table','1');
INSERT INTO `migrations` VALUES('3','0001_01_01_000002_create_jobs_table','1');
INSERT INTO `migrations` VALUES('4','2025_05_12_020710_create_posts_table','1');
INSERT INTO `migrations` VALUES('5','2025_05_12_022357_add_admin_field_to_users_table','1');
INSERT INTO `migrations` VALUES('6','2025_05_12_032045_add_is_admin_to_users_table','1');
INSERT INTO `migrations` VALUES('7','2025_05_14_012025_create_comments_table','2');
INSERT INTO `migrations` VALUES('8','2025_05_15_000000_create_notifications_table','3');
INSERT INTO `migrations` VALUES('9','2025_05_14_030932_add_view_count_to_posts_table','4');

-- Table structure for table `notifications`
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `notifications`
INSERT INTO `notifications` VALUES('27a50e99-a881-475a-81c2-6e83249c6f01','App\\Notifications\\NewCommentNotification','App\\Models\\User','1','{\"message\":\"Ph\\u1ea1m Huy Ho\\u00e0ng commented on your post \\\"\\u00e1da\\\"\",\"link\":\"\\/posts\\/1\",\"comment_id\":7,\"post_id\":1}',NULL,'2025-05-14 03:57:45','2025-05-14 03:57:45');
INSERT INTO `notifications` VALUES('ab2e42d4-7ae8-420e-91ad-29badc234839','App\\Notifications\\NewCommentNotification','App\\Models\\User','1','{\"message\":\"Ajxx commented on your post \\\"\\u00e1da\\\"\",\"link\":\"\\/posts\\/1\",\"comment_id\":6,\"post_id\":1}',NULL,'2025-05-14 03:54:31','2025-05-14 03:54:31');
INSERT INTO `notifications` VALUES('ba2b52b6-e5de-4e52-bc0d-5eef73c66f11','App\\Notifications\\NewCommentNotification','App\\Models\\User','1','{\"message\":\"Ajxx commented on your post \\\"\\u00e1da\\\"\",\"link\":\"\\/posts\\/1\",\"comment_id\":5,\"post_id\":1}',NULL,'2025-05-14 03:04:44','2025-05-14 03:04:44');
INSERT INTO `notifications` VALUES('da984a88-ec45-45f8-98b6-4c2842808b99','App\\Notifications\\NewCommentNotification','App\\Models\\User','1','{\"message\":\"RinKu Onino commented on your post \\\"\\u00e1da\\\"\",\"link\":\"\\/posts\\/1\",\"comment_id\":8,\"post_id\":1}',NULL,'2025-05-14 04:15:16','2025-05-14 04:15:16');

-- Table structure for table `password_reset_tokens`
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table structure for table `posts`
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `view_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `posts`
INSERT INTO `posts` VALUES('1','1','áda','123','2025-05-14 02:13:36','2025-05-14 04:15:13','7');

-- Table structure for table `sessions`
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `sessions`
INSERT INTO `sessions` VALUES('AEtoH9mDD0bVEjOZ35BuVMru5vmeqJ3oeIkJAaGK','4','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYlZZbFEza2RxNjVuaWlrbVFWV2Y5cVpSUmRXNUtGY1l2Mll6NEl3OCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3N0cy8xIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjM6InVybCI7YTowOnt9fQ==','1747196113');
INSERT INTO `sessions` VALUES('oHAPMol7I9VbcyfR4Ix9SeoXuNIAe3q44PN0HtYc','1','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSXJSajVrQkR5YXVaU3J0N3NYSFFGY3NpdXJidzdBRElvVDhGZ0pEWSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=','1747196132');

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` VALUES('1','RinKu','tungxeko912@gmail.com','2025-05-14 01:12:38','$2y$12$dOB04z36wkaKTmz0L7l2WOPmBePi.RWOZVLkNmH7iTmmJr3cULgAO',NULL,'2025-05-14 01:12:19','2025-05-14 01:12:38','admin','0');
INSERT INTO `users` VALUES('2','Ajxx','tungsahur@gmail.com','2025-05-14 01:17:48','$2y$12$Ea1TUcbBYiPTCArz5OuT7.OAHw4sfZb56w6.P7s7MIOwBbmcDRBO6',NULL,'2025-05-14 01:17:25','2025-05-14 01:17:48','user','0');
INSERT INTO `users` VALUES('3','Phạm Huy Hoàng','toidicodedao@gmail.com','2025-05-14 03:57:14','$2y$12$fAZMOMc07PuMrxeL7iI15em3FfzWLuCExtIU.LygM5X3lP/TsQZSa',NULL,'2025-05-14 03:56:55','2025-05-14 03:57:14','user','0');
INSERT INTO `users` VALUES('4','RinKu Onino','toidicodedao001@gmail.com','2025-05-14 04:14:26','$2y$12$8H1NUnLQTXSRf.xX5VeP8.E6eKfjZydBJZr8U5KNOBqc7oTXzq182',NULL,'2025-05-14 04:13:53','2025-05-14 04:14:26','user','0');
