<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cas extends Model
{
    public function dohvatiDatume($id){
        return \DB::table('cas')->select('datum')
            ->where('id_odeljenje', $id)
            ->groupBy('datum')
            ->paginate(5);
    }

    public function filterDatum($datum, $id){
        return \DB::table('cas')->select('datum')
            ->where('id_odeljenje', $id)
            ->where('datum', $datum)
            ->distinct()
            ->get();
    }

    public function filter($datum){
        return \DB::table('cas')->select('cas.*', 'predmet.naziv', 'korisnici.ime', 'korisnici.prezime' )
            ->join('predmet', 'predmet.id_predmet', '=', 'cas.id_predmet')
            ->join('korisnici', 'korisnici.id_korisnik', '=', 'cas.id_korisnik')
            ->where('cas.datum', $datum)
            ->orderBy('cas.po_redu')
            ->get();
    }

    public function dohvatiOdsutne($id){
        return \DB::table('ucenik')->select('ucenik.*')
            ->join('odsutni', 'odsutni.id_ucenik', '=', 'ucenik.id_ucenik')
            ->where('odsutni.id_cas', $id)
            ->distinct()
            ->get();
    }

    public function dohvatiZaCas($id){
        return \DB::table('cas')->select('id_cas', 'opis', 'napomena')
            ->where('cas.id_cas', $id)
            ->get();
    }
}
