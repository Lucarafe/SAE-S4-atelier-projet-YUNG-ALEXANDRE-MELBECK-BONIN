import {loadArticles, loadCategories, loadData} from "../module/apiLoader.js";
import {display_article, display_articles, displayArticles} from "../display/display.js";
import {config} from '../conf/config.js';

export function articleAction(div) {
    div.addEventListener('click',  function () {
        loadData(this.getAttribute('url'))
            .then(art => display_article(art));
    });
}

export function categorieAction(li) {
    li.addEventListener('click',  function () {
        loadData(this.getAttribute('url'))
            .then(categ => display_articles(categ.articles));
    });
}

export function categoriesAction(li) {
    li.addEventListener('click',  function () {
        loadArticles()
            .then(article => display_articles(article.articles));
    });
}

export function userAction(p) {
    p.addEventListener('click',  function () {
        loadData(this.getAttribute('url'))
            .then(art => display_articles(art.articles));
    });
}

export function ButtonTrieAction(boutonTri) {
    boutonTri.addEventListener('click', function () {
        const ordre = this.dataset.ordre;
        const newOrdre = (ordre === config.trieAsc) ? config.trieDesc : config.trieAsc;

        loadArticles(newOrdre)
            .then(article => display_articles(article.articles));

        boutonTri.textContent = (newOrdre === config.trieAsc) ? 'Trier par ordre décroissant' : 'Trier par ordre croissant';
        boutonTri.dataset.ordre = newOrdre;
    });
}

export function searchBarAction(searchBar, articles) {
    searchBar.addEventListener('keyup', (e) => {
        const searchString = e.target.value.toLowerCase();

        const filteredArticles = articles.filter((art) => {
            return (
                art.article.titre.toLowerCase().includes(searchString) ||
                art.article.resume.toLowerCase().includes(searchString)
            );
        });

        const articleListe = document.getElementById('liste');
        articleListe.textContent = "";
        displayArticles(filteredArticles, articleListe);
    });
}
