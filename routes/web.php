<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\LoginController::class, 'index'])->name('loginPage');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get("/logout", [\App\Http\Controllers\LoginController::class, "logout"])->name("logout");

Route::get('/home', [\App\Http\Controllers\PocetnaController::class, 'index'])->name('home')->middleware('profesor');
Route::get('/home/direktor', [\App\Http\Controllers\PocetnaController::class, 'direktor'])->name('direktor');

Route::get('/dnevnik/{id}', [\App\Http\Controllers\DnevnikController::class, 'index'])->name('dnevnik')->middleware('profesor');
Route::get('/dnevnik/{id}/filter', [\App\Http\Controllers\DnevnikController::class, 'filter'])->name('dnevnikFilter')->middleware('profesor');
Route::get('/dnevnik/{id}/paginacija', [\App\Http\Controllers\DnevnikController::class, 'paginacija'])->name('paginacija')->middleware('profesor');
Route::get('/dnevnik/{id}/filterDatum', [\App\Http\Controllers\DnevnikController::class, 'filterDatum'])->name('filterDatum')->middleware('profesor');
Route::get('/dnevnik/{id}/odsutni', [\App\Http\Controllers\DnevnikController::class, 'odustni'])->name('dnevnikOdustni')->middleware('profesor');
Route::delete('/dnevnik/{id}/obrisi', [\App\Http\Controllers\DnevnikController::class, 'obrisi'])->name('obrisiCas')->middleware('profesor');
Route::get('/dnevnik/{id}/edit', [\App\Http\Controllers\DnevnikController::class, 'edit'])->name('edit')->middleware('profesor');
Route::put('/dnevnik/update', [\App\Http\Controllers\DnevnikController::class, 'update'])->name('updateCas')->middleware('profesor');

Route::get('/cas/{id}', [\App\Http\Controllers\CasController::class, 'index'])->name('formaCas')->middleware('profesor');
Route::post('/cas/{id}/insert', [\App\Http\Controllers\CasController::class, 'insert'])->name('dodajCas')->middleware('profesor');

Route::get('/profil', [\App\Http\Controllers\ProfilController::class, 'index'])->name('profil')->middleware('korisnik');
Route::put('/profil/izmeni', [\App\Http\Controllers\ProfilController::class, 'updateProfil'])->name('izmeniProfil')->middleware('korisnik');
Route::put('/profil/izmeniLozinku', [\App\Http\Controllers\ProfilController::class, 'izmeniLozinku'])->name('izmeniLozinku')->middleware('korisnik');

Route::get('/smerovi', [\App\Http\Controllers\SmeroviController::class, 'index'])->name('smerovi')->middleware('admin');
Route::post('/smerovi/insert', [\App\Http\Controllers\SmeroviController::class, 'insert'])->name('dodajSmer')->middleware('admin');
Route::delete('/smerovi/delete', [\App\Http\Controllers\SmeroviController::class, 'delete'])->name('izbrisiSmer')->middleware('admin');

Route::get('/predmeti', [\App\Http\Controllers\PredmetiController::class, 'index'])->name('predmeti')->middleware('admin');
Route::post('/predmeti/insert', [\App\Http\Controllers\PredmetiController::class, 'insert'])->name('dodajPredmet')->middleware('admin');
Route::delete('/predmeti/delete', [\App\Http\Controllers\PredmetiController::class, 'delete'])->name('izbrisiPredmet')->middleware('admin');

Route::get('/nastavnici', [\App\Http\Controllers\NastavniciController::class, 'index'])->name('nastavnici')->middleware('admin');
Route::delete('/nastavnici/delete', [\App\Http\Controllers\NastavniciController::class, 'delete'])->name('obrisiNastavnika')->middleware('admin');

Route::get('/ucenici', [\App\Http\Controllers\UceniciController::class, 'index'])->name('ucenici')->middleware('adminRazredni');
Route::post('/ucenici/insert', [\App\Http\Controllers\UceniciController::class, 'insert'])->name('dodajUcenika')->middleware('adminRazredni');

Route::get('/odeljenja', [\App\Http\Controllers\OdeljenjaController::class, 'index'])->name('odeljenja')->middleware('admin');
Route::get('/odeljenja/filter', [\App\Http\Controllers\OdeljenjaController::class, 'filterPredmeti'])->name('odeljenjaPredmet')->middleware('admin');
Route::post('/odeljenja/insert', [\App\Http\Controllers\OdeljenjaController::class, 'insert'])->name('dodajOdeljenje')->middleware('admin');

Route::get('/registracija', [\App\Http\Controllers\RegistracijaController::class, 'index'])->name('registracijaForma')->middleware('adminRazredni');
Route::post('/registracija/insert', [\App\Http\Controllers\RegistracijaController::class, 'insert'])->name('registracija')->middleware('adminRazredni');
Route::post('/roditelj', [\App\Http\Controllers\RegistracijaController::class, 'insertRoditelj'])->name('dodajKontakt')->middleware('adminRazredni');

Route::get('/odeljenje/{id}', [\App\Http\Controllers\OdeljenjaController::class, 'show'])->name('odeljenje')->middleware('profesor');
Route::get('/ucenik/{id}', [\App\Http\Controllers\UceniciController::class, 'show'])->name('ucenik')->middleware('profesor');
Route::get('/ucenik/{id}/filter', [\App\Http\Controllers\UceniciController::class, 'filter'])->name('ucenikFilter')->middleware('profesor');
Route::put('/ucenik/izostanci', [\App\Http\Controllers\UceniciController::class, 'izostanci'])->name('izostanci')->middleware('razredni');
Route::post('/ucenik/ocena', [\App\Http\Controllers\UceniciController::class, 'oceni'])->name('ocena')->middleware('profesor');
Route::delete('/ucenik/izbrisi', [\App\Http\Controllers\UceniciController::class, 'izbrisi'])->name('izbrisi')->middleware('adminRazredni');
Route::post('/ucenik/zahtev', [\App\Http\Controllers\UceniciController::class, 'zahtev'])->name('zahtev')->middleware('profesor');
Route::post('/ucenik/zakljucna', [\App\Http\Controllers\UceniciController::class, 'zakljuciOcenu'])->name('zakljucnaOcena')->middleware('profesor');
Route::put('/ucenik/vladanje', [\App\Http\Controllers\UceniciController::class, 'vladanje'])->name('vladanje')->middleware('razredni');


Route::get('/zahtevi', [\App\Http\Controllers\ZahteviController::class, 'index'])->name('zahtevi')->middleware('direktor');
Route::put('/zahtevi/odobri', [\App\Http\Controllers\ZahteviController::class, 'odobri'])->name('odobriZahtev')->middleware('direktor');
Route::put('/zahtevi/odbij', [\App\Http\Controllers\ZahteviController::class, 'odbij'])->name('odbijZahtev')->middleware('direktor');

Route::get('/roditelj', [\App\Http\Controllers\RoditeljController::class, 'index'])->name('roditelj')->middleware('roditelj');
Route::get('/roditelj/filter', [\App\Http\Controllers\RoditeljController::class, 'filter'])->name('roditeljFilter')->middleware('roditelj');
