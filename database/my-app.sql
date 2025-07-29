-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table my-app.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `author_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_author_id_foreign` (`author_id`),
  CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.articles: ~1 rows (approximately)
INSERT INTO `articles` (`id`, `author_id`, `title`, `content`, `published_at`, `created_at`, `updated_at`) VALUES
	(3, 2, 'Panduan Menggunakan Helpdesk', '## 🚀 Panduan Menggunakan Helpdesk IT\n\nLayanan Helpdesk IT memudahkan Anda dalam menyelesaikan berbagai masalah teknis.\n\n### ✅ Fitur Utama\n\n- Pelaporan gangguan perangkat\n- Permintaan instalasi software\n- Reset password akun\n- Monitoring status tiket\n\n### 📌 Cara Mengajukan Tiket\n\n1. Masuk ke portal IT\n2. Klik menu **"Buat Tiket Baru"**\n3. Pilih kategori masalah\n4. Isi deskripsi dengan detail\n5. Klik tombol `Kirim`\n\n> 📝 *Pastikan Anda menjelaskan masalah secara lengkap agar proses lebih cepat.*\n\n---\n\n### 💡 Tips Menulis Deskripsi Masalah\n\n- Jelaskan apa yang terjadi\n- Sebutkan perangkat yang digunakan\n- Sertakan langkah-langkah yang sudah dicoba\n- Tambahkan **screenshot** jika perlu\n\nContoh:\n\ndan ini lampiran lainnya\n![Alt Text](http://127.0.0.1:8000/storage/uploads/articles/sSApELcWs4aOeVqmVyCTTG6FEuOIeFgcDrb4uLLs.jpg)', '2025-07-28 17:00:00', '2025-07-28 23:29:48', '2025-07-29 00:11:31'),
	(4, 2, 'Information', '### Dear All\nTerlampir untuk area yang **sudah merger**, dan masih memiliki gantungan piutang harap di segerakan untuk menyelesaikan segala transaksi yang berkaitan dengan piutang area yang telah merger, karena akan segera di nonaktifkan,\n\nTerimakasih\n\n![alt text](http://127.0.0.1:8000/storage/uploads/articles/CTmGjKj8dFNU2kwHuXxWfoshucO1vv8OFt8MiOh2.jpg)', '2025-07-28 17:00:00', '2025-07-28 23:51:19', '2025-07-29 00:16:57'),
	(5, 2, 'UPDATE BACKUP SCYLLA 2025 PUKUL 16.00 WIB.', '**Dear All,\nUPDATE BACKUP SCYLLA 2025 PUKUL 16.00 WIB.**\n Dimohon untuk mengirimkan backup setiap hari melalui link Form dibawah ini. Yang masih belum lengkap/bolong2 segera dilengkapi dan pastikan aksesnya dibuka. Jika ada yang update backup dengan memakai folder mohon untuk tetap mengisi Form dan segera konfirmasi. Terima kasih\n\nBerikut Link:\n1. Monitoring Backup Scylla : [https://bit.ly/monitoring_dbscylla](https://)\n2. Form Input Monitoring dbScylla : [https://bit.ly/form-input-monitoring_dbscylla](https://)\n\nterlampir ', '2025-07-28 17:00:00', '2025-07-29 00:18:29', '2025-07-29 00:20:02');

