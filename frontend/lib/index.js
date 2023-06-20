import {loadArticles, loadCategories} from "./module/apiLoader.js";
import {display_articles, display_categorie} from "./display/display.js";

loadArticles().then(article => {
    display_articles(article.articles);
});
loadCategories().then(categories =>{
    display_categorie(categories.categories)
})
