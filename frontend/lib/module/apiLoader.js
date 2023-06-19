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