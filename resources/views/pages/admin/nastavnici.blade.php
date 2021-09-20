@extends('layouts.layout')
@section('title') Predmeti @endsection
@section('description') Forma za dodavanje predmeta @endsection
@section('keywords') dnevnik, elektronski, profesor, skola, smer, predmeti @endsection
@section('content')
    <div class="container containerMargina1">
        <div class="row">
            <div class="col-lg-10 m-auto">
                @include("partials.success")
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Ime i prezime</th>
                        <th scope="col">Predmet</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody id="ispisNastavnici">
                    @foreach($nastavnici as $n)
                        <tr>
                            <td>{{ $n->ime }} {{ $n->prezime }}</td>
                            <td> {{ $n->naziv }} </td>
                            <td class="text-center">
                                <form action="{{ route('obrisiNastavnika') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" class="nastanikid" name="nastavnikid" value="{{ $n->id_korisnik }}">
                                    <button type="submit" class="btn btn-sm btn-danger izbrisiNastavnika">
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
