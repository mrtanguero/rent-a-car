<x-app-layout>
  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('cars.store') }}" method="POST" class="mx-auto w-75" enctype="multipart/form-data">
          @csrf

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <label for="name" class="form-label">Naziv automobila</label>
          <input type="text" name="name" id="name" class="form-control mb-2" value={{ old('name') }}>

          <label for="plate-number" class="form-label">Registarski broj</label>
          <input type="text" name="plate_number" id="plate-number" class="form-control mb-2"
            value={{ old('plate_number') }}>

          <label for="year" class="form-label">Godina proizvodnje</label>
          <input type="number" name="year" id="year" class="form-control mb-2" value={{ old('year') }}>

          <label for="car-class" class="form-label">Tip automobila</label>
          <select name="car_class" id="car-class" class="form-select mb-2">
            <option value="" selected>--{{ __('Car type') }}--</option>

            @foreach ($carClasses as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
          </select>

          <label for="seats-number" class="form-label">Broj sjedišta</label>
          <input type="number" name="seats_number" id="seats-number" class="form-control mb-2">

          <label for="price-per-day" class="form-label">Cijena po danu (EUR)</label>
          <input type="number" name="price_per_day" id="price-per-day" class="form-control mb-2">

          <label for="car-img" class="form-label">Fotografija</label>
          <input class="form-control mb-2" type="file" name="car_img" id="car-img">

          <label for="notes">Dodatne informacije</label>
          <textarea class="form-control mb-4" style="height: 100px" name="notes" id="notes"></textarea>

          <button type="submit" class="btn btn-primary w-100">Sačuvaj</button>

        </form>
      </div>
    </div>
  </div>
</x-app-layout>