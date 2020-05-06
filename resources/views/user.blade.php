{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')  

@section('title', 'Inicio')

@section('css')
<style>
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

@stop

@section('content_header')
    <h1 id="align-text-center">Usuarios e permissoes de acesso. </h1>
@stop

@section('content')



<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Novo Usuario</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Alterar usuario</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Permissoes de acesso</a>
    
    
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">@include('permissoesDeAcesso')</div>

  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"> @include('novoUsuario') </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">@include('alterarUsuario')</div>
  
</div>


@stop

