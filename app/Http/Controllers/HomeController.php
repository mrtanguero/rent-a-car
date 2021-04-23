<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $search = $request->query('search', '');

        if ($search) {
            $reservations =  Reservation::with(['car', 'client'])
                ->join('clients', 'reservations.client_id', '=', 'clients.id')
                ->join('cars', 'reservations.car_id', '=', 'cars.id')
                ->join('locations', function ($join) {
                    $join->on('reservations.pickup_location_id', '=', 'locations.id')
                        ->orOn('reservations.return_location_id', '=', 'locations.id');
                })
                ->where('clients.name', 'like', "%$search%")
                ->orWhere('cars.name', 'like', "%$search%")
                ->orWhere('locations.name', 'like', "%$search%")
                ->select('reservations.*')
                ->orderBy('date_from')
                ->paginate(10)->withQueryString();
        } else {
            $reservations = Reservation::with(['car', 'client'])
                ->orderBy('date_from')
                ->paginate(10);
        }

        return view('home', ['reservations' => $reservations]);
    }
}
