@extends('adminlte::page')
@section('title', 'Permisos')
@section('content_header')
<h1 class="text-center"> <b>Administración de Permisos</b></h1>
@stop
@section('content')
<div class="card-header">
    <x-adminlte-button label="Nuevo" theme="info" icon="fas fa-lg fa-save" class="float-rigth" data-toggle="modal"
        data-target="#modalPurple" />
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="rosas" class="table table-striped table-bordered nowrap table-info">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permisos as $permiso)
                    <tr>
                        <td>{{ $permiso->id }}</td>
                        <td>{{ $permiso->name }}</td>
                        <td>
                            <button class="btnEditar btn btn-xs btn-default text-primary mx-1 shadow" data-id="{{ $permiso->id }}" data-name="{{ $permiso->name }}" title="Editar">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>
                            <form action="{{ route('permisos.destroy', $permiso) }}" method="POST" class="d-inline">
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

{{-- Themed --}}
<x-adminlte-modal id="modalPurple" title="Nuevo permiso" theme="info" icon="fas fa-bolt" size='lg' disable-animations>
    <form action="{{ route('permisos.store') }}" method="POST">
        @csrf
        <x-adminlte-input name="nombre" label="Nombre" placeholder="Aquí su permiso" label-class="text-lightblue">
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-button type="submit" label="Guardar" theme="info" icon="fas fa-lg fa-save" />
    </form>
</x-adminlte-modal>

{{-- Modal de Edición de Permiso --}}
<x-adminlte-modal id="modalEditPermission" title="Editar Permiso" theme="success" icon="fas fa-edit" size="lg"
    disable-animations>
    <form id="formEditPermission" method="POST">
        @csrf
        @method('PUT')
        <x-adminlte-input name="name" label="Nombre" placeholder="Nombre del permiso" label-class="text-success" />
        <x-adminlte-button type="submit" label="Actualizar" theme="success" icon="fas fa-save" />
    </form>
</x-adminlte-modal>

@stop
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap4.css">

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap4.js"></script>

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
                var idPermiso = boton.getAttribute('data-id');
                var nombrePermiso = boton.getAttribute('data-name');
                // Colocar el ID del permiso en el formulario de edición
                document.querySelector('#formEditPermission').setAttribute('action', "{{ url('permisos') }}/" + idPermiso);
                // Rellenar el campo de nombre con el nombre del permiso
                document.querySelector('#modalEditPermission input[name="name"]').value = nombrePermiso;

                // Abrir el modal de edición
                $('#modalEditPermission').modal('show');
            });
        });
        // Manejar la respuesta de actualización con SweetAlert
        $('#formEditPermission').submit(function (event) {
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
    $(document).ready(function(){
              $('.d-inline').submit(function(e){
                e.preventDefault();
               Swal.fire({
                title: "Estas seguro?",
                text: "Se va eliminar un Permiso!",
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