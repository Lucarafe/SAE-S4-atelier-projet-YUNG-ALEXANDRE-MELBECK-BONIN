<?php
declare(strict_types=1);

namespace MiniPress\app\models;
use \Illuminate\Database\Eloquent as Eloq;

class User extends Eloq\Model
{
    protected $table = 'user';
    protected $primaryKey = 'email';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}