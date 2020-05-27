<?php

namespace App\Http\Controllers;
use App\patio;
use Auth;

use Illuminate\Http\Request;

class exitPatio extends Controller
{  

    public function exit(patio $modelPatio)
    {
        
        date_default_timezone_set('America/Sao_Paulo');
        $dateAtual = date("Y-m-d");

        try {
            $lastIdPatio = $modelPatio->max('id');
            $patio = $modelPatio->find($lastIdPatio);
            $update = $patio->where('data','=',$dateAtual)->whereNull('dataFinal')->update(['dataFinal'=>$dateAtual]);
            
        } catch (\Throwable $th) {
            die("codigo 2000 | Erro ao finalizar patio </h1> - ".$th->getMessage());
        }
        
        Auth::logout();
        return redirect()->route('login');
    }
}
