<?php

namespace App\Repositories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WalletRepository
{
    protected $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function save(array $attributes)
    {
        return $this->wallet->create($attributes);
    }

    public function searchUserWallet(array $attributes, $id)
    {
        try {
            return $this->wallet->where('id', $id)->where('user_id', $attributes['user_id'])->firstOrFail();
        } catch (\Exception $e) {
            throw new ModelNotFoundException('Invalid Wallet');
        }
    }

    public function cash(array $attributes, $id)
    {
        $wallet_response = $this->wallet->find($id);
        $new_balance = $wallet_response->current_balance + $attributes['income'];
        $wallet_response->current_balance = $new_balance;
        $wallet_response->save();
        return $wallet_response;
    }

    public function getWalletTypeUser(array $attributes, $type, $message)
    {
        try {
            return $this->wallet->where('id', $attributes[$type])->firstOrFail();
        } catch (\Exception $e) {
            throw new ModelNotFoundException($message);
        }
    }

    public function getLojistaWallet(array $attributes, $type)
    {

        $wallet_response = $this->wallet->find($attributes[$type]);
        $user = $wallet_response->user;

        if($user['type'] == 'lojista'){
            throw new ModelNotFoundException('You can only receive transactions');
        }
        return $user;
    }

    public function getWallet($id){
        $wallet_response = $this->wallet->find($id);
        return $wallet_response['current_balance'];
    }

}
