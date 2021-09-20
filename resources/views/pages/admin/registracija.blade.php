@extends('layouts.layout')
@section('title') Registracija @endsection
@section('description') Forma za registraciju korisnika @endsection
@section('keywords') dnevnik, elektronski, profesor, registracija, korisnik @endsection
@section('content')
    <div class="container containerMargina1 visina">
        <div class="row">
            <div class="col-lg-10 m-auto">
                @include("partials.success")
                @include('partials.error')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto">
                <h2>Registracija korisnika</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto">
                @include('partials.form', ["action" => 'registracija'])
            </div>
        </div>
    </div>
@endsection
