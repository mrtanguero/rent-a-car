<?php

use App\Models\Reservation;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
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

Route::get('/', function () {
    return view(
        'home',
        ['reservations' => Reservation::with(['car', 'client'])
            ->orderBy('date_from')
            ->paginate(10)]
    );
})->middleware(['auth'])->name('home');

Route::resource(
    'cars',
    CarController::class
)->middleware(['auth']);
Route::post('cars/select', [CarController::class, 'select'])->name('cars.select');

Route::resource(
    'clients',
    ClientController::class
)->middleware(['auth']);

Route::resource(
    'reservations',
    ReservationController::class
)->middleware(
    ['auth']
);

require __DIR__ . '/auth.php';
