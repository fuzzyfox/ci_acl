CREATE TABLE IF NOT EXISTS `user` (
	user_id		INT				NOT NULL AUTO_INCREMENT,
	name		VARCHAR(70)		NOT NULL,
	email		VARCHAR(254)	NOT NULL,
	password	CHAR(128)		NOT NULL,
	PRIMARY KEY (`user_id`),
	UNIQUE (`email`)
);

CREATE TABLE IF NOT EXISTS `role` (
	role_id		INT			NOT NULL AUTO_INCREMENT,
	name		VARCHAR(70)	NOT NULL,
	description	TEXT,
	PRIMARY KEY (`role_id`),
	UNIQUE (`name`)
);

CREATE TABLE IF NOT EXISTS `user_role` (
	user_id	INT	NOT NULL,
	role_id	INT	NOT NULL,
	PRIMARY KEY (`user_id`, `role_id`),
	FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
	FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`)
);

CREATE TABLE IF NOT EXISTS `perm` (
	perm_id	INT			NOT NULL AUTO_INCREMENT,
	name	VARCHAR(70)	NOT NULL,
	value	INT			NOT NULL,
	PRIMARY KEY (`perm_id`),
	UNIQUE (`name`),
	UNIQUE (`value`)
);

CREATE TABLE IF NOT EXISTS `role_perm` (
	role_id INT NOT NULL,
    perm_id INT NOT NULL,
    PRIMARY KEY (`role_id`, `perm_id`),
    FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
    FOREIGN KEY (`perm_id`) REFERENCES `perm` (`perm_id`)
);
