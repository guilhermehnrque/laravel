<?php

namespace App\Http\Controllers;

use App\Http\Requests\Wallet\WalletStoreRequest;
use App\Http\Requests\Wallet\WalletUpdateRequest;
use Illuminate\Http\Request;

use App\Models\Wallet;
use App\Services\WalletService;

class WalletController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function store(WalletStoreRequest $request)
    {
        $validated = $request->validated();
        $response = $this->walletService->register($request);
        return response()->json(['message' => 'Wallet created', 'wallet_code' => $response->id], 201);
    }

    public function update(WalletUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $this->walletService->checkWallet($request, $id);
        $wallet_response = $this->walletService->deposit($request, $id);
        return response()->json(['message' => 'Income added', 'New balance' => $wallet_response ->current_balance], 201);
    }

}
