@extends('layouts.layout')
@section('title') Čas @endsection
@section('description') Forma za upis casa @endsection
@section('keywords') dnevnik, elektronski, profesor, odeljenja, casovi @endsection
@section('content')
    <div class="container containerMargina visina">
        <div class="row">
            <div class="col-lg-10 m-auto mt-5">
                <h2>Upišite čas</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto">
                <form action="" method="POST" class="mt-3">
                    <div class="mb-3">
                        <label for="opis" class="form-label">Nastavna jedinica</label>
                        <input type="text" class="form-control" id="opis" name="opis" />
                        <p class="text-danger" id="opisGreska"></p>
                    </div>
                    <div class="mb-3">
                        <label for="datumCas" class="form-label">Datum</label>
                        <input type="date" class="form-control" id="datumCas" name="datumCas" value="{{ date('Y-m-d') }}"/>
                        <p class="text-danger" id="datumGreska"></p>
                    </div>
                    <div class="mb-3">
                        <label for="brojCasa" class="form-label">Redni broj časa</label>
                        <input type="number" class="form-control" id="brojCasa" name="brojCasa" />
                        <p class="text-danger" id="brojCasaGreska"></p>
                    </div>
                    <div class="mb-3">
                        <label for="napomena" class="form-label">Napomena</label>
                        <textarea id="napomena" name="napomena" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <p>Odustni</p>
                        @foreach($ucenici as $ucenik)
                            <div class="form-check">
                                <input class="form-check-input odsutniCas" type="checkbox" value="{{ $ucenik->id_ucenik }}" name="odsutniCas">
                                <label class="form-check-label" for="odsutniCas">
                                    {{ $ucenik->ime }} {{ $ucenik->prezime }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn mt-3 mb-3" id="upisiBtn">Izvrši</button>
                </form>
            </div>
        </div>
    </div>
@endsection
