<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Home\Index;
use App\Livewire\Users\Index as UserIndex;
use App\Livewire\Users\Create as UserCreate;
use App\Livewire\Users\Edit as UserEdit;
use App\Livewire\Roles\Index as RoleIndex;
use App\Livewire\Roles\Create as RoleCreate;
use App\Livewire\Roles\Edit as RoleEdit;
use App\Livewire\Permissions\Index as PermissionIndex;
use App\Livewire\Permissions\Create as PermissionCreate;
use App\Livewire\Permissions\Edit as PermissionEdit;
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', Index::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/users/create', UserCreate::class)->name('users.create');
    Route::get('/users/{id}/edit', UserEdit::class)->name('users.edit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/roles', RoleIndex::class)->name('roles.index');
    Route::get('/roles/create', RoleCreate::class)->name('roles.create');
    Route::get('/roles/{role}/edit', RoleEdit::class)->name('roles.edit');
});


Route::prefix('permissions')->name('permissions.')->group(function () {
    Route::get('/', PermissionIndex::class)->name('index');
    Route::get('/create', PermissionCreate::class)->name('create');
    Route::get('/{id}/edit', PermissionEdit::class)->name('edit');
});

require __DIR__.'/auth.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});