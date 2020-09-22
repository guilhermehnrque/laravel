<?php

namespace App\Services;

use App\Repositories\WalletRepository;
use Illuminate\Http\Request;

class WalletService
{
    protected $walletRepository;

    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function register(Request $request)
    {
        return $this->walletRepository->save($request->all());
    }
}
