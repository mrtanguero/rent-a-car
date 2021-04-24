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
                <div class="header d-flex align-items-center">
                    <h1 class="flex-grow-1">Rezervacije</h1>
                    <form action="{{ route('home') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="search"
                                value="{{ request()->query('search') }}">
                            <button type="submit" class="btn btn-outline-primary me-2" type="button" id="button-addon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                        Napravi novu rezervaciju
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                            <tr class="align-middle">
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
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('reservations.show', ['reservation'=>$reservation]) }}"
                                            type="submit" class="btn btn-primary me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                        </a>
                                        <form
                                            action="{{ route('reservations.destroy', ['reservation'=>$reservation]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
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