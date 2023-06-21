-- Données pour la table `user`
INSERT INTO `user` (`login`, `passwd`, `email`, `nomUser`, `prenomUser`, `tel`, `token`, `privilege`) VALUES
                                                                                                          ('john.doe', 'pass123', 'john.doe@example.com', 'Doe', 'John', '123456789', 'token123', 1),
                                                                                                          ('jane.smith', 'password', 'jane.smith@example.com', 'Smith', 'Jane', '987654321', 'token456', 0),
                                                                                                          ('alice', 'alicepass', 'alice@example.com', 'Alice', 'Brown', '555555555', NULL, 0),
                                                                                                          ('bob', 'bobpass', 'bob@example.com', 'Bob', 'Johnson', '999999999', NULL, 0),
                                                                                                          ('emma', 'emmapass', 'emma@example.com', 'Watson', 'Emma', '111111111', 'token789', 1);

-- Données pour la table `article`
INSERT INTO `article` (`titre`, `resume`, `contenu`, `img`, `auteur`, `idCategorie`, `created_at`, `updated_at`, `idAuteur`, `publication`)
VALUES (
           'Les couchers de soleils',
    '---

# Les couchers de soleil

Les couchers de soleil sont un spectacle naturel incroyablement beau et apaisant. Chaque soir, lorsque le soleil se rapproche de l''horizon, le ciel se transforme en une palette de couleurs éblouissantes. Du rouge flamboyant à l''orange chaud en passant par le rose délicat et le violet intense, les couchers de soleil offrent une explosion de couleurs spectaculaires. C''est un moment idéal pour se détendre, contempler la beauté de la nature et profiter d''une atmosphère paisible. Les couchers de soleil symbolisent la fin de la journée et marquent la transition entre le jour et la nuit. Ils nous offrent des moments de sérénité, nous permettant de nous connecter avec la nature et de réfléchir sur les événements de la journée passée. C''est une expérience simple mais profondément enrichissante qui nous rappelle la beauté et la fragilité de notre monde.

---
',
           '---

# Les couchers de soleil

Les couchers de soleil sont un spectacle naturel incroyablement beau et apaisant. Chaque soir, lorsque le soleil se rapproche de l''horizon, le ciel se transforme en une palette de couleurs éblouissantes. Voici quelques raisons pour lesquelles les couchers de soleil sont si captivants :

## 1. Couleurs spectaculaires

Les couchers de soleil offrent une explosion de couleurs vibrantes qui illuminent le ciel. Du rouge flamboyant à l''orange chaud, en passant par le rose délicat et le violet intense, les nuances se mêlent harmonieusement pour créer un véritable spectacle visuel.

## 2. Atmosphère paisible

Lorsque le soleil se couche, l''atmosphère se transforme. La douce lumière tamisée crée une ambiance chaleureuse et apaisante. C''est un moment idéal pour se détendre, contempler la beauté de la nature et profiter d''un moment de tranquillité.

## 3. Moments de sérénité

Les couchers de soleil sont souvent associés à des moments de sérénité. Que ce soit sur une plage, au sommet d''une montagne ou simplement depuis votre fenêtre, observer le coucher du soleil offre une pause dans le tumulte de la vie quotidienne. C''est l''occasion de se connecter avec la nature et de se sentir en harmonie avec l''univers qui nous entoure.

## 4. Symbole de fin de journée

Les couchers de soleil marquent la fin d''une journée et le début de la soirée. Ils symbolisent la transition entre le jour et la nuit, offrant un moment de réflexion sur les événements de la journée passée et une anticipation de ce que la soirée peut apporter.

Profitez de ces moments magiques et prenez le temps de vous arrêter pour admirer les couchers de soleil. C''est une expérience simple mais profondément enrichissante qui nous rappelle la beauté et la fragilité de notre monde.

---
',
    '   image.jpg',
        'emma',
        1,
        NOW(),
        NOW(),
        5,
        1
       ),
       ('Taylor Swift : Nouvel album et tournée mondiale',
        '---\nDécouvrez les dernières actualités de Taylor Swift.\n---',
        '---
        \n# Préparez-vous, fans français de Taylor Swift,\ncar la reine de la pop vient d''annoncer une tournée européenne de son "The Eras Tour" ! Après des mois de spéculation et d''anticipation, la superstar mondiale a dévoilé les dates de sa tournée en Europe, promettant un voyage musical inoubliable qui captivera les fans à travers le continent. Pour la France, rendez-vous à Paris La Défense Arena les 9 & 10 mai 2024 mais aussi au Groupama Stadium de Lyon le 2 juin 2024 !\n\n## Taylor Swift en concert à Paris et à Lyon : inscrivez-vous à l''alerte artiste\n\nC''est officiel, la tournée européenne passera bien par la France pour trois dates : deux à Paris, point de départ de The Eras Tour en Europe et une à Lyon. En tout 26 dates avec des étapes prévues dans les plus grandes villes d''Europe comme Lisbonne, Berlin, Madrid, Londres, Stockholm, Edinburgh, Liverpool, Cardiff, Dublin, Amsterdam, Zûrich, Milan, etc.\n\nPour patienter, coup de projecteur sur l''un de ses concerts donné lors de sa tournée américaine que Taylor Swift a entamée en mars dernier et qui prendra fin en août.\n
        ',
        'taylor-swift.jpg',
        'john.doe',
        1,
        NOW(),
        NOW(),
        1,
        1),
       ('La queen Lana Del Rey',
        '# Lana Del Rey : Une icône de la pop alternative

Lana Del Rey est une artiste américaine dont la musique unique mélange la pop, le rock et la musique alternative. Sa voix envoûtante et son style rétro ont captivé des millions de fans à travers le monde. Ses chansons explorent des thèmes sombres tels que l''amour perdu et la mélancolie, créant une ambiance cinématographique. Lana Del Rey a sorti plusieurs albums acclamés par la critique, dont "Born to Die", "Ultraviolence" et "Norman Fucking Rockwell!". Son style distinctif et son talent musical ont fait d''elle une icône de la pop alternative. Découvrez l''univers captivant et intemporel de Lana Del Rey !
',
        '# Lana Del Rey : Une icône de la pop alternative

Lana Del Rey est une artiste américaine connue pour son style musical unique mélangeant la pop, le rock et la musique alternative. Sa voix envoûtante et sa capacité à créer une ambiance cinématographique ont captivé des millions de fans à travers le monde.

## Les débuts de Lana Del Rey

Née Elizabeth Woolridge Grant, Lana Del Rey a connu ses premiers succès avec des chansons telles que "Video Games" et "Born to Die". Son style rétro et sa nostalgie pour une époque révolue ont contribué à son attrait singulier. Elle a rapidement gagné en popularité et est devenue une figure emblématique de la scène musicale contemporaine.

## Un univers sombre et introspectif

Les chansons de Lana Del Rey explorent souvent des thèmes sombres tels que l''amour perdu, la mélancolie et la désillusion. Sa musique est empreinte d''une ambiance nostalgique, évoquant des images de paysages urbains nocturnes et de romances tragiques. Ses paroles poétiques et introspectives reflètent ses propres expériences personnelles et offrent une profondeur émotionnelle à ses compositions.

## Une discographie riche et variée

Lana Del Rey a sorti plusieurs albums acclamés par la critique, parmi lesquels :

1. "Born to Die" (2012)
2. "Ultraviolence" (2014)
3. "Honeymoon" (2015)
4. "Lust for Life" (2017)
5. "Norman Fucking Rockwell!" (2019)
6. "Chemtrails over the Country Club" (2021)
7. "Blue Banister" (2021)
8. "Did you Know That There A Tunnel Under Ocean Blvd" (2023)

Chacun de ces albums présente une évolution artistique et musicale, tout en conservant l''esthétique unique de Lana Del Rey.

## Une artiste influente

Lana Del Rey a laissé une empreinte durable sur l''industrie musicale et a inspiré de nombreux artistes émergents. Son style distinctif, son charisme et son talent musical ont fait d''elle une véritable icône de la pop alternative.

Que vous soyez un fan de longue date ou que vous découvriez Lana Del Rey pour la première fois, sa musique vous transportera dans un univers captivant et intemporel.

',
        'lana.jpg',
        'alice',
        1,
        NOW(),
        NOW(),
        3,
        1),
       ('Comment installer PHP',
        'Découvrez notre tuto sur comment installer PHP !',
        '## Installation de PHP

1. **Téléchargement de PHP :**
   - Rendez-vous sur le site officiel de PHP à l''adresse suivante : [https://www.php.net/downloads.php](https://www.php.net/downloads.php)
   - Choisissez la version de PHP appropriée à votre système d''exploitation (Windows, macOS, Linux, etc.).
   - Téléchargez le package d''installation correspondant à votre configuration.

2. **Installation de PHP :**
   - Sur Windows :
     - Exécutez le fichier d''installation téléchargé.
     - Suivez les instructions de l''assistant d''installation pour configurer PHP.
     - Sélectionnez les composants à installer, tels que le module Apache si vous souhaitez utiliser PHP avec un serveur web Apache.
     - Choisissez le répertoire d''installation de PHP.
     - Configurez les paramètres spécifiques à votre environnement (par exemple, l''emplacement de votre serveur web).
     - Terminez l''installation.

   - Sur macOS :
     - Ouvrez le fichier d''installation téléchargé (généralement un fichier .dmg).
     - Suivez les instructions de l''assistant d''installation pour configurer PHP.
     - Choisissez les composants à installer.
     - Configurez les paramètres spécifiques à votre environnement.
     - Terminez l''installation.

   - Sur Linux :
     - Utilisez le gestionnaire de paquets de votre distribution Linux pour installer PHP. Par exemple, pour Ubuntu, vous pouvez exécuter la commande suivante dans un terminal :
       ```
       sudo apt-get install php
       ```
     - Suivez les instructions du gestionnaire de paquets pour l''installation.

3. **Vérification de l''installation :**
   - Pour vérifier que PHP est correctement installé, ouvrez un terminal ou une invite de commandes et exécutez la commande suivante :
     ```
     php -v
     ```
   - Vous devriez voir s''afficher la version de PHP installée.

4. **Utilisation de PHP :**
   - Créez un fichier avec une extension .php (par exemple, index.php) dans un éditeur de texte.
   - Ajoutez votre code PHP à l''intérieur des balises PHP :
     ```php
     <?php
     // Votre code PHP ici
     ?>
     ```
   - Vous pouvez maintenant écrire votre code PHP pour effectuer des opérations telles que la manipulation de données, la génération de contenu dynamique, etc.
   - Pour exécuter votre code PHP, vous devez le placer dans le répertoire de votre serveur web local (par exemple, htdocs pour Apache) et accéder à ce fichier via votre navigateur web en utilisant l''URL appropriée (par exemple, [http://localhost/monfichier.php](http://localhost/monfichier.php)).

Ceci est une introduction de base à l''installation et à l''utilisation de PHP. Vous pouvez trouver plus d''informations et de ressources dans la documentation officielle de PHP sur le site web de PHP.net.

J''espère que cela vous aide à démarrer avec PHP !
',
        'php.jpg',
        'bob',
        2,
        NOW(),
        NOW(),
        4,
        1);


-- Données pour la table `categorie`
INSERT INTO `categorie` (`titre`, `resume`, `created_at`, `updated_at`) VALUES
('Actualités', 'Dernières nouvelles et événements', NOW(), NOW()),
('Tutoriels', 'Guides et didacticiels', NOW(), NOW()),
('Conseils', 'Conseils pratiques et astuces', NOW(), NOW());


--
INSERT INTO `user` (`login`, `passwd`, `email`, `nomUser`, `prenomUser`, `tel`, `token`, `privilege`) VALUES
    ('admin',	'$2y$12$CvVp14eT5oWFJqTf3d3nn.Q1NW3VZEJMdD2RJkNK0gf4i/xCOzwKi',	'Test1@gmail.com',	'',	'',	'',	NULL,	1);