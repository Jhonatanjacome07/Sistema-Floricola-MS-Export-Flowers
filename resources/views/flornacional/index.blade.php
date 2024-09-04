@extends('adminlte::page')

@section('title', 'Flor nacional')

@section('content_header')
<h1 class="text-center"> <b>Flor Nacional</b></h1>
@stop

@section('content')

<div class="card-header container">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
      <a href="{{ route('flornacional.create') }}" class="btn btn-primary"><b>Nuevo Ingreso</b></a>
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
                      <th>Motivo</th>
                      <th>Fecha</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                <?php $contador=0;?>
                  @foreach ($flornacional as $FlorNacional)
                  <tr>
                      <td>
                        <?php echo $contador= $contador + 1;?>
                      </td>
                      <td>{{ $FlorNacional->name }}</td>
                      <td>{{ $FlorNacional->nbloque }}</td>
                      <td>{{ $FlorNacional->cantidadtallos }}</td>
                      <td>{{ $FlorNacional->plaga }}</td>
                      <td>{{ date('d/m/Y', strtotime($FlorNacional->fecha)) }}</td>
                      <td>
                          <button class="btnEditar btn btn-xs btn-default text-primary mx-1 shadow" data-id="{{ $FlorNacional->id }}" 
                            data-name="{{ $FlorNacional->name }}" 
                            data-nbloque="{{ $FlorNacional->nbloque }}" 
                            data-cantidadtallos="{{ $FlorNacional->cantidadtallos }}" 
                            data-plaga="{{ $FlorNacional->plaga }}" 
                            data-fecha="{{ $FlorNacional->fecha }}"
                            title="Editar">
                              <i class="fa fa-lg fa-fw fa-pen"></i>
                          </button>
                          <form action="{{ route('flornacional.destroy', $FlorNacional) }}" method="POST" class="d-inline">
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


  <x-adminlte-modal id="modalEditFlorNacional" title="Editar Flor Nacional" theme="success" icon="fas fa-edit" size="lg"
    disable-animations>
    <form id="formEditFlorNacional" method="POST"
      action="{{ route('flornacional.update', ['flornacional' => $FlorNacional->id]) }}">
      @csrf
      @method('PUT')
      <x-adminlte-input name="name" label="Nombre" placeholder="Nombre de la flor nacional" label-class="text-success"
        value="{{ old('name', $FlorNacional->name) }}" />
      <x-adminlte-input name="nbloque" label="Número de bloque" placeholder="Número de bloque"
        label-class="text-success" value="{{ old('nbloque', $FlorNacional->nbloque) }}" />
      <x-adminlte-input name="cantidadtallos" label="Cantidad de tallos" placeholder="Cantidad de tallos"
        label-class="text-success" value="{{ old('cantidadtallos', $FlorNacional->cantidadtallos) }}" />
      <x-adminlte-input name="plaga" label="Plaga" placeholder="Plaga" label-class="text-success"
        value="{{ old('plaga', $FlorNacional->plaga) }}" />
        <x-adminlte-input type="date" name="fecha" label="Fecha" placeholder="Fecha" label-class="text-success" />
      <x-adminlte-button type="submit" label="Actualizar" theme="success" icon="fas fa-save" />
    </form>
  </x-adminlte-modal>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
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
            var id = boton.getAttribute('data-id');
            var name = boton.getAttribute('data-name');
            var nbloque = boton.getAttribute('data-nbloque');
            var cantidadtallos = boton.getAttribute('data-cantidadtallos');
            var plaga = boton.getAttribute('data-plaga');
            var fechaRecepcion = boton.getAttribute('data-fecha');
             // Colocar el ID de la recepción en el formulario de edición
             document.querySelector('#formEditFlorNacional').setAttribute('action', "{{ url('flornacional') }}/" + id);

            // Rellenar los campos del formulario con los datos del registro seleccionado
            document.querySelector('#formEditFlorNacional [name="name"]').value = name;
            document.querySelector('#formEditFlorNacional [name="nbloque"]').value = nbloque;
            document.querySelector('#formEditFlorNacional [name="cantidadtallos"]').value = cantidadtallos;
            document.querySelector('#formEditFlorNacional [name="plaga"]').value = plaga;
            document.querySelector('#modalEditFlorNacional input[name="fecha"]').value = fechaRecepcion;
            // Mostrar el modal
            $('#modalEditFlorNacional').modal('show');
        });
    });

    // Manejar la respuesta de actualización con SweetAlert
    $('#formEditFlorNacional').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var actionUrl = $(this).attr('action');

        $.ajax({
            url: actionUrl,
            method: 'PUT',
            data: formData,
            success: function (response) {
                // Mostrar SweetAlert cuandolos datos se actualicen correctamente
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
  $(document).ready(function(){
            $('.d-inline').submit(function(e){
              e.preventDefault();
             Swal.fire({
              title: "Estas seguro?",
              text: "Se va eliminar un registro",
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