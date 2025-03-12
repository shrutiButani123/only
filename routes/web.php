<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BuyerController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])->group(function (){
    Route::get('register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});


Route::get('cities/{id}', [RegisterController::class, 'cities'])->name('cities');

Route::middleware(['auth'])->group(function (){
    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
});

Route::get('/buyers', [BuyerController::class, 'index'])->name('buyers.index'); // List all buyers
Route::get('/buyers/create', [BuyerController::class, 'create'])->name('buyers.create'); // Show create form
Route::post('/buyers', [BuyerController::class, 'store'])->name('buyers.store'); // Store buyer data
// Route::get('/buyers/{id}', [BuyerController::class, 'show'])->name('buyers.show'); // Show buyer details
Route::get('/buyers/{id}/edit', [BuyerController::class, 'edit'])->name('buyers.edit'); // Show edit form
Route::put('/buyers/{id}', [BuyerController::class, 'update'])->name('buyers.update'); // Update buyer data
Route::delete('/buyers/{id}', [BuyerController::class, 'destroy'])->name('buyers.destroy'); // Delete buyer

Route::get('/buyers/export', [BuyerController::class, 'export'])->name('buyers.export');
