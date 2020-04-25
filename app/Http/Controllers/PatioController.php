<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\veiculos;
use App\patio;

class PatioController extends Controller
{


    private $patio;
    private $data;

    public function __construct(patio $patio)  //(patio $patio) e o mesmo que $patio = new patio;
    {
        $this->patio = $patio;
        $this->setData($patio->all());
    }

    public function setData($data)
    {
        $this->data=$data;
    }

    public function getData()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $dateAtual = date("Y-m-d");
        return json_encode($this->data);
    }

    public function getPatioId($id)
    {
        $patioid = $this->patio->find($id);
        return $patioid;
    }
    public function getPatioDate($id)
    {
        $patioDate = $this->patio->where('id',$id);
        var_dump($patioDate);
        exit;
        //return $patioDate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VeiculoController $veiculos)
    {


        return "relatorio de patioController";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "cadastrar veiculo CREATE";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'cadastrar patio';
        /*
        $veiculos = new veiculos();
        $data = $request->all();
        $veiculos->create($data);
        return redirect()->route('home');
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "mostrar veiculo SHOW"; 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "Editar veiculo EDIT"; 
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "saida do veiculo  DESTROY $id"; 
    }
}
