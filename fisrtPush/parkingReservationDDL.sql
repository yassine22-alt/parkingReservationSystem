DROP DATABASE IF EXISTS prs;
CREATE DATABASE prs;
 use prs;
 CREATE TABLE `register` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_username` (`username`)
);
 CREATE TABLE `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `quitting_date` datetime DEFAULT NULL,
  `price` smallint DEFAULT NULL,
  `reservation_code` varchar(10) DEFAULT NULL,
  `spot_number` smallint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_spot_number` (`spot_number`),
  KEY `username` (`username`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`username`) REFERENCES `register` (`username`)
)
