<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Users\Create;
use App\Livewire\Dashboard\Users\Form;
use App\Livewire\Dashboard\Users\Users;
use App\Livewire\Dashboard\Users\ViewUser;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Dashboard routes
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin'], function () {
    Route::get('/', Dashboard::class)->name('admin');

    Route::get('clientes', Users::class)->name('clientes.index');
    Route::get('cadastrar-cliente', Form::class)->name('clientes.create');
    Route::get('editar-cliente/{userId}', Form::class)->name('clientes.edit');
    Route::get('visualizar-cliente/{user}', ViewUser::class)->name('clientes.view');
});

// Authentication routes
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});