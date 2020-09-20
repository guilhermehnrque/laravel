<?php

namespace App\Http\Controllers;

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

        if($user->type == 'lojista'){
            return response()->json(['message' => 'You can only receive transactions'], 422);
        }

        // Se o usuário for comun - prosseguir
        // Verificar se o valor informado ultrapassa o limite existente na carteira
        $value = $request->value;
        $wallet = Wallet::find($request->payer);
        $payerCurrentBalance = $wallet->current_balance;

        if($value > $payerCurrentBalance){
            return response()->json(['message' => "Higher value than expected"], 422);
        } else if(($payerCurrentBalance - $value) < 0){
            return response()->json(['message' => "More than you have"], 422);
        }

        $wallet->current_balance = ($payerCurrentBalance - $value);
        $wallet->save();

        // Adicionando o valor na carteira de quem está recebendo o pagamento
        $payee = Wallet::find($request->payee);
        $payeeCurrentBalance = $payee->current_balance;
        $payee->current_balance = ($payeeCurrentBalance + $value);
        $payee->save();
        
        return response()->json(['message' => 'Transaction OK', 'dsadas' => $payee], 201);
        
        // $response = Transfer::create($request->all());
        // return response()->json(['message' => 'Transfer requistion created', 'transfer_code' => $response->id], 201);
    }
}
