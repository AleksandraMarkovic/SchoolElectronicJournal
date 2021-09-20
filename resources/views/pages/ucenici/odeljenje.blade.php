@extends('layouts.layout')
@section('title') Odeljenje @endsection
@section('description') Prikaz odeljenja u skoli @endsection
@section('keywords') dnevnik, elektronski, profesor, skola, odeljenje @endsection
@section('content')
    <div class="container containerMargina visina">
        <div class="row" id="odeljenjeGore">
            @foreach($podaci as $p)
            <div class="col-lg-6 col-md-6 odeljenjeResponsive mt-3">
                <h5 class="card-title">Imenik</h5>
                <h6 class="card-subtitle mb-3 text-muted">Razredno odeljenje: @if($p->godina == 1) I @elseif($p->godina == 2) II @elseif($p->godina == 3) III @else IV @endif<span class="badge text-muted">{{ $p->broj_odeljenja }}</span> ({{ count($ucenici) }})</h6>
            </div>
            <div class="col-lg-6 col-md-6 odeljenjeResponsive mt-3 text-end">
                <h5 class="card-title">Razredni</h5>
                <h6 class="card-subtitle mb-3 text-muted">{{ $p->prezime }} {{ $p->ime }}</h6>
            </div>
            @endforeach
        </div>
        <div class="row djaci">
            @foreach($ucenici as $u)
                <div class="mt-2 shadow-sm ucenikOdeljenje">
                    <div class=" m-auto text-center">
                        <a href="{{ route('ucenik', ['id' => $u->id_ucenik]) }}"> <img class="w-75 ucenikSlika" src="{{asset('assets/images/'.$u->slika)}}" alt="{{ $u->prezime }} {{ $u->ime }}"> </a>
                    </div>
                    <div class="ucenikIme text-center">
                        <a href="{{ route('ucenik', ['id' => $u->id_ucenik]) }}">{{ $u->prezime }} {{ $u->ime }}</a>
                        <p class="text-muted smerOdeljenje">{{ $u->naziv }} (4)</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
