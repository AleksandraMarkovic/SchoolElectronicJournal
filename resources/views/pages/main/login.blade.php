@extends('layouts.layoutLogin')
@section('title') Login @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <h1 id="naslov"><i class="fa fa-book" aria-hidden="true" ></i>eDnevnik</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center" id="tabelaLogin">
            <div class="col-lg-4 col-md-6 col-8 d-flex justify-content-center align-items-center" id="loginKol">
                <form action="{{ route('login') }}" method="POST" class="mt-3">
                    <div class="mb-3">
                        <label for="kor_ime" class="form-label">Korisničko ime</label>
                        <input type="text" class="form-control" id="kor_ime" name="kor_ime" autocomplete="off"/>
                        <p class="text-danger" id="kor_imeGreska"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lozinka" class="form-label">Šifra</label>
                        <input type="password" class="form-control" id="lozinka" name="lozinka" />
                        <p class="text-danger" id="lozinkaGreska"></p>
                    </div>
                    <button type="button" class="btn" id="loginBtn">Prijavi se</button>
                </form>
            </div>
        </div>
    </div>
@endsection
