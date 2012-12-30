CREATE TABLE IF NOT EXISTS `user` (
	user_id		INT				NOT NULL AUTO_INCREMENT,
	name		VARCHAR(70)		NOT NULL,
	email		VARCHAR(254)	NOT NULL,
	password	CHAR(128)		NOT NULL,
	PRIMARY KEY (`user_id`),
	UNIQUE (`email`)
);

CREATE TABLE IF NOT EXISTS `role` (
	role_id		INT			NOT NULL AUTO_INCREMENT, -- the uid for the role
	name		VARCHAR(70)	NOT NULL, -- name of the role (human readable)
	slug		varchar(35)		NOT NULL, -- the system name for the role (set by the system on role creation)
	description	TEXT		NOT NULL, -- what this role is for, and allows (high level not details)
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
	perm_id		INT				NOT NULL AUTO_INCREMENT, -- the uid for the permission
	name		VARCHAR(70)		NOT NULL, -- the human name for the permission (can be changed by the system)
	slug		varchar(35)		NOT NULL, -- the system name for the permission (set by the developer)
	description	varchar(140)	NOT NULL, -- a brief description of what this permission allows to happen
	PRIMARY KEY (`perm_id`),
	UNIQUE (`name`),
	UNIQUE (`slug`)
);

CREATE TABLE IF NOT EXISTS `role_perm` (
	role_id INT NOT NULL,
    perm_id INT NOT NULL,
    PRIMARY KEY (`role_id`, `perm_id`),
    FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
    FOREIGN KEY (`perm_id`) REFERENCES `perm` (`perm_id`)
);
