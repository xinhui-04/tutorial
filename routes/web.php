<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ProfileController;
use App\Models\ContactUs;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome', ['menuItems' => MenuItem::all()]);
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', [ContactUsController::class, 'index'])->name('contact.index');
Route::Post('/contact', [ContactUsController::class, 'store'])->name('contact.store');

// shows related dashboard based on role
Route::get('/app', function () {
    if (Auth::user()->role === 'admin') {
        return view('admin.dashboard');
    }

    if (Auth::user()->role === 'staff') {
        return view('staff.dashboard');
    }

    return view('welcome', ['menuItems' => MenuItem::all()]);
})->middleware(['auth', 'verified'])->name('dashboard');

// used route modal binding
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [RegisteredUserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [RegisteredUserController::class, 'store'])->name('users.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/menu', [MenuItemController::class, 'index'])->name('menu.index');
    Route::get('/menu/create', [MenuItemController::class, 'create'])->name('menu.create');
    Route::post('/menu/create', [MenuItemController::class, 'store'])->name('menu.store');
    Route::get('/menu/edit/{item}', [MenuItemController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/edit/{item}', [MenuItemController::class, 'update'])->name('menu.update');
    Route::delete('/menu/delete/{item}', [MenuItemController::class, 'destroy'])->name('menu.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/feedback', [ContactUsController::class, 'feedback'])->name('contact-us.feedback'); 
});

require __DIR__ . '/auth.php';
