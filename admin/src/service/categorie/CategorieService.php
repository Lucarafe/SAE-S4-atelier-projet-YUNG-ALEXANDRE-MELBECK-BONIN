<?php

namespace MiniPress\app\service\categorie;

use MiniPress\app\models\Categorie;

class CategorieService
{
    public function getCategories(): array
    {
        return Categorie::all()->toArray();
    }

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