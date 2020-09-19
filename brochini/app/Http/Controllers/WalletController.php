<?php

namespace App\Http\Controllers;

use App\Http\Requests\Wallet\WalletStoreRequest;
use App\Http\Requests\Wallet\WalletUpdateRequest;
use Illuminate\Http\Request;

use App\Models\Wallet;

class WalletController extends Controller
{

    public function store(WalletStoreRequest $request)
    {
        $validated = $request->validated();
        $response = Wallet::create($request->all());
        return response()->json(['message' => 'Wallet created', 'wallet_code' => $response->id], 201);
    }

    public function update(WalletUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        
        $wallet = new Wallet;
        if (!$id == null) {
            $walletResponse = $wallet->checkIfWalletExists($id, $request->user_id);

            if ($walletResponse == null) {
                return response()->json(['status' => 'error', 'message' => 'Invalid wallet'], 201);
            }

            $new_balance = $walletResponse->current_balance + $request->income;
            $walletResponse->current_balance = $new_balance;
            $walletResponse->save();
            return response()->json(['message' => 'Income added', 'actual_balance' => $walletResponse->current_balance], 201);
        }
    }

    public function withdraw(Request $request, $id)
    {
    }
}
