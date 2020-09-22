<?php

namespace App\Repositories;

use App\Models\Transfer;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;

class TransferRepository
{
    protected $transfer;
    protected $wallet;
    protected $urlTransaction;

    public function __construct(Transfer $transfer, Wallet $wallet)
    {
        $this->transfer = $transfer;
        $this->wallet = $wallet;
        $this->urlTransaction = 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';
    }

    public function transaction(array $attributes)
    {
        $value = $attributes['value'];
        $payerWallet = $this->wallet->find($attributes['payer']);
        $payerCurrentBalance = $payerWallet->current_balance;

        if ($value > $payerCurrentBalance) {
            throw new ModelNotFoundException("You're trying to transfer more cash than you have");
        } else if (($payerCurrentBalance - $value) < 0) {
            throw new ModelNotFoundException("You're trying to transfer negative cash");
        }

        $payeeWallet = $this->wallet->find($attributes['payee']);
        $payeeCurrentBalance = $payeeWallet->current_balance;

        $payerWallet->current_balance = ($payerCurrentBalance - $value);
        $payeeWallet->current_balance = ($payeeCurrentBalance + $value);

        $response = Http::get($this->urlTransaction);
        if ($response->failed()) {
            $data = $attributes;
            $data['status'] = 'rejected';
            Transfer::create($data);
            throw new ModelNotFoundException("Transaction denied");
        }

        $payerWallet->save();
        $payeeWallet->save();
        $data = $attributes;
        $data['status'] = 'approved';
        return Transfer::create($data);
    }
}
