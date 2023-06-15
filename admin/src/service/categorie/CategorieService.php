<?php

namespace MiniPress\app\service\categorie;

use MiniPress\app\models\Categorie;

class CategorieService
{
    /**
     * Récupère toutes les catégories.
     *
     * @return array Tableau contenant les catégories
     */
    public function getCategories(): array
    {
        return Categorie::all()->toArray();
    }

    /**
     * Ajoute une nouvelle catégorie.
     *
     * @param string $titre Le titre de la catégorie
     * @param string $resume Le résumé de la catégorie
     * @throws \Exception En cas d'erreur lors de la création de la catégorie
     * @return void
     */
    public function addCategorie(string $titre, string $resume): void
    {
        try {
            $categorie = new Categorie();
            $categorie->titre = $titre;
            $categorie->resume = $resume;
            $categorie->save();
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la création de la catégorie : " . $e->getMessage());
        }
    }

}