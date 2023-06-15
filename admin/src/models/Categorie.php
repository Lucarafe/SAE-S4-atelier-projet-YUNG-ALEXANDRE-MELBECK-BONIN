<?php
declare(strict_types=1);

namespace MiniPress\app\models;
use \Illuminate\Database\Eloquent as Eloq;

class Categorie extends Eloq\Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = true;
    public $keyType = 'int';

    public function articles()
    {
        return $this->hasMany(Article::class, 'idCategorie');
    }
}
