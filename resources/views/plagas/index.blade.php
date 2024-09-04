@extends('adminlte::page')

@section('title', 'Plagas')

@section('content_header')
<h1 class="text-center"> <b>Plagas</b></h1>
@stop
@section('content')
<div class="card-header container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <a href="{{ route('plagas.create') }}" class="btn btn-primary"><b>Agregar nueva plaga</b></a>
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
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contador=0;?>
                    @foreach($plagas as $plaga)
                    <tr>
                        <td><?php echo $contador= $contador + 1;?></td>
                        <td>{{ $plaga->name }}</td>
                        <td id="resp{{ $plaga->id }}">
                            @if($plaga->status == 1)
                            <span class="text-success">Activo</span>
                            @else
                            <span class="text-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <button class="btnEditar btn btn-xs btn-default text-primary mx-1 shadow" data-id="{{ $plaga->id }}" data-name="{{ $plaga->name }}" title="Editar">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            <button class="btnActivar btn btn-xs btn-default text-primary mx-1 shadow" data-id="{{ $plaga->id }}" data-status="{{ $plaga->status }}" title="Activar/Desactivar">
                                <i class="fa fa-lg fa-fw {{ $plaga->status == 1 ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger' }}"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


    {{-- Modal de Edición de Plaga --}}
    <x-adminlte-modal id="modalEditPlaga" title="Editar Plaga" theme="success" icon="fas fa-edit" size="lg"
        disable-animations>
        <form id="formEditPlaga" method="POST">
            @csrf
            @method('PUT')
            <x-adminlte-input name="name" label="Nombre" placeholder="Nombre de la plaga"
                label-class="text-success" />
            <x-adminlte-button type="submit" label="Actualizar" theme="success" icon="fas fa-save" />
        </form>
    </x-adminlte-modal>


@stop

@section('css')

@stop

@section('js')


<script>
    $(document).ready(function() {
        $('#rosas').DataTable({
            "language": {
                "search": "Buscar",
                "lengthMenu": "Mostrar _MENU_ resgistros por página",
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
    $(document).ready(function() {
      $('.btnActivar').on('click', function() {
          var plagaId = $(this).data('id');
          var nuevoEstado = $(this).data('status') == 1 ? 0 : 1;

          $.ajax({
              url: '{{ route("plagas.toggle", ":plagaId") }}'.replace(':plagaId', plagaId),
              method: 'PUT',
              data: {
                  _token: '{{ csrf_token() }}',
                  _method: 'PUT'
              },
              success: function(response) {
                  // Actualizar el estado en la tabla
                   // Actualizar el estado en la tabla
                   $('#resp' + plagaId).html(nuevoEstado == 1 ? '<span class="text-success">Activo</span>' : '<span class="text-danger">Inactivo</span>');
                   $('.btnActivar[data-id="' + plagaId + '"]').data('status', nuevoEstado);
                  // Actualizar el icono del botón de activar/desactivar
                  $('.btnActivar[data-id="' + plagaId + '"]').html('<i class="fa fa-lg fa-fw ' + (nuevoEstado == 1 ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger') + '"></i>');
                  // Actualizar el atributo data-status del botón
                  var iconClass = nuevoEstado == 1 ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger';
                  $('.btnActivar[data-id="' + plagaId + '"]').data('status', nuevoEstado);
              },
              error: function(xhr) {
                  console.error(xhr);
              }
          });
      });
  });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    var botonesEditar = document.querySelectorAll('.btnEditar');
    botonesEditar.forEach(function (boton) {
        boton.addEventListener('click', function (event) {
            event.preventDefault();
            var idPlaga = boton.getAttribute('data-id');
            var nombrePlaga = boton.getAttribute('data-name');
            // Colocar el ID de la plaga en el formulario de edición
            document.querySelector('#formEditPlaga').setAttribute('action', "{{ url('Plagas') }}/" + idPlaga);
            // Rellenar el campo de nombre con el nombre de la plaga
            document.querySelector('#modalEditPlaga input[name="name"]').value = nombrePlaga;

            // Abrir el modal de edición
            $('#modalEditPlaga').modal('show');
        });
    });
    // Manejar la respuesta de actualización con SweetAlert
    $('#formEditPlaga').submit(function (event) {
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





@stop