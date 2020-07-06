<div class="border" id="margin-border">

    <h4 id="align-text-center">Visualizar/Editar  Tabelas de preços. </h4>
    <br>
    <form method="get" action="{{ route('tbPreco.create') }}">
                
        @csrf  
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Tipo de veiculo:</label>
            <select class="custom-select" name="tipoId" required>
                <option value="" selected> </option>
                @if(!isset($tipoVeiculo))

                    <option value="1">P</option>
                    <option value="1">M</option>

                @else

                    @foreach($tipoVeiculo as $tipo)
                    <option value="{{$tipo->id}}">{{$tipo->tamanho}}</option>
                    @endforeach
                    
                @endif    
            </select>
        </div>
        <div class="align-div">
            <button type="submit" class="btn btn-info" >Pesquisar</button>
            
        </div>
    </form>
    <div class="align-btn-visualizar">    
        <form method="POST" action="{{ route('tbPrecoAll') }}">
                    
            @csrf  
            <div class="align-div">
            
                <button type="submit" class="btn btn-primary" >Visualizar Todas</button>
                        
            </div>

        </form> 
    </div>

</div>
@if(isset($data))
    <table class="table">
    <thead class="thead-dark">
        <tr>

            <!-- <th scope="col">Veiculo</th> -->
            <th scope="col">Id</th>
            <th scope="col">Tipo de Veiculo</th>
            <th scope="col">1 Hora</th>
            <th scope="col">2 Horas</th>
            <th scope="col">3 Horas</th>
            <th scope="col">4 Horas</th>
            <th scope="col">Diaria</th>
            <th scope="col">15 minutos</th>
            <th scope="col">30 minutos</th>
            <th scope="col">60 minutos</th>
            <th scope="col"></th>

        </tr>
    </thead>

    <tbody>
        @if(isset($data))
            @foreach($data as $value)
            <form method="POST" action="route('tbPreco.update',{{$value->id}})">   
            @method('PUT')          
            @csrf
                <tr>

                    <td>
                        {{$value->id}}
                    </td>
                    <td>                      
                        <input type="text" class="form-control" value="{{$veiculo->tamanho}}" disabled="disabled" required>                       
                    </td>
                    <td>                      
                        <input type="mumber" class="form-control" name="vlUmaHora" value="{{$veiculo->vlUmaHora}}" step="0.01" min="0" max="100" required>                       
                    </td>
                    <td>
                        <input type="mumber" class="form-control" name="vlDuasHoras" value="{{$value->vlDuasHoras}}" step="0.01" min="0" max="100" required>                    
                    </td>
                    <td>
                        <input type="mumber" class="form-control" name="vlTresHoras" value="{{$value->vlTresHoras}}" step="0.01" min="0" max="100" required>
                    </td>
                    <td>
                        <input type="mumber" class="form-control" name="vlQuatroHoras" value="{{$value->vlQuatroHoras}}" step="0.01" min="0" max="100" required>    
                    </td>            
                    <td>
                        <input type="mumber" class="form-control" name="vlDiaria" value="{{$value->vlDiaria}}" step="0.01" min="0" max="100" required>
                    </td>
                    <td>
                        <input type="mumber" class="form-control" name="vlQuinzeMin" value="{{$value->vlQuinzeMin}}" step="0.01" min="0" max="100" required>
                    </td>
                    <td>
                        <input type="mumber" class="form-control" name="vlTrintaMin" value="{{$value->vlTrintaMin}}" step="0.01" min="0" max="100" required>
                    </td>
                    <td>
                        <input type="mumber" class="form-control" name="vlTrintaMin" value="{{$value->vlSessentaMin}}" step="0.01" min="0" max="100" required>
                    </td>
                    <td>
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Deseja realmente alterar estes dados?')">Alterar</button>
                    </td>
                </tr> 
       
            </form>
            @endforeach  
            
        @endif    
    </tbody>
    </table>
@endif
