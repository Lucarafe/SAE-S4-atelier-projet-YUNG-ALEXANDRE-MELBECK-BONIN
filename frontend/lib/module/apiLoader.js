import {config} from '../conf/config.js';

//Fonction qui permet de charger les articles à partir de l'API
export function loadArticles(api = '/api/articles'){
    return fetch(config.entryPoint + api)
        .then(response => {
            // Si la réponse est OK, renvoie les données JSON
            if (response.ok) return response.json();
            // Sinon, rejette la promesse avec une erreur contenant le statut de la réponse
            else return Promise.reject(new Error(response.statusText))
        })
        // Gère les erreurs en les affichant dans la console
        .catch(error => {

            console.log('error : '+error);
        });
}

// Fonction qui permet de charger les catégories à partir de l'API
export function loadCategories(){
    return fetch(config.entryPoint + '/api/categories')
        .then(response => {
            // Si la réponse est OK, renvoie les données JSON
            if (response.ok) return response.json();
            // Sinon, rejette la promesse avec une erreur contenant le statut de la réponse

            else return Promise.reject(new Error(response.statusText))
        })
        // Gère les erreurs en les affichant dans la console
        .catch(error => {
            console.log('error : '+error);
        });
}

// Fonction pour charger les données à partir de l'API en utilisant une URL donnée
export function loadData(url){
    return fetch(config.entryPoint + url)
        .then(response => {
            // Si la réponse est OK, renvoie les données JSON
            if (response.ok) return response.json();
            // Sinon, rejette la promesse avec une erreur contenant le statut de la réponse
            else return Promise.reject(new Error(response.statusText))
        })
        // Gère les erreurs en les affichant dans la console
        .catch(error => {
            console.log('error : '+error);
        });
}
