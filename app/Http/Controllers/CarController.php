<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarClass;
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
}
