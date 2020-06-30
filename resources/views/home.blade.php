{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')  

@section('title', 'Inicio')

@section('css')
<style>
    .input{
      padding-right:10px;
    }
    .border{
      
    width:90%;
    height:90%;
    margin-left:40px;
    border-width:10px;
    padding-left:50px;
    padding-top:15px;
    border-image:url(border.png) 30 30 repeat;
    -moz-border-image:url(border.png) 30 30 repeat; /* Firefox */
    -webkit-border-image:url(border.png) 30 30 repeat; /* Safari e Chrome */
    -o-border-image:url(border.png) 30 30 repeat; /* Opera */
    }

  .align-div{

    text-align: center;

  }
  #btn-novo-usuario{

      margin-top:-66px;
      margin-left:90px;

  }
  #margin-border{

      display:block;
      padding:50px;
  }
  #align-text-center{

      text-align:center;
      
  }

</style> 

@stop

@section('js')
  <!-- Script para mascara do input  - mascara personalizada data-mask='aaa0000'  -->
  <script src="https://bossanova.uk/jsuites/v2/jsuites.js"></script>
  <link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css" />

  <script>

  $(document).ready(function(){

      $('#myModal').modal('show');
    
  });
  function cont(){
    var conteudo = document.getElementById('print').innerHTML;
    tela_impressao = window.open('about:blank');
    tela_impressao.document.write(conteudo);
    tela_impressao.window.print();
    tela_impressao.window.close();
  }
  </script>
@stop
@section('content_header')
        <h1 id="align-text-center">Entrada de Veiculos</h1>

@stop
@if(!isset($acess))

    @section('content')
      @if(isset($veiculo)) 
        <div class="container mt-3">
          <!-- The Modal -->
          <div class="modal fade" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">

                <div id="print" class="conteudo">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Saída de Veiculos - Sistema Estapark</h4>
                  </div>
                  
                  <!-- Modal body -->
                  
                      <div class="modal-body">

                        <p>Identificador: {{$veiculo->id}}</p>
                        <p>Patio: {{$veiculo->patioId}}</p>
                        <p>Placa: {{$veiculo->placa}}</p>
                        <p>Hora entrada: {{$veiculo->horaEntrada}}</p>
                        <p>Hora Saida: {{$veiculo->horaSaida}}</p>
                        <p>Valor a pagar: {{'R$ '.number_format($veiculo->valorTotal, 2, ',', '.')}} </p>
                      
                      </div>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                  <!--<button type="button" class="btn btn-info" onclick="window.print()">Imprimir</button>-->
                  <input type="button" class="btn btn-info" onclick="cont();" value="Imprimir">
                </div>
                
              </div>   
            </div>
          </div>
        </div>    
      @endif

      <div class="border">  
        <form method="post" action="{{ route('veiculo.store')}}">
          @csrf     
          <input type="hidden" class="form-control" name="patioId" value="{{$patioId}}">
          <div class="row">
            <div class="input">
              <label for="lblPlaca">Placa:</label>
              <input type="text" class="form-control" name="placa" aria-describedby="placa" placeholder="Exemplo: NHS7900" data-mask='aaa0000' required>
            </div>
            <div class="input">
              <label for="lblPlaca">Tipo:</label>
              <div class="input-group mb-3">
                <select class="custom-select" id="inputGroupSelect01" name="tipoId" required>
                <option></option>
                  @foreach($tiposVeiculo as $tipo)
                    <option value="1">{{$tipo->tamanho}}</option>
                  @endforeach
                </select> 
                &nbsp;
                &nbsp;   
                &nbsp;                 
                <button class="btn btn-primary">Adicionar ao Patio</button>
              </div> 
            </div>
          </div>    
        </form>
      </div>
      
      <!--

      ************ Form versao anterior ******************

      <form method="post" action="{{ route('veiculo.store')}}">
          @csrf   

          <input type="hidden" class="form-control" name="patioId" value="{{$patioId}}">
          <div class="form-group">
              <label for="lblPlaca">Placa:</label>
              <input type="text" class="form-control" name="placa" aria-describedby="placa" placeholder="Exemplo: NHS7900" data-mask='aaa0000' required>
              <small id="emailHelp" class="form-text text-muted">Digite a placa do veiculo.</small>
          </div>

          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Tipo de veiculo</label>
              </div>
                  <select class="custom-select" id="inputGroupSelect01" name="tipoId" required>
                      <option selected valule="">  </option>
                      <option value="1">Pequeno</option>
                      <option value="2">Medio</option>
                      <option value="3">Grande</option>
                      <option value="4">Moto</option>
                  </select>
          </div>
          <button class="btn btn-primary">Adicionar ao Patio</button>

      </form>


      -->

      <hr>

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Veiculo</th>
            <th scope="col">Placa</th>
            <th scope="col">Tipo</th>
            <th scope="col">Hora Entrada</th>
            <th scope="col"></th>
          </tr>
        </thead>

        <tbody>
          @foreach($patio as $value)
            <tr>
              <th scope="row">{{$value->id}}</th>
              <td>{{$value->placa}}</td>
              <td>{{$value->tamanho}}</td>
              <td>{{$value->horaEntrada}}</td>
              <td>
                <form action="{{ route('veiculo.update',$value->id) }}" method="POST"> <!-- usar form como method field para DELETE PUTH OU PATH, pos nao exite action delete tem que forçar um iput com {!! method_field('delete') !!}  -->
                    {!! method_field('put') !!}
                    @csrf
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Confirma a saida deste veiculo?')">Registrar saida</button>

                </form>
              </td>
            </tr>    
          @endforeach
        </tbody>
      </table>
@stop
@else
  @section('content')
  
    @include('acessoNegado')

  @stop
@endif









