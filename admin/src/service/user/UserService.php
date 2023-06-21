<?php

namespace MiniPress\app\service\user;

use MiniPress\app\models\User;

class UserService
{
    public function getUsers(): array
    {
        return User::all()->toArray();
    }

    public function getUserById($id)
    {
        return User::where('id', $id)->get()->toArray();
    }
}