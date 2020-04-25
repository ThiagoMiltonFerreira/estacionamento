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

        $lastIdPatio = $modelPatio->max('id');
        $patio = $modelPatio->find($lastIdPatio);
        $update = $patio->where('data','=',$dateAtual)->whereNull('dataFinal')->update(['dataFinal'=>$dateAtual]);
        Auth::logout();
        return redirect()->route('login');
    }
}
