<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\patio;
use App\veiculos;
use App\Http\Controllers\VeiculoController;
use DateTime;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PatioController $patios,patio $modelPatio,veiculos $veiculos,VeiculoController $veiculoController,$idVeiculo = null)
    {

        date_default_timezone_set('America/Sao_Paulo');
        $dateAtual = date("Y-m-d");
        //var_dump($dateAtual);
        //exit;

        $lastIdPatio = $modelPatio->max('id');
        $patio = $modelPatio->find($lastIdPatio);
        $patioId;

        $dateAtual = new DateTime( $dateAtual );
        $dateInicioPatio = new DateTime( date('Y-m-d', strtotime($patio->data)) );

  
        $dtString= (array)$dateAtual;
       //var_dump(substr($dtString['date'],0,10 ));
        //var_dump($patio->data===substr($dtString['date'],0,10 ) && $patio->dataFinal === substr($dateAtual->date,0,10 ));
        //var_dump($dtString['date']);
        
        //exit;


        if($dateAtual>$dateInicioPatio && $patio->dataFinal == null)
        {
            
            $update = $patio->update(['dataFinal' => substr($dtString['date'],0,10 )]);

            if($update)
            {
                //echo "Update na data final, agora tenho que criar um novo patio";
                try {
                        $createPatio = $modelPatio->create(['data'=>substr($dtString['date'],0,10 )]);    
                        $patioId = $createPatio->id;
            
                } catch  (ModelNotFoundException $exception) {

                    return back()->withError($exception->getMessage())->withInput();
                }
                
            }
            else
            {
                echo "<script>alert('Erro ao Finalizar patio do dia anterior!') </script>";
            }


        }
        else if ($dateAtual>$dateInicioPatio && $patio->dataFinal != null)
        {
            $createPatio = $modelPatio->create(['data'=>substr($dtString['date'],0,10 )]);    
            $patioId = $createPatio->id;

        }
        else if($patio->data===substr($dtString['date'],0,10 ) && $patio->dataFinal === substr($dateAtual->date,0,10 ))
        {
            $createPatio = $modelPatio->create(['data'=>substr($dtString['date'],0,10 )]);    
            $patioId = $createPatio->id;
        }
        else
        {
            
            $patioId = $patio->id;
           
        }

        if($idVeiculo!=null)
        {

            $veiculo = $veiculos->find($idVeiculo);

    
        }
   
        $patio = $veiculos->select('veiculos.id','veiculos.placa','tipos.tamanho','veiculos.patioId','veiculos.horaEntrada','veiculos.horaSaida')
                                                                                                    
                                                                                ->whereNull('horaSaida')
                                                                                ->join('tipos', 'tipos.id', '=', 'veiculos.tipoId')
                                                                                ->get(); // Pagar os campos especificados  os veiculos onde horaSaida e nulo e unir com a tabela tipos onde 'tipos.id', '=', 'veiculos.tipoId'
        //var_dump($patio);
        //exit;
        return view('home',compact('patio','patioId',isset($veiculo)?'veiculo':''));


        // Criar encerramneto do patio insert no patio dataFInal
  
    }
}
