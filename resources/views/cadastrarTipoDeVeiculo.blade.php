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
    #margin-border{

        display:block;
        padding-top:20px;
        padding-left:80px;
        align:center;
    
    }
    </style>


@section('js')
    <!--<script> console.log('Hi!'); </script>   -->
@stop

@section('content_header')
    <h1 align="center">Cadastrar tipo de veiculo</h1>
@stop

@section('content')
    @if(!isset($acess))
        <div class="alert alert-warning" role="alert">
            Ao cadastrar o novo tipo de veiculo, será nescessario vincular o mesmo a uma <a href="#">tabela de preço.</a>
        </div>
        @if(isset($_GET['error']))
            <div class="alert alert-danger" role="alert">
                    {{$_GET['error']}}
            </div>
        @endif
        <div class="border" id="margin-border">
        <form method="POST" action="{{ route('veiculoType.store') }}">
            
            @csrf  
                <div class="form-group row" id="margin-border">
                    <label for="nome" class="col-sm-2 col-form-label">Tipo:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Inserir o tipo de veiculo com base em sua tabela de cobraça." required>
                    </div>
                </div>
                <div class="align-div">
                    <button type="submit" class="btn btn-info" >Salvar</button>
                </div>
        </form>         
        <div>
    @else

        @include('acessoNegado')

    @endif    
@stop










