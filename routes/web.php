<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipanteController;
use Illuminate\Support\Facades\Auth;
use App\Models\Participante;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PropuestaTallerController;
use App\Http\Controllers\AcreditacionController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {

    return view('dashboard');

})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ACREDITACIÓN CONGRESO
Route::middleware(['auth'])->group(function () {

    Route::get('/acreditaciones', [AcreditacionController::class, 'panel']);

});

Route::get('/acreditar/congreso/{fecha}', [AcreditacionController::class, 'acreditarCongreso']);
Route::post('/acreditar/congreso/{fecha}', [AcreditacionController::class, 'guardarAcreditacionCongreso']);
Route::get(
    '/ver-qr/congreso/{dia}',
    [AcreditacionController::class, 'verQrCongreso']
);

// ACREDITACIÓN TALLERES
Route::get(
    '/acreditar/taller/{id}',
    [AcreditacionController::class, 'acreditarTaller']
);

Route::post(
    '/acreditar/taller/{id}',
    [AcreditacionController::class, 'guardarAcreditacionTaller']
);

Route::get(
    '/ver-qr/taller/{id}',
    [AcreditacionController::class, 'verQrTaller']
);

// CERTIFICADOS
Route::get(
    '/certificados',
    [AcreditacionController::class, 'certificados']
);

Route::post(
    '/certificados',
    [AcreditacionController::class, 'buscarCertificados']
);


Route::get(

    '/certificado/congreso/{user}/{fecha}',

    [AcreditacionController::class, 'certificadoCongreso']

);

Route::get(

    '/certificado/taller/{user}/{taller}',

    [AcreditacionController::class, 'certificadoTaller']

);

// INSCRIBIR ESTUDIANTES
use App\Http\Controllers\EstudianteController;

Route::get('/buscar-escuelas', [EstudianteController::class, 'buscarEscuelas']);

Route::get('/cargar-estudiantes', [EstudianteController::class, 'formulario']);

Route::post('/cargar-estudiantes', [EstudianteController::class, 'guardar']);

// Route::middleware(['auth'])->group(function () {

//     Route::get('/talleres', [TallerController::class, 'index'])->name('talleres.index');

// });

// VISTA PARA INSCRIPTOS

Route::get('/participantes', [ParticipanteController::class, 'index'])
    ->middleware(['auth'])
    ->name('participantes.index');

// PROPUESTAS TALLERES
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/propuestas-talleres', [PropuestaTallerController::class, 'index'])
        ->name('propuestas.index');

     Route::post('/admin/propuestas-talleres/{propuesta}/estado',

        [PropuestaTallerController::class, 'cambiarEstado'])

        ->name('propuestas.estado');

    Route::get('/admin/propuestas-talleres/{propuesta}/editar',

        [PropuestaTallerController::class, 'edit'])

        ->name('propuestas.edit');

    Route::put('/admin/propuestas-talleres/{propuesta}',

        [PropuestaTallerController::class, 'update'])

        ->name('propuestas.update');

    Route::post(
    '/admin/propuestas-talleres/{propuesta}/crear-taller',
    [PropuestaTallerController::class, 'crearTaller']
)->name('propuestas.crearTaller');

});
    Route::get('/proponer-taller', [PropuestaTallerController::class, 'create'])
        ->name('propuestas.create');

    Route::post('/proponer-taller', [PropuestaTallerController::class, 'store'])
        ->name('propuestas.store');
// FIN PROPUESTAS TALLERES

// MESAS Y STANDS
use App\Http\Controllers\ProgramaController;

Route::get('/mesas', [ProgramaController::class, 'mesas'])
    ->name('mesas');

Route::get('/stands', [ProgramaController::class, 'stands'])
    ->name('stands');

// FIN DE MESAS Y STANDS

Route::get('/talleres', [TallerController::class, 'index'])->name('talleres');

Route::post('/inscribirse/{id}', [InscripcionController::class, 'store'])
    ->middleware('auth')
    ->name('inscribirse');

Route::get('/consultar-inscripcion', [InscripcionController::class, 'formPublico']);
Route::post('/consultar-inscripcion', [InscripcionController::class, 'buscarPublico']);

require __DIR__.'/auth.php';
