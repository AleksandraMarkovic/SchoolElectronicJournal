<?php

namespace App\Http\Controllers;

use App\Models\Odeljenje;
use Illuminate\Http\Request;

class PocetnaController extends OsnovniController
{
    private $odeljenjeModel;

    public function index(){
        $this->odeljenjeModel = new Odeljenje();
        if(session('korisnik')->id_uloga == 1 || session('korisnik')->id_uloga == 5) {
            $this->data['podaci'] = $this->odeljenjeModel->dohvatiOdeljenjaPocetna();
        }
        else if(session('korisnik')->id_uloga == 2 || session('korisnik')->id_uloga == 3) {
            $this->data['podaci'] = $this->odeljenjeModel->dohvatiOdeljenjaProfesor(session('korisnik')->id_korisnik);
        }

        return view("pages.main.home", $this->data);
    }

    public function direktor(){
        $opravdano = \DB::table('odsutni')->where("opravdano", 1)->get();
        $neopravdano = \DB::table('odsutni')->where("opravdano", 0)->get();
        $neregulisani = \DB::table('odsutni')->where("opravdano", null)->get();
        $odobreni = \DB::table('zahtev')->where('odobreno', 1)->get();
        $neodobreni = \DB::table('zahtev')->where('odobreno', 0)->get();
        return response()->json(
            [
                "opravdano" => $opravdano,
                "neopravdano" => $neopravdano,
                "neregulisani" => $neregulisani,
                "odobreni" => $odobreni,
                "neodobreni" => $neodobreni
            ]
        );
    }
}
