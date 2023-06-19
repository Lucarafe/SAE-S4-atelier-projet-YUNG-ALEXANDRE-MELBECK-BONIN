import {loadArticles} from "./module/apiLoader.js";

loadArticles().then(article => {
    console.log(article)
});
