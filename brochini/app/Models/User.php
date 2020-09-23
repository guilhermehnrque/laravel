<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{ 
    protected $hidden = ['password'];
    
    protected $table = 'users';

    protected $fillable = [
        'full_name', 'cpf_cnpj', 'email', 'password', 'type'
    ];

    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet', 'user_id', 'id');
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

}
