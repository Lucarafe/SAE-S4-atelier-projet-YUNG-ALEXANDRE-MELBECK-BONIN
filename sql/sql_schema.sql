SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `login` varchar(20) NOT NULL,
    `passwd` varchar(256) NOT NULL,
    `email` varchar(256) NOT NULL,
    `nomUser` varchar(20) DEFAULT NULL,
    `prenomUser` varchar(20) DEFAULT NULL,
    `tel` varchar(20) DEFAULT NULL,
    `token` varchar(50) DEFAULT NULL,
    `privilege` int(2) NOT NULL DEFAULT 0,
    PRIMARY KEY (`email`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
    `id` bigint PRIMARY KEY AUTO_INCREMENT,
    `titre` text NOT NULL,
    `resume` text NOT NULL,
    `contenu` longtext NOT NULL ,
    `img` varchar(128) NOT NULL,
    `auteur` longtext NOT NULL ,
    `idCategorie` bigint NOT NULL ,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
    `id` bigint PRIMARY KEY AUTO_INCREMENT,
    `titre` text NOT NULL ,
    `resume` text NOT NULL ,
    `created_at` datetime NOT NULL,
    `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;