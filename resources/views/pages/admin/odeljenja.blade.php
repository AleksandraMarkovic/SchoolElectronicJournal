@extends('layouts.layout')
@section('title') Odeljenje @endsection
@section('description') Froma za dodavanje odeljenja @endsection
@section('keywords') dnevnik, elektronski, profesor, odeljenje @endsection
@section('content')
    <div class="container containerMargina1 visina">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <h2>Dodajte novo odeljenje</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto">
                <form action="{{ route('dodajOdeljenje') }}" method="post" class="mt-3" >
                    @csrf
                    <div class="mb-3">
                        <label for="brojOdeljenja" class="form-label">Broj odeljenja</label>
                        <input type="text" class="form-control" id="brojOdeljenja" name="brojOdeljenja" />
                        <p class="text-danger" id="brojOdeljenjaG"></p>
                    </div>
                    <div class="mb-3">
                        <label for="godina" class="form-label">Godina</label>
                        <input type="text" class="form-control" id="godina" name="godina" />
                        <p class="text-danger" id="godinaG"></p>
                    </div>
                    <div class="mb-3">
                        <label for="razredni" class="form-label">Razredni starešina</label>
                        <select class="form-select" id="razredni" name="razredni">
                            <option value="0">Izaberite...</option>
                            @foreach($korisnici as $k)
                                <option value="{{ $k->id_korisnik }}">{{ $k->ime }} {{ $k->prezime }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger" id="razredniG"></p>
                    </div>
                    <div class="mb-3">
                        <label for="smerOdeljenje" class="form-label">Smer</label>
                        <select class="form-select" id="smerOdeljenje" name="smerOdeljenje">
                            <option value="0">Izaberite...</option>
                            @foreach($smerovi as $s)
                                <option value="{{ $s->id }}">{{ $s->naziv }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger" id="smerOdeljenjeG"></p>
                    </div>
                    <div class="mb-3" id="prikaziPredmete">

                    </div>
                    <button type="button" class="btn mb-5" id="dodajOdeljenje">Dodaj</button>
                </form>
            </div>
        </div>
    </div>
@endsection
