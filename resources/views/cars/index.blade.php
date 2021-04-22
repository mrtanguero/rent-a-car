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
                  </tbody>
                </table>
                <div class="d-flex justify-content-end mt-3">
                  <a href="{{ route('cars.show', ['car'=>$car]) }}" class="btn btn-primary btn-sm w-100">Detalji</a>
                  <a href="{{ route('cars.edit', ['car'=>$car]) }}" class="btn btn-primary ms-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path
                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                      <path fill-rule="evenodd"
                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg></a>
                  <form action="{{ route('cars.destroy', ['car'=>$car]) }}" method="POST">
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