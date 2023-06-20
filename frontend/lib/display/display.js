import {
    articleAction,
    ButtonTrieAction,
    categorieAction,
    categoriesAction,
    searchBarAction,
    userAction
} from "../action/addListener.js";
import {config} from "../conf/config.js";
'use strict'

export function displayArticles(filteredArticles, articleListe) {
    filteredArticles.forEach(art => {
        var article = art.article;
        const div = document.createElement('div');
        div.className = 'article';
        div.setAttribute('url', art.links.self.href);

        const title = document.createElement('h3');
        const resume = document.createElement('p');
        const date = document.createElement('p');
        const author = document.createElement('p');

        // Définir le contenu des éléments
        title.textContent = article.titre;
        resume.textContent = article.resume;
        date.textContent = `Créé le ${article.created_at}`;
        author.textContent = `Écrit par ${article.auteur}`;

        // Ajouter les éléments
        div.appendChild(title);
        div.appendChild(resume);
        div.appendChild(author);

        articleAction(div);

        // Ajout à la liste des articles
        articleListe.appendChild(div);
    });
}

export function display_articles(articles) {
    const titreList = document.getElementById('nomListe');
    titreList.textContent = "";
    titreList.textContent = 'Liste des articles :';

    const searchBar = document.createElement('input');
    searchBar.setAttribute('type', 'text');
    searchBar.setAttribute('id', 'searchBar');
    searchBar.setAttribute('placeholder', 'Rechercher...');
    titreList.appendChild(searchBar);

    const articleListe = document.getElementById('liste');
    articleListe.textContent = "";
    searchBarAction(searchBar, articles);


    // Initial display of all articles
    displayArticles(articles, articleListe);
}

export function display_categorie(categories) {
    const listCategorie = document.getElementById('listCategorie');
    const categoryList = document.querySelector('.category-list');
    const categoryNav = document.querySelector('.category-nav');
    const arrowLeft = document.querySelector('.arrow-left');
    const arrowRight = document.querySelector('.arrow-right');

    // Créer un élément de bouton pour chaque catégorie
    const button = document.createElement('button');

    button.className = "categorie";
    button.textContent = 'Tous les articles';
    categoriesAction(button);
    listCategorie.appendChild(button);
    // Créer un élément de liste pour chaque catégorie
    categories.forEach(categ => {
        var categorie = categ.categorie;
        const button = document.createElement('button');
        button.setAttribute('url', categ.links.self.href);
        button.className = 'button';

        const subTitle = document.createElement('h2');
        subTitle.textContent = categorie.titre;

        button.appendChild(subTitle);
        categorieAction(button);

        categoryList.appendChild(button);
    });

    let slideIndex = 0;

    arrowLeft.addEventListener('click', () => {
        slideIndex--;
        slideCarousel();
    });

    arrowRight.addEventListener('click', () => {
        slideIndex++;
        slideCarousel();
    });

    // Ajouter un événement de redimensionnement à la fenêtre
    window.addEventListener('resize', slideCarousel);

// Fonction slideCarousel mise à jour
    function slideCarousel() {
        const buttons = categoryList.querySelectorAll('.button');
        const buttonWidth = buttons[0].offsetWidth;
        const maxSlides = Math.floor(categoryList.offsetWidth / buttonWidth);

        if (categories.length <= maxSlides) {
            // Si toutes les catégories sont affichées et visibles
            arrowLeft.style.display = 'none';
            arrowRight.style.display = 'none';
            categoryList.style.transform = 'translateX(0)';
        } else {
            // Sinon, afficher les flèches et appliquer le défilement
            arrowLeft.style.display = 'block';
            arrowRight.style.display = 'block';

            if (slideIndex < 0) {
                slideIndex = categories.length - maxSlides;
            } else if (slideIndex > categories.length - maxSlides) {
                slideIndex = 0;
            }

            categoryList.style.transform = `translateX(-${slideIndex * buttonWidth}px)`;
        }
    }



    // Initialiser le carousel slider
    slideCarousel();

    // Fixer les flèches de navigation
    const containerWidth = categoryNav.offsetWidth;
    const arrowWidth = arrowLeft.offsetWidth;

    arrowLeft.style.left = `-${arrowWidth}px`;
    arrowRight.style.right = `-${arrowWidth}px`;
    categoryNav.style.width = `${containerWidth}px`;
}

export function display_article(art) {
    const titreList = document.getElementById('nomListe');
    const articleListe = document.getElementById('liste');

    articleListe.textContent = "";

    // Récupérer le premier article du tableau
    const article = art.article;

    // Créer un élément div pour afficher l'article
    const div = document.createElement('div');
    div.className = 'article';
    div.setAttribute('url', article.url);

    titreList.textContent = article.titre;

    // Créer un élément paragraphe p pour afficher la date de création de l'article
    let conv = new showdown.Converter();
    const contenu = document.createElement('p');
    contenu.innerHTML = conv.makeHtml(article.contenu);

    // Créer un élément paragraphe p pour afficher l'auteur de l'article
    const author = document.createElement('p');
    author.setAttribute('url', art.links.articles_author.href);
    userAction(author);
    author.textContent = article.auteur;

    // Ajouter les éléments au div de l'article
    div.appendChild(contenu);
    div.appendChild(author);

    // Ajout du div de l'article à la liste des articles
    articleListe.appendChild(div);
}

export function display_trie(){
    const boutonTri = document.getElementById('trie');

    boutonTri.textContent = 'Trier par ordre croissant';
    boutonTri.dataset.ordre = config.trieAsc;
    ButtonTrieAction(boutonTri);
}


