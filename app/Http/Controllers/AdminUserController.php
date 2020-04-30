<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminUser;
use App\User;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $adminUser;
    private $user;
    public function __construct(AdminUser $adminUser, User $user)
    {
        $this->adminUser = $adminUser;
        $this->user = $user;
    }
    public function index()
    {
        
        //$users = $this->user->all()->sortBy("name");

        $users = $this->user->select('users.name')->orderBy('users.name', 'asc')->get();
        //dd($users);
        return view('user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //var_dump($request->all());
        //exit;
        $users = $this->user->select('users.id','users.name','users.email','admin_users.name as tipo','admin_users.tela_entrada_saida_veiculo','admin_users.tela_usuario',
        'admin_users.tela_veiculo_caixa','admin_users.tela_tabela_preco','admin_users.tela_cadastrar_tipo_veiculo')
                                ->join('admin_users','users.idTipoAdminUser','=','admin_users.id')
                                ->where('users.name','=',$request->users)
                                ->orderBy('users.name', 'asc')
                                ->get();

        //dd($users);
        return view('user',compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
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
