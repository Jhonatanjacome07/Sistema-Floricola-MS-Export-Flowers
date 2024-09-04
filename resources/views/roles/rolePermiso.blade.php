@extends('adminlte::page')
@section('title', 'Inicio')
@section('content_header')
    <h1 class="text-center">
        <b>Roles y Permisos</b>
    </h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <p>{{ $role->name }}</p>
        </div>
        <div class="card-body">
            <h5>Lista de permisos</h5>
            {!! Form::model($role, ['route' => ['roles.update', $role], 'method' => 'put']) !!}
            @foreach ($permisos as $permiso)
                <div>
                    <label>
                        {!! Form::checkbox('permisos[]', $permiso->id, $role->hasPermissionTo($permiso->id) ?: false, [
                            'class' => 'mr-1',
                        ]) !!} {{ $permiso->name }}
                    </label>
                </div>
            @endforeach
            {!! Form::submit('Asignar Permisos', ['class' => 'btn btn-info mt-3']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
