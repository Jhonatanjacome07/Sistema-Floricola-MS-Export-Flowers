@extends('adminlte::page')

@section('title', 'Asignar roles a usuario: '.$user->name)

@section('content_header')
    <h1>Asignar roles a usuario: {{$user->name}}</h1>
@stop

@section('content')
    <form action="{{route('usuarios.sync_roles', $user)}}" method="post">
        @csrf
        @method('put')

        @foreach($roles as $rol)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$rol->id}}" name="roles[]" {{ $user->hasRole($rol) ? 'checked' : '' }}>
                <label class="form-check-label" for="defaultCheck1">
                    {{$rol->name}}
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Asignar roles</button>
    </form>
@stop