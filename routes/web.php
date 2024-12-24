<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
    Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');
    Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/{client}/update', [ClientController::class, 'update'])->name('clients.update');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');

    // Soft delete routes
    Route::delete('/{client}/delete', [ClientController::class, 'destroy'])->name('clients.delete');
    Route::get('/trashed', [ClientController::class, 'trashed'])->name('clients.trashed');
    Route::post('/{client}/restore', [ClientController::class, 'restore'])->name('clients.restore');
});

Route::get('/temp', [ClientController::class, 'temp'])->name('temp');

// Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
// Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
// Route::post('/invoice-settings', [InvoiceController::class, 'updateSettings'])->name('invoice.settings.update');

Route::get('/quotes/create', [QuoteController::class, 'create'])->name('quotes.create');
Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
Route::post('/quote-settings', [QuoteController::class, 'updateSettings'])->name('quote.settings.update');
