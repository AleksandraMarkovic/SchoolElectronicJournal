@extends('layouts.layout')
@section('title') Početna @endsection
@section('description') Početna strana @endsection
@section('keywords') dnevnik, elektronski, profesor, odeljenja @endsection
@section('content')
    @if(session('korisnik')->id_uloga == 5)
        <div class="container containerMargina">
            <div class="row">
                <div class="col-lg-6 mt-5">
                    <canvas id="izostanciChart"></canvas>
                </div>
                <div class="col-lg-6 mt-5">
                    <canvas id="zahteviChart"></canvas>
                </div>
            </div>
        </div>
    @endif
    <div class="container visina @if(session('korisnik')->id_uloga != 5) containerMargina @endif" id="containerPocetna">
        <div class="row d-flex justify-content-start">
            @foreach($podaci as $o)
            <div class="shadow-sm mt-5 d-flex justify-content-start odeljenjePocetna">
                <div class="linija my-auto"></div>
                <div>
                    <p class="brojOdeljenja">@if($o->godina == 1) I @elseif($o->godina == 2) II @elseif($o->godina == 3) III @else IV @endif<span class="badge">{{ $o->broj_odeljenja }}</span> </p>
                    <h5 class="card-title">@if(session('korisnik')->id_uloga == 1 || session('korisnik')->id_uloga == 5){{ substr($o->ime, 0, 1) }}. {{ $o->prezime }} @elseif(session('korisnik')->id_uloga == 2 || session('korisnik')->id_uloga == 3) {{ $o->naziv }} @endif</h5>
                    <h6 class="card-subtitle mb-4 text-muted">@if($o->godina == 1) I @elseif($o->godina == 2) II @elseif($o->godina == 3) III @else IV @endif razred srednje skole</h6>
                    <a href="{{ route('odeljenje', ['id' => $o->id_odeljenje]) }}" class="btn-sm linkPocetna" title="Imenik"> <i class="fa fa-user" aria-hidden="true"></i> </a>
                    <a href="{{ route('dnevnik', ['id' => $o->id_odeljenje]) }}" class="btn-sm linkPocetna" title="Dnevnik"> <i class="fa fa-book" aria-hidden="true"></i> </a>
                    <a href="{{ route('formaCas', ['id' => $o->id_odeljenje]) }}" class="btn-sm linkPocetna" title="Dodaj čas"> <i class="fa fa-plus-circle" aria-hidden="true"></i> </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
