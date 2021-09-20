<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predmet extends Model
{
    public function dohvatiPredmete(){
        return \DB::table("predmet")->select('id_predmet as id', 'naziv')->get();
    }

    public function predmetiSmer($id){
        return \DB::table('predmet')->select('predmet.id_predmet', 'predmet.naziv', 'korisnici.id_korisnik', 'korisnici.ime', 'korisnici.prezime')
            ->join('smer_predmet', 'predmet.id_predmet', '=', 'smer_predmet.id_predmet')
            ->join('korisnik_predmet', 'predmet.id_predmet', '=', 'korisnik_predmet.id_predmet')
            ->join('korisnici', 'korisnici.id_korisnik', '=', 'korisnik_predmet.id_korisnik')
            ->where('smer_predmet.id_smer', $id)
            ->get();
    }
}
