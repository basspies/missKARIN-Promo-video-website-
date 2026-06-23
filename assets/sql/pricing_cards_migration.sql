-- Migration: pricing_cards and pricing_card_features
CREATE TABLE IF NOT EXISTS `pricing_cards` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `tag` VARCHAR(255) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `price` DECIMAL(10,2) DEFAULT 0,
  `price_note` VARCHAR(255) DEFAULT NULL,
  `button_text` VARCHAR(255) DEFAULT NULL,
  `button_url` VARCHAR(255) DEFAULT NULL,
  `sort_order` INT DEFAULT 0,
  `is_active` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `pricing_card_features` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `price_card_id` INT NOT NULL,
  `feature_text` TEXT NOT NULL,
  `sort_order` INT DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY (`price_card_id`),
  CONSTRAINT `fk_pricing_card` FOREIGN KEY (`price_card_id`) REFERENCES `pricing_cards`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
