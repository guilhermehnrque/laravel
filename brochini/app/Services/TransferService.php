<?php

namespace App\Services;

use App\Repositories\TransferRepository;
use Illuminate\Http\Request;

class TransferService
{
    protected $transferRepository;

    public function __construct(TransferRepository $transferRepository)
    {
        $this->transferRepository = $transferRepository;
    }

    public function transfer(Request $request){
        return $this->transferRepository->transaction($request->all());
    }

}
