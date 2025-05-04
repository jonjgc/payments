<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [ 'name', 'cpf', 'email', 'password', 'type', 'balance'];
    protected $hidden = ['password'];

    public function transferAsPayer() 
    {
        return $this->hasMany(Transfer::class, 'payer_id');
    }

    public function transferAsPayee() 
    {
        return $this->hasMany(Transfer::class, 'payee_id');
    }

}
