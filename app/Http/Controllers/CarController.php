<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarClass;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Extra;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'notes' => 'nullable|string'
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
            "additional_notes" => $request->notes ?? null
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
        return view('cars.show', compact(['car']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $car_classes = CarClass::all();
        return view('cars.edit', compact(['car', 'car_classes']));
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
        $current_year = date("Y");
        $request->validate([
            'name' => 'required|min:4|max:30',
            'plate_number' => 'required|min:6|max:15',
            'year' => "required|numeric|between:1950,$current_year",
            'car_class' => 'required|numeric',
            'seats_number' => 'required|numeric',
            'price_per_day' => 'required|numeric',
            'notes' => 'nullable|string'
        ]);

        if ($request->file('car_img')) {
            $photo_url = $request->file('car_img')->store('car-images');
            Storage::delete($car->photo_url);
            $car->photo_url = $photo_url;
        }

        $car->car_title = $request->name;
        $car->plate_number = $request->plate_number;
        $car->production_year = $request->year;
        $car->car_class_id = $request->car_class;
        $car->number_of_seats = $request->seats_number;
        $car->price_per_day = $request->price_per_day;
        $car->additional_notes = $request->notes ?? null;

        $car->save();

        return redirect(route('cars.show', ['car' => $car]))->with('status', 'Izmjene uspješno sačuvane!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect('cars')->with('status', 'Automobil je uspješno izbrisan');
    }

    public function select(Request $request)
    {
        if (strtotime($request->date_to) < strtotime($request->date_from)) {
            session(['date_error' => [
                'date_from' => $request->date_from,
                'date_to' => $request->date_to,
                'client_id' => $request->client_id,
                'pickup_location_id' => $request->pickup_location_id,
                'return_location_id' => $request->return_location_id,
                'car_class_id' => $request->car_class_id
            ]]);
            return back()->with(
                'error',
                'Datum kraja rezervacije mora biti poslije datuma početka iste!'
            );
        }

        $request->validate([
            'client_id' => 'required|numeric',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'pickup_location_id' => 'required|numeric',
            'return_location_id' => 'required|numeric'
        ]);


        $reservation = Reservation::make([
            "client_id" => $request->client_id,
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

        $cars = Car::with(
            ['reservations', 'car_class']
        )->get()->reject(function ($car) use ($request) {
            $flag = false;
            if ($request->car_class_id && $car->car_class->id != $request->car_class_id) {
                $flag = true;
            }
            foreach ($car->reservations as $reservation) {
                if (
                    (strtotime($reservation->date_from) <= strtotime($request->date_from)
                        && strtotime($reservation->date_to) >= strtotime($request->date_from))
                    || (strtotime($reservation->date_to) >= strtotime($request->date_to)
                        && strtotime($reservation->date_from) <= strtotime($request->date_to))
                    || (strtotime($reservation->date_from) >= strtotime($request->date_from)
                        && strtotime($reservation->date_to) <= strtotime($request->date_to))
                ) {
                    $flag = true;
                }
            }
            return $flag;
        });

        $locations = Location::all();
        $client = Client::find($request->client_id);
        $car_class = $request->car_class_id ? CarClass::find($request->car_class_id)->name : '';

        return view(
            'cars.select',
            compact(['cars', 'reservation', 'extras', 'locations', 'client', 'car_class'])
        );
    }
}
