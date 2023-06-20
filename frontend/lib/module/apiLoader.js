import {config} from '../conf/config.js';

export function loadArticles(){
    return fetch(config.entryPoint + '/api/articles')
        .then(response => {
            if (response.ok) return response.json();
            else return Promise.reject(new Error(response.statusText))
        })
        .catch(error => {
            console.log('error : '+error);
        });
}

export function loadCategories(){
    return fetch(config.entryPoint + '/api/categories')
        .then(response => {
            if (response.ok) return response.json();
            else return Promise.reject(new Error(response.statusText))
        })
        .catch(error => {
            console.log('error : '+error);
        });
}

export function loadData(url){
    return fetch(config.entryPoint + url)
        .then(response => {
            if (response.ok) return response.json();
            else return Promise.reject(new Error(response.statusText))
        })
        .catch(error => {
            console.log('error : '+error);
        });
}
