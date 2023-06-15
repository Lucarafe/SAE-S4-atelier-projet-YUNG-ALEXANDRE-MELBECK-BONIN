<?php

namespace MiniPress\app\service\user;

use MiniPress\app\models\User;

class UserService
{
    public function getUsers(): array
    {
        return User::all()->toArray();
    }
}