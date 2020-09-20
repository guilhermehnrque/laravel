<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'tranfers';

    protected $fillable = [
        'value', 'status', 'payer', 'payee'
    ];

    public function walletPayer()
    {
        return $this->belongsTo('App\Models\Wallet', 'payer', 'id');
    }

    public function walletPayee()
    {
        return $this->belongsTo('App\Models\Wallet', 'payee', 'id');
    }
}
