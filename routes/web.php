<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::resource(
        'cars',
        CarController::class
    );
    Route::post(
        'cars/select',
        [CarController::class, 'select']
    )->name('cars.select');

    Route::resource(
        'clients',
        ClientController::class
    );

    Route::resource(
        'reservations',
        ReservationController::class
    )->except(['index']);
});


require __DIR__ . '/auth.php';
