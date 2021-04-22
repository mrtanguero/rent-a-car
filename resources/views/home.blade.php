<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">
                {{-- Status message --}}
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                {{-- Content goes here --}}
                <div class="header d-flex align-items-center justify-between">
                    <h1>{{ __('Rezervacije') }}</h1>
                    <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                        {{ __('Create new') }}
                    </a>
                </div>
                <div class="table-responsive-md">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Od</th>
                                <th>Do</th>
                                <th>Klijent</th>
                                <th>Automobil</th>
                                <th>Lokacija preuzimanja</th>
                                <th>Lokacija vraćanja</th>
                                <th>Cijena</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ date("d.m.Y.", strtotime($reservation->date_from)) }}</td>
                                <td>{{ date("d.m.Y.", strtotime($reservation->date_to)) }}</td>
                                <td>
                                    <a href="{{ route('clients.show', ['client'=> $reservation->client]) }}">
                                        {{ $reservation->client->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('cars.show', ['car'=> $reservation->car]) }}">
                                        {{ $reservation->car->name }}
                                    </a>
                                </td>
                                <td>{{ $reservation->pickup_location->name }}</td>
                                <td>{{ $reservation->return_location->name }}</td>
                                <td>{{ $reservation->price }}€</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $reservations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- 
TODO:
- search filter za klijente
- Default img za kola? 
- Provjeri brisanje za povezane modele!
- Rekreiraj checkboxes 
--}}