<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard\Companies\Companies;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Settings;
use App\Livewire\Dashboard\Trips\Trips;
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
    Route::get('configuracoes/{config}/edit', Settings::class)->name('settings');

    Route::get('clientes', Users::class)->name('clientes.index');
    Route::get('cadastrar-cliente', Form::class)->name('clientes.create');
    Route::get('editar-cliente/{userId}', Form::class)->name('clientes.edit');
    Route::get('visualizar-cliente/{user}', ViewUser::class)->name('clientes.view');

    Route::get('empresas', Companies::class)->name('companies.index');
    Route::get('cadastrar-empresa', Form::class)->name('companies.create');
    Route::get('editar-empresa/{companyId}', Form::class)->name('companies.edit');
    Route::get('visualizar-empresa/{company}', ViewUser::class)->name('companies.view');

    Route::get('viagens', Trips::class)->name('trips.index');
    Route::get('cadastrar-viagem', Form::class)->name('trips.create');
    Route::get('editar-viagem/{companyId}', Form::class)->name('trips.edit');
    Route::get('visualizar-viagem/{company}', ViewUser::class)->name('trips.view');
});

// Authentication routes
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});