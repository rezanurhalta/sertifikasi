<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\PesertaController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/', fn() => redirect()->route('login'));


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

      Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);


});
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('skema', SkemaController::class);
    Route::resource('peserta', PesertaController::class);
   
  
});
Route::middleware(['auth', 'role:user'])->group(function () {
   
    
    // Dashboard User
    Route::get('/dashboard-user', [DashboardController::class, 'userIndex'])->name('dashboard.user');

    // Melihat dan Mengedit Milik Sendiri
    Route::get('/data-peserta', [DashboardController::class, 'userPesertaDetail'])->name('user.peserta.detail');
    Route::get('/data-peserta/edit', [DashboardController::class, 'userPesertaEdit'])->name('user.peserta.edit');
    Route::put('/data-peserta', [DashboardController::class, 'userPesertaUpdate'])->name('user.peserta.update');
});