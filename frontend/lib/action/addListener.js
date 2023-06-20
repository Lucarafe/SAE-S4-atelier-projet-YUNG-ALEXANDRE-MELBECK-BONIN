import {loadArticles, loadCategories, loadData} from "../module/apiLoader.js";
import {display_article, display_articles, displayArticles} from "../display/display.js";
import {config} from '../conf/config.js';

export function articleAction(div){
    div.addEventListener('click',  function (){
        loadData(this.getAttribute('url')).then(art =>{
            display_article(art);
        });
    })
}

export function categorieAction(li){
    li.addEventListener('click',  function (){
        loadData(this.getAttribute('url')).then(categ =>{
            display_articles(categ.articles);
        });
    })
}

export function categoriesAction(li){
    li.addEventListener('click',  function (){
        loadArticles().then(article => {
            display_articles(article.articles);
        });
    })
}

export function userAction(p){
    p.addEventListener('click',  function (){
        loadData(this.getAttribute('url')).then(art =>{
            display_articles(art.articles);
        });
    })
}

export function ButtonTrieAction(boutonTri){
    boutonTri.addEventListener('click', function (){
        const ordre = this.dataset.ordre;

        if (ordre === config.trieAsc) {
            trierArticlesAscendant(this);
        } else {
            trierArticlesDescendant(this);
        }
    })
}

function trierArticlesAscendant(boutonTri) {
    loadArticles(boutonTri.dataset.ordre).then(article =>{
        display_articles(article.articles);
    })

    boutonTri.textContent = 'Trier par ordre décroissant';
    boutonTri.dataset.ordre = config.trieDesc;
}


function trierArticlesDescendant(boutonTri) {
    loadArticles(boutonTri.dataset.ordre).then(article =>{
        display_articles(article.articles);
    })

    boutonTri.textContent = 'Trier par ordre croissant';
    boutonTri.dataset.ordre = config.trieAsc;
}

export function searchBarAction(searchBar, articles){
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
