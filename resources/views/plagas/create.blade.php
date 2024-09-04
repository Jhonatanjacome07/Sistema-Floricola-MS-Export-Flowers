@extends('adminlte::page')

@section('title', 'Plagas')

@section('content_header')
    <h1 class="text-center"> <b>Agregar Nueva Plaga</b></h1>
@stop

@section('content')

    <section>
        <form method="POST" action="{{ route('plagas.store') }} " class="mx-auto" style="max-width: 950px;">
            @csrf
            <div class="card text-white bg-amber" style="border-radius: 20px;" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" >
                            <x-adminlte-input type="text" name="name" label="Nombre de la plaga" label-class="text-lightblue"
                                placeholder="Ingrese el nombre" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>El campo nombre no puede estar vacío</strong>
                                    </span>
                                @enderror
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fa fa-spa text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                        </div>
                    </div>

                    <div class="text-center">
                        <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success"
                            icon="fas fa-lg fa-save" />
                        <x-adminlte-button label="Cancelar" theme="danger" icon="fas fa-ban"
                            onclick="location.href='{{ route('plagas.index') }}'" />
                    </div>
                    @if (session('status') === 'user-registered')
                    <script>
                        window.onload = function() {
                            Swal.fire({
                                title: 'Registro',
                                text: 'Registro exitoso.',
                                icon: 'success',
                                timer: 2000, // Controla la duración del mensaje
                                showConfirmButton: false // Oculta el botón "OK"
                            });
                        };
                    </script>
                @endif
                </div>
            </div>
        </form>
    </section>

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
  
@stop
