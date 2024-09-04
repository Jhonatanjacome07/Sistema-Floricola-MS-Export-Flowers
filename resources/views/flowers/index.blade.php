@extends('adminlte::page')

@section('title', 'Rosas')

@section('content_header')
<h1 class="text-center"> <b>Rosas</b></h1>
@stop

@section('content')

@if (session('success-create'))
<div class="alert alert-primary text-center">
    {{ session('success-create') }}
</div>
@elseif(session('success-update'))
<div class="alert alert-success text-center">
    {{ session('success-update') }}
</div>
@elseif(session('success-delete'))
<div class="alert alert-warning text-center">
    {{ session('success-delete') }}
</div>
@endif


<div class="card-header container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <a href="{{ route('flowers.create') }}" class="btn btn-primary"><b>Agregar nueva variedad</b></a>
        </div>

    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="rosas" class="table table-striped table-bordered nowrap table-info" >
                <thead>
                    <tr>
                        <th>Nr</th>
                        <th>Nombre</th>
                        <th>Número de bloque</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contador=0;?>
                            @foreach($flowers as $flower)
                            <tr>
                                <td>
                                    <?php echo $contador= $contador + 1;?>
                                </td>
                                <td>{{ $flower->name }}</td>
                                <td>{{ $flower->nbloque }}</td>
                                <td id="resp{{ $flower->id }}">
                                    @if($flower->status == 1)
                                    <span class="text-success">Activo</span>
                                    @else
                                    <span class="text-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btnEditar btn btn-xs btn-default text-primary mx-1 shadow"
                                        data-id="{{ $flower->id }}" data-name="{{ $flower->name }}"
                                        data-nbloque="{{ $flower->nbloque }}" title="Editar">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button>

                                    <button class="btnActivar btn btn-xs btn-default text-success mx-1 shadow"
                                        data-id="{{ $flower->id }}" data-status="{{ $flower->status }}">
                                        <i
                                            class="fa fa-lg fa-fw {{ $flower->status == 1 ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger' }}"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal de Edición de Rosa --}}
<x-adminlte-modal id="modalEditRose" title="Editar Rosa" theme="success" icon="fas fa-edit" size="lg"
    disable-animations>
    <form id="formEditRose" method="POST">
        @csrf
        @method('PUT')
        <x-adminlte-input name="name" label="Nombre" placeholder="Nombre de la rosa" label-class="text-success" />
        <x-adminlte-input name="nbloque" label="Número de bloque" placeholder="Número de bloque"
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
    document.addEventListener('DOMContentLoaded', function () {
    var botonesEditar = document.querySelectorAll('.btnEditar');
    botonesEditar.forEach(function (boton) {
        boton.addEventListener('click', function (event) {
            event.preventDefault();
            var idRosa = boton.getAttribute('data-id');
            var nombreRosa = boton.getAttribute('data-name');
            var nbloqueRosa = boton.getAttribute('data-nbloque');
            // Colocar el ID de la rosa en el formulario de edición
            document.querySelector('#formEditRose').setAttribute('action', "{{ url('Rosas') }}/" + idRosa);
            // Rellenar los campos de nombre y color con los datos de la rosa
            document.querySelector('#modalEditRose input[name="name"]').value = nombreRosa;
            document.querySelector('#modalEditRose input[name="nbloque"]').value = nbloqueRosa;

            // Abrir el modal de edición
            $('#modalEditRose').modal('show');
        });
    });
    // Manejar la respuesta de actualización con SweetAlert
    $('#formEditRose').submit(function (event) {
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
      $('.btnActivar').on('click', function() {
          var flowerId = $(this).data('id');
          var nuevoEstado = $(this).data('status') == 1 ? 0 : 1;

          $.ajax({
              url: '{{ route("flowers.toggle", ":flowerId") }}'.replace(':flowerId', flowerId),
              method: 'PUT',
              data: {
                  _token: '{{ csrf_token() }}',
                  _method: 'PUT'
              },
              success: function(response) {
                  // Actualizar el estado en la tabla
                  $('#resp' + flowerId).html(nuevoEstado == 1 ? '<span class="text-success">Activo</span>' : '<span class="text-danger">Inactivo</span>');
                  // Actualizar el atributo data-status del botón
                  $('.btnActivar[data-id="' + flowerId + '"]').data('status', nuevoEstado);
                  // Cambiar el icono del botón de activar/desactivar
                  var iconClass = nuevoEstado == 1 ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger';
                  $('.btnActivar[data-id="' + flowerId + '"] i').removeClass().addClass('fa fa-lg fa-fw ' + iconClass);
              },
              error: function(xhr) {
                  console.error(xhr);
              }
          });
      });
  });
</script>








@stop