<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    protected $fillable = [
       'current_balance', 'status', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    public function tranfersSource(){
        return $this->hasMany('App\Models\Transfer', 'wallet_source', 'id');
    }

    public function tranfersTarget(){
        return $this->hasMany('App\Models\Transfer', 'wallet_target', 'id');
    }

    public function checkIfWalletExists($wallet_id, $user_id){
        return $this->where('id', $wallet_id)->where('user_id', $user_id)->first();
    }
}
