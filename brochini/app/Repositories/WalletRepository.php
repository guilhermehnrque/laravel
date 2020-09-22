<?php

namespace App\Repositories;

use App\Models\Wallet;

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
}
