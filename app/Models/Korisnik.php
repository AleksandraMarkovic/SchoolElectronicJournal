<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korisnik extends Model
{
    public function dohvatiStaresine(){
        return \DB::table('korisnici')->select('korisnici.id_korisnik', 'korisnici.ime', 'korisnici.prezime')
            ->leftJoin('odeljenje', 'korisnici.id_korisnik', '=', 'odeljenje.id_korisnik')
            ->whereNotIn('korisnici.id_korisnik', function ($query){
                $query->select('id_korisnik')
                    ->from('odeljenje');
            })
            ->where('korisnici.id_uloga', 2)
            ->get();
    }

    public function dohvatiNastavnike(){
        return \DB::table('korisnici')->select('korisnici.*', 'predmet.naziv')
            ->leftJoin('korisnik_predmet', 'korisnik_predmet.id_korisnik', '=', 'korisnici.id_korisnik')
            ->leftJoin('predmet', 'korisnik_predmet.id_predmet', '=', 'predmet.id_predmet')
            ->where('korisnici.id_uloga', 2)
            ->orWhere('korisnici.id_uloga', 3)
            ->get();

    }
}
