<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'tranfers';

    protected $fillable = [
       'value', 'status'
    ];
 
    public function user(){
        return $this->belongsTo('App\Models\Users', 'user_id', 'id')
    }
}
