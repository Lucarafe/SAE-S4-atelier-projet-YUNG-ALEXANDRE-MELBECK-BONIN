-- Données pour la table `user`
INSERT INTO `user` (`login`, `passwd`, `email`, `nomUser`, `prenomUser`, `tel`, `token`, `privilege`) VALUES
                                                                                                          ('john.doe', 'pass123', 'john.doe@example.com', 'Doe', 'John', '123456789', 'token123', 1),
                                                                                                          ('jane.smith', 'password', 'jane.smith@example.com', 'Smith', 'Jane', '987654321', 'token456', 0),
                                                                                                          ('alice', 'alicepass', 'alice@example.com', 'Alice', 'Brown', '555555555', NULL, 0),
                                                                                                          ('bob', 'bobpass', 'bob@example.com', 'Bob', 'Johnson', '999999999', NULL, 0),
                                                                                                          ('emma', 'emmapass', 'emma@example.com', 'Watson', 'Emma', '111111111', 'token789', 1);

-- Données pour la table `article`
INSERT INTO `article` (`titre`, `resume`, `contenu`, `img`, `auteur`, `idCategorie`, `created_at`, `updated_at`, `idAuteur`, `publication`) VALUES
                                                                                                                     ('Introduction à MiniPress', 'MiniPress est un puissant système de gestion de contenu.', 'MiniPress est une solution avancée pour la gestion de contenu de sites web. Il offre une interface conviviale et des fonctionnalités riches.', 'image1.jpg', 'john.doe', 1, NOW(), NOW(), 1, 1),
                                                                                                                     ('Les meilleures pratiques de rédaction en markdown', 'Découvrez comment rédiger du contenu en utilisant la syntaxe markdown.', 'Le markdown est un langage simple et efficace pour la rédaction de contenu. Apprenez les astuces et les bonnes pratiques pour l utiliser au mieux.', 'image2.jpg', 'jane.smith', 2, NOW(), NOW(),2, 1),
                                                                                                                     ('Nouvelle fonctionnalité de MiniPress', 'Découvrez la dernière fonctionnalité ajoutée à MiniPress.', 'Nous sommes heureux d annoncer une nouvelle fonctionnalité passionnante ajoutée à MiniPress. Elle facilitera encore plus la gestion de votre contenu.', 'image3.jpg', 'alice', 1, NOW(), NOW(), 3, 1),
                                                                                                                     ('Les avantages de lutilisation de MiniPress', 'Découvrez pourquoi MiniPress est le meilleur choix pour votre site web.', 'MiniPress offre de nombreux avantages, tels que la facilité d utilisation, la flexibilité et la puissance. Découvrez pourquoi de plus en plus de personnes choisissent MiniPress.', 'image4.jpg', 'bob', 3, NOW(), NOW(), 4, 1),
                                                                                                                     ('Conseils pour optimiser votre site web avec MiniPress', 'Améliorez les performances et l expérience utilisateur de votre site web avec MiniPress.', 'Découvrez des astuces pour optimiser votre site web, améliorer sa vitesse de chargement et offrir une expérience utilisateur exceptionnelle.', 'image5.jpg', 'emma', 2, NOW(), NOW(), 5, 1);
INSERT INTO `article` (`titre`, `resume`, `contenu`, `img`, `auteur`, `idCategorie`, `created_at`, `updated_at`, `idAuteur`, `publication`)
VALUES (
           'Titre de l\'article',
    'Résumé de l\'article',
           '## Contenu de l\'article\n\nCeci est un exemple de contenu détaillé en Markdown.\n\n### Sous-titre 1\n\n- Point 1\n- Point 2\n- Point 3\n\n### Sous-titre 2\n\n1. Élément 1\n2. Élément 2\n3. Élément 3\n',
    'image.jpg',
    'emma',
     1,
    NOW(), NOW(),
           5,
           1
       );

-- Données pour la table `categorie`
INSERT INTO `categorie` (`titre`, `resume`, `created_at`, `updated_at`) VALUES
('Actualités', 'Dernières nouvelles et événements', NOW(), NOW()),
('Tutoriels', 'Guides et didacticiels', NOW(), NOW()),
('Conseils', 'Conseils pratiques et astuces', NOW(), NOW());


--
INSERT INTO `user` (`login`, `passwd`, `email`, `nomUser`, `prenomUser`, `tel`, `token`, `privilege`) VALUES
    ('admin',	'$2y$12$CvVp14eT5oWFJqTf3d3nn.Q1NW3VZEJMdD2RJkNK0gf4i/xCOzwKi',	'Test1@gmail.com',	'',	'',	'',	NULL,	1);