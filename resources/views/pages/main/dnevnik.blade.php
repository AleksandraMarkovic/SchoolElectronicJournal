@extends('layouts.layout')
@section('title') Dnevnik @endsection
@section('description') Prikaz dnevnika i upis casova @endsection
@section('keywords') dnevnik, elektronski, profesor, odeljenja, casovi @endsection
@section('content')
    <div class="container containerMargina containerDnevnik">
        <div class="row" id="odeljenjeGore">
            <div class="col-lg-6 col-md-6 mt-3">
                <h5 class="card-title mt-2">Dnevnik rada</h5>
            </div>
            <div class="col-lg-6 col-md-6 mt-3 mb-2 d-flex justify-content-end">
                <input type="date" class="form-control w-50" id="casDatum" >
                <input type="button" class="btn ms-2" id="filterDatum" value="Filtriraj" >
            </div>
        </div>
        <div class="row">
            <div class="colSuccess1">
                @include('partials.success')
            </div>
        </div>
        <div class="row mb-3" id="datumi">
            @foreach($datumi as $d)
                <div class="col-lg-12">
                    <div class="row datumCas">
                        <a href="#" class="datum dan">
                            @if(date('l', strtotime($d->datum)) == "Monday")
                                Ponedeljak
                            @elseif(date('l', strtotime($d->datum)) == "Tuesday")
                                Utorak
                            @elseif(date('l', strtotime($d->datum)) == "Wednesday")
                                Sreda
                            @elseif(date('l', strtotime($d->datum)) == "Thursday")
                                Četvrtak
                            @elseif(date('l', strtotime($d->datum)) == "Friday")
                                Petak
                            @endif

                        </a>
                        <a href="#" class="datum d">{{ date('d.m.Y.', strtotime($d->datum))}}</a>
                    </div>
                    <input type="hidden" class="datumVred" value="{{ $d->datum }}">
                    <input type="hidden" class="ulogovani" value="{{ session('korisnik')->id_korisnik }}">
                    <div class="row casovi d-flex justify-content-start">

                    </div>
                </div>
            @endforeach
        </div>
        {{$datumi->links('pagination.bootstrap-4')}}
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Odustni</h5>
                    </div>
                    <div class="modal-body" id="modalBody">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Zatvori</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalIzmeniCas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Izmeni čas</h5>
                        <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateCas') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nastavnaJedUpdate" class="form-label">Nastavna jedinica</label>
                                <input type="text" class="form-control" id="nastavnaJedUpdate" name="nastavnaJedUpdate"/>
                                <p class="text-danger" id="nastavnaJedUpdateG"></p>
                            </div>
                            <div class="mb-3">
                                <label for="napomenaUpdate" class="form-label">Napomena</label>
                                <textarea id="napomenaUpdate" name="napomenaUpdate" class="form-control"></textarea>
                                <p class="text-danger" id="napomenaUpdateG"></p>
                            </div>
                            <input type="hidden" id="casId" name="casId">
                            <input type="submit" class="btn float-end" id="updateCas" value="Izmeni">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
