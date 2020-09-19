<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transfer\TransferStoreRequest;
use Illuminate\Http\Request;

use App\Models\Transfer;

class TransferController extends Controller
{
    // public function store(WalletStoreRequest $request)
    // {
    //     $validated = $request->validated();
    //     $response = Wallet::create($request->all());
    //     return response()->json(['message' => 'Wallet created', 'wallet_code' => $response->id], 201);
    // }

    public function store(TransferStoreRequest $request)
    {
        $validated = $request->validated();
        $response = Transfer::create($request->all());
        return response()->json(['message' => 'Transfer requistion created', 'transfer_code' => $response->id], 201);
    }
}
