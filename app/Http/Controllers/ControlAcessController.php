<?php

namespace App\Http\Controllers;
use App\AdminUser;
use App\Http\Controllers\ControllerValidatesRequests; // classe validadora de request do form
use Illuminate\Http\Request;


class ControlAcessController extends Controller
{

    private $tipoAdminUser;
    private $data;
    public function __construct(AdminUser $modelTipoAdminUser)  
    {
        $this->tipoAdminUser = $modelTipoAdminUser;
       // $this->setData($veiculo->all());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30'
        ]);

        //dd($request->all());
        $data = $request->all();
        //dd($data);
        try {
            $this->tipoAdminUser->create($data);
            $sucess = "Permissao de acesso Cadastrada.";
            
        } catch (\Throwable $th) {
            $error = "Codigo 2000 |Erro ao cadastrar nova permissao de acesso, ".$th->getMessage(); 
        }

        return  redirect()->route('user.index',compact('sucess','error'));
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
        //
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
        //
    }
}