-- Dumping structure for table my-app.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.cache: ~1 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel_cache_spatie.permission.cache', 'a:3:{s:5:"alias";a:5:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"f";s:12:"display_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:17:{i:0;a:5:{s:1:"a";i:1;s:1:"b";s:10:"view.users";s:1:"c";s:3:"web";s:1:"f";s:9:"Data User";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:5:{s:1:"a";i:6;s:1:"b";s:9:"add.users";s:1:"c";s:3:"web";s:1:"f";s:8:"Add User";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:5:{s:1:"a";i:7;s:1:"b";s:10:"edit.users";s:1:"c";s:3:"web";s:1:"f";s:11:"Update User";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:5:{s:1:"a";i:8;s:1:"b";s:12:"delete.users";s:1:"c";s:3:"web";s:1:"f";s:11:"Delete User";s:1:"r";a:1:{i:0;i:1;}}i:4;a:5:{s:1:"a";i:9;s:1:"b";s:10:"view.roles";s:1:"c";s:3:"web";s:1:"f";s:9:"Data Role";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:5;a:5:{s:1:"a";i:10;s:1:"b";s:9:"add.roles";s:1:"c";s:3:"web";s:1:"f";s:8:"Add Role";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:6;a:5:{s:1:"a";i:11;s:1:"b";s:12:"delete.roles";s:1:"c";s:3:"web";s:1:"f";s:11:"Delete Role";s:1:"r";a:1:{i:0;i:1;}}i:7;a:5:{s:1:"a";i:12;s:1:"b";s:10:"edit.roles";s:1:"c";s:3:"web";s:1:"f";s:11:"Update Role";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:5:{s:1:"a";i:14;s:1:"b";s:15:"add.permissions";s:1:"c";s:3:"web";s:1:"f";s:15:"Add Permissions";s:1:"r";a:1:{i:0;i:1;}}i:9;a:5:{s:1:"a";i:15;s:1:"b";s:18:"delete.permissions";s:1:"c";s:3:"web";s:1:"f";s:18:"Delete Permissions";s:1:"r";a:1:{i:0;i:1;}}i:10;a:5:{s:1:"a";i:16;s:1:"b";s:16:"edit.permissions";s:1:"c";s:3:"web";s:1:"f";s:18:"Update Permissions";s:1:"r";a:1:{i:0;i:1;}}i:11;a:5:{s:1:"a";i:17;s:1:"b";s:16:"view.permissions";s:1:"c";s:3:"web";s:1:"f";s:16:"Data Permissions";s:1:"r";a:1:{i:0;i:1;}}i:12;a:5:{s:1:"a";i:18;s:1:"b";s:12:"create.users";s:1:"c";s:3:"web";s:1:"f";s:8:"Add User";s:1:"r";a:1:{i:0;i:1;}}i:13;a:4:{s:1:"a";i:19;s:1:"b";s:15:"create.articles";s:1:"c";s:3:"web";s:1:"f";s:11:"Add Article";}i:14;a:4:{s:1:"a";i:20;s:1:"b";s:13:"edit.articles";s:1:"c";s:3:"web";s:1:"f";s:14:"Update Article";}i:15;a:4:{s:1:"a";i:21;s:1:"b";s:15:"delete.articles";s:1:"c";s:3:"web";s:1:"f";s:14:"Delete Article";}i:16;a:4:{s:1:"a";i:22;s:1:"b";s:13:"view.articles";s:1:"c";s:3:"web";s:1:"f";s:12:"Data Article";}}s:5:"roles";a:3:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:5:"admin";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:2;s:1:"b";s:5:"staff";s:1:"c";s:3:"web";}i:2;a:3:{s:1:"a";i:3;s:1:"b";s:4:"user";s:1:"c";s:3:"web";}}}', 1753852166);

-- Dumping structure for table my-app.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.cache_locks: ~0 rows (approximately)

-- Dumping structure for table my-app.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table my-app.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.jobs: ~0 rows (approximately)

-- Dumping structure for table my-app.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
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

-- Dumping data for table my-app.job_batches: ~0 rows (approximately)

-- Dumping structure for table my-app.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.migrations: ~9 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_07_27_155828_add_two_factor_columns_to_users_table', 1),
	(5, '2025_07_27_155912_create_personal_access_tokens_table', 1),
	(6, '2025_07_27_181520_create_permission_tables', 2),
	(7, '2025_07_28_134301_add_display_name_to_permissions_table', 3),
	(8, '2025_07_28_170623_add_blocked_permissions_to_users_table', 4),
	(9, '2025_07_29_045552_create_articles_table', 5);

-- Dumping structure for table my-app.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.model_has_permissions: ~11 rows (approximately)
INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 2),
	(6, 'App\\Models\\User', 2),
	(7, 'App\\Models\\User', 2),
	(8, 'App\\Models\\User', 2),
	(9, 'App\\Models\\User', 2),
	(10, 'App\\Models\\User', 2),
	(11, 'App\\Models\\User', 2),
	(12, 'App\\Models\\User', 2),
	(19, 'App\\Models\\User', 2),
	(20, 'App\\Models\\User', 2),
	(22, 'App\\Models\\User', 2);

-- Dumping structure for table my-app.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.model_has_roles: ~3 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 2),
	(3, 'App\\Models\\User', 3),
	(1, 'App\\Models\\User', 5);

