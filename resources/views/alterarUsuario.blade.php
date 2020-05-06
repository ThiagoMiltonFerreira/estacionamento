<div class="border" id="margin-border">

    @if(!isset($users))
        <h4 id="align-text-center">Pesquisar usuario. </h4>
        <form action="{{ route('user.create') }}" method="GET">
            @csrf
            <div class="form-group row">
                                    
                        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                        <select class="custom-select" id="inputGroupSelect01" name="users" required>
                        <option selected value=""></option>
                        @foreach($usersName as $value)
                            <option value="{{$value->name}}">{{$value->name}}</option>
                        @endforeach    
                        </select>
                    </div>    
            </div>
            <div class="align-div">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>                    

    @else


    @foreach($users as $user)
        <form method="post" action="{{ route('user.update',$user->id) }}">
        @method('PUT')
        @csrf  

            
            <h4 id="align-text-center">Detalhes de Usuario. </h4>
            <div class="form-group row">
                <label for="staticId" class="col-sm-2 col-form-label">Identificador</label>
                <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$user->id ?? '#'}}" name="id" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" value="{{$user->name ?? '#'}}" name="name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-10">
                <input type="email" class="form-control" value="{{$user->email ?? '#'}}" name="email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" >
                </div>
            </div>       
            <div class="input-group mb-3">
                <label for="nome" class="col-sm-2 col-form-label">Tipo de acesso</label>       
                <select class="custom-select" id="inputGroupSelect01" name="idTipoAdminUser" required>
                    @foreach($usersTipo as $tipoUser)
                    <option value="{{ $user->tipo == $tipoUser->name ? $user->idTipoAdminUser : $tipoUser->id }}" {{$user->tipo==$tipoUser->name?'selected':''}}> {{$tipoUser->name}} </option>
                    @endforeach
                    
                </select>
            </div>


            <div class="align-div">
                <h4 id="align-text-center">Permissões</h4></br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" disabled type="checkbox" id="inlineCheckbox1" value="tela_entrada_saida_veiculo" {{$user->tela_entrada_saida_veiculo==1?'checked':''}}>
                    <label class="form-check-label" for="inlineCheckbox1" >Entrada e saida de veiculos</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" disabled type="checkbox" id="inlineCheckbox1" value="tela_usuario" {{$user->tela_usuario==1?'checked':''}}>
                    <label class="form-check-label" for="inlineCheckbox1" >Usuarios</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" disabled type="checkbox" id="inlineCheckbox1" value="tela_veiculo_caixa" {{$user->tela_veiculo_caixa==1?'checked':''}}>
                    <label class="form-check-label" for="inlineCheckbox1" >Relatorio de veiculos e caixa</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" disabled type="checkbox" id="inlineCheckbox1" value="tela_tabela_preco" {{$user->tela_tabela_preco==1?'checked':''}}>
                    <label class="form-check-label" for="inlineCheckbox1" >Tabelas de preços</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" disabled type="checkbox" id="inlineCheckbox1" value="tela_tabela_preco"  {{$user->tela_cadastrar_tipo_veiculo==1?'checked':''}}>
                    <label class="form-check-label" for="inlineCheckbox1" >Tipos de veiculos</label>
                </div>

    @endforeach
                <br>
                <br>
                    <div class="align-div">
                        <button type="submit" class="btn btn-info">Salvar</button>    
                    </div>
            </div>
        </form>
@endif
