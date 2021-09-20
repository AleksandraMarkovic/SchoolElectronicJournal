<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odeljenje extends Model
{
    public function dohvatiOdeljenja() {
        return \DB::table('odeljenje')->get();
    }

    public function dohvatiOdeljenje($id){
        return \DB::table('ucenik')->select('ucenik.id_ucenik', 'ucenik.ime', 'ucenik.prezime', 'ucenik.slika', 'smer.naziv')
            ->join('odeljenje', 'odeljenje.id_odeljenje', '=', 'ucenik.id_odeljenje')
            ->join('smer', 'smer.id_smer', '=', 'odeljenje.id_smer')
            ->where('ucenik.id_odeljenje', $id)
            ->get();
    }

    public function dohvatiRazrednog($id){
        return \DB::table('odeljenje')->select('odeljenje.broj_odeljenja', 'odeljenje.godina', 'korisnici.ime', 'korisnici.prezime')
            ->join('korisnici', 'korisnici.id_korisnik', '=', 'odeljenje.id_korisnik')
            ->where('odeljenje.id_odeljenje', $id)
            ->get();
    }

    public function dohvatiOdeljenjaPocetna(){
        return \DB::table('odeljenje')->select('odeljenje.*', 'korisnici.ime', 'korisnici.prezime')
            ->join('korisnici', 'korisnici.id_korisnik', '=', 'odeljenje.id_korisnik')
            ->orderBy('odeljenje.godina', 'asc')
            ->orderBy('odeljenje.broj_odeljenja', 'asc')
            ->get();
    }

    public function dohvatiOdeljenjaProfesor($id){
        return \DB::table('odeljenje')->select('odeljenje.*', 'predmet.naziv')
            ->join('korisnici', 'korisnici.id_korisnik', '=', 'odeljenje.id_korisnik')
            ->join('odeljenje_predmet', 'odeljenje_predmet.id_odeljenje', '=', 'odeljenje.id_odeljenje')
            ->join('predmet', 'predmet.id_predmet', '=', 'odeljenje_predmet.id_predmet')
            ->where('odeljenje_predmet.id_korisnik', $id)
            ->orderBy('odeljenje.godina', 'asc')
            ->orderBy('odeljenje.broj_odeljenja', 'asc')
            ->get();
    }
}
