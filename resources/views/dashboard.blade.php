@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
<h1 class="text-center"> <b>MSFLOWERS</b></h1>
<div class="text-center">
    <img src="/images/logo.jpg" alt="Logo" width="150px" class="rounded-circle">
</div>
@stop

@section('content')


<p class="text-center">Bienvenido <b>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</b>, tus roles son:
    @foreach(Auth::user()->roles as $role)
        {{ $role->name }}
        @if (!$loop->last)
            
        @endif
    @endforeach
</p>

@role ('Administrador')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('Administrador.index') }}" class="text-dark">
                    <span class="info-box-text"><b>Registrar Usuarios</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('roles.index') }}" class="text-dark">
                    <span class="info-box-text"><b>Registrar Roles </b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('permisos.index') }}" class="text-dark">
                    <span class="info-box-text"><b>Registrar Permisos</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('asignar.index') }}" class="text-dark">
                    <span class="info-box-text"><b>Asignar Roles</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-seedling"></i></span>
            <div class="info-box-content">
                <a href="{{ route('flowers.index') }}" class="text-dark">
                    <span class="info-box-text"><b>Registrar Variedades</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fa fa-spa"></i></span>
            <div class="info-box-content">
                <a href="{{ route('plagas.index') }}" class="text-dark">
                    <span class="info-box-text"><b>Registrar Plagas</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h1 class="text-center"> <b>Rosas</b></h1>

    <div class="row">
        <div class="col-md-12">
            <div id="gallery" class="row">
                <div class="col-sm-3">
                    <a href="{{ asset('assets/img/portfolio/highmagic.jpg') }}" data-toggle="lightbox"
                        data-gallery="gallery" class="d-block mb-4">
                        <img src="{{ asset('assets/img/portfolio/highmagic.jpg') }}" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="{{ asset('assets/img/portfolio/FREEDOM.jpg') }}" data-toggle="lightbox"
                        data-gallery="gallery" class="d-block mb-4">
                        <img src="{{ asset('assets/img/portfolio/FREEDOM.jpg') }}" class="img-fluid img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole
{{-- Sección para el recepcionistas --}}
@role ('Recepcionista')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('recepcion.create') }}" class="text-dark">
                    <span class="info-box-text"><b>Registrar producción</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('recepcion.index') }}" class="text-dark">
                    <span class="info-box-text"><b>Lista de producción</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-seedling"></i></span>
            <div class="info-box-content">
                <a href="{{ route('recepcionreporte') }}" class="text-dark">
                    <span class="info-box-text"><b>Reportes</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
@endrole
{{-- Sección para flor nacional --}}
@role ('Flor nacional')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('flornacional.create') }}" class="text-dark">
                    <span class="info-box-text"><b>Registrar flor nacional</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('flornacional.index') }}" class="text-dark">
                    <span class="info-box-text"><b>Lista de flor nacional</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-seedling"></i></span>
            <div class="info-box-content">
                <a href="{{ route('flornacionalreporte') }}" class="text-dark">
                    <span class="info-box-text"><b>Reportes</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
@endrole
{{-- Sección para el digitador --}}
@role ('Digitador')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('digitador.create') }}" class="text-dark">
                    <span class="info-box-text"><b>Registrar bonche</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-user-plus"></i></span>
            <div class="info-box-content">
                <a href="{{ route('digitador.index') }}" class="text-dark">
                    <span class="info-box-text"><b>Lista de bonches</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box  ">
            <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-seedling"></i></span>
            <div class="info-box-content">
                <a href="{{ route('boncheoreporte') }}" class="text-dark">
                    <span class="info-box-text"><b>Reportes</b></span>
                    <span class="info-box-number">
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
@endrole


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!'); 
</script>
@stop