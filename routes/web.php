<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FoodandBeverageController;
use App\Http\Controllers\HotelLocationController;
use App\Http\Controllers\HotelReservationController;
use App\Http\Controllers\OtherServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TicketReservationController;
use App\Http\Controllers\TourLocationTransportController;
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

// Route::get('/temp', [ClientController::class, 'temp'])->name('temp');

Route::prefix('quotes')->group(function () {
    Route::get('/', [QuoteController::class, 'index'])->name('quotes.index');
    Route::get('/create', [QuoteController::class, 'create'])->name('quotes.create');
    Route::post('/', [QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotations/search', [QuoteController::class, 'search'])->name('quotations.search');
    Route::get('/quotations/{quotation}', [QuoteController::class, 'show'])->name('quotations.show');


    // Route::get('/create/form', [QuoteController::class, 'index'])->name('quotes.index');//
    // Route::post('/form/store', [QuoteController::class, 'store'])->name('quotes.form.store');
    // Route::post('/create/form', [QuoteController::class, 'hotel_store'])->name('quotes.form.store');
});

Route::prefix('ticket')->group(function (){
    Route::get('/add/ticket/form', [QuoteController::class, 'ticket'])->name('add.ticket');//
    Route::post('/ticket-reservations', [TicketReservationController::class, 'store'])->name('ticket.reservations.store');
    Route::get('/ticket-reservations/{id}/edit', [TicketReservationController::class, 'edit'])->name('ticket-reservations.edit');
    Route::put('/ticket-reservations/{id}', [TicketReservationController::class, 'update'])->name('ticket-reservations.update');
});

Route::prefix('hotel')->group(function (){
    Route::get('/add/hotel/form', [QuoteController::class, 'hotel'])->name('add.hotel');//
    Route::post('/hotel-reservations', [HotelReservationController::class, 'store'])->name('hotel.reservations.store');

    Route::post('/create/form', [HotelReservationController::class, 'hotel_store'])->name('quotes.form.store'); // Popup Modal Add Hotel Location

    Route::get('/hotel-reservations/{id}/edit', [HotelReservationController::class, 'edit'])->name('hotel_reservations.edit');
    Route::put('/hotel-reservations/{id}', [HotelReservationController::class, 'update'])->name('hotel_reservations.update');
});

Route::prefix('food')->group(function (){
    Route::get('/add/food/form', [QuoteController::class, 'food'])->name('add.food');//
    Route::post('/food-beverage', [FoodandBeverageController::class, 'store'])->name('food.beverage.store');

    Route::post('/create/form', [FoodandBeverageController::class, 'food_store'])->name('food.form.store'); // Popup Modal Add Hotel Location
});

Route::prefix('tour')->group(function (){
    Route::get('/add/tour/form', [QuoteController::class, 'tour'])->name('add.tour');//
    Route::post('/tour-location-transports', [TourLocationTransportController::class, 'store'])->name('tour.transports.store');

    Route::post('/create/form', [TourLocationTransportController::class, 'tour_store'])->name('tour.form.store'); // Popup Modal Add Hotel Location
});

Route::prefix('service')->group(function (){
    Route::get('/add/service/form', [QuoteController::class, 'service'])->name('add.service');//
    Route::post('/other-service', [OtherServiceController::class, 'store'])->name('other.service.store');

    Route::post('/create/form', [OtherServiceController::class, 'service_store'])->name('service.form.store'); // Popup Modal Add Hotel Location
});

Route::get('/view', function () {
    return view('partials.pdf.pdf');
});

