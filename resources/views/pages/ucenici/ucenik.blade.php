@extends('layouts.layout')
@section('title') Učenik @endsection
@section('description') Prikaz ucenika @endsection
@section('keywords') dnevnik, elektronski, profesor, odeljenje, ucenik @endsection
@section('content')
    <div class="container visina ucenikContainer">
        <div class="row">
            <div class="col-lg-12 colSuccess">
                @include('partials.success')
            </div>
        </div>
        <div class="row ucenik shadow-sm">
            <div class="col-lg-3 text-center levo">
                @foreach($ucenik as $u)
                    <div class="slikaIme">
                        <img class="img-fluid mb-2 mt-4 slika" src="{{asset('assets/images/'. $u->slika)}}">
                        <div class="imeSmer">
                            <p class="ime mt-2">{{ $u->prezime }} {{ $u->ime }}</p>
                            <p class="text-muted">{{ $u->naziv }} (4) </p>
                        </div>
                    </div>
                    <div>
                        @if(session('korisnik')->id_uloga == 2 && $u->id_odeljenje == session('odeljenje')->id_odeljenje)
                            <form class="prikaziVladanje mt-4" action="{{ route('vladanje') }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="w-75 m-auto d-flex mb-2 justify-content-start divVladanje">
                                    <input type="text" class="form-control form-control-sm text-center" id="vladanje" name="vladanje" value="{{ $u->vladanje }}"/>
                                    <p class="text-danger" id="vladanjeG"></p>
                                    <input type="hidden" name="iducenik" value="{{ $u->id_ucenik }}">
                                    <input type="submit" class="btn btn-sm w-75 ms-2" id="vladanjeBtn" value="Izmeni vladanje">
                                </div>
                            </form>
                        @else
                            <div class="w-75 m-auto d-flex mb-3 justify-content-start divTekstVladanje vucenik">
                                <p class="tekstVladanje">Ocena iz vladanja</p>
                                <p class="ocenaVladanje">{{ $u->vladanje }}</p>
                            </div>
                        @endif
                        @if(session('korisnik')->id_uloga == 2 || session('korisnik')->id_uloga == 3)
                            <a type="button" class="btn btn-sm w-75 @if(count($zakljucna2)) sakrij @endif" id="prikaziOcenu" href="#ModalOcena" data-bs-toggle="modal">
                                <i class="fa fa-plus-square me-1" aria-hidden="true"></i>
                                Dodaj ocenu
                            </a>
                            <a type="button" class="btn btn-sm w-75 mt-1 @if(count($zakljucna2)) sakrij @endif" id="prikaziZakljucnu" href="#ModalZakljucna" data-bs-toggle="modal">
                                <i class="fa fa-graduation-cap me-1" aria-hidden="true"></i>
                                Zaključi ocenu
                            </a>
                            <a type="button" class="btn btn-sm w-75 mt-1 mb-3" id="prikaziZahtev" href="#ModalFormaZahtev" data-bs-toggle="modal">
                                <i class="fa fa-flag me-1" aria-hidden="true"></i>
                                Pogrešna ocena
                            </a>
                        @endif
                        @if(session('korisnik')->id_uloga == 1 || (session('korisnik')->id_uloga == 2 && $u->id_odeljenje == session('odeljenje')->id_odeljenje))
                            <div class="sakrij mb-3 divKontakt">
                                <a class="btn btn-sm w-50 mt-2 mb-4 btnDodajKontakt" href="#ModalFormaRoditelj" data-bs-toggle="modal"><i class="fa fa-plus-square me-1" aria-hidden="true"></i> Dodaj kontakt</a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="col-lg-9">
                <ul class="nav nav-tabs navigacija">
                    <li class="nav-item">
                        <a class="nav-link linkTab active linkOcene" aria-current="page" href="#" id="linkOcene">Ocene i izostanci</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link linkTab linkPredmeti" href="#" id="linkPredmeti">Predmeti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link linkTab linkInfo" href="#" id="linkInfo">Informacije</a>
                    </li>
                </ul>
                <div class="ocene">
                    @foreach($ucenik as $u)
                        @if(session('korisnik')->id_uloga == 1 || session('korisnik')->id_uloga == 5 || (session('korisnik')->id_uloga == 2 && $u->id_odeljenje == session('odeljenje')->id_odeljenje))
                            <div>
                                <div class="col-lg-12">
                                    <select class="form-select mt-4 mb-3" id="predmetOcena" name="predmetOcena">
                                        @if(session('korisnik')->id_uloga == 2)
                                            <option value="{{ session('predmet')->id_predmet }}" selected>{{ session('predmet')->naziv }}</option>
                                            @foreach($predmeti as $p)
                                                @if(session('predmet')->id_predmet != $p->id_predmet)
                                                    <option value="{{ $p->id_predmet }}">{{ $p->naziv }}</option>
                                                @endif
                                            @endforeach
                                            <input type="hidden" id="idpredmet" value="{{ session('predmet')->id_predmet }}">
                                        @else
                                            <option value="0">Izaberite...</option>
                                            @foreach($predmeti as $p)
                                                <option value="{{ $p->id_predmet }}">{{ $p->naziv }}</option>
                                            @endforeach
                                        @endif
                                        <input type="hidden" id="idpredmet" value="">
                                    </select>
                                </div>
                            </div>
                            <div class="w-100 text-center mt-5 izaberitePredmet">
                                <h5 class="fw-normal">Izaberite predmet za prikaz ocena.</h5>
                            </div>
                        @endif
                    @endforeach
                    <div class="d-flex justify-content-between polugodista" >
                        <div class="col-lg-6 mt-4">
                            <div class="naslovPolugodiste mb-4">
                                <h5 class="polugodiste">I Polugodište</h5>
                            </div>
                            <div class="w-100 d-flex justify-content-between">
                                <div class="polug1 d-flex w-50">
                                    @foreach($ocene as $ocena)
                                        @if($ocena->id_polugodiste == 1)
                                            <div title="{{ $ocena->vrsta }}" class="ocena">
                                                <span>{{$ocena ->ocena}}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="naslovPolugodiste mb-4">
                                <h5 class="polugodiste">II Polugodište</h5>
                            </div>
                            <div class="w-100 d-flex justify-content-between">
                                <div class="polug2 d-flex w-50">
                                    @foreach($ocene as $ocena)
                                        @if($ocena->id_polugodiste == 2)
                                            <div title="{{ $ocena->vrsta }}" class="ocena">
                                                <span>{{$ocena ->ocena}}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start prosek mt-3">
                        <div class="prosekPrvo d-flex justify-content-start me-3">
                            @foreach($prosekPrvo as $p)
                                <div class="srednja">
                                    <p>Srednja ocena (I Polugodište)</p>
                                </div>
                                <div class="srednjaOcena">
                                    <p class="fw-bold">{{ round($p->prosecnaOcena, 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="prosekDrugo d-flex justify-content-start">
                            @foreach($prosekDrugo as $p)
                                <div class="srednja">
                                    <p>Srednja ocena (II Polugodište)</p>
                                </div>
                                <div class="srednjaOcena">
                                    <p class="fw-bold">{{ round($p->prosecnaOcena, 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-5" id="zakljucnaNaslov">
                        <h5>Zaključne ocene</h5>
                    </div>
                    <div class="d-flex justify-content-start" id="zakljucneUcenik">
                        <div class="zakljucnaPolugodiste me-3 mt-2">
                            <h6>I Polugodište</h6>
                            @if(count($zakljucna1))
                                @foreach($zakljucna1 as $z)
                                    @switch($z->zakljucna_ocena)
                                        @case(1)
                                            <p>nedovoljan ({{$z->zakljucna_ocena}})</p>
                                            @break
                                        @case(2)
                                            <p>dovoljan ({{$z->zakljucna_ocena}})</p>
                                            @break
                                        @case(3)
                                            <p>dobar ({{$z->zakljucna_ocena}})</p>
                                            @break
                                        @case(4)
                                            <p>vrlo dobar ({{$z->zakljucna_ocena}})</p>
                                            @break
                                        @case(5)
                                            <p>odličan ({{$z->zakljucna_ocena}})</p>
                                            @break
                                    @endswitch
                                @endforeach
                            @else
                                <p>&ndash;</p>
                            @endif
                        </div>
                        <div class="zakljucnaPolugodiste mt-2">
                            <h6>II Polugodište</h6>
                            @if(count($zakljucna2))
                                @foreach($zakljucna2 as $z)
                                    @switch($z->zakljucna_ocena)
                                        @case(1)
                                            <p>nedovoljan ({{$z->zakljucna_ocena}})</p>
                                            @break
                                        @case(2)
                                            <p>dovoljan ({{$z->zakljucna_ocena}})</p>
                                            @break
                                        @case(3)
                                            <p>dobar ({{$z->zakljucna_ocena}})</p>
                                            @break
                                        @case(4)
                                            <p>vrlo dobar ({{$z->zakljucna_ocena}})</p>
                                            @break
                                        @case(5)
                                            <p>odličan ({{$z->zakljucna_ocena}})</p>
                                            @break
                                    @endswitch
                                @endforeach
                            @else
                                <p>&ndash;</p>
                            @endif
                        </div>
                    </div>
                    <div class="izostanciNaslov mt-5">
                        <h5>Izostanci</h5>
                    </div>
                    <div class="d-flex justify-content-start flex-wrap mt-3 mb-4">
                        <div class="col-lg-3 col-md-3 col-6 mt-3 d-flex align-items-center">
                            <div class="izostanci neregulisani">
                                <span>{{ count($neregulisani) }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="text-center mt-2 text-muted ms-2">neregulisani</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 mt-3 d-flex align-items-center">
                            <div class="izostanci opravdani">
                                <span>{{ count($opravdani) }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="text-center mt-2 text-muted ms-2">opravdani</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 mt-3 d-flex align-items-center">
                            <div class="izostanci neopravdani">
                                <span>{{ count($neopravdani) }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="text-center mt-2 text-muted ms-2">neopravdani</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6 mt-3 d-flex align-items-center">
                            <div class="izostanci ukupno">
                                <span>{{ count($neregulisani) + count($opravdani) + count($neopravdani) }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="text-center mt-2 text-muted ms-2">ukupno</p>
                            </div>
                        </div>
                    </div>
                    @if(count($neregulisani) > 0 && session('korisnik')->id_uloga == 2 && $u->id_odeljenje == session('odeljenje')->id_odeljenje)
                        <div class="izostanciNaslov mt-5">
                            <h5>Neregulisani izostanci</h5>
                        </div>
                        <div id="neregulisaniIzostanci">
                            <form action="{{ route('izostanci') }}" method="post" class="mt-4">
                                @csrf
                                @method('PUT')
                                @foreach($neregulisani as $n)
                                    <div class="d-flex justify-content-start flex-wrap mb-3">
                                        <div class="datumNeregulisani">
                                            <p>{{ date('d.m.Y.', strtotime($n->datum)) }} {{$n->naziv}}</p>
                                        </div>
                                        <div class="casNeregulisani">
                                            <p>{{$n->po_redu}}. čas</p>
                                        </div>
                                        <div class="w-25 neregulisaniSelect">
                                            <select class="form-select mb-3 mt-1 selectOpravdano" name="selectOpravdano[]">
                                                <option value="izaberite">Izaberite...</option>
                                                <option value="1">Opravdano</option>
                                                <option value="0">Neopravdano</option>
                                            </select>
                                        </div>
                                        <input type="hidden" class="idOdsutni" name="idOdsutni[]" value="{{$n->id_odsutni}}">
                                    </div>
                                @endforeach
                                <p class="text-danger" id="selectOpravdanoG"></p>
                                <div class="col-lg-3 mb-3">
                                    <input class="btn" type="submit" id="regIzostanke" value="Izvrši">
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="predmeti">
                    <div class="col-lg-12 table-responsive">
                        <table class="table" id="tabelaPredmeti">
                            <thead>
                            <tr>
                                <th scope="col">Predmet</th>
                                <th scope="col">Nastavnik</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($predmeti as $p)
                                <tr>
                                    <td class="nazivPredmeta">{{ $p->naziv }}</td>
                                    <td>{{ $p->prezime }} {{ $p->ime }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="informacije">
                    <div class="col-lg-6">
                        <div class="mb-3 naslovInfo">
                            <h4 class="fw-normal">Podaci o učeniku</h4>
                        </div>
                        @foreach($ucenik as $u)
                            <div class="d-flex">
                                <span class="fw-bold w-50">Datum rođenja</span>
                                <p class="ms-2">{{ date('d.m.Y.', strtotime($u->datum_rodjena)) }}</p>
                            </div>
                            <div class="d-flex">
                                <span class="fw-bold w-50">Mesto rođenja</span>
                                <p class="ms-2">{{ $u->mesto_rodjenja }}</p>
                            </div>
                            <div class="d-flex">
                                <span class="fw-bold w-50">Adresa</span>
                                <p class="ms-2">{{ $u->adresa }}</p>
                            </div>
                            <div class="d-flex">
                                <span class="fw-bold w-50">JMBG</span>
                                <p class="ms-2">{{ $u->jmbg }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3 naslovInfo">
                            <h4 class="fw-normal">Kontakti</h4>
                        </div>
                        @foreach($roditelji as $r)
                            <div class="d-flex">
                                <span class="fw-bold w-50">Ime</span>
                                <p class="ms-2">{{ $r->prezime }} {{ $r->ime }}</p>
                            </div>
                            <div class="d-flex">
                                <span class="fw-bold w-50">Telefon</span>
                                <p class="ms-2">{{ substr($r->telefon, 0, 3) }}/{{ substr($r->telefon, 3, 3) }}-{{ substr($r->telefon, 6, 3) }}</p>
                            </div>
                            <div class="d-flex">
                                <span class="fw-bold w-50">Email</span>
                                <p class="ms-2">{{ $r->email }}</p>
                            </div>
                            <div class="d-flex justify-content-end borderBottom">
                                @if(session('korisnik')->id_uloga == 1 || (session('korisnik')->id_uloga == 2 && $u->id_odeljenje == session('odeljenje')->id_odeljenje))
                                    <form action="{{ route('izbrisi') }}" method="post" id="formaKontakt">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="izbrisiRoditelj" value="{{ $r->id_korisnik }}">
                                        <button type="submit" class="btn btn-sm mb-2">
                                            Izbriši
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal fade" id="ModalFormaZahtev" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Pošaljite zahtev</h5>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <form action="{{ route('zahtev') }}" method="POST" class="mt-3">
                                    <div class="mb-3">
                                        <label for="pogresnaOcena" class="form-label">Pogrešna ocena</label>
                                        <input type="text" class="form-control" id="pogresnaOcena" name="pogresnaOcena" />
                                        <p class="text-danger" id="pogresnaOcenaG"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="novaOcena" class="form-label">Nova ocena</label>
                                        <input type="text" class="form-control" id="novaOcena" name="novaOcena" />
                                        <p class="text-danger" id="novaOcenaG"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="datumOcene" class="form-label">Datum ocene</label>
                                        <input type="date" class="form-control" id="datumOcene" name="datumOcene" />
                                        <p class="text-danger" id="datumOceneG"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="vrstaOceneZ" class="form-label">Vrsta ocene</label>
                                        <select class="form-select" id="vrstaOceneZ" name="vrstaOceneZ">
                                            <option value="0">Izaberite...</option>
                                            @foreach($vrsta as $v)
                                                <option value="{{ $v->id_vrsta_ocene }}">{{ $v->vrsta }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger" id="vrstaOceneZG"></p>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" id="zahtev">Pošalji</button>
                                <button type="button" class="btn" data-bs-dismiss="modal">Odustani</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ModalFormaRoditelj" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Pošaljite zahtev</h5>
                                <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                @include('partials.form', ["action" => 'dodajKontakt'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ModalOcena" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Ocenite učenika</h5>
                                <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <form action="{{ route('ocena') }}" method="post">
                                    <input type="text" class="form-control w-100" id="ocenaVred" name="ocenaVred" placeholder="Unesite ocenu">
                                    <p class="text-danger" id="ocenaGreska"></p>
                                    <select class="form-select" id="vrstaOcene" name="vrstaOcene">
                                        <option value="0">Izaberite...</option>
                                        @foreach($vrsta as $v)
                                            <option value="{{ $v->id_vrsta_ocene }}">{{ $v->vrsta }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger" id="vrstaGreska"></p>
                                    <input type="button" class="btn" id="btnOcena" value="Oceni">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ModalZakljucna" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Zaključite ocenu</h5>
                                <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                                </button>
                            </div>
                            <div class="modal-body" >
                                <form action="{{ route('zakljucnaOcena') }}" method="post">
                                    <input type="text" class="form-control w-100" id="zakljucnaOcena" name="zakljucnaOcena" placeholder="Zaključite ocenu">
                                    <p class="text-danger" id="zakljucnaGreska"></p>
                                    <select class="form-select mb-3 @if(count($zakljucna1)) sakrij @endif" id="polug" name="polug">
                                        <option value="0">Izaberite...</option>
                                        <option value="1">Prvo polugodište</option>
                                        <option value="2">Drugo polugodište</option>
                                    </select>
                                    <input type="button" class="btn" id="btnZakljuci" value="Zaključi">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
