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
        const author = document.createElement('p');

        title.textContent = article.titre;
        resume.textContent = article.resume;
        author.textContent = `Écrit par ${article.auteur}`;

        div.appendChild(title);
        div.appendChild(resume);
        div.appendChild(author);

        articleAction(div);

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

    const button = document.createElement('button');

    button.className = "categorie";
    button.textContent = 'Tous les articles';
    categoriesAction(button);
    listCategorie.appendChild(button);
    // Créer un élément de liste pour chaque catégorie
    categories.forEach(categ => {
        var categorie = categ.categorie
        const li = document.createElement('li');
        li.setAttribute('url', categ.links.self.href);
        li.className = "categorie";
        li.textContent = categorie.titre;
        categorieAction(li);

        // Ajouter l'élément de liste à la liste des catégories
        listCategorie.appendChild(li);
    });
}

export function display_article(art) {
    const titreList = document.getElementById('nomListe');
    const articleListe = document.getElementById('liste');

    articleListe.textContent = "";
    console.log(art);
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


