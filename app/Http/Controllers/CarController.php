<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarClass;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Extra;
use App\Models\Location;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::with('car_class')->get();
        return view('cars.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carClasses = CarClass::all();
        return view('cars.create', ['carClasses' => $carClasses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_year = date("Y");
        $request->validate([
            'name' => 'required|min:4|max:30',
            'plate_number' => 'required|min:6|max:15',
            'year' => "required|numeric|between:1950,$current_year",
            'car_class' => 'required|numeric',
            'seats_number' => 'required|numeric',
            'price_per_day' => 'required|numeric',
            'additional_notes' => 'nullable|string'
        ]);

        $photo_url = $request->file('car_img')->store('car-images');

        Car::create([
            "car_title" => $request->name,
            "plate_number" => $request->plate_number,
            "production_year" => $request->year,
            "car_class_id" => (int)($request->car_class),
            "number_of_seats" => (int)($request->seats_number),
            "price_per_day" => (int)($request->price_per_day),
            "photo_url" => $photo_url,
            "additional_notes" => $request->additional_notes ?? null
        ]);

        return redirect('cars')->with('status', 'Automobil uspješno kreiran!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }

    public function select(Request $request)
    {
        $request->validate([
            'client_id' => 'required|numeric',
            // 'car_id' => 'required|numeric',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'pickup_location_id' => 'required|numeric',
            'return_location_id' => 'required|numeric'
        ]);
        $reservation = Reservation::make([
            "client_id" => $request->client_id,
            // "car_id" => $request->car_id,
            "date_from" => $request->date_from,
            "date_to" => $request->date_to,
            "pickup_location_id" => $request->pickup_location_id,
            "return_location_id" => $request->return_location_id,
        ]);

        $extras = [];
        foreach (Extra::all() as $extra) {
            if ($request->input("extra_" . $extra->id)) {
                $extras[] = $extra->id;
            }
        }

        $locations = Location::all();
        $client = Client::find($request->client_id);
        // Ovo mora u onom drugom kontroleru
        // $reservation->extras()->attach($extras);
        // return redirect('/')->with('status', 'Rezervacija uspješno dodata');

        return view(
            'cars.select',
            compact(['reservation', 'extras', 'locations', 'client'])
        );
    }
}
