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
          <h1>{{ __('Clients') }}</h1>
          <a href="{{ route('clients.create') }}" class="btn btn-primary">
            {{ __('Create new') }}
          </a>
        </div>
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
              {{-- <th>Dodatne informacije</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($clients as $client)
            <tr>
              <td>{{ $client->name }}</td>
              <td>{{ $client->country->name }}</td>
              <td>{{ $client->id_document_number }}</td>
              <td>{{ $client->email }}</td>
              <td>{{ $client->phone }}</td>
              <td>{{ $client->first_reservation }}</td>
              <td>{{ $client->last_reservation }}</td>
              {{-- <td>{{ $client->additional_notes }}</td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>