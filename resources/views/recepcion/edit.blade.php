@extends('adminlte::page')

@section('title', 'Editar Registro')

@section('content_header')
    <h1 class="text-center"> <b>Recepción</b></h1>
@stop

@section('content')
       
            <div class="card text-white bg-amber" style="border-radius: 20px;">
               
                <div class="card-header"></div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ route ('recepcion.update', $recepcion) }}" class="mx-auto" style="max-width: 900px;">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <x-adminlte-input type="text" name="name" label="Nombre" label-class="text-lightblue"
                                    placeholder="Nombre de la variedad" value="{{ $recepcion->name }}">
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>El campo nombre no puede estar vacío</strong>
                                        </span>
                                    @enderror
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-seedling text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>

                            </div>
                            <div class="col-md-6">
                                <x-adminlte-input type="text" name="nbloque" label="Número de bloque" label-class="text-lightblue"
                                    value="{{ $recepcion->nbloque }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-seedling text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="col-md-6">
                                <x-adminlte-input type="text" name="cantidadtallos" label="Número tallos" label-class="text-lightblue"
                                    value="{{ $recepcion->cantidadtallos }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-seedling text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
    
                        </div>

                        <div class="text-center">
                            <x-adminlte-button class="btn-flat" type="submit" label="Actualizar" theme="success"
                                icon="fas fa-lg fa-save" />
                            <x-adminlte-button label="Cancelar" theme="danger" icon="fas fa-ban"
                                onclick="location.href='{{ route('recepcion.index') }}'" />

                        </div>
                    </form>
                </div>
            </div>
       
   

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1y6tN0nK/3r39J6Sq5DD+456cXVpQ6eq0cYQ2kL17l7Y0y4kQ+8+5+t8c7b5794b9178c21384f15"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .input-group-text {
            font-size: 14px;
        }

        .input-group {
            margin-bottom: 10px;
        }

        .text-sm {
            font-size: 12px;
        }
    </style>
@stop

@section('js')
   

    @if (session ("message"))
        <script>
            $(document).ready(function(){
                let message="{{ session('mesage') }}}";
                Swal.fire ({
                    'title': 'Resultado',
                    'text': mensaje,
                    'icon': 'success'
                })
            })
        </script>
        
    @endif
@stop
