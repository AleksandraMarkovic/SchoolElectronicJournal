@extends('layouts.layout')
@section('title') Roditelj @endsection
@section('description') Prikaz ucenika roditelju @endsection
@section('keywords') dnevnik, elektronski, roditelj, skola, odeljenje @endsection
@section('content')
    <div class="container visina containerMargina">
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 col-11 m-auto mt-3 padajucaRoditelj">
                <label for="ucenikRoditelj" class="form-label labelUcenik">Učenik</label>
                <select id="ucenikRoditelj" name="ucenikRoditelj" class="form-select">
                    @foreach($ucenici as $ucenik)
                        <option value="{{ $ucenik->id_ucenik }}">{{ $ucenik->ime }} {{ $ucenik->prezime }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row ucenik shadow-sm">
            <div class="col-lg-3 text-center levo" id="roditeljLevo">
            </div>
            <div class="col-lg-9">
                <ul class="nav nav-tabs navigacija">
                    <li class="nav-item">
                        <a class="nav-link linkTab active linkOcene" aria-current="page" href="#" id="linkOcene">Ocene i izostanci</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link linkTab linkPredmeti" href="#" id="linkPredmeti">Predmeti</a>
                    </li>
                </ul>
                <div class="ocene">
                    <div>
                        <div class="col-lg-12">
                            <select name="predmetiR" id="predmetiR" class="form-select mt-4 mb-3">

                            </select>
                        </div>
                    </div>
                    <div class="w-100 text-center mt-5 izaberitePredmet">
                        <h5 class="fw-normal">Izaberite predmet za prikaz ocena.</h5>
                    </div>
                    <div class="d-flex justify-content-between polugodista" id="oceneRoditelj" >
                    </div>
                    <div class="d-flex justify-content-start prosek mt-3">
                        <div class="d-flex justify-content-start me-3" id="prosekPrvoR">

                        </div>
                        <div class="d-flex justify-content-start" id="prosekDrugoR">

                        </div>
                    </div>
                    <div class="mt-5 sakrij" id="zakljucnaNaslov">
                        <h5>Zaključne ocene</h5>
                    </div>
                    <div class="d-flex justify-content-start" id="zakljucneRoditelj">
                    </div>
                    <div class="izostanciNaslov mt-5">
                        <h5>Izostanci</h5>
                    </div>
                    <div class="d-flex justify-content-start flex-wrap mt-3 mb-4" id="izostanciRoditelj">

                    </div>
                </div>
                <div class="predmeti">
{{--                    <div class="row">--}}
                        <div class="col-lg-12">
                            <table class="table" id="tabelaPredmeti">
                                <thead>
                                <tr>
                                    <th scope="col">Predmet</th>
                                    <th scope="col">Nastavnik</th>
                                </tr>
                                </thead>
                                <tbody id="predmetiRoditelj">

                                </tbody>
                            </table>
                        </div>
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
