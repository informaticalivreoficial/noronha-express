<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Dashboard\Companies\Companies;
use App\Livewire\Dashboard\Companies\CompanyForm;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Manifests\{
    ManifestForm,
    ManifestView,
    Manifests
};
use App\Livewire\Dashboard\Permissions\Index as PermissionIndex;
use App\Livewire\Dashboard\Roles\Index as RoleIndex;
use App\Livewire\Dashboard\Reports\Companies as ReportsCompanies;
use App\Livewire\Dashboard\Reports\Manifests as ReportsManifests;
use App\Livewire\Dashboard\{
    Settings,
    TableOfValues
};
use App\Livewire\Dashboard\Trips\TripForm;
use App\Livewire\Dashboard\Trips\Trips;
use App\Livewire\Dashboard\Users\Form;
use App\Livewire\Dashboard\Users\Time;
use App\Livewire\Dashboard\Users\Users;
use App\Livewire\Dashboard\Users\ViewUser;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Dashboard routes
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin'], function () {
    Route::get('/', Dashboard::class)->name('admin');
    Route::get('configuracoes', Settings::class)->name('settings');
    Route::get('tabela-de-precos', TableOfValues::class)->name('finances.tableofvalue');

    Route::get('/cargos', RoleIndex::class)->name('admin.roles');
    Route::get('/permissoes', PermissionIndex::class)->name('admin.permissions');

    Route::get('usuarios/clientes', Users::class)->name('users.index');
    Route::get('usuarios/time', Time::class)->name('users.time');
    Route::get('usuarios/cadastrar', Form::class)->name('users.create');
    Route::get('usuarios/{userId}/editar', Form::class)->name('users.edit');
    Route::get('usuarios/{user}/visualizar', ViewUser::class)->name('users.view');

    // Companies
    Route::get('empresas', Companies::class)->name('companies.index');
    Route::get('empresas/cadastrar-empresa', CompanyForm::class)->name('companies.create');
    Route::get('empresas/editar-empresa/{company}', CompanyForm::class)->name('companies.edit');
    Route::get('empresas/visualizar-empresa/{company}', ViewUser::class)->name('companies.view');

    // Trips
    Route::get('viagens', Trips::class)->name('trips.index');
    Route::get('viagens/cadastrar-viagem', TripForm::class)->name('trips.create');
    Route::get('viagens/{trip}/editar', TripForm::class)->name('trips.edit');

    // Manifests
    Route::get('manifestos', Manifests::class)->name('manifests.index');
    Route::get('manifestos/cadastrar-manifesto', ManifestForm::class)->name('manifests.create');
    Route::get('manifestos/{manifest}/editar', ManifestForm::class)->name('manifests.edit');
    Route::get('manifestos/{manifest}/visualizar', ManifestView::class)->name('manifests.view');

    // Reports
    Route::get('relatorios-empresas', ReportsCompanies::class)->name('companyReport.index');
    Route::get('relatorios-manifestos', ReportsManifests::class)->name('manifestReport.index');
});

// Authentication routes
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});