<?php
declare(strict_types=1);

namespace MiniPress\app\models;
use \Illuminate\Database\Eloquent as Eloq;

class Article extends Eloq\Model
{
    protected $table = 'article';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = true;
    public $keyType = 'int';

    // retourne la catégorie de l'article
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'idCategorie');
    }
    // retourne l'auteur de l'article
    public function user()
    {
        return $this->belongsTo(User::class, 'email');
    }
}
