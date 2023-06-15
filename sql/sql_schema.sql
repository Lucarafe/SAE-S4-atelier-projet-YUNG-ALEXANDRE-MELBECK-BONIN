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
    PRIMARY KEY (`email`)
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

INSERT INTO `user` (`login`, `passwd`, `email`, `nomUser`, `prenomUser`, `tel`, `token`, `privilege`) VALUES
                                                                                                          ('john', 'password123', 'john@example.com', 'Doe', 'John', '1234567890', NULL, 0),
                                                                                                          ('jane', 'password456', 'jane@example.com', 'Doe', 'Jane', '9876543210', NULL, 0);

INSERT INTO `categorie` (`titre`, `resume`, `created_at`, `updated_at`) VALUES
                                                                            ('Catégorie 1', 'Résumé de la catégorie 1', NOW(), NOW()),
                                                                            ('Catégorie 2', 'Résumé de la catégorie 2', NOW(), NOW());

INSERT INTO `article` (`titre`, `resume`, `contenu`, `img`, `auteur`, `idCategorie`, `created_at`, `updated_at`) VALUES
                                                                                                                     ('Article 1', 'Résumé de l\'article 1', 'Contenu de l\'article 1', 'image1.jpg', 'Auteur 1', 1, NOW(), NOW()),
                                                                                                                     ('Article 2', 'Résumé de l\'article 2', 'Contenu de l\'article 2', 'image2.jpg', 'Auteur 2', 2, NOW(), NOW());
