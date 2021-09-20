@extends('layouts.layout')
@section('title') Smerovi @endsection
@section('description') Forma za dodavanje smerova @endsection
@section('keywords') dnevnik, elektronski, skola, profesor, smerovi @endsection
@section('content')
    <div class="container containerMargina1 visina">
        <div class="row">
            <div class="col-lg-10 m-auto">
                @include('partials.success')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto d-flex flex-column">
                <button type="button" class="btn" id="dodajSmer">
                    <i class="fa fa-plus-square me-1" aria-hidden="true"></i> Dodaj smer
                </button>
                <div class="row">
                    <div class="col-lg-12" id="formaSmer">
                        <form action="{{ route('dodajSmer') }}" method="post" class="d-flex flex-row forma">
                            <div class="mb-3">
                                <input type="text" placeholder="Naziv smera" class="form-control" id="smer" name="smer" />
                                <p class="text-danger" id="smerGreska"></p>
                            </div>
                            <div class="mb-3">
                                <input type="button" class="btn" id="izvrsiSmer" value="Izvrši">
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
                            <th scope="col">Naziv smera</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="ispisSmerovi">
                        @foreach($podaci as $p)
                            <tr>
                                <td> {{ $p->naziv }} </td>
                                <td class="text-center">
                                    <form action="{{ route('izbrisiSmer') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" class="smerid" name="smerid" value="{{ $p->id }}" />
                                        <button type="submit" class="btn btn-sm btn-danger izbrisi">
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
