import {loadData} from "../module/apiLoader.js";
import {display_article, display_articles} from "../display/display.js";

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

export function userAction(p){
    p.addEventListener('click',  function (){
        loadData(this.getAttribute('url')).then(art =>{
            display_articles(art.articles);
        });
    })
}