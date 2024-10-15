CREATE TABLE IF NOT EXISTS `achievementCards` (
	`card_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`card_type` VARCHAR(20) NOT NULL, `card_type_arg` VARCHAR(20) NOT NULL,
	`card_location` VARCHAR(20) NOT NULL, `card_location_arg` VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `actionCards` (
	`card_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`card_type` VARCHAR(20) NOT NULL, `card_type_arg` VARCHAR(20) NOT NULL,
	`card_location` VARCHAR(20) NOT NULL, `card_location_arg` VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `factions`    (`faction` ENUM('EARTHFOLK', 'ELVENFOLK', 'FIREFOLK', 'SMALLFOLK') PRIMARY KEY, `player_id` INT);
CREATE TABLE IF NOT EXISTS `settlements` (`id` INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY, `location` VARCHAR(20), `faction` ENUM('EARTHFOLK', 'ELVENFOLK', 'FIREFOLK', 'SMALLFOLK'));
CREATE TABLE IF NOT EXISTS `resources`   (`id` INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY, `location` VARCHAR(20), `type` ENUM('FOOD', 'WOOD', 'METAL', 'STONE', 'CULTURE'));
CREATE TABLE IF NOT EXISTS `markers`     (`id` INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY, `location` VARCHAR(20), `type` ENUM('x1', 'x2food', 'x2wood', 'x2metal', 'x2stone', 'x3wood', 'x3metal', 'x3stone', 'STARTING', 'VP'));
