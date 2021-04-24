<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarClass;
use App\Models\Client;
use App\Models\Extra;
use App\Models\Location;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = Car::orderBy('name')->get();
        $car_classes = CarClass::all();
        $clients = Client::orderBy('name')->get();
        $locations = Location::all();
        $extras = Extra::all();
        return view(
            'reservations.create',
            compact(['cars', 'car_classes', 'clients', 'extras', 'locations'])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|numeric',
            'car_id' => 'required|numeric',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'pickup_location_id' => 'required|numeric',
            'return_location_id' => 'required|numeric'
        ]);

        $reservation = Reservation::create([
            "client_id" => $request->client_id,
            "car_id" => $request->car_id,
            "date_from" => $request->date_from,
            "date_to" => $request->date_to,
            "pickup_location_id" => $request->pickup_location_id,
            "return_location_id" => $request->return_location_id,
        ]);

        $extras = session('extras');
        if ($extras) {
            $reservation->extras()->attach($extras);
        }
        session(['extras' => null]);
        return redirect('/')->with('status', 'Rezervacija uspješno dodata');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', ['reservation' => $reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $cars = Car::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();
        $locations = Location::all();
        $extras = Extra::all();
        return view(
            'reservations.edit',
            compact(['reservation', 'cars', 'clients', 'extras', 'locations'])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'client_id' => 'required|numeric',
            'car_id' => 'required|numeric',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'pickup_location_id' => 'required|numeric',
            'return_location_id' => 'required|numeric'
        ]);

        $reservation->fill([
            'client_id' => $request->client_id,
            'car_id' => $request->car_id,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'pickup_location_id' => $request->pickup_location_id,
            'return_location_id' => $request->return_location_id
        ]);

        $extras = [];
        foreach (Extra::all() as $extra) {
            $string = 'extra_' . $extra->id;
            if ($request->has($string)) {
                $extras[] = $extra->id;
            }
        }

        $reservation->extras()->sync($extras);
        $reservation->save();
        return redirect(
            route('reservations.show', ['reservation' => $reservation])
        )->with('status', 'Rezervacija uspješno izmijenjena');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        if (request()->route()->uri === 'reservations/{reservation}') {
            return redirect(route('home'))->with('status', 'Rezervacija je uspješno izbrisana!');
        }
        dd('Jok');
        return back()->with('status', 'Rezervacija je uspješno izbrisana!');
    }
}
