<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth - Login
|--------------------------------------------------------------------------
*/

// Ruta login
Route::get('login', [Controller::class, 'login'])->name('login');
// Ruta register
Route::get('view-register', [Controller::class, 'register'])->name('view-register');
// Ruta reset passowrd
Route::get('view-reset-password', [Controller::class, 'resetPassword'])->name('view-reset-password');
// Ruta Home
Route::get('view-home', [Controller::class, 'home'])->name('view-home');

// Ruta registrar usuario
Route::post('register-user', [Controller::class, 'registerUser'])->name('register-user');
// Ruta logear usuario
Route::post('login-user', [Controller::class, 'loginUser'])->name('login-user');
// Ruta para validar username o email del usuario
Route::post('validate-user', [Controller::class, 'validateUser'])->name('validate-user');
/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

// Ruta deslogear usuario
Route::get('logout', [Controller::class, 'logout'])->name('logout');