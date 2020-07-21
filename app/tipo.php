<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo extends Model
{
    	
   //protected $table = 'tipos';
    public $timestamps = false;
    protected $fillable = [
        'tamanho',
        'ativo',
    
    ];
}
