<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\DigitadorController;
use App\Http\Controllers\FlorNacionalController;
use App\Http\Controllers\PlagasController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\FlowersController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecepcionistaController;
use App\Http\Controllers\RoleController;
use App\Models\Flowers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.welcome');
  })->name('home.welcome');

  

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
     //Ruta para agregar plagas
     Route::resource('/Plagas', PlagasController::class )->names('plagas');
     Route::put('/plagas/{plaga}/toggle', [PlagasController::class, 'toggle'])->name('plagas.toggle');
        //Ruta para agregar usuarios
     Route::resource('/Usuarios', AdministradorController::class)->names('Administrador');
     //Rutas para Agregar y cambiar estados de las rosas 
     Route::resource('/Rosas', FlowersController::class)->names('flowers');
     Route::put('/flowers/{flower}/toggle', [FlowersController::class, 'toggle'])->name('flowers.toggle');
    //Ruta para recepcón
    Route:: resource('/recepcion', RecepcionistaController::class)->names('recepcion');
    Route::get('/reporte', [RecepcionistaController::class, 'reporte'])->name('recepcionreporte');
    Route::get('/generar-pdf', [RecepcionistaController::class, 'generarPDF'])->name('generar_pdf');
    Route::post('/obtener-bloques', 'RecepcionistaController@obtenerBloques')->name('obtenerBloques');

    //Ruta para FlorNacional
    Route:: resource('/flornacional', FlorNacionalController::class)->names('flornacional');
    Route::get('/reporte-flor-nacional', [FlorNacionalController::class, 'reporteFlorNacional'])->name('flornacionalreporte');
    Route::get('/reporte-flor-nacional-parametros', [FlorNacionalController::class, 'reporteFlorNacionalParametros'])->name('flornacionalreporteparametros');

    //Ruta para Boncheo
    Route:: resource('/digitador', DigitadorController::class)->names('digitador');
    Route::get('/reporte-bonches', [DigitadorController::class, 'reporte'])->name('boncheoreporte');


    //Rutas para los roles, permisos y asignaciones
    Route:: resource('/roles', RoleController::class)->names('roles');
    Route:: resource('/permisos', PermisoController::class)->names('permisos');
    Route:: resource('/asignar', AsignarController::class)->names('asignar');


});
//Rutas de desarrollador
Route::get('/inicio', [AdminController::class, 'index'])->name('admin.index');



//Rutas para agregar usuarios, crear, mostrar, editar, elimiar

Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios', [AdministradorController::class, 'index'])->name('Administrador.index');
    Route::get('/usuarios/create', [AdministradorController::class, 'create'])->name('Administrador.create');
    Route::post('/usuarios', [AdministradorController::class, 'store'])->name('Administrador.store');
    Route::get('/usuarios/{user}/edit', [AdministradorController::class, 'edit'])->name('Administrador.edit');
    Route::put('/usuarios/{user}', [AdministradorController::class, 'update'])->name('Administrador.update');
    Route::delete('/usuarios/{user}', [AdministradorController::class, 'destroy'])->name('Administrador.destroy');
});



Route::middleware('auth:sanctum')->group(function () {
//Rutas para flowers, crear, mostrar, editar, elimiar 
Route::get('/flowers', [FlowersController::class, 'index'])->name('flowers.index');
Route::get('/flowers/create', [FlowersController::class, 'create'])->name('flowers.create');
Route::post('/flowers', [FlowersController::class, 'store'])->name('flowers.store');
Route::get('/flowers/{flowers}/edit', [FlowersController::class, 'edit'])->name('flowers.edit');
Route::put('/flowers/{flowers}', [FlowersController::class, 'update'])->name('flowers.update');
Route::delete('/flowers/{flowers}/delete', [FlowersController::class, 'destroy'])->name('flowers.destroy');

});


require __DIR__.'/auth.php';
