DROP TABLE IF EXISTS `#__painter_addresses`;
CREATE TABLE `#__painter_addresses` (
	`address_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`address_line1` VARCHAR(128) DEFAULT NULL,
	`address_line2` VARCHAR(128) DEFAULT NULL,
	`address_city` VARCHAR(64) DEFAULT NULL,
	`address_postal_code` VARCHAR(16) DEFAULT NULL,
	`address_phone` VARCHAR(16) DEFAULT NULL,
	`ordering` INT(11) UNSIGNED DEFAULT NULL,
	`published` TINYINT(1) UNSIGNED DEFAULT 0,
	`checked_out` INT(11) UNSIGNED DEFAULT 0,
	`checked_out_time` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified_by` INT(11) UNSIGNED DEFAULT 0,
	`access` INT(11) UNSIGNED DEFAULT NULL,
	`region_id` INT(11) UNSIGNED DEFAULT NULL,
	`country_id` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`address_id`),
	KEY `region_id` (`region_id`),
	KEY `country_id` (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__painter_clients`;
CREATE TABLE `#__painter_clients` (
	`client_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`client_name` VARCHAR(128) DEFAULT NULL,
	`client_number` VARCHAR(16) DEFAULT NULL,
	`client_contact` VARCHAR(128) DEFAULT NULL,
	`client_phone` VARCHAR(16) DEFAULT NULL,
	`client_email` VARCHAR(128) DEFAULT NULL,
	`ordering` INT(11) UNSIGNED DEFAULT NULL,
	`published` TINYINT(1) UNSIGNED DEFAULT 0,
	`checked_out` INT(11) UNSIGNED DEFAULT 0,
	`checked_out_time` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified_by` INT(11) UNSIGNED DEFAULT 0,
	`access` INT(11) UNSIGNED DEFAULT NULL,
	`attribs` TEXT DEFAULT NULL,
	`customer_id` INT(11) UNSIGNED DEFAULT NULL,
	`user_id` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`client_id`),
	KEY `customer_id` (`customer_id`),
	KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__painter_countries`;
CREATE TABLE `#__painter_countries` (
	`country_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`country_name` VARCHAR(128) DEFAULT NULL,
	`country_code` CHAR(2) DEFAULT NULL,
	`ordering` INT(11) UNSIGNED DEFAULT NULL,
	`published` TINYINT(1) UNSIGNED DEFAULT 0,
	`checked_out` INT(11) UNSIGNED DEFAULT 0,
	`checked_out_time` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified_by` INT(11) UNSIGNED DEFAULT 0,
	`access` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__painter_customers`;
CREATE TABLE `#__painter_customers` (
	`customer_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`customer_name` VARCHAR(128) DEFAULT NULL,
	`customer_title` VARCHAR(128) DEFAULT NULL,
	`customer_number` VARCHAR(16) DEFAULT NULL,
	`customer_logo` VARCHAR(128) DEFAULT NULL,
	`customer_website` TINYTEXT DEFAULT NULL,
	`customer_email` TINYTEXT DEFAULT NULL,
	`customer_warranty` TEXT DEFAULT NULL,
	`customer_notes` TEXT DEFAULT NULL,
	`ordering` INT(11) UNSIGNED DEFAULT NULL,
	`published` TINYINT(1) UNSIGNED DEFAULT 0,
	`checked_out` INT(11) UNSIGNED DEFAULT 0,
	`checked_out_time` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified_by` INT(11) UNSIGNED DEFAULT 0,
	`access` INT(11) UNSIGNED DEFAULT NULL,
	`user_id` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`customer_id`),
	KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__painter_items`;
CREATE TABLE `#__painter_items` (
	`item_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`item_name` VARCHAR(128) DEFAULT NULL,
	`item_desc` TEXT DEFAULT NULL,
	`item_qty` INT(8) DEFAULT 0,
	`item_uom` VARCHAR(16) DEFAULT NULL,
	`item_rate` DECIMAL(5,4) DEFAULT 0.0000,
	`item_type` TINYINT(1) DEFAULT 0,
	`ordering` INT(11) UNSIGNED DEFAULT NULL,
	`published` TINYINT(1) UNSIGNED DEFAULT 0,
	`checked_out` INT(11) UNSIGNED DEFAULT 0,
	`checked_out_time` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified_by` INT(11) UNSIGNED DEFAULT 0,
	`access` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__painter_materials`;
CREATE TABLE `#__painter_materials` (
	`material_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`material_name` VARCHAR(128) DEFAULT NULL,
	`material_desc` TEXT DEFAULT NULL,
	`material_number` VARCHAR(64) DEFAULT NULL,
	`ordering` INT(11) UNSIGNED DEFAULT NULL,
	`published` TINYINT(1) UNSIGNED DEFAULT 0,
	`checked_out` INT(11) UNSIGNED DEFAULT 0,
	`checked_out_time` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified_by` INT(11) UNSIGNED DEFAULT 0,
	`access` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY(`material_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__painter_proposals`;
CREATE TABLE `#__painter_proposals` (
	`proposal_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`proposal_name` VARCHAR(128) DEFAULT NULL,
	`proposal_notes` TEXT DEFAULT NULL,
	`proposal_misc` TEXT DEFAULT NULL,
	`proposal_number` VARCHAR(64) DEFAULT NULL,
	`proposal_subtotal` DECIMAL(11,2) DEFAULT 0.00,
	`proposal_total` DECIMAL(11,2) DEFAULT 0.00,
	`ordering` INT(11) UNSIGNED DEFAULT NULL,
	`published` TINYINT(1) UNSIGNED DEFAULT 0,
	`checked_out` INT(11) UNSIGNED DEFAULT 0,
	`checked_out_time` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified_by` INT(11) UNSIGNED DEFAULT 0,
	`access` INT(11) UNSIGNED DEFAULT NULL,
	`client_id` INT(11) UNSIGNED DEFAULT NULL,
	`user_id` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`proposal_id`),
	KEY `client_id` (`client_id`),
	KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__painter_regions`;
CREATE TABLE `#__painter_regions` (
	`region_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`region_name` VARCHAR(128) DEFAULT NULL,
	`region_code` VARCHAR(8) DEFAULT NULL,
	`region_tax` DECIMAL(5,4) DEFAULT 0.0000,
	`ordering` INT(11) UNSIGNED DEFAULT NULL,
	`published` TINYINT(1) UNSIGNED DEFAULT 0,
	`checked_out` INT(11) UNSIGNED DEFAULT 0,
	`checked_out_time` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified_by` INT(11) UNSIGNED DEFAULT 0,
	`access` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY (`region_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__painter_services`;
CREATE TABLE `#__painter_services` (
	`service_id` INT(11) UNSIGNED NOT NULL	AUTO_INCREMENT,
	`service_name` VARCHAR(128) DEFAULT NULL,
	`ordering` INT(11) UNSIGNED DEFAULT NULL,
	`published` TINYINT(1) UNSIGNED DEFAULT 0,
	`checked_out` INT(11) UNSIGNED DEFAULT 0,
	`checked_out_time` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified` DATETIME DEFAULT '0000-00-00 00:00:00',
	`modified_by` INT(11) UNSIGNED DEFAULT 0,
	`access` INT(11) UNSIGNED DEFAULT NULL,
	PRIMARY KEY(`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;