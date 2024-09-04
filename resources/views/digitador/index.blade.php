@extends('adminlte::page')

@section('title', 'Digitador')

@section('content_header')
<h1 class="text-center"> <b>Lista de Bonches ingresados</b></h1>
@stop

@section('content')


<div class="card-header container">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
      <a href="{{ route('digitador.create') }}" class="btn btn-primary"><b>Agregar</b></a>
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
                      <th>fecha</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $contador = 0; ?>
                  @foreach ($Bonche as $Bonches)
                  <tr>
                      <td>
                        <?php echo $contador= $contador + 1;?>
                      </td>
                      <td>{{ $Bonches->name }}</td>
                      <td>{{ $Bonches->nbloque }}</td>
                      <td>{{ $Bonches->cantidadtallos }}</td>
                      <td>{{ date('d/m/Y', strtotime($Bonches->fecha)) }}</td>

                      <td>
                          <button class="btnEditar btn btn-xs btn-default text-primary mx-1 shadow"
                              data-id="{{ $Bonches->id }}" data-name="{{ $Bonches->name }}"
                              data-nbloque="{{ $Bonches->nbloque }}"
                              data-cantidadtallos="{{ $Bonches->cantidadtallos }}"
                              data-codigobarras="{{ $Bonches->codigobarras }}" 
                              data-fecha="{{ $Bonches->fecha }}"
                              data-medida="{{ $Bonches->medida }}"
                              title="Editar">
                              <i class="fa fa-lg fa-fw fa-pen"></i>
                          </button>
                          <form action="{{ route('digitador.destroy', $Bonches) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                  title="Eliminar">
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

  <x-adminlte-modal id="modalEditarBonche" title="Editar Bonche" theme="success" icon="fas fa-edit" size="lg"
    disable-animations>
    <form id="formEditarBonche" method="POST" action="{{ route('digitador.update', ['digitador' => $Bonches->id]) }}">
      @csrf
      @method('PUT')
      <x-adminlte-input name="name" label="Nombre" placeholder="Nombre de la variedad" label-class="text-success"
        value="{{ old('name', $Bonches->name) }}" />
      <x-adminlte-input name="nbloque" label="Número de bloque" placeholder="Número de bloque"
        label-class="text-success" value="{{ old('nbloque', $Bonches->nbloque) }}" />
      <x-adminlte-input name="cantidadtallos" label="Cantidad de tallos" placeholder="Cantidad de tallos"
        label-class="text-success" value="{{ old('cantidadtallos', $Bonches->cantidadtallos) }}" />
      <x-adminlte-input name="medida" label="Medida" placeholder="Medida" label-class="text-success"
        value="{{ old('plaga', $Bonches->medida) }}" />
      <x-adminlte-input type="date" name="fecha" label="Fecha" placeholder="Fecha" label-class="text-success" />
      <x-adminlte-input name="codigobarras" label="Código de barras" placeholder="Código de barras"
        label-class="text-success" value="{{ old('plaga', $Bonches->codigobarras) }}" />
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
              var idRecepcion = boton.getAttribute('data-id');
              var name = boton.getAttribute('data-name');
              var nbloque = boton.getAttribute('data-nbloque');
              var cantidadtallos = boton.getAttribute('data-cantidadtallos');
              var medida = boton.getAttribute('data-medida');
              var codigobarras = boton.getAttribute('data-codigobarras');
              var fechaRecepcion = boton.getAttribute('data-fecha');

              document.querySelector('#formEditarBonche').setAttribute('action', "{{ url('digitador') }}/" + idRecepcion);

              document.querySelector('#formEditarBonche [name="name"]').value = name;
              document.querySelector('#formEditarBonche [name="nbloque"]').value = nbloque;
              document.querySelector('#formEditarBonche [name="cantidadtallos"]').value = cantidadtallos;
              document.querySelector('#formEditarBonche [name="medida"]').value = medida;
              document.querySelector('#formEditarBonche [name="codigobarras"]').value = codigobarras;
              document.querySelector('#formEditarBonche [name="fecha"]').value = fechaRecepcion;

              $('#modalEditarBonche').modal('show');
          });
      });

      $('#formEditarBonche').submit(function (event) {
          event.preventDefault();
          var formData = $(this).serialize();
          var actionUrl = $(this).attr('action');

          $.ajax({
              url: actionUrl,
              method: 'PUT',
              data: formData,
              success: function (response) {
                  Swal.fire({
                      title: 'Éxito',
                      text: response.message,
                      icon: 'success',
                      timer: 2000
                  }).then(function () {
                      location.reload();
                  });
              },
              error: function (xhr) {
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