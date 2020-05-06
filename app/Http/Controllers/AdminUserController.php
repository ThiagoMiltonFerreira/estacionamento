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
    private $data;

    public function __construct(AdminUser $adminUser, User $user)
    {
        $this->adminUser = $adminUser;
        $this->user = $user;
        $this->setData($user->select('users.name')->orderBy('users.name', 'asc')->get());
    }
    public function getData()
    {
        return $this->data;
    }
    public function setData($data)
    {
        $this->data = $data;
    }
    public function index()
    {
        $usersName = $this->getData();
        $usersTipo =  $this->adminUser->all(); 
        return view('user', compact('usersName','usersTipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = $this->user->select('users.idTipoAdminUser','users.id','users.name','users.email','admin_users.name as tipo','admin_users.tela_entrada_saida_veiculo','admin_users.tela_usuario',
        'admin_users.tela_veiculo_caixa','admin_users.tela_tabela_preco','admin_users.tela_cadastrar_tipo_veiculo')
                                ->join('admin_users','users.idTipoAdminUser','=','admin_users.id')
                                ->where('users.name','=',$request->users)
                                ->orderBy('users.name', 'asc')
                                ->get();


        $usersTipo =  $this->adminUser->all();                           
        //dd($users);
        $usersName = $this->getData();
    
        return view('user',compact('usersName','users','usersTipo'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        return 'salvar novo usuario';

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
        //dd($request->all());
        return 'update';
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
