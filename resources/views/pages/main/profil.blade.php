@extends('layouts.layout')
@section('title') Profil @endsection
@section('description') Profil korisnika @endsection
@section('keywords') dnevnik, elektronski, korisnik, odeljenja @endsection
@section('content')
    <div class="container containerMargina1 visina">
        <div class="row">
            <div class="col-lg-12 colSuccess">
                @include('partials.success')
                @include('partials.error')
            </div>
        </div>
        <div class="row shadow-sm" id="redProfil">
            @foreach($profil as $p)
            <div class="col-lg-3 text-center">
                <img class="img-fluid mt-5 profilnaSlika" src="{{asset("assets/images/".$p->slika)}}" />
                <h2 class="mt-4 text-center imePrezime">{{ $p->ime }} <br> {{ $p->prezime }}</h2>
            </div>
            <div class="col-lg-8 mt-4">
                <div class="mt-4">
                    <h3 class="naslovProfil">Glavne postavke</h3>
                </div>
                <form action="{{ route('izmeniProfil') }}" method="post" class="mt-3" enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="kor_imeProfil" class="form-label">Korisničko ime</label>
                        <input type="text" class="form-control" id="kor_imeProfil" name="kor_imeProfil" value="{{ $p->kor_ime }}"/>
                        <p class="text-danger" id="kor_imeProfilG"></p>
                        @error('kor_imeProfil')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailProfil" class="form-label">Email</label>
                        <input type="text" class="form-control" id="emailProfil" name="emailProfil" value="{{ $p->email }}"/>
                        <p class="text-danger" id="emailProfilGreska"></p>
                        @error('emailProfil')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    @if(session('korisnik')->id_uloga == 4)
                        <div class="mb-3">
                            <label for="brojTelefona" class="form-label">Broj telefona</label>
                            <input type="text" class="form-control" id="brojTelefona" name="brojTelefona" value="{{ $p->telefon }}"/>
                            <p class="text-danger" id="brojTelefonaG"></p>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="slikaProfil" class="form-label">Slika</label>
                        <input type="file" class="form-control" id="slikaProfil" name="slikaProfil" />
                        @error('slikaProfil')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <input type="submit" class="btn float-end" id="updateProfil" value="Izmeni"/>
                </form>
                @endforeach
                <div class="bezbednost">
                    <h3 class="naslovProfil">Bezbednost</h3>
                </div>
                <div class="mt-3 mb-3">
                    <label for="izmeniLozinku" class="form-label">Lozinka</label>
                    <button type="button" class="btn btn-sm mt-2 mb-3 ms-2" id="izmeniLozinku">Izmeni lozinku</button>
                </div>
                <form action="{{ route('izmeniLozinku') }}" method="post" class="mt-3" id="formaLozinka">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="staraLozinka" class="form-label">Stara lozinka</label>
                        <input type="password" class="form-control" id="staraLozinka" name="staraLozinka" />
                        @error('staraLozinka')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="novaLozinka" class="form-label">Nova lozinka</label>
                        <input type="password" class="form-control" id="novaLozinka" name="novaLozinka" />
                        @error('novaLozinka')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ponovoLozinka" class="form-label">Ponovite lozinku</label>
                        <input type="password" class="form-control" id="ponovoLozinka" name="ponovoLozinka" />
                        @error('ponovoLozinka')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <button type="submit" class="btn mb-4 float-end" id="updateLozinka">Izmeni</button>
                </form>
            </div>
        </div>
    </div>
@endsection
