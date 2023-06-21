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

// Fonction pour afficher les articles dans la liste
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

        // Affichage des informations de l'article
        title.textContent = article.titre;
        let conv = new showdown.Converter();
        resume.innerHTML = conv.makeHtml(article.resume);
        console.log(resume.innerHTML)
        let dateObject = new Date(article.created_at);

        let readableDate = dateObject.toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });

        date.textContent = `Créé le ${readableDate}`;

        author.textContent = `Écrit par ${article.auteur}`;

        // Ajouter les éléments à la div de l'article
        div.appendChild(title);
        div.appendChild(resume);
        div.appendChild(date)
        div.appendChild(author);
        // Appel de l'action pour l'article
        articleAction(div);

        // Ajout de la div de l'article à la liste des articles
        articleListe.appendChild(div);
    });
}

// Fonction pour afficher tous les articles
export function display_articles(articles) {
    const form = document.getElementById('form');
    form.style.display = 'flex';
    const search = document.getElementById('searchBar');
    search.innerText = "";

    const searchBar = document.createElement('input');
    searchBar.setAttribute('type', 'text');
    searchBar.setAttribute('id', 'searchBar');
    searchBar.setAttribute('placeholder', 'Rechercher...');

    search.appendChild(searchBar);
    const articleListe = document.getElementById('liste');
    articleListe.textContent = "";

    const arti = document.getElementById('articleDetail');
    arti.textContent = "";
    searchBarAction(searchBar, articles);


    // Affichage initial de tous les articles
    displayArticles(articles, articleListe);
}

// Fonction pour afficher les catégories
export function display_categorie(categories) {
    const categoryList = document.querySelector('.category-list');

    const button = document.createElement('button');
    button.className = 'button';

    const subTitle = document.createElement('h2');
    subTitle.textContent = 'Tous';

    button.appendChild(subTitle);
    categoriesAction(button);
    categoryList.appendChild(button);

    // Créer un élément de bouton pour chaque catégorie
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

}

// Fonction pour afficher un article spécifique
export function display_article(art) {
    const articleListe = document.getElementById('liste');
    articleListe.textContent = "";


    const arti = document.getElementById('articleDetail');
    arti.textContent = "";
    let form = document.getElementById('form');
    form.style.display = 'none';

    const hr = document.createElement('hr');
    const hr2 = document.createElement('hr');
    const hr3 = document.createElement('hr');
    // Récupérer le premier article du tableau
    const article = art.article;

    // Créer un élément div pour afficher l'article
    const div = document.createElement('div');
    div.className = 'articleDetail';

    // Créer un élément img pour afficher l'image de l'article
    const img = document.createElement('img');
    img.setAttribute('src', 'image/' +article.img);
    img.setAttribute('alt', 'Image de l\'article');
    div.appendChild(img);
    div.appendChild(hr);
    // Créer un élément div pour les détails de l'article
    const detailsDiv = document.createElement('div');
    detailsDiv.className = 'articleDetails';

    // Créer un élément h2 pour le titre de l'article
    const title = document.createElement('h2');
    title.textContent = article.titre;
    detailsDiv.appendChild(title);
    detailsDiv.appendChild(hr2);
    // Créer un élément p pour le contenu de l'article
    let conv = new showdown.Converter();
    const contenu = document.createElement('p');
    contenu.innerHTML = conv.makeHtml(article.contenu);
    detailsDiv.appendChild(contenu);
    detailsDiv.appendChild(hr3);
    // Créer un élément div pour les métadonnées de l'article
    const metadataDiv = document.createElement('div');
    metadataDiv.className = 'metadata';

    // Créer un élément p pour le nom du créateur de l'article
    const author = document.createElement('p');
    author.setAttribute('url', art.links.articles_author.href);
    userAction(author);
    author.textContent = `Par ${article.auteur}`;
    metadataDiv.appendChild(author);

    // Créer un élément p pour la date de création de l'article
    const createdAt = document.createElement('p');
    const dateObject = new Date(article.created_at);
    const readableDate = dateObject.toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
    createdAt.textContent = `Créé le ${readableDate}`;
    metadataDiv.appendChild(createdAt);

    detailsDiv.appendChild(metadataDiv);
    div.appendChild(detailsDiv);

    // Ajout du div de l'article à la liste des articles
    arti.appendChild(div);
}


// Fonction pour afficher le bouton de tri
export function display_trie(){
    const boutonTri = document.getElementById('trie');
    boutonTri.className = ''
    boutonTri.textContent = 'Trier par ordre croissant';
    boutonTri.dataset.ordre = config.trieAsc;
    ButtonTrieAction(boutonTri);
}


