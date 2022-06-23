<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{

    public function getUsers()
    {

        return User::all();
    }

    public function getUserDetail($id)
    {
        return User::find($id);
    }

    public function createUser($data)
    {
        return User::create($data);
    }

    public function updateUser($user, $data)
    {
        return $user->update($data);
    }
}
