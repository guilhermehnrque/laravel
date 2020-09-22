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

    public function search(array $attributes, $id){
        try {
            return $this->wallet->where('id', $id)->where('user_id', $attributes['user_id'])->firstOrFail();
        } catch (\Exception $e) {
            throw new ModelNotFoundException('Invalid Wallet');
        }
    }

    public function cash(array $attributes, $id){
        $wallet_response = $this->wallet->find($id);
        $new_balance = $wallet_response->current_balance + $attributes['income'];
        $wallet_response->current_balance = $new_balance;
        $wallet_response->save();
        return $wallet_response;
    }
}
