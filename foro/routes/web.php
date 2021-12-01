<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
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
| Home 
|--------------------------------------------------------------------------
*/

// Ruta deslogear usuario
Route::get('logout', [Controller::class, 'logout'])->name('logout');

// Ruta formulario para crear post
Route::post('post-create-view', [PostController::class, 'createPostView'])->name('post-create-view');
// Ruta crear post
Route::post('create-post', [PostController::class, 'createNewPost'])->name('create-post');
// Ruta para acceder a un post especifico

// Ruta para crear comentario

//  Lista de usuarios
Route::get('user-list-view', [UserController::class, 'userListView'])->name('user-list-view');
// Editar Usuario
Route::get('user-edit-view', [UserController::class, 'userEditView'])->name('user-edit-view');
// Informacion de usuario
Route::get('user-info-view/{id}', [UserController::class, 'userInfoView'])->name('user-info-view');