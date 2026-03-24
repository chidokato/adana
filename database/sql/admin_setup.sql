-- Admin database and seed (MySQL)
CREATE DATABASE IF NOT EXISTS `adana`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `adana`;

CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` (`name`, `email`, `password`, `created_at`, `updated_at`)
VALUES ('Admin', 'admin@adana.local', '$2y$10$5hvAYRMgjZzJXYihXNz5m.XLBuUiCdNByeiaccXC7MdzM0BwyzEfm', NOW(), NOW());
