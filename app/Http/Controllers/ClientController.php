<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Country;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');

        if ($search) {
            $clients = Client::with('country')
                ->join('countries', 'clients.country_id', '=', 'countries.id')
                ->where('clients.name', 'like', "%$search%")
                ->orWhere('countries.name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhere('id_document_number', 'like', "%$search%")
                ->select('clients.*')

                ->paginate(10)->withQueryString();
        } else {
            $clients = Client::with('country')->paginate(10);
        }

        return view('clients.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('clients.create', ['countries' => $countries]);
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
            'name' => 'required|string|between:4,50',
            'country_id' => 'required|numeric',
            'id_document_number' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'required|string',
            'additional_notes' => 'nullable|string'
        ]);

        Client::create([
            "name" => $request->name,
            "country_id" => (int)($request->country_id),
            "id_document_number" => $request->id_document_number,
            "email" => $request->email,
            "phone" => $request->phone,
            "additional_notes" => $request->notes
        ]);

        return redirect('clients')->with('status', 'Klijent uspješno kreiran');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $countries = Country::all();
        return view(
            'clients.edit',
            ['client' => $client, 'countries' => $countries]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|between:4,50',
            'country_id' => 'required|numeric',
            'id_document_number' => 'required|string|max:50',
            'email' => 'required|email',
            'phone' => 'required|string',
            'notes' => 'nullable|string'
        ]);
        $client->name = $request->name;
        $client->country_id = $request->country_id;
        $client->id_document_number = $request->id_document_number;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->additional_notes = $request->notes;

        $client->save();
        return redirect(route('clients.show', ['client' => $client]))->with('status', "Izmjene uspješno sačuvane!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if ($client->reservations->count()) {
            return redirect(route('clients.show', ['client' => $client]))->with('warning', 'Klijent je vezan aktivne rezervacije, morate prvo obrisati rezervacije da biste obrisali vozilo!');
        }

        $client->delete();
        return redirect(route('clients.index'))->with('status', 'Klijent uspješno izbrisan!');
    }
}
