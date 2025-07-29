<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ArticleImageUploadController;
use App\Livewire\Home\Index;
use App\Livewire\Users\Index as UserIndex;
use App\Livewire\Users\Create as UserCreate;
use App\Livewire\Users\Detail as UserDetail;
use App\Livewire\Roles\Index as RoleIndex;
use App\Livewire\Roles\Create as RoleCreate;
use App\Livewire\Roles\Edit as RoleEdit;
use App\Livewire\Permissions\Index as PermissionIndex;
use App\Livewire\Permissions\Create as PermissionCreate;
use App\Livewire\Permissions\Edit as PermissionEdit;
use App\Livewire\Articles\Index as ArticleIndex;
use App\Livewire\Articles\Create as ArticleCreate;
use App\Livewire\Articles\Edit as ArticleEdit;
use App\Livewire\Articles\Show as ArticleShow;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/', Index::class)->name('welcome');

Route::view('home', 'home')
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', Index::class)->name('home');

});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', UserIndex::class)->middleware('can:view.users')->name('users.index');
    Route::get('/users/create', UserCreate::class)->middleware('can:create.users')->name('users.create');
    Route::get('/users/{user}/detail', UserDetail::class)->middleware('can:view.users')->name('users.detail');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/roles', RoleIndex::class)->name('roles.index');
    Route::get('/roles/create', RoleCreate::class)->name('roles.create');
    Route::get('/roles/{role}/edit', RoleEdit::class)->name('roles.edit');
});


Route::prefix('permissions')->name('permissions.')->group(function () {
    Route::get('/permisions', PermissionIndex::class)->name('index');
    Route::get('/create', PermissionCreate::class)->name('create');
    Route::get('/{id}/edit', PermissionEdit::class)->name('edit');
});

Route::get('/roles/{role}/permissions', \App\Livewire\Roles\AssignPermissions::class)->name('roles.permissions');

Route::middleware(['auth'])->prefix('articles')->name('articles.')->group(function () {
    Route::get('/', ArticleIndex::class)->name('index');
    Route::get('/create', ArticleCreate::class)->name('create');
    Route::get('/{article}/edit', ArticleEdit::class)->name('edit');
    Route::get('/{article}', ArticleShow::class)->name('show');
});

// Pindahkan ke luar grup agar tidak double "articles"
Route::post('/articles/upload-image', [ArticleImageUploadController::class, 'store'])
    ->name('articles.upload-image');



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