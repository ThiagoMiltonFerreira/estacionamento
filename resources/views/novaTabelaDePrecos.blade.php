<div class="border" id="margin-border">
    
    <h4 id="align-text-center">Cadastrar Nova Tabela de preços. </h4>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="alert alert-warning" role="alert">
        Toda tabela de Preço deve ser obrigatoriamente vinculada a um tipo de veiculo, para que seja efetuada a cobrança.<br>
        Todo tipo de veiculo para ser cadastrado a uma nova tabela, deve esta com status ativo na pagina <a href="/admin/veiculoType">Cadastrar tipo de veiculo.</a>
    </div>

    <form method="POST" action="{{ route('tbPreco.store') }}">
     
        @csrf 
            <div class="input-group mb-3">
                <label for="nome" class="col-sm-2 col-form-label">Tipo de veiculo</label>       
                <select class="custom-select" id="inputGroupSelect01" name="tipoId" required>
                    <option value="" selected> </option>
                    @if(!isset($tipoVeiculoCadastro))

                        <option value="1">P</option>
                        <option value="1">M</option>

                    @else

                        @foreach($tipoVeiculoCadastro as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->tamanho}}</option>
                        @endforeach
                        
                    @endif    
                </select>
            </div>
            <hr>
            <h4 id="align-text-center">Valores a cada hora. </h4>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Valor 1 Hora</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="vlUmaHora" placeholder="Valor referente a 1 Hora de permanencia no patio." step="0.01" min="0" max="100" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Valor 2 Horas</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="vlDuasHoras" placeholder="Valor referente a 2 Horas de permanencia no patio." step="0.01" min="0" max="100" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Valor 3 Horas</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="vlTresHoras" placeholder="Valor referente a 3 Horas de permanencia no patio." step="0.01" min="0" max="100" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Valor 4 Horas</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="vlQuatroHoras" placeholder="Valor referente a 4 Horas de permanencia no patio." step="0.01" min="0" max="100" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Valor Diaria</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="vlDiaria" placeholder="Valor referente a Diaria (Acima de 4 horas)." step="0.01" min="0" max="100" required>
                </div>
            </div>
            <hr>
            <h4 id="align-text-center">Valores a cada 15 minutos. </h4>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Valor 15 minutos</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="vlQuinzeMin" placeholder="Valor referente a 15 minutos de permanencia no patio." step="0.01" min="0" max="100" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Valor 30 minutos</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="vlTrintaMin" placeholder="Valor referente a 30 minutos de permanencia no patio." step="0.01" min="0" max="100" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-2 col-form-label">Valor 60 minutos</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" name="vlSessentaMin" placeholder="Valor referente a 60 minutos de permanencia no patio." step="0.01" min="0" max="100" required>
                </div>
            </div>
            <div class="align-div">
                <button type="submit" class="btn btn-info" >Salvar</button>
            </div>

    </form>         
</div>

