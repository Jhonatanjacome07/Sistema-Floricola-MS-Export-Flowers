@extends('adminlte::page')

@section('title', 'Reporte')

@section('content_header')
<h1 class="text-center" font-family: sans-serif;> <b>MSFLOWERS</b></h1>
@stop

@section('content')

<!-- Sección oculta con el encabezado y el logo -->
<div id="header-section"
    style="display: none; padding: 20px; background-color: #f8f9fa; font-family: sans-serif;">
    <div style="display: flex; align-items: center; justify-content: center;">
        <h2 style="margin-right: 360px;"><strong>MS EXPORT FLOWERS</strong></h2>
        <img src="images/logo.jpg" style="margin-left: 800px; width: 90%; max-width: 200px; margin-left: 20px;">
    </div>
            <p style="margin-bottom: 5px;"><strong>Dirección: </strong> Pichincha, Cayambe</p>
            <p style="margin-bottom: 5px;"><strong>Teléfono:</strong>+593 989386555</p>
            <p style="margin-bottom: 5px;"><strong>Email:</strong> msexport@gmail.com</p>
            <p style="margin-bottom: 5px;  "><strong>Reporte de recepción en el rango de las siguientes fechas: </strong> </p>
            <div id="date-section" style="display: none;">
                <p style="margin-bottom: 5px; display: inline-block;" id="start-date"><strong>Fecha de inicio:</strong></p>
                <p style="margin-bottom: 5px; display: inline-block; margin-left: 10px;"><strong>----</strong></p>
                <p style="margin-bottom: 5px; display: inline-block; margin-left: 10px" id="end-date"><strong>Fecha de finalización:</strong></p>
            </div>
            <p style="margin-bottom: 5px;"> <b>Elaborado por: </b>{{ Auth::user()->name }} {{ Auth::user()->lastname }},
                @foreach(Auth::user()->roles as $role)
                    {{ $role->name }}
                    @if (!$loop->last)
                        
                    @endif
                @endforeach
            </p>
           
</div>



<!-- Sección oculta con el reporte de producción -->
<div id="report-section" style="display: none;" class="text-center">

</div>
<form method="GET" action="{{ route('recepcionreporte') }} " id="report-form ">
    <div class="row" id="input-section">
        <div class="col-md-6">
            <div class="form-group">
                <label for="start_date">Fecha de inicio:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->input('start_date', date('Y-m-d', strtotime('-1 week'))) }}" onchange="this.form.submit()">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="end_date">Fecha de fin:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->input('end_date', date('Y-m-d')) }}" onchange="this.form.submit()">
            </div>
        </div>
        <div class="col-md-12" id="report-button">
            <button class="btn btn-primary print-button" onclick="printReport()">
                <i class="fas fa-file-pdf"></i>
                Imprimir Reporte
            </button>
        </div>
    </div>

</form>

<div id="report-content">
    <div class="col-md-12 d-flex justify-content-center">
        <canvas id="myChart" class="mx-auto" style="width: 60%;"></canvas>
    </div>



    <div class="container">

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Bloque</th>
                    <th>Fecha</th>
                    <th>Cantidad de tallos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recepciones as $recepcion)
                <tr>
                    <td>{{ $recepcion->name }}</td>
                    <td>{{ $recepcion->nbloque }}</td>
                    <td>{{ \Carbon\Carbon::parse($recepcion->fecha)->format('d-m-Y') }}</td>
                    <td>{{ $recepcion->cantidadtallos }}</td>
                </tr>
                @endforeach

                <tr class="total">
                    <td colspan="3">Total:</td>
                    <td> {{ $recepciones->sum('cantidadtallos') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels);
    const data = @json($data);

    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'bar'
        , data: {
            labels: labels
            , datasets: [{
                label: 'Cantidad de tallos'
                , data: data
                , backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                    , 'rgba(54, 162, 235, 0.2)'
                    , 'rgba(255, 206, 86, 0.2)'
                    , 'rgba(75, 192, 192, 0.2)'
                    , 'rgba(153, 102, 255, 0.2)'
                    , 'rgba(255, 159, 64, 0.2)'
                ]
                , borderColor: [
                    'rgba(255, 99, 132, 1)'
                    , 'rgba(54, 162, 235, 1)'
                    , 'rgba(255, 206, 86, 1)'
                    , 'rgba(75, 192, 192, 1)'
                    , 'rgba(153, 102, 255, 1)'
                    , 'rgba(255, 159, 64, 1)'
                ]
                , borderWidth: 1
            }]
        }
        , options: {
            scales: {
                y: {
                    beginAtZero: true
                    , ticks: {
                        suggestedMin: 0
                        , suggestedMax: 100
                        , stepSize: 20
                    }
                }
                , x: {
                    ticks: {
                        autoSkip: true
                        , maxRotation: 45
                        , minRotation: 45
                    }
                }
            }
        }
    });

    function printReport() {
        // Mostrar la sección de fechas
        document.getElementById('date-section').style.display = 'block';

        // Obtener las fechas seleccionadas
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        // Actualizar el contenido de los elementos <p>
        document.getElementById('start-date').textContent = 'Fecha de inicio: ' + startDate;
        document.getElementById('end-date').textContent = 'Fecha fin: ' + endDate;

        // Ocultar la sección de entrada
        document.getElementById('input-section').style.display = 'none';
        // Ocultar el botón de reporte
        document.getElementById('report-button').style.display = 'none';
        // Mostrar el encabezado y el reporte antes de imprimir
        document.getElementById('header-section').style.display = 'block';
        document.getElementById('report-section').style.display = 'block';
        window.print();
        // Ocultar el encabezado y el reporte después de imprimir
        document.getElementById('header-section').style.display = 'none';
        document.getElementById('report-section').style.display = 'none';
    }

</script>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<style>
    @media print {

        #url-container,
        #url-container * {
            display: none !important;
        }
    }

    @media print {
        a[href] {
            pointer-events: none;
        }
    }

</style>

<style type="text/css">
    @media print {

        /* Ocultar el encabezado que muestra la URL */
        @page {
            margin-top: 0;
        }
    }

</style>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@stop
