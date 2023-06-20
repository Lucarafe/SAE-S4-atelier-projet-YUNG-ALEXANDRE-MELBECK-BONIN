import {loadArticles, loadCategories} from "./module/apiLoader.js";
import {display_articles, display_categorie, display_trie} from "./display/display.js";

loadArticles().then(article => {
    display_articles(article.articles);
});
display_trie();
loadCategories().then(categories =>{
    display_categorie(categories.categories)
})
