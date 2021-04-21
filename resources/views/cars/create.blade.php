<x-app-layout>
  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('cars.store') }}" method="POST" class="mx-auto w-75" enctype="multipart/form-data">
          <h1 class="mt-2 mb-3">Kreiraj novi automobil</h1>
          @csrf

          <label for="name" class="form-label">Naziv automobila</label>
          <input type="text" name="name" id="name"
            class="form-control mb-2 {{ $errors->get('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
          @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          <label for="plate-number" class="form-label">Registarski broj</label>
          <input type="text" name="plate_number" id="plate-number"
            class="form-control mb-2 {{ $errors->get('plate_number') ? 'is-invalid' : '' }}"
            value="{{ old('plate_number') }}">
          @error('plate_number')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          <label for="year" class="form-label">Godina proizvodnje</label>
          <input type="number" name="year" id="year"
            class="form-control mb-2 {{ $errors->get('year') ? 'is-invalid' : '' }}" value="{{ old('year') }}">
          @error('year')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          <label for="car-class" class="form-label">Tip automobila</label>
          <select name="car_class" id="car-class"
            class="form-select mb-2 {{ $errors->get('car_class') ? 'is-invalid' : '' }}">
            <option value="" {{ !old('car_class') ? 'selected' : '' }}>--{{ __('Car type') }}--</option>

            @foreach ($carClasses as $type)
            <option value="{{ $type->id }}" {{ $type->id == old('car_class') ? 'selected' : '' }}>{{ $type->name }}
            </option>
            @endforeach
          </select>
          @error('car_class')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          <label for="seats-number" class="form-label">Broj sjedišta</label>
          <input type="number" name="seats_number" id="seats-number"
            class="form-control mb-2 {{ $errors->get('seats_number') ? 'is-invalid' : '' }}"
            value="{{ old('seats_number') }}">
          @error('seats_number')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          <label for="price-per-day" class="form-label">Cijena po danu (EUR)</label>
          <input type="number" name="price_per_day" id="price-per-day"
            class="form-control mb-2 {{ $errors->get('price_per_day') ? 'is-invalid' : '' }}"
            value="{{ old('price_per_day') }}">
          @error('price_per_day')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          <label for="car-img" class="form-label">Fotografija</label>
          <input class="form-control mb-2" type="file" name="car_img" id="car-img">

          <label for="notes">Dodatne informacije</label>
          <textarea class="form-control mb-4" style="height: 100px" name="notes"
            id="notes">{{ old('notes') }}</textarea>
          @error('notes')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          <button type="submit" class="btn btn-primary w-100">Sačuvaj</button>

        </form>
      </div>
    </div>
  </div>
</x-app-layout>