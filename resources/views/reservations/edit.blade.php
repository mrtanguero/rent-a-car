<x-app-layout>
  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('reservations.update', ['reservation'=>$reservation]) }}" method="POST"
          class="mx-auto w-75">
          <h1 class="mb-3">Izmijeni rezervaciju</h1>
          @csrf
          @method('put')

          <div class="row row-col-sm-6">

            <div class="col mb-2">
              <label for="date-from">Od:</label>
              <input class="form-label w-100" type="date" name="date_from" id="date-from"
                value="{{ old('date_from', $reservation->date_from) }}" style="border-radius: 5px; border-color: #ccc">
              @error('date_from')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col mb-2">
              <label for="date-to">Do:</label>
              <input class="form-label w-100" type="date" name="date_to" id="date-to"
                value="{{ old('date_to', $reservation->date_from) }}" style="border-radius: 5px; border-color: #ccc">
              @error('date_to')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          <div class="row row-col-sm-6 mb-2">
            <div class="col">
              <label for="pickup-location" class="form-label">Klijent</label>
              <select name="pickup_location_id" id="pickup-location" class="form-select mb-2">
                @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                  {{ old('pickup_location_id', $reservation->pickup_location->id) == $location->id ? 'selected' : '' }}>
                  {{ $location->name }}</option>
                @endforeach
              </select>
              @error('pickup_location_id')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col">
              <label for="return-location" class="form-label">Klijent</label>
              <select name="return_location_id" id="return-location" class="form-select mb-2">
                @foreach ($locations as $location)
                <option value="{{ $location->id }}"
                  {{ old('return_location_id', $reservation->return_location->id) == $location->id ? 'selected' : '' }}>
                  {{ $location->name }}</option>
                @endforeach
              </select>
              @error('return_location_id')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row row-col-sm-6 mb-2">
            <div class="col">
              <label for="client" class="form-label">Klijent za koga pravite rezervaciju</label>
              <select name="client_id" id="client" class="form-select mb-2">
                @foreach ($clients as $client)
                <option value="{{ $client->id }}"
                  {{ old('client_id', $reservation->client_id) == $client->id ? 'selected' : '' }}>
                  {{ $client->name }}</option>
                @endforeach
              </select>
              @error('client_id')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col">
              <label for="car-id" class="form-label">Klasa automobila (opciono)</label>
              <select name="car_id" id="car-id" class="form-select mb-2">
                @foreach ($cars as $car)
                <option value="{{ $car->id }}" {{ old('car_id', $car->id) == $car->id ? 'selected' : '' }}>
                  {{ $car->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          @foreach ($extras as $extra)
          <div class="form-check mb-2">
            <input class="form-check-input" name="extra_{{ $extra->id }}" type="checkbox" value="checked"
              id="check-{{ $extra->id }}"
              {{ old('extra_' . $extra->id, $reservation->extras[$loop->index] ?? null) ? 'checked' : '' }}>
            <label class="form-check-label" for="check-{{ $extra->id }}">
              {{ $extra->name }}
            </label>
          </div>
          @endforeach

          <button type="submit" class="btn btn-primary w-100 mt-2">Sačuvaj izmjene</button>

        </form>
      </div>
    </div>
  </div>
</x-app-layout>