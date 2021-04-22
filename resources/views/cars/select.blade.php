<x-app-layout>
  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
        @php
        session(['extras' => $extras]);
        @endphp

        <div>
          <h2 class="mb-3">Podaci koje ste unijeli:</h2>
          <strong>Klijent: </strong>{{ $client->name }}
          <br /><strong>Od: </strong>{{ date("d.m.Y.", strtotime($reservation->date_from)) }}
          <br /><strong>Do: </strong>{{ date("d.m.Y.", strtotime($reservation->date_to)) }}
          <br /><strong>Lokacija preuzimanja vozila:
          </strong>{{ $locations->find($reservation->pickup_location_id)->name }}
          <br /><strong>Lokacija vraćanja vozila:
          </strong>{{ $locations->find($reservation->return_location_id)->name }}
          @if ($car_class)
          <br /><strong>Odabrana klasa automobila: </strong>{{ $car_class }}
          @endif
          </p>
        </div>
        {{-- Cars (filtered) --}}
        <form id="select-car" action="{{ route('reservations.store') }}" method="POST">
          <div class="row g-3 mt-1">
            @csrf

            <input type="hidden" name="client_id" value={{ old('client_id', $reservation->client_id) }}>
            <input type="hidden" name="date_from" value={{ old('date_from', $reservation->date_from) }}>
            <input type="hidden" name="date_to" value={{ old('date_to' ,$reservation->date_to) }}>
            <input type="hidden" name="pickup_location_id"
              value={{ old('pickup_location_id', $reservation->pickup_location_id) }}>
            <input type="hidden" name="return_location_id"
              value={{ old('pickup_location_id', $reservation->return_location_id) }}>
            <input id="car-id" type="hidden" name="car_id" value="{{ old('car_id') }}">

            <h2>Dostupna vozila @if ($car_class) {{ 'zadate klase' }} @endif za dati period:</h2>
            @foreach ($cars as $car)
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card shadow-sm">
                @unless ($car_class)
                <span
                  class="badge bg-success position-absolute top-2 left-2 shadow-sm">{{ $car->car_class->name }}</span>
                @endunless
                <img src="{{ Storage::url($car->photo_url) }}" class="card-img-top"
                  style="max-height: 8rem; object-fit: cover" alt="{{ $car->name }} image">
                <div class="card-body">
                  <h5 class="card-title">{{ $car->name }}</h5>
                  <h6 class="card-subtitle text-muted">{{ $car->plate_number }}</h6>
                  <table class=" table my-2">
                    <tbody>
                      <tr>
                        <th>Godište:</th>
                        <td>{{ $car->production_year }}.</td>
                      </tr>
                      <tr>
                        <th>Br. sjedišta:</th>
                        <td>{{ $car->number_of_seats }}</td>
                      </tr>
                      <tr>
                        <th>Cijena/danu:</th>
                        <td>{{ $car->price_per_day }}€</td>
                      </tr>
                      <tr>
                        <th>Ukupno:</th>
                        <td>
                          {{ $car->price_per_day * ((int)(date_diff(date_create($reservation->date_from), date_create($reservation->date_to))->format('%a')) + 1) }}€
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="d-flex justify-content-end mt-3">
                    <button data-car-id="{{ $car->id }}" type="submit"
                      class="btn btn-primary btn-sm w-100">Odaberi</button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </form>
      </div>
    </div>
  </div>
  </div>

  <x-slot name="myscript">
    <script src="{{ asset('js/myscript.js') }}"></script>
  </x-slot>
</x-app-layout>