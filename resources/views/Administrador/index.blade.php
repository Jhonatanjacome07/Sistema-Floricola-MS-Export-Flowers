@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<h1 class="text-center"> <b>Usuarios</b></h1>
@stop

@section('content')

@role('Administrador')
<div class="card-header container">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
      <a href="{{ route('Administrador.create') }}" class="btn btn-primary"><b>Agregar Usuarios</b></a>
    </div>
  </div>
</div>

@endrole

<div class="card">
  <div class="card-body">
      <div class="table-responsive">
        <table id="rosas" class="table table-striped table-bordered nowrap table-info">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Administrador as $User)
                <tr>
                    <td>{{ $User->cedula }}</td>
                    <td>{{ $User->name }}</td>
                    <td>{{ $User->lastname }}</td>
                    <td>{{ $User->email }}</td>
                    <td>
                        <button class="btnEditar btn btn-xs btn-default text-primary mx-1 shadow" data-id="{{ $User->id }}" data-name="{{ $User->name }}" data-lastname="{{ $User->lastname }}" data-email="{{ $User->email }}" data-cedula="{{ $User->cedula }}" data-phone="{{ $User->phone }}" title="Editar">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                        <form action="{{ route ('Administrador.destroy', $User) }}" method="POST" class="d-inline">
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


<x-adminlte-modal id="modalEditUser" title="Editar Usuario" theme="success" icon="fas fa-edit" size="lg"
  disable-animations>
  <form id="formEditUser" method="POST">
    @csrf
    @method('PUT')
    <x-adminlte-input name="name" label="Nombre" placeholder="Nombre" label-class="text-lightblue" />
    <x-adminlte-input name="lastname" label="Apellido" placeholder="Apellido" label-class="text-lightblue" />
    <x-adminlte-input name="email" type="email" label="Email" placeholder="Email" label-class="text-lightblue" />
    <x-adminlte-input name="cedula" type="text" maxlength="10" label="Cédula" placeholder="Cédula"
      label-class="text-lightblue" />
    <x-adminlte-input name="phone" type="text" maxlength="10" label="Teléfono" placeholder="Teléfono"
      label-class="text-lightblue" />
    <x-adminlte-input type="password" name="password" label="Contraseña" placeholder="Contraseña"
      label-class="text-lightblue" />
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
  document.addEventListener("DOMContentLoaded", function () {
    var botonesEditar = document.querySelectorAll('.btnEditar');

    botonesEditar.forEach(function (boton) {
      boton.addEventListener('click', function (event) {
        event.preventDefault();
        var idUsuario = boton.getAttribute('data-id');
        var nombreUsuario = boton.getAttribute('data-name');
        var apellidoUsuario = boton.getAttribute('data-lastname');
        var emailUsuario = boton.getAttribute('data-email');
        var cedulaUsuario = boton.getAttribute('data-cedula');
        var telefonoUsuario = boton.getAttribute('data-phone');

        // Colocar el ID del usuario en el formulario de edición
        document.querySelector('#formEditUser').setAttribute('action', "{{ url('Usuarios') }}/" + idUsuario);
        // Rellenar los campos de nombre, apellido, email, cedula y telefono con los datos del usuario
        document.querySelector('#modalEditUser input[name="name"]').value = nombreUsuario;
        document.querySelector('#modalEditUser input[name="lastname"]').value = apellidoUsuario;
        document.querySelector('#modalEditUser input[name="email"]').value = emailUsuario;
        document.querySelector('#modalEditUser input[name="cedula"]').value = cedulaUsuario;
        document.querySelector('#modalEditUser input[name="phone"]').value = telefonoUsuario;

        // Abrir el modal de edición
        $('#modalEditUser').modal('show');
      });
    });

    // Manejar la respuesta de actualización con SweetAlert
    $('#formEditUser').submit(function (event) {
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

    // Limitar el máximo de caracteres de cedula y telefono a 10 dígitos
    $('#modalEditUser input[name="cedula"], #modalEditUser input[name="phone"]').on('input', function () {
      this.value = this.value.slice(0, 10);
    });
  });
</script>



<script>
  $(document).ready(function(){
            $('.d-inline').submit(function(e){
              e.preventDefault();
             Swal.fire({
              title: "Estas seguro?",
              text: "Se va eliminar un Usuario!",
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