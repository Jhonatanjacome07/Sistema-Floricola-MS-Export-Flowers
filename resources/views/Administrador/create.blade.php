@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class="text-center"> <b>Agregar Nuevo Usuario</b></h1>
@stop

@section('content')

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                
            </h2>

            <p class="mt-1 text-sm text-gray-600">

            </p>
        </header>

        <form method="POST" action="{{ route('Administrador.store') }}" class="mx-auto" style="max-width: 900px;">
            @csrf
            <div class="card text-white bg-amber" style="border-radius: 20px;">
                <div class="card-header">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input type="text" name="name" label="Nombre" label-class="text-lightblue"
                                placeholder="Nombre del usuario" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>El campo nombre no puede estar vacío</strong>
                                    </span>
                                @enderror
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>

                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input type="text" name="lastname" label="Apellido" label-class="text-lightblue"
                                placeholder="Apellido del usuario" value="{{ old('lastname') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-12">
                            <x-adminlte-input type="email" name="email" label="Correo Electrónico"
                                label-class="text-lightblue" placeholder="user@gmail.com" value="{{ old('email') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-at text-lightblue"></i>
                                    </div>
                                </x-slot>
                                <x-slot name="bottomSlot">
                                </x-slot>
                            </x-adminlte-input>
                        </div>

                        <div class="col-md-6">
                            <x-adminlte-input name="cedula" label="Cédula" label-class="text-lightblue"
                                placeholder="Cédula" value="{{ old('cedula') }}" maxlength="10" pattern="[0-9]{10}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text ">
                                        <i class="fas fa-id-card text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="telefono" label="Teléfono" label-class="text-lightblue"
                                placeholder="Teléfono" value="{{ old('telefono') }}" maxlength="10" pattern="[0-9]{10}">
                                @error('phone')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    
                    </div>
                    <div class="text-center">
                        <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success"
                            icon="fas fa-lg fa-save" />
                        <x-adminlte-button label="Cancelar" theme="danger" icon="fas fa-ban"
                            onclick="location.href='{{ route('Administrador.index') }}'" />
                    </div>
                    
                    @if (session('status') === 'user-registered')
                        <script>
                            window.onload = function() {
                                Swal.fire({
                                    title: 'Usuario registrado',
                                    text: 'El nuevo usuario ha sido registrado exitosamente.',
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
    <script>
        console.log('Hi!');
    </script>

    
@stop
