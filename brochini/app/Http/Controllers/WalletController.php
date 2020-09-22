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
        //$validated = $request->validated();
        //return response()->json(['message' => 'Wallet created', 'wallet_code' => $request->all()], 201);
        $response = $this->walletService->register($request);
        
        return response()->json(['message' => 'Wallet created', 'wallet_code' => $response->id], 201);
    }

    public function update(WalletUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        //if ($id == null) return response()->json(['status' => 'error', 'message' => 'Invalid user id'], 201);

        $walletResponse = $this->wallet->isWalletUserValid($id, $request->user_id);

        $new_balance = $walletResponse->current_balance + $request->income;
        $walletResponse->current_balance = $new_balance;
        $walletResponse->save();
        
        return response()->json(['message' => 'Income added', 'actual_balance' => $walletResponse->current_balance], 201);
    }

    public function withdraw(Request $request, $id)
    {
    }
}
