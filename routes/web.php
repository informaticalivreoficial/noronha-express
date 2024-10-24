<?php

use App\Livewire\Admin\UserComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'admin.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'livewire.admin.users.profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('usuarios', UserComponent::class)->name('users.index')->middleware(['auth']);

require __DIR__.'/auth.php';
