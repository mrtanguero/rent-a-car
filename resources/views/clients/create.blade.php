<x-app-layout>
  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('clients.store') }}" method="POST" class="mx-auto w-75">
          @csrf

          <label for="name" class="form-label">Ime i prezime klijenta</label>
          <input type="text" name="name" id="name" class="form-control mb-2">

          <label for="country-id" class="form-label">Država</label>
          <select name="country_id" id="country-id" class="form-select mb-2">
            <option value="" selected>--{{ __('Država') }}--</option>

            @foreach ($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
          </select>

          <label for="id-document-number" class="form-label">Broj pasoša / lične karte</label>
          <input type="text" name="id_document_number" id="id-document-number" class="form-control mb-2">


          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control mb-2">

          <label for="phone" class="form-label">Broj telefona</label>
          <input type="text" name="phone" id="phone" class="form-control mb-2">

          <label for="notes">Dodatne informacije</label>
          <textarea class="form-control mb-4" style="height: 100px" name="notes" id="notes"></textarea>

          <button type="submit" class="btn btn-primary w-100">Sačuvaj</button>

        </form>
      </div>
    </div>
  </div>
</x-app-layout>