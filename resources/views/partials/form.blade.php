<form action="{{ route($action) }}" method="post" class="mt-3" enctype='multipart/form-data'>
    @csrf
    <div class="mb-3">
        <label for="imeRegistracija" class="form-label">Ime</label>
        <input type="text" class="form-control" id="imeRegistracija" name="imeRegistracija" />
        <p class="text-danger" id="imeRegistracijaG"></p>
        @error('imeRegistracija')
        <p class="text-danger">
            {{$message}}
        </p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="prezimeRegistracija" class="form-label">Prezime</label>
        <input type="text" class="form-control" id="prezimeRegistracija" name="prezimeRegistracija" />
        <p class="text-danger" id="prezimeRegistracijaG"></p>
        @error('prezimeRegistracija')
        <p class="text-danger">
            {{$message}}
        </p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="korImeReg" class="form-label">Korisničko ime</label>
        <input type="text" class="form-control" id="korImeReg" name="korImeReg" />
        <p class="text-danger" id="korImeRegG"></p>
        @error('korImeReg')
        <p class="text-danger">
            {{$message}}
        </p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="emailReg" class="form-label">Email</label>
        <input type="text" class="form-control" id="emailReg" name="emailReg" />
        <p class="text-danger" id="emailRegG"></p>
        @error('emailReg')
        <p class="text-danger">
            {{$message}}
        </p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sifraReg" class="form-label">Lozinka</label>
        <input type="password" class="form-control" id="sifraReg" name="sifraReg" />
        <p class="text-danger" id="sifraRegG"></p>
        @error('sifraReg')
        <p class="text-danger">
            {{$message}}
        </p>
        @enderror
    </div>
    @if($action == 'registracija')
        <div class="mb-3">
            <label for="slikaReg" class="form-label">Slika</label>
            <input type="file" class="form-control" id="slikaReg" name="slikaReg" />
        </div>
        <div class="mb-3">
            <label for="predmetReg" class="form-label">Predmet</label>
            <select class="form-select" id="predmetReg" name="predmetReg">
                <option value="0">Izaberite...</option>
                @foreach($predmeti as $p)
                    <option value="{{ $p->id }}">{{ $p->naziv }}</option>
                @endforeach
            </select>
            @error('predmetReg')
            <p class="text-danger">
                {{$message}}
            </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ulogaReg" class="form-label">Uloga</label>
            <select class="form-select" id="ulogaReg" name="ulogaReg">
                <option value="0">Izaberite...</option>
                <option value="3">Nastavnik</option>
                <option value="2">Razredni starešina</option>
            </select>
            @error('ulogaReg')
            <p class="text-danger">
                {{$message}}
            </p>
            @enderror
        </div>
    @else
        <div class="mb-3">
            <label for="brojTelefona" class="form-label">Broj telefona</label>
            <input type="text" class="form-control" id="brojTelefona" name="brojTelefona" />
            <p class="text-danger" id="brojTelefonaG"></p>
        </div>
    @endif
    <div class="mt-5 d-flex justify-content-end">
        @if($action == 'registracija')
        <button type="submit" class="btn mb-5" id="registruj">Registruj</button>
        @else
            <button type="button" class="btn mb-5" id="registrujRoditelj">Dodaj</button>
        @endif
    </div>
</form>
