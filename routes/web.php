<?php

use App\Models\Reclamacion; 
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ReclamacionController;
use App\Http\Controllers\MotivoController;
use App\Http\Controllers\RedController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\EstadoReclamacionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/test', function () {     
    return Reclamacion::first()->segmento->value;  
    /*return Inertia::render('Test',[
            'currentUser' => Auth::user(),            
        ]);*/
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {    
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	Route::resource('reclamaciones',ReclamacionController::class);
	Route::resource('motivosReclamaciones', MotivoController::class);
    Route::resource('estadoReclamacion', EstadoReclamacionController::class);
    Route::resource('red', RedController::class);
    Route::resource('servicio', ServicioController::class);
	Route::get('graficas', [ReclamacionController::class,'reclamacionesPorUsuario'])->name('graficas');
	Route::get('reportes', [ReclamacionController::class,'reportes'])->name('reportes');
	
});

require __DIR__.'/auth.php';
