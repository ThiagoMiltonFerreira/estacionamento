<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patio extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'data',
        'dataFinal'
    

    ];
}
