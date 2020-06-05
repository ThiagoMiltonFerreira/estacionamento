<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\patio;
use App\veiculos;
use App\User;
use App\Http\Controllers\VeiculoController;
use DateTime;
use Auth;


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
    public function index(PatioController $patios,patio $modelPatio,veiculos $veiculos,VeiculoController $veiculoController,User $user,$idVeiculo = null)
    {    
        //dd(Auth::user()->idTipoAdminUser);
        session_start();

        $dataUser = $user->select('users.idTipoAdminUser','users.id','users.name','users.email','admin_users.name as tipo','admin_users.tela_entrada_saida_veiculo','admin_users.tela_usuario',
        'admin_users.tela_veiculo_caixa','admin_users.tela_tabela_preco','admin_users.tela_cadastrar_tipo_veiculo')
                                ->join('admin_users','users.idTipoAdminUser','=','admin_users.id')
                                ->where('users.idTipoAdminUser','=',Auth::user()->idTipoAdminUser)
                                ->orderBy('users.name', 'asc')
                                ->get();

        $_SESSION['dataUser'] = json_decode($dataUser[0]);
        $dataSession = (array)$_SESSION["dataUser"];
        //var_dump($dataSession);
        //exit;
        if($dataSession['tela_entrada_saida_veiculo'] === 0 )
        {
            $acess = false;
            return view('home',compact('acess'));
            //echo"nao tem permissao.";
            //var_dump($dataSession);
            //exit;
        }

        date_default_timezone_set('America/Sao_Paulo');
        $dateAtual = date("Y-m-d");
        //var_dump($dateAtual);
        //exit;
        try {
            $lastIdPatio = $modelPatio->max('id');
        } catch (\Throwable $th) {
            die("codigo 3000 | Erro ao carregar maior id </h1> - ".$th->getMessage());
        }
        try {
            $patio = $modelPatio->find($lastIdPatio);
        } catch (\Throwable $th) {
            die("codigo 3001 | Erro ao pesquisar patio por id </h1> - ".$th->getMessage());
        }
        
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
            try {
                $createPatio = $modelPatio->create(['data'=>substr($dtString['date'],0,10 )]);    
                $patioId = $createPatio->id;
                
            } catch (\Throwable $th) {
                die("codigo 3002 | Erro ao Criar Patio </h1> - ".$th->getMessage());
            }
            

        }
        else if($patio->data===substr($dtString['date'],0,10 ) && $patio->dataFinal === substr($dateAtual->date,0,10 ))
        {
            try {
                $createPatio = $modelPatio->create(['data'=>substr($dtString['date'],0,10 )]);    
                $patioId = $createPatio->id;
            } catch (\Throwable $th) {
                die("codigo 3003 | Erro ao Criar Patio </h1> - ".$th->getMessage());
            }

        }
        else
        {
            
            $patioId = $patio->id;
           
        }

        if($idVeiculo!=null)
        {

            $veiculo = $veiculos->find($idVeiculo);

    
        }
   
        try {
            $patio = $veiculos->select('veiculos.id','veiculos.placa','tipos.tamanho','veiculos.patioId','veiculos.horaEntrada','veiculos.horaSaida')
                                                                                                    
            ->whereNull('horaSaida')
            ->join('tipos', 'tipos.id', '=', 'veiculos.tipoId')
            ->get(); // Pagar os campos especificados  os veiculos onde horaSaida e nulo e unir com a tabela tipos onde 'tipos.id', '=', 'veiculos.tipoId'
        } catch (\Throwable $th) {
            die("codigo 3004 | Erro ao Carregar veiculos no Patio </h1> - ".$th->getMessage());
        }
       
        //var_dump($patio);
        //exit;
        return view('home',compact('patio','patioId',isset($veiculo)?'veiculo':''));


        // Criar encerramneto do patio insert no patio dataFInal
  
    }
}
