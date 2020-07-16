<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class preco extends Model
{
    protected $table = 'preco';
    public $timestamps = false;
    protected $fillable = [
        'tipoId',
        'vlUmaHora',
        'vlDuasHoras',
        'vlTresHoras',
        'vlQuatroHoras',
        'vlDiaria',
        'vlQuinzeMin',
        'vlTrintaMin',
        'vlSessentaMin'
    

    ];
}
