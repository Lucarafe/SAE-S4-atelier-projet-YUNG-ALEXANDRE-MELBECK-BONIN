import {loadArticles} from "./module/apiLoader.js";
import {display_articles} from "./display/display.js";

loadArticles().then(article => {
    display_articles(article.articles);
    console.log(article.articles)
});
