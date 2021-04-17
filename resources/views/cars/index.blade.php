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
          <h1>{{ __('Cars') }}</h1>
          <a href="{{ route('cars.create') }}" class="btn btn-primary">
            {{ __('Create new') }}
          </a>
        </div>
        {{-- <div class="container"> --}}
        <div class="row g-3 mt-1">
          @foreach ($cars as $car)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card shadow-sm">
              <span class="badge bg-success position-absolute top-2 left-2 shadow-sm">{{ $car->car_class->name }}</span>
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
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        {{-- </div> --}}
      </div>
    </div>
  </div>
</x-app-layout>