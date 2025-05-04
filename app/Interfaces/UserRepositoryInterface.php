<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function find($id);
    public function updateBalance($user, $amount);
}