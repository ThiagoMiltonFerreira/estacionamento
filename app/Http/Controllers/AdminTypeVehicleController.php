<?php
namespace App\Http\Controllers;
use App\tipo;
use App\Http\Controllers\ControllerValidatesRequests;


use Illuminate\Http\Request;

class AdminTypeVehicleController extends Controller
{

    private $tipo;
    public function __construct(tipo $modelTipo)  
    {
        $this->tipo = $modelTipo;

    }

    public function index()
    {
        session_start();
        $dataSession = (array)$_SESSION["dataUser"];
        if($dataSession['tela_entrada_saida_veiculo'] === 0 )
        { 
            $acess = false;
            return view('cadastrarTipoDeVeiculo',compact('acess'));
        }
        return view('cadastrarTipoDeVeiculo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sucess=null;
        $error=null;
        $this->validate($request, [
            'tamanho' => 'required|max:15'
        ]);

        $data = $request->all();
        try {
            $tipo = $this->tipo->create($data);
            if($tipo)
            {
                $sucess = "$tipo->tamanho Cadastrado com sucesso!";
                try {
                    $data = $this->tipo->all();
                    //dd($data);
                } catch (\Throwable $th) {  
                    $error = "codigo 5559 | Falha ao todos tipos de veiculos - ".$th->getMessage();
                    //return view('cadastrarTipoDeVeiculo',compact($error!=null?'error':'sucess'));
                }
                
                
            }
        } catch (\Throwable $th) {
            $data = $this->tipo->all();
            $error = "codigo 6000 | Falha ao cadastrar novo tipo de veiculo - ".$th->getMessage(); 
        }
       
        return view('cadastrarTipoDeVeiculo',compact('data',$error!=null?'error':'sucess'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('home');
        
    }
    public function showAll()
    {
        $sucess=null;
        $error=null;
        try {
            $data = $this->tipo->all();

        } catch (\Throwable $th) {
            $error = "codigo 6001 | Falha ao Carregar todos os tipos de veiculos - ".$th->getMessage();
        }
        
        return view('cadastrarTipoDeVeiculo',compact('data',$error!=null?'error':''));

        //return "Mostrar todos os tipos de veiculo";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();
        unset($data["_method"],$data["_token"]);

        foreach($data as $key=>$value)
        {   
            try {
                $update = $this->tipo->find((int)$key)->update(['ativo'=>(int)$value]);
            } catch (\Throwable $th) {
                die("codigo 8000 | Erro ao alterar status de tipo de veiculo - ".$th->getMessage());
            }       
           
        }

        return redirect()->route('veiculoType.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('home');
    }
}
