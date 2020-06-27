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
    <h1 align="center">Cadastrar tipo de veiculo</h1>
@stop

@section('content')
    @if(!isset($acess))
        <div class="alert alert-warning" role="alert">
            Ao cadastrar o novo tipo de veiculo, será nescessario vincular o mesmo a uma <a href="#">tabela de preço.</a>
        </div>
        @if(isset($error))
            <div class="alert alert-danger" role="alert">
                    {{$error}}
            </div>
        @endif
        @if(isset($sucess))
            <div class="alert alert-info" role="alert">
                    {{$sucess}}
            </div>
        @endif
        <div class="border" id="margin-border">
        <form method="POST" action="{{ route('veiculoType.store') }}">
            
            @csrf  
                <div class="form-group row">
                    <label for="nome" class="col-sm-2 col-form-label">Tipo:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="tamanho" placeholder="Inserir o tipo de veiculo com base em sua tabela de cobraça." required>
                    </div>
                </div>
                <div class="align-div">
                    <button type="submit" class="btn btn-info" >Salvar</button>
                    
                </div>

        </form> 
        <div class="align-btn-visualizar">
            <form method="post" action="{{ route('typeVeihicleAll') }}">            
                @csrf   
                <button type="submit" class="btn btn-primary" >Visualizar todos</button>
            </form>       
        </div>  
        <br>   
        <div>
        
        @if(isset($data))
        <form action="{{ route('veiculoType.update','1') }}" method="POST"> <!-- usar form como method field para DELETE PUTH OU PATH, pos nao exite action delete tem que forçar um iput com {!! method_field('delete') !!}  -->
                    @method('PUT')
                    @csrf
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Identificador</th>
                        <th scope="col">Tipo de veiculo</th>
                        <th scope="col">Ativado</th>
                        <th scope="col">Desativado</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($data as $value)
                        <tr>
                        <th scope="row">{{$value->id}}</th>
                        <td>{{$value->tamanho}}</td>  
                        <td>
                            <input class="form-check-input" type="radio" id="inlineCheckbox1" name="{{$value->id}}" value="1"  {{$value->ativo==1?'checked':''}}>
                        </td> 
                        <td>
                            <input class="form-check-input" type="radio" id="inlineCheckbox1" name="{{$value->id}}" value="0"  {{$value->ativo==0?'checked':''}}>
                        </td> 
                        </tr>    
                        @endforeach
                    </tbody>  
            </table> 
                <button class="btn btn-danger" type="submit">Alterar</button>      
        </form>
        @endif 
          
    @else

        @include('acessoNegado')

    @endif    
@stop










