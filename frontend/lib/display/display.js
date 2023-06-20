import {articleAction, categorieAction, userAction} from "../action/addListener.js";
'use strict'

export function display_articles(articles) {
    const titreList = document.getElementById('nomListe');
    titreList.textContent = "";
    titreList.textContent = 'Liste des articles :';
    const articleListe = document.getElementById('liste');

    articleListe.textContent = "";
    // Parcourir les articles dans l'ordre inverse
    articles.forEach(art => {
        var article = art.article;
        const div = document.createElement('div');
        div.className = 'article';
        div.setAttribute('url', art.links.self.href); // Ajout de l'attribut id avec la valeur de l'id de l'article

        const title = document.createElement('h3');
        const date = document.createElement('p');
        const author = document.createElement('p');

        // Définir le contenu des éléments
        title.textContent = article.titre;
        date.textContent = `Créé le ${article.created_at}`;
        author.textContent = `Auteur : ${article.auteur}`;

        // Ajouter les éléments
        div.appendChild(title);
        div.appendChild(date);
        div.appendChild(author);

        articleAction(div);

        // Ajout à la liste des articles
        articleListe.appendChild(div);
    });

}

export function display_categorie(categories) {
    const listCategorie = document.getElementById('listCategorie');

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
    author.setAttribute('url', art.links.articlesUser);
    userAction(author);
    author.textContent = article.auteur;

    // Ajouter les éléments au div de l'article
    div.appendChild(contenu);
    div.appendChild(author);

    // Ajout du div de l'article à la liste des articles
    articleListe.appendChild(div);
}


