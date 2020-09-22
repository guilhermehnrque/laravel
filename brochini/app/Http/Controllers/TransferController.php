<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Requests\Transfer\TransferStoreRequest;
use Illuminate\Http\Request;

use App\Models\Transfer;
use App\Models\Wallet;

use App\Services\TransferService;
use App\Services\WalletService;

class TransferController extends Controller
{
    protected $walletService;
    protected $transferService;

    public function __construct(TransferService $transferService, WalletService $walletService)
    {
        $this->transferService = $transferService;
        $this->walletService = $walletService;
    }

    public function store(TransferStoreRequest $request)
    {
        $validated = $request->validated();

        $this->walletService->searchWallet($request, 'payer','Payer wallet invalid');
        $this->walletService->searchWallet($request, 'payee','Payee wallet invalid');
        $this->walletService->checkWalletLojista($request, 'payer');
        $response = $this->transferService->transfer($request);
        return response()->json(['message' => $response], 201);
    }
}
