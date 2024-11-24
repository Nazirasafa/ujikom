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

-- Dumping structure for table ujikom_nazira.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `img` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ujikom_nazira.categories: ~5 rows (approximately)
INSERT INTO `categories` (`id`, `img`, `title`, `created_at`, `updated_at`) VALUES
	(1, '/storage/images/Iz3hy1lNFz0n36NwWVb3iV2uGFlFuPfRnkzE4C0u.jpg', 'KEJUARAAN', NULL, '2024-11-21 02:44:25'),
	(2, '/storage/images/CkiD1Zk0ordSGXiDwukV9ZRog38sHhkltmglEtFW.jpg', 'LOMBA', '2024-10-30 21:01:55', '2024-11-21 02:45:16'),
	(3, '/storage/images/inpoOB8fUL62CHM2BwqVhViMl26potkarlEIZoHN.jpg', 'PASKIBRA', '2024-10-30 23:55:03', '2024-11-21 02:46:06'),
	(5, '/storage/images/Lz4a3pypSu8ZtvHAjOqpxpX2Znw9MZl0fRTLxGOd.jpg', 'SOSIALISASI', '2024-11-21 09:09:44', '2024-11-21 09:09:44'),
	(6, '/storage/images/TGxRaR1K9oLSIsoM4jsoF6o7SSNj5DBSbFX6xZwQ.jpg', 'INTERNASIONAL', '2024-11-21 09:15:45', '2024-11-21 09:15:45');

-- Dumping structure for table ujikom_nazira.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_media` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ujikom_nazira.events: ~3 rows (approximately)
INSERT INTO `events` (`id`, `name`, `short_desc`, `desc`, `img`, `social_media`, `date`, `time_start`, `time_end`, `created_at`, `updated_at`) VALUES
	(11, 'TRANSFORKRAB', 'Acara gelar karya', 'menampilkan kreasi dari siswa berasal dari daerah masing masing', '/storage/images/G80iVx6RoAGaoqGditOdgzsts6MhI0xFMoBBYk0L.png', 'https://www.instagram.com/transforkr4b?igsh=cWs2MzVpaWxlNXNm', '2024-11-22', '07:00:00', '13:00:00', '2024-11-09 04:44:33', '2024-11-21 02:00:50'),
	(12, 'NEOSPRAGMA', 'pentas seni di smkn 4 Bogor', 'ada dj mail 🥳‼️', '/storage/images/T1aKLoELhnZCxOg3xUO9MQK916RipZ4V6xpqlQDm.jpg', 'https://www.instagram.com/neospragma?igsh=bXRjOXJkZnBrd28x', '2024-11-26', '07:00:00', '17:00:00', '2024-11-10 19:34:31', '2024-11-21 01:53:48'),
	(21, 'FRUIT TEA', 'lomba lomba seru', 'fruit tea mengadakan lomba yang menarik di smkn 4 Bogor dan menampilkannya di lapangan', '/storage/images/AsEmg3dRwsaHdqHVrdCCDwBBGFRNKYG55CfsBhO2.jpg', 'https://www.instagram.com/smkn4kotabogor?igsh=bGxyNjhnMjc0dHhw', '2024-11-24', '08:00:00', '11:00:00', '2024-11-20 05:08:06', '2024-11-21 02:05:38');

-- Dumping structure for table ujikom_nazira.galleries
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ujikom_nazira.galleries: ~3 rows (approximately)
INSERT INTO `galleries` (`id`, `name`, `desc`, `img`, `created_at`, `updated_at`) VALUES
	(1, 'KEGIATAN P5', 'Lorem ipsum dolor sit amet, usu at dicam dolore inimicus. Ad voluptua definiebas vim, te vim omnes postulant. Oblique facilisis id qui. Eros latine pertinax no pri, his ei lorem nominati. Malis tractatos mnesarchum cum ut, at cibo sale pro. Qui ex nibh augue vituperata, ut nec fabulas evertitur vituperata. In eos natum populo malorum, equidem ancillae invenire nec ut, no his quas tation ponderum.', '/storage/images/c9dISSMijBYnRMqB2OYvSGtQnygzqTg43igys4Zg.jpg', NULL, '2024-11-21 02:47:54'),
	(2, 'PRESTASI EKSKUL', 'prestasi atau kejuaraan yang diraih oleh ekstrakulikuler dari smkn 4 Bogor.', '/storage/images/gi5z5b1oOltXe3SqdHaa9S43TheJ4tR2lmmxqUVs.jpg', NULL, '2024-11-21 02:15:22'),
	(3, 'KEGIATAN SOSIALIASI', 'lorem ipsum', '/storage/images/sMkaNqwDWeZd3G8YFB3yJsWsM8qu4TKIc8oDkZ1W.jpg', '2024-10-29 08:29:06', '2024-11-21 02:37:03');

-- Dumping structure for table ujikom_nazira.gallery_images
CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_images_gallery_id_foreign` (`gallery_id`),
  CONSTRAINT `gallery_images_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ujikom_nazira.gallery_images: ~0 rows (approximately)

-- Dumping structure for table ujikom_nazira.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_post_id_foreign` (`post_id`),
  CONSTRAINT `images_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ujikom_nazira.images: ~0 rows (approximately)

-- Dumping structure for table ujikom_nazira.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `img` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_time` int NOT NULL DEFAULT '0',
  `views` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ujikom_nazira.posts: ~2 rows (approximately)
