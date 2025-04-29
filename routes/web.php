<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard\Companies\Companies;
use App\Livewire\Dashboard\Companies\CompanyForm;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Manifests\ManifestForm;
use App\Livewire\Dashboard\Manifests\Manifests;
use App\Livewire\Dashboard\Reports\Companies as ReportsCompanies;
use App\Livewire\Dashboard\Reports\Manifests as ReportsManifests;
use App\Livewire\Dashboard\Settings;
use App\Livewire\Dashboard\Trips\TripForm;
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

    // Companies
    Route::get('empresas', Companies::class)->name('companies.index');
    Route::get('cadastrar-empresa', CompanyForm::class)->name('companies.create');
    Route::get('editar-empresa/{company}', CompanyForm::class)->name('companies.edit');
    Route::get('visualizar-empresa/{company}', ViewUser::class)->name('companies.view');

    // Trips
    Route::get('viagens', Trips::class)->name('trips.index');
    Route::get('viagens/cadastrar-viagem', TripForm::class)->name('trips.create');
    Route::get('viagens/editar-viagem/{trip}/editar', TripForm::class)->name('trips.edit');

    // Manifests
    Route::get('manifestos', Manifests::class)->name('manifests.index');
    Route::get('cadastrar-manifesto', ManifestForm::class)->name('manifests.create');
    Route::get('editar-manifesto/{manifest}/editar', ManifestForm::class)->name('manifests.edit');

    // Reports
    Route::get('relatorios-empresas', ReportsCompanies::class)->name('companyReport.index');
    Route::get('relatorios-manifestos', ReportsManifests::class)->name('manifestReport.index');
});

// Authentication routes
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});