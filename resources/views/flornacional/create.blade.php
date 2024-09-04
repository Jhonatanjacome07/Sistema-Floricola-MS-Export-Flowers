@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class="text-center"> <b>Flor Nacional</b></h1>
@stop

@section('content')


  
        @php
            if (session()) {
                if (session('message') == 'ok') {
                    echo '<x-adminlte-alert class="bg-teal text-uppercase" icon="fa fa-lg fa-thumbs-up" title="Done" dismissable>
        Datos registrados!
    </x-adminlte-alert>';
                    # code...
                }
                # code...
            }
        @endphp
        <form method="POST" action="{{ route('flornacional.store') }}" class="mx-auto" style="max-width: 900px;">
            @csrf
            <div class="card text-white bg-amber" style="border-radius: 20px;">
                <div class="card-header"></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-select name="name" label="Nombre" label-class="text-lightblue" error="$errors->has('name') ? $errors->first('name') : null">
                                <option value="">Seleccione una variedad</option>
                               @php
                                    $addedNames = [];
                                @endphp
                                @foreach($flowers as $flower)
                                    @unless(in_array($flower->name, $addedNames))
                                        <option value="{{ $flower->name }}">{{ $flower->name }}</option>
                                        @php
                                            $addedNames[] = $flower->name;
                                        @endphp
                                    @endunless
                                @endforeach
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-seedling text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-select>
                        </div>
                        
                        <div class="col-md-6">
                            <x-adminlte-select name="nbloque" label="Número de bloque" label-class="text-lightblue"
                                error="$errors->has('name') ? $errors->first('name') : null">
                                <option value="">Seleccione un bloque</option>
                                @php
                                    $addedNumbers = [];
                                @endphp
                                @foreach($flowers->sortBy('nbloque') as $flower)
                                    @unless(in_array($flower->nbloque, $addedNumbers))
                                        <option value="{{ $flower->nbloque }}">{{ $flower->nbloque }}</option>
                                        @php
                                            $addedNumbers[] = $flower->nbloque;
                                        @endphp
                                    @endunless
                                @endforeach
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-seedling text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-select>
                        </div>
                        
                        <div class="col-md-6">
                            <x-adminlte-input type="text" name="cantidadtallos" label="Número tallos"
                                label-class="text-lightblue" value="{{ old('cantidadtallos') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-seedling text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input type="date" name="fecha" label="Fecha" label-class="text-lightblue" value="{{ old('fecha') }}">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt text-lightblue"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>

                        <div class="col-md-6">
                            <x-adminlte-select name="motivo" label="Plaga" label-class="text-lightblue" error="$errors->has('name') ? $errors->first('name') : null">
                                @foreach($plagas as $plagas)                        
                                    <option value="{{ $plagas->name }}">{{ $plagas->name}}</option>                        
                                @endforeach                        
                                <x-slot name="prependSlot">                        
                                    <div class="input-group-text">                        
                                        <i class="fas fa-seedling text-lightblue"></i>                        
                                    </div>                        
                                </x-slot>                        
                            </x-adminlte-select>                                 
                        </div>        
                        

                    </div>

                    <div class="text-center">
                        <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success"
                            icon="fas fa-lg fa-save" />
                        <x-adminlte-button label="Cancelar" theme="danger" icon="fas fa-ban"
                            onclick="location.href='{{ route('flornacional.index') }}'" />

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
        <script>
            console.log('Hi!');
        </script>
    @stop
