<x-app-layout>
  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="container">
          @if (session('status'))
          <div class="alert alert-success text-center">
            {{ session('status') }}
          </div>
          @endif
          @if (session('warning'))
          <div class="alert alert-danger text-center">
            {{ session('warning') }}
          </div>
          @endif
          <h2 class="text-center mt-3 mb-5">{{ $client->name }}</h2>
          <div class="d-flex flex-column align-items-center">
            <table class="table w-50">
              <tbody>
                <tr>
                  <th class="w-50 text-right">Ime klijenta</th>
                  <td>{{ $client->name }}</td>
                </tr>
                <tr>
                  <th class="text-right">Država</th>
                  <td>{{ $client->country->name }}</td>
                </tr>
                <tr>
                  <th class="text-right">Broj pasoša / lične karte</th>
                  <td>{{ $client->id_document_number }}</td>
                </tr>
                <tr>
                  <th class="text-right">E-mail adresa</th>
                  <td>{{ $client->email }}</td>
                </tr>
                <tr>
                  <th class="text-right">Broj telefona</th>
                  <td>{{ $client->phone }}</td>
                </tr>
                <tr>
                  <th class="text-right">Dodatne napomene</th>
                  <td>{{ $client->additional_notes }}</td>
                </tr>
              </tbody>
            </table>
            <div class="d-flex mt-3">
              <a href="{{ route('clients.edit', ['client'=>$client]) }}" class="btn btn-primary">
                <div class="d-flex align-items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
                    <path
                      d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd"
                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                  <span>Izmijeni</span>
                </div>
              </a>
              <form action="{{ route('clients.destroy', ['client'=>$client]) }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-danger ms-1">
                  <div class="d-flex align-items-center">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-trash me-1" viewBox="0 0 16 16">
                      <path
                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                      <path fill-rule="evenodd"
                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                    <span>Obriši</span>
                  </div>
                </button>
              </form>
            </div>
          </div>
        </div>

        <h3 class="mt-5 mb-4 text-center">Rezervacije</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Od</th>
              <th>Do</th>
              <th>Vozilo</th>
              <th>Lokacija preuzimanja</th>
              <th>Lokacija vraćanja</th>
              <th>Cijena</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($client->reservations as $reservation)
            <tr class="align-middle">
              <td>
                {{ date("d.m.Y.", strtotime($reservation->date_from)) }}
              </td>
              <td>
                {{ date("d.m.Y.", strtotime($reservation->date_to)) }}
              </td>
              <td>{{ $reservation->car->name }}</td>
              <td>{{ $reservation->pickup_location->name }}</td>
              <td>{{ $reservation->return_location->name }}</td>
              <td>{{ $reservation->price }}€ </td>
              <td>
                <form action="{{ route('reservations.destroy', ['reservation'=>$reservation]) }}" method="POST">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-trash" viewBox="0 0 16 16">
                      <path
                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                      <path fill-rule="evenodd"
                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
</x-app-layout>