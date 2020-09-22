<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Wallet extends Model
{
    protected $table = 'wallets';

    protected $fillable = [
        'current_balance', 'status', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function payer()
    {
        return $this->hasMany('App\Models\Transfer', 'payer', 'id');
    }

    public function payee()
    {
        return $this->hasMany('App\Models\Transfer', 'payee', 'id');
    }

}
