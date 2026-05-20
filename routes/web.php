<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipanteController;
use Illuminate\Support\Facades\Auth;
use App\Models\Participante;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PropuestaTallerController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {

    $participante = Participante::where('user_id', Auth::id())->first();

    if (!$participante) {
        return redirect()->route('perfil.create');
    }

    return view('dashboard');

})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/completar-perfil', [ParticipanteController::class, 'create'])->name('perfil.create');
    Route::post('/completar-perfil', [ParticipanteController::class, 'store'])->name('perfil.store');
});

// Route::middleware(['auth'])->group(function () {

//     Route::get('/talleres', [TallerController::class, 'index'])->name('talleres.index');

// });

// PROPUESTAS TALLERES
    Route::get('/proponer-taller', [PropuestaTallerController::class, 'create'])
        ->name('propuestas.create');

    Route::post('/proponer-taller', [PropuestaTallerController::class, 'store'])
        ->name('propuestas.store');
// FIN PROPUESTAS TALLERES

Route::get('/talleres', [TallerController::class, 'index'])->name('talleres');

Route::post('/inscribirse/{id}', [InscripcionController::class, 'store'])
    ->middleware('auth')
    ->name('inscribirse');

Route::get('/consultar-inscripcion', [InscripcionController::class, 'formPublico']);
Route::post('/consultar-inscripcion', [InscripcionController::class, 'buscarPublico']);

require __DIR__.'/auth.php';