INSERT INTO `posts` (`id`, `img`, `title`, `user_id`, `body`, `read_time`, `views`, `created_at`, `updated_at`) VALUES
	(14, '/storage/images/0ZDPI6usr69pUqiIgakjOAekR3svyzuIJk5aesT9.jpg', 'SOSIALIASI ANTI NARKOBA', 9, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos \r\nsapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam\r\nrecusandae alias error harum maxime adipisci amet laborum. Perspiciatis \r\nminima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit', 5, 20, '2024-11-21 05:27:19', '2024-11-21 17:08:03'),
	(15, '/storage/images/EcJS8wyZ20QTdNOck078vFOXDQWRDX8zIxaQTGtr.jpg', 'PERTUKARAN PELAJAR MALAYSIA', 9, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos \r\nsapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam\r\nrecusandae alias error harum maxime adipisci amet laborum. Perspiciatis \r\nminima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit \r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos \r\nsapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam\r\nrecusandae alias error harum maxime adipisci amet laborum. Perspiciatis \r\nminima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit', 15, 13, '2024-11-21 05:27:50', '2024-11-21 17:08:42'),
	(16, '/storage/images/yLvYbrm9OVbPCbRvzrHv3LFOR8uomUjziKrKT20B.jpg', 'KEGIATAN P5', 9, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos \r\nsapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam\r\nrecusandae alias error harum maxime adipisci amet laborum. Perspiciatis \r\nminima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit', 15, 5, '2024-11-21 05:28:23', '2024-11-21 10:11:34');

-- Dumping structure for table ujikom_nazira.post_category
CREATE TABLE IF NOT EXISTS `post_category` (
  `post_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  KEY `post_category_post_id_foreign` (`post_id`),
  KEY `post_category_category_id_foreign` (`category_id`),
  CONSTRAINT `post_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_category_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ujikom_nazira.post_category: ~5 rows (approximately)
INSERT INTO `post_category` (`post_id`, `category_id`) VALUES
	(16, 5),
	(15, 6),
	(14, 5),
	(14, 2),
	(15, 2);

-- Dumping structure for table ujikom_nazira.socials
CREATE TABLE IF NOT EXISTS `socials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ujikom_nazira.socials: ~0 rows (approximately)

-- Dumping structure for table ujikom_nazira.visits
CREATE TABLE IF NOT EXISTS `visits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ujikom_nazira.visits: ~5 rows (approximately)
INSERT INTO `visits` (`id`, `created_at`, `updated_at`) VALUES
	(1, '2024-11-10 23:47:37', '2024-11-10 23:47:38'),
	(2, '2024-11-10 23:47:41', '2024-11-10 23:47:42'),
	(3, '2024-11-11 16:22:22', '2024-11-11 16:22:22'),
	(4, '2024-11-11 16:22:25', '2024-11-11 16:22:25'),
	(5, '2024-11-11 16:22:28', '2024-11-11 16:22:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
