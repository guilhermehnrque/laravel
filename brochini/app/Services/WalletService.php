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

    public function deposit(Request $request, $id)
    {
        return $this->walletRepository->cash($request->all(), $id);
    }

    public function checkWallet(Request $request, $id)
    {
        return $this->walletRepository->searchUserWallet($request->all(), $id);
    }

    public function searchWallet(Request $request, $type, $message)
    {
        return $this->walletRepository->getWallet($request->all(), $type, $message);
    }

    public function checkWalletLojista(Request $request, $type)
    {
        return $this->walletRepository->getLojistaWallet($request->all(), $type);
    }


}
