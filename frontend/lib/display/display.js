
export function display_articles(articles) {
    const titreList = document.getElementById('nomListe');
    titreList.textContent = 'Liste des articles :';
    const articleListe = document.getElementById('liste');

    // Parcourir les articles dans l'ordre inverse
    articles.forEach(art => {
        var article = art.article
        // Créer les éléments HTML pour afficher les informations de l'article
        const div = document.createElement('div');
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

        // Ajout à la liste des articles
        articleListe.appendChild(div);
    });
}