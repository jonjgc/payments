<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function updateBalance($user, $amount)
    {
        $user->balance += $amount;
        $user->save();
        return $user;
    }

}