-- Dumping structure for table my-app.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table my-app.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.permissions: ~17 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `display_name`) VALUES
	(1, 'view.users', 'web', '2025-07-28 00:06:43', '2025-07-28 06:58:12', 'Data User'),
	(6, 'add.users', 'web', '2025-07-28 05:57:40', '2025-07-28 06:57:59', 'Add User'),
	(7, 'edit.users', 'web', '2025-07-28 05:57:56', '2025-07-28 06:57:51', 'Update User'),
	(8, 'delete.users', 'web', '2025-07-28 05:58:09', '2025-07-28 06:57:43', 'Delete User'),
	(9, 'view.roles', 'web', '2025-07-28 05:59:02', '2025-07-28 06:57:24', 'Data Role'),
	(10, 'add.roles', 'web', '2025-07-28 05:59:22', '2025-07-28 06:57:06', 'Add Role'),
	(11, 'delete.roles', 'web', '2025-07-28 05:59:33', '2025-07-28 06:56:58', 'Delete Role'),
	(12, 'edit.roles', 'web', '2025-07-28 05:59:56', '2025-07-28 06:49:41', 'Update Role'),
	(14, 'add.permissions', 'web', '2025-07-28 15:42:13', '2025-07-28 15:42:13', 'Add Permissions'),
	(15, 'delete.permissions', 'web', '2025-07-28 15:42:31', '2025-07-28 15:42:31', 'Delete Permissions'),
	(16, 'edit.permissions', 'web', '2025-07-28 15:42:43', '2025-07-28 15:42:57', 'Update Permissions'),
	(17, 'view.permissions', 'web', '2025-07-28 15:43:24', '2025-07-28 15:43:24', 'Data Permissions'),
	(18, 'create.users', 'web', '2025-07-28 20:31:43', '2025-07-28 20:31:43', 'Add User'),
	(19, 'create.articles', 'web', '2025-07-28 22:08:22', '2025-07-28 22:08:22', 'Add Article'),
	(20, 'edit.articles', 'web', '2025-07-28 22:08:41', '2025-07-28 22:08:41', 'Update Article'),
	(21, 'delete.articles', 'web', '2025-07-28 22:09:04', '2025-07-28 22:09:04', 'Delete Article'),
	(22, 'view.articles', 'web', '2025-07-28 22:09:26', '2025-07-28 22:09:26', 'Data Article');

-- Dumping structure for table my-app.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table my-app.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.roles: ~4 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', '2025-07-27 11:55:32', '2025-07-27 11:55:32'),
	(2, 'staff', 'web', '2025-07-27 11:55:32', '2025-07-27 11:55:32'),
	(3, 'user', 'web', '2025-07-27 11:55:32', '2025-07-27 11:55:32');

-- Dumping structure for table my-app.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.role_has_permissions: ~21 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(1, 2),
	(6, 2),
	(7, 2),
	(9, 2),
	(10, 2),
	(12, 2),
	(9, 3),
	(10, 3);

-- Dumping structure for table my-app.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
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

-- Dumping data for table my-app.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('ADfgMxMC2B5EadMYISnSezVyjzveMM6j2Pib3Dd1', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibTFNOHU1RldTUE4xQUtUM2R2eXJPT3JMY2JXSWlsZXlQVlpxOGFFRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcnRpY2xlcy8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1753774159);

-- Dumping structure for table my-app.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blocked_permissions` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table my-app.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `blocked_permissions`) VALUES
	(2, 'Munawar Risman', 'pmaho_itsupport7@pinusmerahabadi.co.id', NULL, '$2y$12$lCil0JqXUCeegTUK67yWReMLq8tOVdr0r68CF6ZkiusphXtziqqiy', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-27 11:59:46', '2025-07-28 08:28:13', NULL),
	(3, 'Anwar', 'pmaho_itsupport6@pinusmerahabadi.co.id', NULL, '$2y$12$Tw7W3jItpyh3nBTgunC8v.6BwlGs7TcKsTaoDsRJSAszbI1bCheIy', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-27 12:12:37', '2025-07-27 12:12:37', NULL),
	(5, 'Anwar', 'pmaho_itsupport3@pinusmerahabadi.co.id', NULL, '$2y$12$yxIiawjCYyP3Wu5dfKtqFuVngWuW3XpkBf6oJUlm4FUi5z/VbtGau', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-27 12:36:11', '2025-07-27 12:36:11', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
