@extends('adminlte::page')

@section('title', 'Reporte')

@section('content_header')
<h1 class="text-center" font-family: sans-serif;> <b>MS FLOWERS</b></h1>
@stop

@section('content')

<!-- Sección oculta con el encabezado y el logo -->
<div id="header-section" style="display: none; padding: 20px; background-color: #f8f9fa; font-family: 'Times New Roman';">
    <div style="display: flex; align-items: center; justify-content: center;">
        <h2 style="margin-right: 450px;"><strong>MS EXPORT FLOWERS</strong></h2>
        <img src="images/logo.jpg" style="margin-left: 20px; width: 90%; max-width: 200px;">
    </div>
    <p style="margin-bottom: 5px;"><strong>Dirección: </strong> Pichincha, Cayambe</p>
    <p style="margin-bottom: 5px;"><strong>Teléfono:</strong> +593 989386555</p>
    <p style="margin-bottom: 5px;"><strong>Email:</strong> msexport@gmail.com</p>
    <p style="margin-bottom: 5px;"><strong>Reporte de Flor Nacional en el rango de las siguientes fechas:</strong></p>
    <div id="date-section" style="display: none;">
        <p style="margin-bottom: 5px; display: inline-block;" id="start-date"><strong>Fecha de inicio:</strong></p>
        <p style="margin-bottom: 5px; display: inline-block; margin-left: 10px;"><strong>----</strong></p>
        <p style="margin-bottom: 5px; display: inline-block; margin-left: 10px;" id="end-date"><strong>Fecha de finalización:</strong></p>
    </div>
    <p style="margin-bottom: 5px; font-family: 'Times New Roman';">
        <strong>Elaborado por: </strong>{{ Auth::user()->name }} {{ Auth::user()->lastname }}, 
        @foreach(Auth::user()->roles as $role)
            {{ $role->name }}
            @if (!$loop->last)
                ,
            @endif
        @endforeach
    </p>      
</div>


<!-- Sección oculta con el reporte de producción -->
<div id="report-section" style="display: none;" class="text-center">

</div>
<form method="GET" action="{{ route('boncheoreporte') }} " id="report-form ">
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
                    <th>Número de bloque</th>
                    <th>Fecha</th>
                    <th>Medida</th>
                    <th>Cantidad de Tallos (Recepción)</th>
                    <th>Cantidad de Tallos (Boncheo)</th>
                    <th>Cantidad de Bonches</th>
                 
                  
                </tr>
            </thead>
            <tbody>
                @foreach ($tableData as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['nbloque'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('d/m/Y') }}</td>
                    <td>{{ $item['medida'] }} cm</td>
                    <td>{{ $item['cantidadtallosRecepcion'] }}</td>
                    <td>{{ $item['cantidadTallosBoncheo'] }}</td>
                    <td>{{ $item['cantidadBonches'] }}</td>
                  
                </tr>
                @endforeach
                <tr class="total">
                    <td colspan="5">Total:</td>
                
                    <td>{{ $tableData->sum('cantidadTallosBoncheo') }}</td>
                    <td>{{ $tableData->sum('cantidadBonches') }}</td>
                </tr>
                <tr id="signature-row" style="display: none;">
                    <td colspan="7" style="text-align: center; border-bottom: 3px solid black;">
                        <hr class="signature-line">
                        
                        Firma</td>
                </tr>
            </tbody>
        </table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Obtener los elementos de fecha de inicio y fecha de fin
    var startDateInput = document.getElementById("start_date");
    var endDateInput = document.getElementById("end_date");

    // Obtener los valores de las fechas
    var startDateValue = startDateInput.value;
    var endDateValue = endDateInput.value;

    // Formatear las fechas en el formato dd/mm/aaaa
    var formattedStartDate = formatDate(startDateValue);
    var formattedEndDate = formatDate(endDateValue);

    // Mostrar las fechas formateadas en los elementos <p> correspondientes
    document.getElementById("start-date").innerHTML = "<strong>Fecha de inicio:</strong> " + formattedStartDate;
    document.getElementById("end-date").innerHTML = "<strong>Fecha fin:</strong> " + formattedEndDate;

    // Función para formatear la fecha en el formato dd/mm/aaaa
    function formatDate(dateString) {
        var date = new Date(dateString);
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        // Agregar ceros iniciales si es necesario
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }

        return day + "/" + month + "/" + year;
    }
</script>



<script>
    const combinedData = @json($combinedData);

const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: combinedData.map(data => data.label),
        datasets: [{
            label: 'Cantidad de tallos (Recepción)',
            data: combinedData.map(data => data.dataRecepcion),
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Cantidad de tallos (Boncheo)',
            data: combinedData.map(data => data.dataBoncheo),
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
           
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
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
        /* Ocultar el encabezado y el pie de página predeterminados */
        @page {
            margin: 0;
        }

        /* Ocultar la URL de la hoja impresa */
        #url-container, #url-container * {
            display: none !important;
        }

        /* Deshabilitar la interacción con los enlaces al imprimir */
        a[href] {
            pointer-events: none;
        }
    }
</style>
@stop


@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@stop