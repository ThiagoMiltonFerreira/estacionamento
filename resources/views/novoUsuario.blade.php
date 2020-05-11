<div class="border" id="margin-border">
    
    <h4 id="align-text-center">Cadastrar Novo Usuario </h4>
    @if(isset($_GET['sucess']))
        <div class="alert alert-info" role="alert">
                {{$_GET['sucess']}}
        </div>
    @elseif(isset($_GET['error']))
        <div class="alert alert-danger" role="alert">
                {{$_GET['error']}}
        </div>
    @endif

    <form method="POST" action="{{ route('user.store') }}">
     
        @csrf  
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="name" placeholder="Nome" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-10">
                <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
                </div>
            </div>       
            <div class="input-group mb-3">
                <label for="nome" class="col-sm-2 col-form-label">Tipo de acesso</label>       
                <select class="custom-select" id="inputGroupSelect01" name="idTipoAdminUser" required>
                    @foreach($usersTipo as $tipoUser)
                    <option value="{{$tipoUser->id}}"> {{$tipoUser->name}} </option>
                    @endforeach
                    
                </select>
            </div>
            <div class="align-div">
                <button type="submit" class="btn btn-info" >Salvar</button>
            </div>
    </form>         
</div>

