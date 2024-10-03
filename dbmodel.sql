CREATE TABLE IF NOT EXISTS `achievementCards` (
	`card_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`card_type` VARCHAR(20) NOT NULL,`card_type_arg` VARCHAR(20) NOT NULL,
	`card_location` VARCHAR(20) NOT NULL,`card_location_arg` VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `actionCards` (
	`card_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`card_type` VARCHAR(20) NOT NULL,`card_type_arg` VARCHAR(20) NOT NULL,
	`card_location` VARCHAR(20) NOT NULL,`card_location_arg` VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `tokens` (
	`id` INT(2) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`type` ENUM('EARTHFOLK', 'ELVENFOLK', 'FIREFOLK', 'SMALLFOLK', 'FOOD', 'WOOD', 'METAL', 'STONE', 'CULTURE'),
	`location` VARCHAR(20), `status` JSON
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `markers` (
	`id` INT(2) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`type` ENUM('x1','x2food','x2wood','x2metal','x2stone','x3wood','x3metal','x3stone','STARTING', 'VP'),
	`location` VARCHAR(20), `status` JSON
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `factions` (
	`faction` ENUM('EARTHFOLK', 'ELVENFOLK', 'FIREFOLK', 'SMALLFOLK') PRIMARY KEY, `player_id` INT,
	`food` INT(2) DEFAULT 0, `wood` INT(2) DEFAULT 0, `metal` INT(2) DEFAULT 0, `stone` INT(2) DEFAULT 0,`culture` INT(2) DEFAULT 0,
	`status` JSON
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
