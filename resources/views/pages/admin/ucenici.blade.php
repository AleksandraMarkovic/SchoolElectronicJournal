@extends('layouts.layout')
@section('title') Učenici @endsection
@section('description') Forma za dodavanje ucenika @endsection
@section('keywords') dnevnik, elektronski, profesor, skola, ucenici @endsection
@section('content')
    <div class="container containerMargina">
        <div class="row">
            <div class="col-lg-10 m-auto">
                @include("partials.success")
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto mt-5">
                <h2>Dodajte novog učenika</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto">
                <form action="{{ route('dodajUcenika') }}" method="post" class="mt-3" enctype='multipart/form-data'>
                    @csrf
                    <div class="mb-3">
                        <label for="imeUcenika" class="form-label">Ime</label>
                        <input type="text" class="form-control" id="imeUcenika" name="imeUcenika" />
                        @error('imeUcenika')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prezimeUcenika" class="form-label">Prezime</label>
                        <input type="text" class="form-control" id="prezimeUcenika" name="prezimeUcenika" />
                        @error('prezimeUcenika')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slikaUcenika" class="form-label">Slika</label>
                        <input type="file" class="form-control" id="slikaUcenika" name="slikaUcenika" />
                        @error('slikaUcenika')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jmbg" class="form-label">Matični broj (JMBG)</label>
                        <input type="text" class="form-control" id="jmbg" name="jmbg" />
                        @error('jmbg')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="adresa" class="form-label">Adresa</label>
                        <input type="text" class="form-control" id="adresa" name="adresa" />
                        @error('adresa')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mestoRodj" class="form-label">Mesto rođenja </label>
                        <input type="text" class="form-control" id="mestoRodj" name="mestoRodj" />
                        @error('mestoRodj')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="datumRodj" class="form-label">Datum rođenja</label>
                        <input type="date" class="form-control" id="datumRodj" name="datumRodj" />
                        @error('datumRodj')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    @if(session('korisnik')->id_uloga == 1)
                        <div class="mb-3">
                            <label for="odeljenjeUcenika" class="form-label">Odeljenje</label>
                            <select class="form-select" id="odeljenjeUcenika" name="odeljenjeUcenika">
                                <option value="0">Izaberite...</option>
                                @foreach($odeljenja as $o)
                                    <option value="{{ $o->id_odeljenje }}"> @if($o->godina == 1) I @elseif($o->godina == 2) II @elseif($o->godina == 3) III @else IV @endif {{ $o->broj_odeljenja }} </option>
                                @endforeach
                            </select>
                            @error('odeljenjeUcenika')
                            <p class="text-danger">
                                {{$message}}
                            </p>
                            @enderror
                        </div>
                    @endif
                    <button type="submit" class="btn mb-5" id="dodajUcenika">Dodaj</button>
                </form>
            </div>
        </div>
    </div>
@endsection
