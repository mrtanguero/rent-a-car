<x-app-layout>
  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
        {{-- @dump($reservation, $extras, $cars) --}}
        @php
        session(['extras' => $extras]);
        @endphp

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

            <h2>Dostupna vozila zadate klase za dati period:</h2>
            @foreach ($cars as $car)
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card shadow-sm">
                <span
                  class="badge bg-success position-absolute top-2 left-2 shadow-sm">{{ $car->car_class->name }}</span>
                <img src="{{ Storage::url($car->photo_url) }}" class="card-img-top"
                  style="max-height: 8rem; object-fit: cover" alt="{{ $car->car_title }} image">
                <div class="card-body">
                  <h5 class="card-title">{{ $car->car_title }}</h5>
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