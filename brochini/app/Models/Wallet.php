<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function checkIfWalletExists($wallet_id, $user_id)
    {
        return $this->where('id', $wallet_id)->where('user_id', $user_id)->first();
    }

    public function getWalletUser($id)
    {
        $wallet = $this->find($id);
        return $wallet->user;
    }

    public function getWallet($id)
    {
        return $this->find($id);
    }

    public function walletExists($wallet_id)
    {
        return $this->where('id', $wallet_id)->exists();
    }


    // public updateSourceWallet($wallet_id, $value){
    //     $source = $this->where('id', $wallet_id)->first();
    //     $source->current_balance = $source->current_balance - $value;
    //     $source->save();
    //     return $source;
    // }

    // public updateTargetWallet(){

    // }
}
