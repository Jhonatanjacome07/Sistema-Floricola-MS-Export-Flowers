@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1 class="text-center"> <b>MSFLOWERS</b></h1>
    <div class="text-center">
        <img src="/images/logo.jpg" alt="Logo" width="150px" class="rounded-circle">
    </div>
@stop

@section('content')

<p class="text-center">Bienvenido <b>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</b>, 
    @foreach(Auth::user()->roles as $role)
        {{ $role->name }}
        @if (!$loop->last)
            
        @endif
    @endforeach
</p>
    @role('Administrador')
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
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-12"><i class="fas fa-file-pdf"></i></span>
                    <div class="info-box-content">
                        <a href="{{ asset('assets/manual/Manual de usuario.pdf') }}" download class="text-dark">
                            <span class="info-box-text"><b>Manual de Usuarios</b></span>
                            <span class="info-box-number"></span>
                        </a>
                    </div>
                </div>
            </div>
           

        </div>
    @endrole
    {{-- Sección para el recepcionistas --}}
    @role('Recepcionista')
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
    {{-- Galeria --}}
        <h1 class="text-center"> <b>Rosas</b></h1>
        <div class="row">
            <div class="col-sm-2">
                <a href="{{ asset('assets/img/portfolio/highmagic.jpg') }}" data-toggle="lightbox" 
                     data-gallery="gallery "  class="d-block mb-4">
                    <img src="{{ asset('assets/img/portfolio/highmagic.jpg') }}" class="img-fluid custom-thumbnail">
                </a>
                <div class="text-center">High & Magic</div>
            </div>
            <div class="col-sm-2">
                <a href="{{ asset('assets/img/portfolio/FREEDOM.jpg') }}" data-toggle="lightbox"
                    data-gallery="gallery" class="d-block mb-4">
                    <img src="{{ asset('assets/img/portfolio/FREEDOM.jpg') }}" class="img-fluid custom-thumbnail" >
                </a>
                <div class="text-center">Freedom</div>
            </div>
            <div class="col-sm-2">
                <a href="{{ asset('assets/img/portfolio/frutteto.jpg') }}" data-toggle="lightbox" data-gallery="gallery"
                    class="d-block mb-4">
                    <img src="{{ asset('assets/img/portfolio/frutteto.jpg') }}" class="img-fluid custom-thumbnail">
                </a>
                <div class="text-center">Frutteto</div>
            </div>
            <div class="col-sm-2">
                <a href="{{ asset('assets/img/portfolio/mandala.jpg') }}" data-toggle="lightbox" data-gallery="gallery"
                    class="d-block mb-4">
                    <img src="{{ asset('assets/img/portfolio/mandala.jpg') }}" class="img-fluid custom-thumbnail">
                </a>
                <div class="text-center">Mandala</div>
            </div>
            <div class="col-sm-2">
                <a href="{{ asset('assets/img/portfolio/ocean.jpg') }}" data-toggle="lightbox" data-gallery="gallery"
                    class="d-block mb-4">
                    <img src="{{ asset('assets/img/portfolio/ocean.jpg') }}" class="img-fluid custom-thumbnail">
                </a>
                <div class="text-center">Ocean Song</div>
            </div>
            <div class="col-sm-2">
                <a href="{{ asset('assets/img/portfolio/brighton.jpg') }}" data-toggle="lightbox" data-gallery="gallery"
                    class="d-block mb-4">
                    <img src="{{ asset('assets/img/portfolio/brighton.jpg') }}" class="img-fluid custom-thumbnail">
                </a>
                <div class="text-center">Brighton</div>
            </div>
        </div>
    @endrole
    {{-- Sección para flor nacional --}}
    @role('Flor nacional')
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
        {{-- Galeria --}}
        <div class="card card-success">
            <div class="card-header">
                <h4 class="card-title">Plagas</h4>
            </div>
                <div class="card-body">
                    
                        <div class="row">
                            <div class="col-sm-2">
                                <a href="{{ asset('assets/img/plagas/arania.jpg') }}" data-toggle="lightbox" 
                                     data-gallery="gallery "  class="d-block mb-4">
                                    <img src="{{ asset('assets/img/plagas/arania.jpg') }}" class="img-fluid custom-thumbnail">
                                </a>
                                <div class="text-center">Araña</div>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ asset('assets/img/plagas/botritis.jpg') }}" data-toggle="lightbox"
                                    data-gallery="gallery" class="d-block mb-4">
                                    <img src="{{ asset('assets/img/plagas/botritis.jpg') }}" class="img-fluid custom-thumbnail" >
                                </a>
                                <div class="text-center">Botritis</div>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ asset('assets/img/plagas/clorosis.jpg') }}" data-toggle="lightbox" data-gallery="gallery"
                                    class="d-block mb-4">
                                    <img src="{{ asset('assets/img/plagas/clorosis.jpg') }}" class="img-fluid custom-thumbnail">
                                </a>
                                <div class="text-center">Clorosis</div>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ asset('assets/img/plagas/corto.jpg') }}" data-toggle="lightbox" data-gallery="gallery"
                                    class="d-block mb-4">
                                    <img src="{{ asset('assets/img/plagas/corto.jpg') }}" class="img-fluid custom-thumbnail">
                                </a>
                                <div class="text-center">Tallo Corto</div>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ asset('assets/img/plagas/cuellosdeganzos.jpg') }}" data-toggle="lightbox" data-gallery="gallery"
                                    class="d-block mb-4">
                                    <img src="{{ asset('assets/img/plagas/cuellosdeganzos.jpg') }}" class="img-fluid custom-thumbnail">
                                </a>
                                <div class="text-center">Cuello de Ganzo</div>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ asset('assets/img/plagas/trips.jpg') }}" data-toggle="lightbox" data-gallery="gallery"
                                    class="d-block mb-4">
                                    <img src="{{ asset('assets/img/plagas/trips.jpg') }}" class="img-fluid custom-thumbnail">
                                </a>
                                <div class="text-center">Trips</div>
                            </div>
                </div>
        </div>
    @endrole
    {{-- Sección para el digitador --}}
    @role('Digitador')
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
    <style>
        .custom-thumbnail {
            border: 7px solid #27cdba; /* Agrega el símbolo "#" antes del código hexadecimal */
        }
    </style>
@endsection



@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
