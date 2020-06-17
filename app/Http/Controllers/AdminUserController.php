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
    private $errorOrSucess;

    public function __construct(AdminUser $adminUser, User $user)
    {
        $this->adminUser = $adminUser;
        $this->user = $user;
        $dataUser;
        try {

            $dataUser = $user->select('users.name')->orderBy('users.name', 'asc')->get();

        } catch (\Throwable $th) {
            // die() para a execução apos exibir o erro
            die("codigo 1000 | Erro ao Carregar nomes de Usuarios - ".$th->getMessage());

        }

        $this->setData($dataUser);


        //$this->setData($user->select('users.name')->orderBy('users.name', 'asc')->get());
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
        
        session_start();
        $dataSession = (array)$_SESSION["dataUser"];

        //var_dump($dataSession["tela_usuario"]);
        //exit;
   
        if($dataSession["tela_usuario"]===null)
        {
            //echo"Ops, voce nao pode acessar. Entre em contato com seu usuário administrador ! ";
            $acess = false;
            return view('user',compact('acess'));
            exit;
        }
    
        $usersName = $this->getData();
        $usersTipo;
        try {
            $usersTipo = $this->adminUser->all();
            
        } catch (\Throwable $th) {
             // die() para a execução apos exibir o erro
             die("codigo 1001 | Erro ao Carregar Tipos de usuarios - ".$th->getMessage());
        }
        
        $errorOrSucess = $this->errorOrSucess;
        return view('user', compact('usersName','usersTipo','errorOrSucess'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users;

        try {
           
            $users = $this->user->select('users.idTipoAdminUser','users.id','users.name','users.email','admin_users.name as tipo','admin_users.tela_entrada_saida_veiculo','admin_users.tela_usuario',
            'admin_users.tela_veiculo_caixa','admin_users.tela_tabela_preco','admin_users.tela_cadastrar_tipo_veiculo')
                                    ->join('admin_users','users.idTipoAdminUser','=','admin_users.id')
                                    ->where('users.name','=',$request->users)
                                    ->orderBy('users.name', 'asc')
                                    ->get();
        } catch (\Throwable $th) {
            // die() para a execução apos exibir o erro
            die("<h1>codigo 1002 | Erro ao Carregar dados completos do usuario </h1> - ".$th->getMessage());
        }
       
        try {
            $usersTipo = $this->adminUser->all();
            
        } catch (\Throwable $th) {
             // die() para a execução apos exibir o erro
             die("codigo 1006 | Erro ao Carregar Tipos de usuarios - ".$th->getMessage());
        }

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
        $data = $request->all();
        $sucess;
        $error;
        $data["idTipoAdminUser"] = (int)$data["idTipoAdminUser"];
        $userFind;
        try {
            $userFind = $this->user->where("name",$data["name"])->get();
        } catch (\Throwable $th) {
            die('<h1>codigo 1003 | Erro ao pesquisar Usuario </h1> - '. $th->getMessage());
        }    
            if(isset($userFind[0]))
            {
                $error = "Usuario nao Cadastrado, usuario ".$data['name']. " ja exite !"; 
            }
            else
            {
                $data['password'] = bcrypt($data['password']);
                try {
                    $user = $this->user->create($data);
                    if($user)
                    {
                        $sucess = "Usuario $user->name Cadastrado";   
                    }
                } catch (\Throwable $th) {
                    $error = "codigo 1004 | Usuario nao cadastrado, Falha ao cadastrar usuario</h1> - ".$th->getMessage();
                }
       
       

        }
        
        return  redirect()->route('user.index',compact('sucess','error'));
      

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
        $data = $request->all();
        $sucess;
        $error;
        $updateUser;
        if($data['password']==null)
        {
            unset($data['password']);
        }
        else
        {
            $data['password'] = bcrypt($data['password']);
        }
       
        try {

            $updateUser = $this->user->find($id)->update($data);

            if($updateUser)
            {               
                $sucess = "Usuario ".$data['name']." Atualizado";
            }
        } catch (\Throwable $th) {
            $error = "Codigo 1005 | Erro ao atualizar o usuario ".$data['name']."! O e-mail informado ja esta sendo ultilizado - ".$th->getMessage();
        }      
        
        return  redirect()->route('user.index',compact('sucess','error'));
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
