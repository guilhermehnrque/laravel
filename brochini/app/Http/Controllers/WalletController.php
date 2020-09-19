<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Models\Wallet;

class WalletController extends Controller
{
    public function store(WalletStoreRequest $request)
    {
        $validated = $request->validated();
        $response = Wallet::create($request->all());
        return response()->json(['message' => 'Wallet created', 'code' => $response->id], 201);
    }

    public function update(Request $request, $id)
    {
        $walletObject = [
            'income' => $request->income,
            'user_id' => $request->user_id
        ];

        try {
            $wallet = Wallet::find($id);
            $wallet->current_balance = $walletObject['income'];
            $wallet->save();

            return response()->json(['message' => 'Income added', 'Actual Balance' => $wallet->current_balance], 201);
        } catch (QueryExpeciton $e) {
            dd($e->getMessage());
        }
    }
}
