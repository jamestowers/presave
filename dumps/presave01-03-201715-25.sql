# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.17-0ubuntu0.16.04.1)
# Database: presave
# Generation Time: 2017-03-01 15:25:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table artist_fan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `artist_fan`;

CREATE TABLE `artist_fan` (
  `fan_id` int(10) unsigned NOT NULL,
  `artist_id` int(10) unsigned NOT NULL,
  `mailing_list_opt_in` tinyint(1) NOT NULL,
  KEY `artist_fan_fan_id_foreign` (`fan_id`),
  KEY `artist_fan_artist_id_foreign` (`artist_id`),
  CONSTRAINT `artist_fan_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`),
  CONSTRAINT `artist_fan_fan_id_foreign` FOREIGN KEY (`fan_id`) REFERENCES `fans` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `artist_fan` WRITE;
/*!40000 ALTER TABLE `artist_fan` DISABLE KEYS */;

INSERT INTO `artist_fan` (`fan_id`, `artist_id`, `mailing_list_opt_in`)
VALUES
	(2,2,0),
	(3,2,0),
	(1,2,0);

/*!40000 ALTER TABLE `artist_fan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table artists
# ------------------------------------------------------------

DROP TABLE IF EXISTS `artists`;

CREATE TABLE `artists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spotify_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;

INSERT INTO `artists` (`id`, `name`, `spotify_id`, `image`, `created_at`, `updated_at`)
VALUES
	(1,'IDER','2LOwKJMjuv7VsprtYaFzl0','https://i.scdn.co/image/91dff15a3650f521d5913da9f182525e5d56c247','2017-02-28 22:14:47','2017-02-28 22:14:47'),
	(2,'Blanck Mass','73LvjicByRK5LazcQYZMAY','https://i.scdn.co/image/2b8771672314c320a7c82ec4f926e665983a13e0','2017-03-01 11:34:36','2017-03-01 11:34:36');

/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table campaign_fan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `campaign_fan`;

CREATE TABLE `campaign_fan` (
  `campaign_id` int(10) unsigned NOT NULL,
  `fan_id` int(10) unsigned NOT NULL,
  `spotify_playlist_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  KEY `campaign_fan_campaign_id_foreign` (`campaign_id`),
  KEY `campaign_fan_fan_id_foreign` (`fan_id`),
  CONSTRAINT `campaign_fan_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`),
  CONSTRAINT `campaign_fan_fan_id_foreign` FOREIGN KEY (`fan_id`) REFERENCES `fans` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `campaign_fan` WRITE;
/*!40000 ALTER TABLE `campaign_fan` DISABLE KEYS */;

INSERT INTO `campaign_fan` (`campaign_id`, `fan_id`, `spotify_playlist_id`)
VALUES
	(2,2,NULL),
	(2,3,NULL),
	(2,1,NULL);

/*!40000 ALTER TABLE `campaign_fan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table campaigns
# ------------------------------------------------------------

DROP TABLE IF EXISTS `campaigns`;

CREATE TABLE `campaigns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `release_spotify_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_artwork` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist_id` int(10) unsigned DEFAULT NULL,
  `artist_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaigns_slug_unique` (`slug`),
  UNIQUE KEY `campaigns_release_spotify_id_unique` (`release_spotify_id`),
  KEY `campaigns_artist_id_foreign` (`artist_id`),
  KEY `campaigns_created_by_foreign` (`created_by`),
  CONSTRAINT `campaigns_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`),
  CONSTRAINT `campaigns_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;

INSERT INTO `campaigns` (`id`, `status`, `release_spotify_id`, `release_title`, `release_artwork`, `slug`, `artist_id`, `artist_logo`, `release_date`, `preview_url`, `description`, `background_image`, `text_color`, `created_by`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'pending',NULL,'Gut Me Like An Animal','gut-me-like-an-animal.jpg','ider-gut',1,NULL,'2017-03-30 23:00:00','https://play.spotify.com/track/3ZURjGtxq9i36dixchh49L',NULL,'ider-1-hi.jpg','FFFFFF',2,'2017-02-28 22:14:47','2017-03-01 13:46:27',NULL),
	(2,'pending',NULL,'World Eater','blanck-mass-artwork.jpg','blanck-mass-world-eater',2,NULL,'2017-03-03 00:00:00',NULL,NULL,'blanck-mass-bg.jpg','FFFFFF',2,'2017-03-01 11:34:36','2017-03-01 11:34:36',NULL);

/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fans`;

CREATE TABLE `fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spotify_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refresh_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fans_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `fans` WRITE;
/*!40000 ALTER TABLE `fans` DISABLE KEYS */;

