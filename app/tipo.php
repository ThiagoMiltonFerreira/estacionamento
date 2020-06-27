<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tamanho',
        'ativo',
    
    ];
}
