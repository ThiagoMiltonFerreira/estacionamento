<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class veiculos extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'placa',
        'tipoId',
        'patioId',
        'horaEntrada',
        'horaSaida',
        'valorTotal'
        
    

    ];

}
