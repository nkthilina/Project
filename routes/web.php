<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// user routes
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
// Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// end user routes

// admin routes
// Route::group(['prefix'=>'admin', 'middleware' => 'redirectAdmin'], function () {
//     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
//     Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    //Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
//});

// Route::middleware('auth')->group(function () {
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });

// end admin routes
// Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// admin routes new
// Route::middleware(['auth', 'user-access:admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });
// end admin routes new

require __DIR__.'/auth.php';
