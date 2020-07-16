{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')  

@section('title', 'Tabela de preços')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
    .align-div{

        text-align: center;

    }  

    .align-btn-visualizar{
        display:block;
        text-align: center;
        margin-left:300px;
        margin-top:-54px;
    }

    .alignTitle{
        text-align: center;
    }
    .align-btn-visualizar{
        display:block;
        text-align: center;
        margin-left:300px;
        margin-top:-54px;
    }

    #margin-border{

        display:block;
        padding-top:20px;
        padding-left:80px;
        padding-right:80px;
        align:center;
    
    }
    </style>


@section('js')
    <!--<script> console.log('Hi!'); </script>   -->
@stop

@section('content_header')
    <h1 align="center">Tabelas de preços</h1>

@stop

@section('content')
    @if(!isset($acess)) 
    @if(isset($_GET['sucess']))
        <div class="alert alert-info" role="alert">
                {{$_GET['sucess']}}
        </div>
    @elseif(isset($_GET['error']))
        <div class="alert alert-danger" role="alert">
                {{$_GET['error']}}
        </div>
    @endif
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Cadastrar nova tabela de preços</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Visualizar/Editar tabelas de preços</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">@include('visualizarTabelaDePrecos')</div>

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"> @include('novaTabelaDePrecos') </div>

        </div>
    @else

        @include('acessoNegado')

    @endif    
@stop










