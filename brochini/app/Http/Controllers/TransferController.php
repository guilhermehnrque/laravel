<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Requests\Transfer\TransferStoreRequest;
use Illuminate\Http\Request;

use App\Models\Transfer;
use App\Models\Wallet;

class TransferController extends Controller
{
    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function store(TransferStoreRequest $request)
    {
        // Validação dos campos
        $validated = $request->validated();

        $walletPayer = $this->wallet->walletExists($request->payer);
        $walletPayee = $this->wallet->walletExists($request->payee);

        if ($walletPayer == null) {
            return response()->json(['generic' => 'Payer wallet invalid'], 422);
        }
        if ($walletPayee == null) {
            return response()->json(['generic' => 'Payee wallet invalid'], 422);
        }

        $walletPayerType = $this->wallet->getTypeWallet($request->payer);
        if ($walletPayerType == 'lojista') {
            return response()->json(['message' => 'You can only receive transactions'], 422);
        }

        $value = $request->value;
        $payer = $this->wallet->getWalletAndUser($request->payer);
        $payee = $this->wallet->getWalletAndUser($request->payee);

        $payerCurrentBalance = $payer->current_balance;
        $payeeCurrentBalance = $payee->current_balance;

        if ($value > $payerCurrentBalance) {
            return response()->json(['message' => "Higher value than expected"], 422);
        } else if (($payerCurrentBalance - $value) < 0) {
            return response()->json(['message' => "More than you have"], 422);
        }

        $payer->current_balance = ($payerCurrentBalance - $value);
        $payee->current_balance = ($payeeCurrentBalance + $value);

        $urlValidation = 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';
        $response = Http::get($urlValidation);

        if ($response->failed()) {
            $data = $request->all();
            $data['status'] = 'rejected';
            $response = Transfer::create($data);
            return response()->json(['guzzlet' => $response], 422);
        }

        $payer->save();
        $payee->save();
        $data = $request->all();
        $data['status'] = 'approved';
        $response = Transfer::create($data);

        return response()->json(['message' => 'Transaction OK', 'data' => $response], 201);
    }
}
