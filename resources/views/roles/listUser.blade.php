@extends('adminlte::page')
@section('title', 'Permisos')
@section('content_header')
<h1 class="text-center"> <b>Administración de usarios y permisos</b></h1>
@stop
@section('content')
<div class="card-header container">
    
        <div class="col-lg-6 col-md-6 col-sm-12">
            <a href="{{ route('Administrador.create') }}" class="btn btn-primary"><b>Agregar Usuarios</b></a>
        </div>

</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="rosas" class="table table-striped table-bordered nowrap table-info">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $User)
                    <tr>
                        <td>{{ $User->id }}</td>
                        <td>{{ $User->name }}</td>
                        <td>{{ $User->email }}</td>
                        <td>
                            <a href="{{ route('asignar.edit', $User) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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
@stop