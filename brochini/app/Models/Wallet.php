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

    public function isWalletUserValid($wallet_id, $user_id)
    {
        try {
            return $this->where('id', $wallet_id)->where('user_id', $user_id)->firstOrFail();
        } catch (\Exception $e) {
            throw new ModelNotFoundException('Invalid wallet');
        }
    }

    public function ifWalletIsLojista($id)
    {

        $wallet = $this->find($id);
        return $wallet->user;
    }

    public function ifWalletExists($wallet_id, $message)
    {
        try {
            return $this->where('id', $wallet_id)->firstOrFail();
        } catch (\Exception $e) {
            throw new ModelNotFoundException($message);
        }
    }

    public function getWalletUserData($id)
    {
        $wallet = $this->find($id);
        return $wallet->user;
    }

    public function getWallet($id)
    {
        return $this->find($id);
    }
}
