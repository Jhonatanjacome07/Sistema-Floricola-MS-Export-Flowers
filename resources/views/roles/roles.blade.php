@extends('adminlte::page')
@section('title', 'Roles')
@section('content_header')
<h1 class="text-center"> <b>Administración de Roles</b></h1>
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
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
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

<x-adminlte-modal id="modalPurple" title="Nuevo Rol" theme="info" icon="fas fa-bolt" size='lg' disable-animations>
    <form action="{{ route('roles.store') }}" method="POST"> 
        @csrf 
        <x-adminlte-input name="nombre" label="Nombre"
            placeholder="Aquí su rol" label-class="text-lightblue">
            <x-slot name="prependSlot">
                <div class="input-group-text"> 
                    <i class="fas fa-user text-lightblue"></i>
                </div>
            </x-slot>
        </x-adminlte-input>
        <x-adminlte-button type="submit" label="Guardar" theme="info" icon="fas fa-lg fa-save" />
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
    $(document).ready(function(){
              $('.d-inline').submit(function(e){
                e.preventDefault();
               Swal.fire({
                title: "Estas seguro?",
                text: "Se va eliminar un Rol!",
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