<?php

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
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');
    Route::get('/seller', [App\Http\Controllers\SellerController::class, 'index'])->name('seller');

    Route::get('/ticket', [App\Http\Controllers\TicketController::class, 'index'])->name('ticket');
    Route::get('/ticket-reply/{idTicket}', [App\Http\Controllers\TicketController::class, 'edit'])->name('ticket-reply');
    Route::post('/ticket-reply-send', [App\Http\Controllers\TicketController::class, 'update'])->name('ticket-reply-send');
    Route::put('/ticket-status-update/{idTicket}', [App\Http\Controllers\TicketController::class, 'updateTicket'])->name('ticket-status-update');
    Route::get('/ticket-create', [App\Http\Controllers\TicketController::class, 'create'])->name('ticket-create');
    Route::post('/ticket-save', [App\Http\Controllers\TicketController::class, 'store'])->name('ticket-save');
});
