<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zahtev extends Model
{
    public function dohvatiZahteve(){
        return \DB::table('zahtev')->select('zahtev.*', 'ucenik.ime', 'ucenik.prezime', 'korisnici.ime as imeK', 'korisnici.prezime as prezimeK', 'vrsta_ocene.vrsta', 'predmet.naziv')
            ->join('ucenik', 'ucenik.id_ucenik', '=', 'zahtev.id_ucenik')
            ->join('vrsta_ocene', 'vrsta_ocene.id_vrsta_ocene', '=', 'zahtev.id_vrsta_ocene')
            ->join('korisnici', 'korisnici.id_korisnik', '=', 'zahtev.id_korisnik')
            ->join('korisnik_predmet', 'korisnik_predmet.id_korisnik', '=', 'korisnici.id_korisnik')
            ->join('predmet', 'korisnik_predmet.id_predmet', '=', 'predmet.id_predmet')
            ->where('zahtev.odobreno', null)
            ->get();
    }
}
