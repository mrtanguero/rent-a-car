<x-app-layout>
  <div class="container mt-4">
    <div class="clientd shadow-sm">
      <div class="card-body">
        {{-- Status message --}}
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif
        {{-- Content goes here --}}
        <div class="header d-flex align-items-center">
          <h1 class="flex-grow-1">Klijenti</h1>
          <form action="{{ route('clients.index') }} " method="GET">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="search"
                value="{{ request()->query('search') }}" aria-label="Recipient's username"
                aria-describedby="button-addon2">
              <button type="submit" class="btn btn-outline-primary me-2" type="button" id="button-addon2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                  viewBox="0 0 16 16">
                  <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg></button>
            </div>
          </form>
          <a href="{{ route('clients.create') }}" class="btn btn-primary">
            Unesi novog klijenta
          </a>
        </div>
        <div class="table-responsive-lg">

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Ime i prezime</th>
                <th>Država</th>
                <th>Broj pasoša / lične</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Prva rezervacija</th>
                <th>Poslednja rezervacija</th>
                <th></th>
                {{-- <th>Dodatne informacije</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($clients as $client)
              <tr class="align-middle">
                <td><a href="{{ route('clients.show', ['client'=>$client]) }}">{{ $client->name }}</a></td>
                <td>{{ $client->country->name }}</td>
                <td>{{ $client->id_document_number }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->phone }}</td>
                {{-- <td>{{ $client->first_reservation->format('m.d.Y') }}</td> --}}
                <td>
                  {{ $client->first_reservation === 'N/A' ? 'N/A' : date("d.m.Y.", strtotime($client->first_reservation)) }}
                </td>
                <td>
                  {{ $client->last_reservation === 'N/A' ? 'N/A' : date("d.m.Y.", strtotime($client->last_reservation)) }}
                </td>
                {{-- <td>{{ $client->additional_notes }}</td> --}}
                <td>
                  <div class="d-flex">
                    <a href="{{ 'clients/' . $client->id . '/edit' }}" class="btn btn-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                          d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                      </svg></a>
                    <form action="{{ route('clients.destroy', ['client'=>$client]) }}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger ms-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-trash" viewBox="0 0 16 16">
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
            {{ $clients->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>