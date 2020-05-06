<form method="post" action="{{ route('acess.store') }}">
     
     @csrf  
    <div class="border" id="margin-border">
        <h4 id="align-text-center">Nova Permissao de acesso. </h4>
        <div class="form-group row">
                    <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Nome da permissao de acesso ao sistema" required>
                    </div>
        </div>

        <div class="align-div">
                    <h4 id="align-text-center">Paginas com autorizadas.</h4></br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="tela_entrada_saida_veiculo" value="1">
                        <label class="form-check-label" for="inlineCheckbox1" >Entrada e saida de veiculos</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="tela_usuario" value="1">
                        <label class="form-check-label" for="inlineCheckbox1" >Usuarios</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="tela_veiculo_caixa" value="1">
                        <label class="form-check-label" for="inlineCheckbox1" >Relatorio de veiculos e caixa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="tela_tabela_preco" value="1">
                        <label class="form-check-label" for="inlineCheckbox1" >Tabelas de preços</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="tela_cadastrar_tipo_veiculo" value="1">
                        <label class="form-check-label" for="inlineCheckbox1" >Tipos de veiculos</label>
                    </div>

                    <br>
                    <br>
                        <div class="align-div">
                            <button type="submit" class="btn btn-info">Salvar</button>    
                        </div>
                </div>

    </div>            
</form>    