INSERT INTO `fans` (`id`, `spotify_user_id`, `name`, `email`, `access_token`, `refresh_token`, `expires_at`, `created_at`, `updated_at`)
VALUES
	(1,'jamestowers','James Towers','lejamboncrew@me.com','BQC1zyz1J4uHrKdWdM5N3JrAr_yLbOz9OeWJFVsIUszg6s1V-hu3IRyRfBchZuBmIabMiClvB7rEnn9DurlhQg-atnMxvuirtwtLB71ubU39ovamYwgqhAzP-NgjwFHedaVKZpmsVM345_R_oZFFpr2Vo8zZfbBU49E9rBnYcwl_a2TLB4SwqZHfOIo0akulJRNXUeG5xyW9viHh3ymhpd8HLyDoFiLWrDRodjxezUONBn4HjV-vjUfL','AQDnFe2RnSRexD3642fwKV_DBXdND5BXNGKtsDp36Lqb08C4CQJN6mSnjqaIv3BX2UyK_uZ1LbYfGa4xnGgscoYDzTU7YOt3WHQ92zZFD_JQQ_Dx12vEo2p61P0oTsDonkw','2017-03-01 14:43:08','2017-03-01 08:14:28','2017-03-01 13:43:08'),
	(2,'brittneybean',NULL,'m.b.bean@gmail.com','BQCl00XfUyfRixjFKV4-hxOIQaGA-5Y6GoVldGWH03fsmerf0CPkYtlH23cGiv3V8yxAKwqsVft3-Kou8Djol48BU-lTi4bl5juPadijLXwtTQVxL0f-YT-YZy5qhAFDymqxkAfyMkkstVpEfviomhgg_rOrhMHpIV1X7YX0tzD_6tEFIe6A6lp0Jd_lT1hzvUgC6dFYKEd2SaObLVLVlyZHTIb4gEC3Pp1WowBdPXw4qT0PjczCBEvshEQIYw','AQDujSY3WLAOQUGYarFs-JapSG9wm-nytuwefqLIG2n93k8aG7rdlA7SpMrT2qnN6zYboU-x61mVyf6zrJpo_BgLnJkfQg-cCnMf5m3Sb10tHdcui7StXUni7SvbNfCegaU','2017-03-01 12:37:42','2017-03-01 11:13:00','2017-03-01 11:37:42'),
	(3,'wldctadam',NULL,'adamroyal@gmail.com','BQCr6e5w4VqNCs8-JyZh6EZRysbn_-dcK93hUzmk5QQRsD6vol-14m_Kd3kNdH-oR9B0zl3a9Bfl7pfS7l_xAvyMs5yJRigEb6CNar8-_t8xB4bug7SYxnQrF2-w2o69rmPY2rG5hiZb6_hxFJHCBtLB18WPoK_an_DjsqC7BhSOKlKMpWxlhSfTV3pTC5RSeYIGNWlQ7YxKaaOAzt4fruliz24czvI0bzrAjZcn5VBOkyTy-LDM5KcRiA','AQDoPB-aN9gGIo6ibDb0UoUnNEMY8o5AoMmyRVpYnWQFmqOhXnNnQZxowNq3UQtAGq8UvNGt2gFJ4aGHqdzjA9gLS9xWLD1R_nKSsiBUPECXYQz5HgTiQQe3F5Fhqvklgdk','2017-03-01 12:46:36','2017-03-01 11:46:36','2017-03-01 11:46:36');

/*!40000 ALTER TABLE `fans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(22,'2014_10_12_000000_create_users_table',1),
	(23,'2014_10_12_100000_create_password_resets_table',1),
	(24,'2017_02_14_134109_create_artists_table',1),
	(25,'2017_02_14_134110_create_campaigns_table',1),
	(26,'2017_02_22_164933_create_fans_table',1),
	(27,'2017_02_23_165520_create_artist_fan_table',1),
	(28,'2017_02_23_213440_create_campaign_fan_table',1),
	(29,'2017_03_01_132918_change_preview_column_name',2);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'james','james@songdrop.com','$2y$10$blKcBTEFgAlshUl76Sfc1uEpvgXeDEkEfHEf1MLlFJxpMDLIkT72K',NULL,'2017-02-28 22:13:59','2017-02-28 22:13:59'),
	(2,'Brittney','brittney@songdrop.com','$2y$10$EmqI/G/1CKevzRBSbQwpp.1FhSEJ6e4hTKDdOng4g7bhnQz1FPJQ.',NULL,'2017-03-01 11:12:43','2017-03-01 11:12:43'),
	(3,'Adam Royal','adam@aesoplabel.com','$2y$10$M4Tnyp3Xn.ZrRZQNARkzG.9Xq6vqvcDG4an/VW951cHmEnMANDQdG',NULL,'2017-03-01 12:33:27','2017-03-01 12:33:27');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
