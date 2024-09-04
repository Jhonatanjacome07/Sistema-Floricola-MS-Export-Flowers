@extends('adminlte::page')

@section('title', 'Recepción')

@section('content_header')
<h1 class="text-center"> <b>Recepción</b></h1>
@stop

@section('content')
<div class="card-header container">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
      <a href="{{ route('recepcion.create') }}" class="btn btn-primary"><b>Nuevo Ingreso </b></a>
    </div>

  </div>

</div>


<div class="card">
  <div class="card-body">
      <div class="table-responsive">
          <table id="rosas" class="table table-striped table-bordered nowrap table-info">
              <thead>
                  <tr>
                      <th>Nr</th>
                      <th>Nombre</th>
                      <th>Número de Bloque</th>
                      <th>Número de Tallos</th>
                      <th>Fecha</th> <!-- Agregamos esta columna -->
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $contador = 0; ?>
                  @foreach ($recepcion as $Recepcion)
                  <tr>
                      <td><?php echo $contador= $contador + 1;?></td>
                      <td>{{ $Recepcion->name }}</td>
                      <td>{{ $Recepcion->nbloque }}</td>
                      <td>{{ $Recepcion->cantidadtallos }}</td>
                      <td>{{ \Carbon\Carbon::parse($Recepcion->fecha)->format('d-m-Y') }}</td> <!-- Formateamos la fecha -->
                      <td>
                          <button class="btnEditar btn btn-xs btn-default text-primary mx-1 shadow" 
                           data-id="{{ $Recepcion->id }}"
                           data-name="{{ $Recepcion->name }}" 
                           data-nbloque="{{ $Recepcion->nbloque }}" 
                           data-cantidadtallos="{{ $Recepcion->cantidadtallos }}" 
                           data-fecha="{{ $Recepcion->fecha }}"
                           title="Editar">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                          </button>
                          <form action="{{ route('recepcion.destroy', $Recepcion) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                                  <i class="fa fa-lg fa-fw fa-trash"></i>
                              </button>
                          </form>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>


 {{-- Modal de Edición de Recepción --}}
<x-adminlte-modal id="modalEditRecepcion" title="Editar Recepción" theme="success" icon="fas fa-edit" size="lg" disable-animations>
  <form id="formEditRecepcion" method="POST">
      @csrf
      @method('PUT')

      <x-adminlte-input name="name" label="Nombre" placeholder="Nombre de la recepción" label-class="text-success" />

      <x-adminlte-input name="nbloque" label="Número de bloque" placeholder="Número de bloque" label-class="text-success" />

      <x-adminlte-input name="cantidadtallos" label="Cantidad de tallos" placeholder="Cantidad de tallos" label-class="text-success" />

      <x-adminlte-input type="date" name="fecha" label="Fecha" placeholder="Fecha" label-class="text-success" />

      <x-adminlte-button type="submit" label="Actualizar" theme="success" icon="fas fa-save" />
  </form>
</x-adminlte-modal>



@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
      $('#rosas').DataTable({
          "language": {
              "search": "Buscar",
              "lengthMenu": "Mostrar _MENU_ registros por página",
              "info": "Mostrando página _PAGE_ de _PAGES_",
              "paginate": {
                  "previous": "Anterior",
                  "next": "Siguiente",
                  "first": "Primero",
                  "last": "Último"
              }
          },
          "lengthMenu": [5, 10, 15],
          "responsive": true,
          "autoWidth": false
      });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var botonesEditar = document.querySelectorAll('.btnEditar');
    botonesEditar.forEach(function (boton) {
        boton.addEventListener('click', function (event) {
            event.preventDefault();
            var idRecepcion = boton.getAttribute('data-id');
            var nombreRecepcion = boton.getAttribute('data-name');
            var nbloqueRecepcion = boton.getAttribute('data-nbloque');
            var cantidadtallosRecepcion = boton.getAttribute('data-cantidadtallos');
            var fechaRecepcion = boton.getAttribute('data-fecha');

            // Colocar el ID de la recepción en el formulario de edición
            document.querySelector('#formEditRecepcion').setAttribute('action', "{{ url('recepcion') }}/" + idRecepcion);

            // Rellenar los campos de nombre, nbloque y cantidadtallos con los datos de la recepción
            document.querySelector('#modalEditRecepcion input[name="name"]').value = nombreRecepcion;
            document.querySelector('#modalEditRecepcion input[name="nbloque"]').value = nbloqueRecepcion;
            document.querySelector('#modalEditRecepcion input[name="cantidadtallos"]').value = cantidadtallosRecepcion;
            document.querySelector('#modalEditRecepcion input[name="fecha"]').value = fechaRecepcion;

            // Abrir el modal de edición
            $('#modalEditRecepcion').modal('show');
        });
    });

    // Manejar la respuesta de actualización con SweetAlert
    $('#formEditRecepcion').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var actionUrl = $(this).attr('action');

        $.ajax({
            url: actionUrl,
            method: 'PUT',
            data: formData,
            success: function (response) {
                // Mostrar SweetAlert cuando los datos se actualicen correctamente
                Swal.fire({
                    title: 'Éxito',
                    text: response.message,
                    icon: 'success',
                    timer: 2000 // 2 segundos
                }).then(function () {
                    // Recargar la página después de cerrar el SweetAlert
                    location.reload();
                });
            },
              error: function (xhr) {
                // Manejar errores si es necesario
                console.error(xhr);
            }
        });
    });
});
</script>

<script>
  $(document).ready(function() {
      $('.js-example-basic-single').select2();
  });
</script>


<script>
  $(document).ready(function(){
            $('.d-inline').submit(function(e){
              e.preventDefault();
             Swal.fire({
              title: "Estas seguro?",
              text: "Se va eliminar un registro!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si, Eliminar ahora!"
              }).then((result) => {
              if (result.isConfirmed) {
                this.submit();
              
              }
              });
            })
        })

</script>
@stop