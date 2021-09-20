<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ucenik extends Model
{
    public function dohvatiUcenika($id){
        return \DB::table('ucenik')->select('ucenik.*', 'smer.naziv')
            ->join('odeljenje', 'odeljenje.id_odeljenje', '=', 'ucenik.id_odeljenje')
            ->join('smer', 'smer.id_smer', '=', 'odeljenje.id_smer')
            ->where('ucenik.id_ucenik', $id)
            ->get();
    }

    public function dohvatiPredmeteUcenika($id){
        return \DB::table('predmet')->select('predmet.*', 'korisnici.*')
            ->join('odeljenje_predmet', 'odeljenje_predmet.id_predmet', '=', 'predmet.id_predmet')
            ->join('odeljenje', 'odeljenje.id_odeljenje', '=', 'odeljenje_predmet.id_odeljenje')
            ->join('ucenik', 'ucenik.id_odeljenje', '=', 'odeljenje.id_odeljenje')
            ->join('korisnici', 'korisnici.id_korisnik', '=', 'odeljenje_predmet.id_korisnik')
            ->where('ucenik.id_ucenik', $id)
            ->get();
    }

    public function dohvatiKontakte($id){
        return \DB::table('korisnici')->select('korisnici.*')
            ->join('roditelj_ucenik', 'roditelj_ucenik.id_korisnik', '=', 'korisnici.id_korisnik')
            ->where('roditelj_ucenik.id_ucenik', $id)
            ->get();
    }

    public function dohvatiIzostanke($id, $opravdano){
        return \DB::table('odsutni')
            ->where('opravdano', $opravdano)
            ->where('id_ucenik', $id)
            ->get();
    }

    public function dohvatiNeregulisane($id){
        return \DB::table('odsutni')->select('odsutni.id_odsutni', 'cas.po_redu', 'cas.datum', 'predmet.naziv')
            ->join('cas', 'cas.id_cas', '=', 'odsutni.id_cas')
            ->join('predmet', 'predmet.id_predmet', '=', 'cas.id_predmet')
            ->where('opravdano', null)
            ->where('id_ucenik', $id)
            ->get();
    }

    public function dohvatiOceneAdmin($id, $idUcenik){
        return \DB::table('ocene')->select('ocene.*', 'vrsta_ocene.vrsta')
            ->join('vrsta_ocene', 'vrsta_ocene.id_vrsta_ocene', '=', 'ocene.id_vrsta_ocene')
            ->where('ocene.id_predmet', $id)
            ->where('ocene.id_ucenik', $idUcenik)
            ->get();
    }

    public function dohvatiProsek($id, $idUcenik, $polugodiste){
        return \DB::table('ocene')->selectRaw('AVG(ocene.ocena) as prosecnaOcena')
            ->join('vrsta_ocene', 'vrsta_ocene.id_vrsta_ocene', '=', 'ocene.id_vrsta_ocene')
            ->join('korisnik_predmet', 'korisnik_predmet.id_predmet', '=', 'ocene.id_predmet')
            ->where('ocene.id_predmet', $id)
            ->where('ocene.id_ucenik', $idUcenik)
            ->where('ocene.id_polugodiste', $polugodiste)
            ->get();
    }

    public function dohvatiOcene($id, $ucenik){
        return \DB::table('ocene')->select('ocene.*', 'vrsta_ocene.vrsta')
            ->join('vrsta_ocene', 'vrsta_ocene.id_vrsta_ocene', '=', 'ocene.id_vrsta_ocene')
            ->join('korisnik_predmet', 'korisnik_predmet.id_predmet', '=', 'ocene.id_predmet')
            ->where('korisnik_predmet.id_korisnik', $id)
            ->where('ocene.id_ucenik', $ucenik)
            ->get();
    }

    public function dohvatiVrstu(){
        return \DB::table('vrsta_ocene')->get();
    }

    public function prosekPolug($id, $polugodiste, $ucenik){
        return \DB::table('ocene')->selectRaw('AVG(ocene.ocena) as prosecnaOcena')
            ->join('vrsta_ocene', 'vrsta_ocene.id_vrsta_ocene', '=', 'ocene.id_vrsta_ocene')
            ->join('korisnik_predmet', 'korisnik_predmet.id_predmet', '=', 'ocene.id_predmet')
            ->where('korisnik_predmet.id_korisnik', $id)
            ->where('ocene.id_ucenik', $ucenik)
            ->where('ocene.id_polugodiste', $polugodiste)
            ->get();
    }

    public function dohvatiZakljucnu($id, $ucenik, $polugodiste){
        return \DB::table('zakljucna_ocena')->select("zakljucna_ocena.*")
            ->join('korisnik_predmet', 'korisnik_predmet.id_predmet', '=', 'zakljucna_ocena.id_predmet')
            ->where('korisnik_predmet.id_korisnik', $id)
            ->where('zakljucna_ocena.id_ucenik', $ucenik)
            ->where('zakljucna_ocena.tip_ocene', $polugodiste)
            ->get();
    }

    public function dohvatiZakljucnuAdmin($id, $ucenik, $polugodiste){
        return \DB::table('zakljucna_ocena')->select("zakljucna_ocena.*")
            ->where('zakljucna_ocena.id_predmet', $id)
            ->where('zakljucna_ocena.id_ucenik', $ucenik)
            ->where('zakljucna_ocena.tip_ocene', $polugodiste)
            ->get();
    }

}
