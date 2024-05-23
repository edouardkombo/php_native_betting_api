CREATE TABLE `brand` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `name` varchar(30),
  `url` varchar(100),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `country` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `name` varchar(20),
  `code` varchar(3),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `currency` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `name` varchar(10),
  `code` varchar(3),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `license` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `brand_id` integer,
  `country_id` integer,
  `created_at` timestamp DEFAULT CURRENT_timestamp,
  PRIMARY KEY (id)
);

CREATE TABLE `credential` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `username` varchar(30),
  `password` varchar(50),
  `player_id` integer,
  `created_at` timestamp DEFAULT CURRENT_timestamp,
  PRIMARY KEY (id)
);

CREATE TABLE `individual` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30),
  `lastname` varchar(30),
  `date_of_birth` varchar(10),
  `nationality` integer,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `address` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `street` varchar(50),
  `city` varchar(50),
  `zip` varchar(50),
  `country_id` integer,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `security` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `token` varchar(100),
  `player_id` integer,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `gender` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `name` varchar(10),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `player` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `brand_id` integer,
  `credential_id` integer,
  `address_id` integer,
  `individual_id` integer,
  `security_id` integer,
  `wallet_id` integer,
  `gender_id` integer,
  `currency_id` integer,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `wallet` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `balance` DOUBLE,
  `player_id` integer,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `finance_type` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `name` varchar(10),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE `finance` (
  `id` integer NOT NULL AUTO_INCREMENT,
  `amount` DOUBLE,
  `payout` double,
  `generated_number` varchar(2),
  `wallet_id` integer,
  `finance_type_id` integer,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

ALTER TABLE `license` ADD FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

ALTER TABLE `license` ADD FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

ALTER TABLE `address` ADD FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

ALTER TABLE `individual` ADD FOREIGN KEY (`nationality`) REFERENCES `country` (`id`);

ALTER TABLE `player` ADD FOREIGN KEY (`individual_id`) REFERENCES `individual` (`id`);

ALTER TABLE `player` ADD FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`);

ALTER TABLE `player` ADD FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

ALTER TABLE `player` ADD FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`);

ALTER TABLE `player` ADD FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

ALTER TABLE `player` ADD FOREIGN KEY (`credential_id`) REFERENCES `credential` (`id`);

ALTER TABLE `credential` ADD FOREIGN KEY (`player_id`) REFERENCES `player` (`credential_id`);

ALTER TABLE `player` ADD FOREIGN KEY (`security_id`) REFERENCES `security` (`id`);

ALTER TABLE `security` ADD FOREIGN KEY (`player_id`) REFERENCES `player` (`security_id`);

ALTER TABLE `wallet` ADD FOREIGN KEY (`player_id`) REFERENCES `player` (`id`);

ALTER TABLE `player` ADD FOREIGN KEY (`wallet_id`) REFERENCES `wallet` (`id`);

ALTER TABLE `finance` ADD FOREIGN KEY (`finance_type_id`) REFERENCES `finance_type` (`id`);

ALTER TABLE `finance` ADD FOREIGN KEY (`wallet_id`) REFERENCES `wallet` (`id`);

