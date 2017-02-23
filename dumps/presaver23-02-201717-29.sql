# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.17)
# Database: presaver
# Generation Time: 2017-02-23 17:29:20 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table campaigns
# ------------------------------------------------------------

DROP TABLE IF EXISTS `campaigns`;

CREATE TABLE `campaigns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `release_spotify_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_artwork` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist_id` int(10) unsigned DEFAULT NULL,
  `release_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview_track_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `campaigns` (`id`, `release_spotify_id`, `release_title`, `release_artwork`, `slug`, `artist_id`, `release_date`, `preview_track_id`, `description`, `background_image`, `created_by`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'12345','No Mythologies','charli-1-800x800.jpg','future',1,'2017-02-24 00:00:00',NULL,'Spicy jalapeno et minim esse, cupidatat in cow andouille irure corned beef culpa in sirloin lorem. Dolor ullamco in, landjaeger flank fatback qui aute cillum tongue cupim sirloin occaecat strip steak. Cillum alcatra ham kielbasa salami duis, veniam ullamco in kevin short loin sed ham hock. Tongue cupidatat qui nisi boudin salami pancetta mollit, pork chop proident aute strip steak. Esse pork belly in, pastrami fugiat elit flank strip steak sirloin eiusmod ut.','mo-by-christian-faustus.jpg',1,'2017-02-23 17:13:20','2017-02-23 17:13:20',NULL);

/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
