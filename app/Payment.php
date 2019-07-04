<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'phone', 'amount'
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }
}