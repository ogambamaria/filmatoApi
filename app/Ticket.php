<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'email', 'movie', 'date', 'time', 'cinema', 'seats'
    ];

    public function users(){
        return $this->belongsTo('App\User');
    }
}