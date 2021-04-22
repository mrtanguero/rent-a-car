<x-app-layout>
  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="container">
          <form action="{{ route('clients.update', ['client'=>$client]) }}" method="POST" class="mx-auto w-75">
            <h2 class="text-center mt-3 mb-5">Izmijeni klijenta: <strong>{{ $client->name }}</strong></h2>
            @csrf
            @method('put')

            <label for="name" class="form-label">Ime i prezime klijenta</label>
            <input type="text" name="name" id="name"
              class="form-control mb-2 {{ $errors->get('name') ? 'is-invalid' : '' }}"
              value="{{ old('name', $client->name) }}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="country-id" class="form-label">Država</label>
            <select name="country_id" id="country-id"
              class="form-select mb-2 {{ $errors->get('country_id') ? 'is-invalid' : '' }}">
              @foreach ($countries as $country)
              <option value="{{ $country->id }}"
                {{ $country->id == old('country_id', $client->country->id) ? 'selected' : '' }}>{{ $country->name }}
              </option>
              @endforeach
            </select>
            @error('country_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="id-document-number" class="form-label">Broj pasoša / lične karte</label>
            <input type="text" name="id_document_number" id="id-document-number"
              class="form-control mb-2 {{ $errors->get('id_document_number') ? 'is-invalid' : '' }}"
              value="{{ old('id_document_number', $client->id_document_number) }}">
            @error('id_document_number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
              class="form-control mb-2 {{ $errors->get('email') ? 'is-invalid' : '' }}"
              value="{{ old('email', $client->email) }}">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="phone" class="form-label">Broj telefona</label>
            <input type="text" name="phone" id="phone"
              class="form-control mb-2 {{ $errors->get('phone') ? 'is-invalid' : '' }}"
              value="{{ old('phone', $client->phone) }}">
            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="notes">Dodatne informacije</label>
            <textarea class="form-control mb-4 {{ $errors->get('notes') ? 'is-invalid' : '' }}" style="height: 100px"
              name="notes" id="notes">{{ old('notes', $client->additional_notes) }}</textarea>
            @error('notes')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary w-100">Sačuvaj</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>