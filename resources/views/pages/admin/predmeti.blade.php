@extends('layouts.layout')
@section('title') Predmeti @endsection
@section('description') Forma za dodavanje predmeta @endsection
@section('keywords') dnevnik, elektronski, profesor, skola, smer, predmeti @endsection
@section('content')
    <div class="container containerMargina1 visina">
        <div class="row">
            <div class="col-lg-10 m-auto">
                @include("partials.success")
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto d-flex flex-column">
                <button type="button" class="btn" id="dodajPredmet">
                    <i class="fa fa-plus-square me-1" aria-hidden="true"></i> Dodaj predmet
                </button>
                <div class="row">
                    <div class="col-lg-12" id="formaPredmet">
                        <form action="{{ route('dodajSmer') }}" method="post" >
                            <div class="mb-3">
                                <input type="text" placeholder="Naziv predmeta" class="form-control" id="predmet" name="predmet" />
                                <p class="text-danger" id="predmetGreska"></p>
                            </div>
                            @foreach($smerovi as $smer)
                                <div class="form-check">
                                    <input class="form-check-input smerPredmet" name="smerPredmet[]" type="checkbox" value="{{ $smer->id }}">
                                    <label class="form-check-label" for="smerPredmet">
                                        {{ $smer->naziv }}
                                    </label>
                                    <p class="text-danger" id="smerPredmetGreska"></p>
                                </div>
                                @endforeach
                            <div class="mb-3">
                                <input type="button" class="btn" id="izvrsiPredmet" value="Izvrši">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Naziv predmeta</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="ispisPredmeti">
                        @foreach($podaci as $p)
                            <tr>
                                <td> {{ $p->naziv }} </td>
                                <td class="text-center">
                                    <form action="{{ route('izbrisiPredmet') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" class="predmetid" name="predmetid" value="{{ $p->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger izbrisiP">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
