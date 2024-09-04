<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\BienvenidaUsuario;
use App\Mail\UsuarioEliminado;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


   
     public function index(Request $request)
     { 
         // Obtener la lista de usuarios
         $Administrador = User::all(); 
         // Pasar los datos a la vista
         return view('Administrador.index', compact('Administrador'));
     }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Administrador.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada del formulario
        $validacion = $request->validate([
            'name' => 'required|string|max:75',
            'lastname' => 'required|string|max:75',
            'email' => 'required|string|email|max:255|unique:users',
            'cedula' => 'required|string|max:10|unique:users',
            'telefono' => 'required|string|max:10',
      
        ]);

        // Crear un nuevo usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->cedula = $request->input('cedula');
        $user->phone = $request->input('telefono');
        $user-> password = bcrypt($request->input('cedula'));
     

        // Guardar el usuario en la base de datos
        $user->save();

        // Enviar correo electrónico de bienvenida al usuario
        Mail::to($user->email)->send(new BienvenidaUsuario($user));

        // Redireccionar a la página de inicio
        return back()->with('status', 'user-registered');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Administrador = User::find($id);
        return back();
    }

   
    public function update(Request $request, $id)
    {
        $Administrador= User::find($id);
        $Administrador->name = $request->input('name');
        $Administrador->lastname = $request->input('lastname');
        $Administrador->email = $request->input('email');
        $Administrador->cedula = $request->input('cedula');
        $Administrador->phone = $request->input('phone');
        $Administrador->password = bcrypt($request->input('password'));
        $Administrador->save();
        return response()->json(['message' => 'Los datos han sido actualizados correctamente']);
    }

    public function destroy(string $id)
    {
        // Encontrar el usuario que se va a eliminar
        $user = User::findOrFail($id);

        // Enviar correo electrónico de usuario eliminado
        Mail::to($user->email)->send(new UsuarioEliminado($user));

        // Eliminar el usuario
        $user->delete();

        // Redireccionar de nuevo a la página anterior
        return back();
    }


///Agregado recientemente
    public function asignarRoles(User $user)
    {
        $roles = Role::all();
        return view('Administrador.asignar_roles', compact('user', 'roles'));
    }

    public function syncRoles(User $user, Request $request)
{
    $user->syncRoles($request->roles);
    return redirect()->route('Administrador.index');
}
}
