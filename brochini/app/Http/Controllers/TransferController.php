<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Requests\Transfer\TransferStoreRequest;
use Illuminate\Http\Request;

use App\Models\Transfer;
use App\Models\Wallet;

class TransferController extends Controller
{
    public function store(TransferStoreRequest $request)
    {
        // Validando as informações
        $validated = $request->validated();
        $user = Wallet::find($request->payer)->user;

        if ($user->type == 'lojista') {
            return response()->json(['message' => 'You can only receive transactions'], 422);
        }

        $value = $request->value;
        $payer = Wallet::find($request->payer);
        $payerCurrentBalance = $payer->current_balance;

        if ($value > $payerCurrentBalance) {
            return response()->json(['message' => "Higher value than expected"], 422);
        } else if (($payerCurrentBalance - $value) < 0) {
            return response()->json(['message' => "More than you have"], 422);
        }

        $payer->current_balance = ($payerCurrentBalance - $value);

        $payee = Wallet::find($request->payee);
        $payeeCurrentBalance = $payee->current_balance;
        $payee->current_balance = ($payeeCurrentBalance + $value);

        $urlValidation = 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';
        $response = Http::get($urlValidation);

        if ($response->failed()) {
            $request->status = 'rejected';
            $response = Transfer::create($request->all());
            return response()->json(['guzzlet' => $response], 422);
        }

        $request->status = 'done';
        $response = Transfer::create($request->all());
        $payer->save();
        $payee->save();
        return response()->json(['message' => 'Transaction OK', 'data' => $response], 201);

    }
}
