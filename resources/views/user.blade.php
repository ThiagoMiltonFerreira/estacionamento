{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')  

@section('title', 'Inicio')

@section('css')



@stop

@section('js')

@stop

@section('content_header')
    <h1 align="center">Usuarios e permissoes de acesso. </h1>
@stop

@section('content')

<form action="{{ route('user.store') }}" method="POST">
    @csrf
    <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Usuario</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01" name="users" required>
            <option selected value=""></option>
            @foreach($users as $value)
                <option value="{{$value->name}}">{{$value->name}}</option>
            @endforeach    
            </select>
    </div>
                    
        <button class="btn btn-primary" type="submit">Buscar</button>
</form>
   

@stop

