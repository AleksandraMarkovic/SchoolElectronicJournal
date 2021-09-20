@extends('layouts.layout')
@section('title') Zahtevi @endsection
@section('description') Prikaz zahteva direktoru @endsection
@section('keywords') dnevnik, elektronski, profesor, direktor, zahtev @endsection
@section('content')
    <div class="container containerMargina1 containerMargina2 visina">
        <div class="row">
            <div class="col-lg-10 m-auto">
                @include('partials.success')
                @include('partials.error')
            </div>
        </div>
        @if(count($zahtevi) == 0)
            <div class="row">
                <div class="col-lg-12 visina d-flex justify-content-center align-items-center" >
                    <h2 class="text-muted nemaZahteva">Trenutno nema zahteva!</h2>
                </div>
            </div>
        @else
            <div class="row mt-4">
                <div class="col-lg-10 m-auto table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-center">
                        <tr>
                            <th scope="col">Učenik</th>
                            <th scope="col">Nastavnik</th>
                            <th scope="col">Predmet</th>
                            <th scope="col">Pogrešna ocena</th>
                            <th scope="col">Nova ocena</th>
                            <th scope="col">Odobreno</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach($zahtevi as $z)
                            <tr>
                                <td> {{ substr($z->ime, 0, 1) }}. {{ $z->prezime }} </td>
                                <td> {{ substr($z->imeK, 0, 1) }}. {{ $z->prezimeK }} </td>
                                <td> {{ $z->naziv }} </td>
                                <td> {{ $z->pogresna_ocena }} </td>
                                <td> {{ $z->nova_ocena }} </td>
                                <td class="d-flex justify-content-center">
                                    <form action="{{ route('odobriZahtev') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="zahtev" value="{{ $z->id_zahtev }}">
                                        <input type="hidden" name="nova" value="{{ $z->nova_ocena }}">
                                        <input type="hidden" name="datumZ" value="{{ $z->datum_ocene }}">
                                        <input type="hidden" name="ucenik" value="{{ $z->id_ucenik }}">
                                        <input type="hidden" name="vrsta" value="{{ $z->id_vrsta_ocene }}">
                                        <button type="submit" class="btn btn-sm success">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route("odbijZahtev") }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="zahtev" value="{{ $z->id_zahtev }}">
                                        <button type="submit" class="btn btn-sm  ms-1">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
