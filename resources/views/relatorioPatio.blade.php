{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')  

@section('title', 'Veiculos\Caixa')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
    .align-div{

    text-align: center;

    }   
    </style>


@section('js')
    <!--<script> console.log('Hi!'); </script>   -->
@stop

@section('content_header')
    <h1 align="center">Relatório de veiculos</h1>
@stop

@section('content')

@if(!isset($acess))
<div>
    <form method="post" action="{{ route('relPatio')}}">
        @csrf
        <div>
            Data Inicial : <input type="datetime-local" name="dtInicial">
            Data Final : <input type="datetime-local" name="dtFinal">
        </div>
        <br>
        <button class="btn btn-primary">Pesquisar</button>
        <button type="button" class="btn btn-info" onclick="window.print()">Imprimir relatório</button>
    </form>
</div>


<hr>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <!-- <th scope="col">Veiculo</th> -->
      <th scope="col">Placa</th>
      <th scope="col">Tipo</th>
      <th scope="col">Patio</th>
      <th scope="col">Hora Entrada</th>
      <th scope="col">Hora Saida</th>
      <th scope="col">Valor pagamento</th>
    </tr>
  </thead>

  <tbody>
    @if(isset($data))
        @foreach($data as $veiculo)
        <!-- @if(isset($veiculo->id)) -->
                <tr>
                    
                    <!-- <th scope="row">#</th> -->
                    <td>{{$veiculo->placa}}</td>
                    <td>{{$veiculo->tamanho}}</td>
                    <td>{{$veiculo->patioId}}</td>
                    <td>{{$veiculo->horaEntrada}}</td>
                    <td>{{$veiculo->horaSaida}}</td>
                    <td>{{'R$ '.number_format($veiculo->valorTotal, 2, ',', '.')}}</td>
                    
                </tr> 
            <!--    @endif       -->
        
        @endforeach  
        
    @endif    
                <tr>
                    <td><b>Valor Total:</b></td> <td>{{isset($data["valorSoma"]) ? 'R$ '.number_format($data["valorSoma"], 2, ',', '.') : '-'}}</td>
                </tr>
  </tbody>
</table>
@else

  @include('acessoNegado')

@endif

@stop










