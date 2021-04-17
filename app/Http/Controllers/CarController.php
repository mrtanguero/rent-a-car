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

        $photo_url = $request->file('car_img')->store('car-images');

        Car::create([
            "car_title" => $request->name,
            "plate_number" => $request->plate_number,
            "production_year" => $request->year,
            "car_class_id" => (int)($request->car_class),
            "number_of_seats" => (int)($request->seats_number),
            "price_per_day" => (int)($request->price_per_day),
            "photo_url" => $photo_url,
            "additional_notes" => $request->notes
        ]);

        // AKO ŽELIMO DA DAMO ID AUTA KAO IME FAJLA
        // $img = $request->file('car_img');
        // $path = $img->storeAs(
        //     'car-images',
        //     $car->id . '.' . $img->getClientOriginalExtension()
        // );
        // $car->photo_url = $img;
        // $car->save();
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
