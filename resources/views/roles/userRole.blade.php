@extends('adminlte::page')
@section('title', 'Inicio')
@section('content_header')
    <h1 class="text-center">
        <b>USUARIOS Y ROLES</b>
    </h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <p>{{ $user->name }}</p>
        </div>
        <div class="card-body">
            <h5>Lista de Roles</h5>
            {!! Form::model($user, ['route' => ['asignar.update', $user], 'method' => 'put']) !!}
            @foreach ($roles as $role)
                <div>
                    <label>
                        {!! Form::checkbox('roles[]', $role->id, $user->hasAnyRole($role->id) ?: false, [
                            'class' => 'mr-1',
                        ]) !!} {{ $role->name }}
                    </label>
                </div>
            @endforeach
            {!! Form::submit('Asignar Roles', ['class' => 'btn btn-info mt-3']) !!}
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
