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

    public function checkWallet(Request $request, $id){
        return $this->walletRepository->search($request->all(), $id);
    }

    public function deposit(Request $request, $id){
        return $this->walletRepository->cash($request->all(), $id);
    }
}
