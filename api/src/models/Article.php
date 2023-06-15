<?php
declare(strict_types=1);

namespace MiniPress\api\models;
use \Illuminate\Database\Eloquent as Eloq;

class Article extends Eloq\Model
{
    protected $table = 'article';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = true;
    public $keyType = 'int';

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
