<?php

namespace App\Http\Controllers;
use App\patio;

use Illuminate\Http\Request;

class exitPatio extends Controller
{
    public function exit(patio $modelPatio,Request $request)
    {
        
        date_default_timezone_set('America/Sao_Paulo');
        $dateAtual = date("Y-m-d");
        //var_dump($dateAtual);
        //exit;
        $lastIdPatio = $modelPatio->max('id');
        $patio = $modelPatio->find($lastIdPatio);
        $update = $patio->where('data','=',$dateAtual)->whereNull('dataFinal')->update(['dataFinal'=>$dateAtual]);
        $value = $request->session()->all();

        //var_dump($_COOKIE);
        //var_dump($value);
        //["PHPSESSID"]
        //unset($_COOKIE["PHPSESSID"]);

        //exit;

        //return redirect()->route('login');
    }
}
