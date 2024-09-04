@extends('adminlte::page')

@section('title', 'Digitador')

@section('content_header')
<h1 class="text-center"> <b>Digitador</b></h1>
@stop

@section('content')


<form method="POST" action="{{ route ('digitador.store') }}" class="mx-auto" style="max-width: 900px;">
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
                    <x-adminlte-input type="text" name="medida" label="Medida" label-class="text-lightblue"
                        value="{{ old('medida') }}">
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
                    <x-adminlte-input type="text" name="codigobarras" id="codigobarras" label="Código de barras"
                        label-class="text-lightblue" value="{{ old('codigobarras') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-barcode text-lightblue"></i>
                            </div>
                        </x-slot>
                        <x-slot name="appendSlot">
                            <x-adminlte-button label="Generar" theme="primary" id="generarBtn" />

                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            <div class="text-center">
                <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success"
                    icon="fas fa-lg fa-save" />
                <x-adminlte-button label="Cancelar" theme="danger" icon="fas fa-ban"
                    onclick="location.href='{{ route('digitador.index') }}'" />
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

@stop

@section('js')
<script>
    function generarNumeroAleatorio() {
        // Generar un número aleatorio de 12 dígitos
        var numeroAleatorio = Math.floor(1000000000 + Math.random() * 9000000000);
        
        // Obtener el campo de entrada del número aleatorio
        var numeroInput = document.querySelector('input[name="codigobarras"]');

        // Establecer el número aleatorio en el campo de entrada
        numeroInput.value = numeroAleatorio;
    }

    // Vincular la función generarNumeroAleatorio al evento click del botón
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('generarBtn').addEventListener('click', function() {
            generarNumeroAleatorio();
        });
    });
</script>
@stop

