<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\tipo;
use App\preco;

class AdminTbPrecoController extends Controller
{

    private $data;
    private $error;
    private $sucess;
    private $valida = [
        'vlUmaHora' => 'required|numeric|min:0|max:100',
        'vlDuasHoras'=>'required|numeric|min:0|max:100',
        'vlTresHoras'=>'required|numeric|min:0|max:100',
        'vlQuatroHoras'=>'required|numeric|min:0|max:100',
        'vlDiaria'=>'required|numeric|min:0|max:100',
        'vlQuinzeMin'=>'required|numeric|min:0|max:100',
        'vlTrintaMin'=>'required|numeric|min:0|max:100',
        'vlSessentaMin'=>'required|numeric|min:0|max:100'
    ];

    public function tipoVeiculoCadastro()
    {
        $tpVeiculo = new tipo;
        try {
            $tipoVeiculoCadastro = $tpVeiculo->select('tipos.id as id','tipos.tamanho as tamanho')
                                            ->leftjoin('preco','tipos.id','=','preco.tipoid')
                                            ->where('tipos.ativo','=',1)
                                            ->whereNull('preco.tipoId')->get();  
        } catch (\Throwable $th) {
            die('Erro ao carregar tipos de veiculos Tela Cadastrar');
        }
  
        return $tipoVeiculoCadastro;                             
    }
    public function tipoVeiculoVisualizar()
    {
        $tpVeiculo = new tipo;
        try {
            $tipoVeiculoVisualizar = $tpVeiculo->select('tipos.id as id','tipos.tamanho as tamanho')
                                                ->leftjoin('preco','tipos.id','=','preco.tipoid')
                                                ->whereNotNull('preco.tipoId')->get();  
        } catch (\Throwable $th) {
            die('Erro ao carregar tipos de veiculos Tela Visualizar');
        }

                                
        return $tipoVeiculoVisualizar;                         
    }

    public function getData()
    {
        return $this->data;
    }
    public function setData($data)
    {
        $this->data=$data;
    }
    public function getError()
    {
        return $this->error;
    }
    public function setError($data)
    {
        $this->error=$data;
    }
    public function getSucess()
    {
        return $this->sucess;
    }
    public function setSucess($data)
    {
        $this->sucess=$data;
    }

    
    public function index(tipo $tpVeiculo)
    {

        $tipoVeiculoCadastro = $this->tipoVeiculoCadastro(); 
        $tipoVeiculoVisualizar = $this->tipoVeiculoVisualizar();

        return view('tabelaDePreco',compact("tipoVeiculoCadastro"),compact("tipoVeiculoVisualizar"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(tipo $tpVeiculo)
    {
        
        try {
            $data = $tpVeiculo->where('preco.tipoId','=',$_GET['tipoId'])->join('preco','tipos.id','=','preco.tipoid')->get();
        } catch (\Throwable $th) {
            die('Erro ao Pesquisar Veiculo'.$th->getMessage());
        }
        $tipoVeiculoCadastro = $this->tipoVeiculoCadastro(); 
        $tipoVeiculoVisualizar = $this->tipoVeiculoVisualizar();

        return view('tabelaDePreco',compact("tipoVeiculoCadastro","tipoVeiculoVisualizar","data"));                                    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, preco $preco)
    {
        $validate = $this->validate($request, $this->valida);
        $data = $request->all();
        try {
            $preco->create($data);
            $this->setSucess('Tabela de Preços cadastrada com sucesso!');
            $sucess = $this->getSucess();
            return redirect()->route('tbPreco.index',compact('sucess'));     
        } catch (\Throwable $th) {
            $this->setError($th->getMessage());
            $error = $this->getError();
            return redirect()->route('tbPreco.index',compact('error'));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(preco $preco, Request $request, $id)
    {
        try {
            $validate = $this->validate($request, $this->valida);
        } catch (\Throwable $th) {
            return redirect()->route('tbPreco.index');
        }                             
        $data = $request->all();
        try {
            $update = $preco->find($id)->update($data);
            $this->setSucess("Tabela de cobrança atualizada com sucesso!");
        } catch (\Throwable $th) {
            $this->setError("Erro ao Atualizar tabela de cobrança, ".$th->getMessage());
        }   
        $error = $this->getError();
        $sucess = $this->getSucess();
        return redirect()->route('tbPreco.index',$error!=NULL?compact('error'):compact('sucess'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showAll(tipo $tpVeiculo)
    {
      
        $tipoVeiculoCadastro = $this->tipoVeiculoCadastro(); 
        $tipoVeiculoVisualizar = $this->tipoVeiculoVisualizar();
        try {
           
            $data = $tpVeiculo->select('preco.id as id','tipos.tamanho as tamanho','preco.vlUmaHora','preco.vlDuasHoras','preco.vlTresHoras','preco.vlQuatroHoras','preco.vlDiaria','preco.vlQuinzeMin','preco.vlTrintaMin','preco.vlSessentaMin')
                                                ->join('preco','tipos.id','=','preco.tipoid')
                                                ->get();  
        } catch (\Throwable $th) {
            die('Erro ao carregar tabelas de preco'.$th->getMessage());
        }
        
        return view('tabelaDePreco',compact("tipoVeiculoCadastro","data","tipoVeiculoVisualizar"));

    }

}
