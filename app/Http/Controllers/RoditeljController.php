<?php

namespace App\Http\Controllers;

use App\Models\Roditelj;
use Illuminate\Http\Request;

class RoditeljController extends OsnovniController
{
    private $roditeljModel;

    public function index(){
        $this->roditeljModel = new Roditelj();
        $this->data['ucenici'] = $this->roditeljModel->dohvatiUcenika();
        return view('pages.roditelj.roditelj', $this->data);
    }

    public function filter(Request $request){
        $this->roditeljModel = new Roditelj();
        $opravdano = $this->roditeljModel->dohvatiIzostanke($request->input('id'), 1);
        $neopravdano = $this->roditeljModel->dohvatiIzostanke($request->input('id'), 0);
        $neregulisani = $this->roditeljModel->dohvatiNeregulisane($request->input('id'));
        $predmeti = $this->roditeljModel->dohvatiPredmeteUcenika($request->input('id'));
        $ocene = $this->roditeljModel->dohvatiOceneAdmin($request->input('predmet'), $request->input('ucenik'));
        $prosek = $this->roditeljModel->dohvatiProsek($request->input('predmet'), $request->input('ucenik'), 1);
        $prosek2 = $this->roditeljModel->dohvatiProsek($request->input('predmet'), $request->input('ucenik'), 2);
        $zakljucna1 = $this->roditeljModel->dohvatiZakljucnuAdmin($request->input('predmet'), $request->input('ucenik'), 1);
        $zakljucna2 = $this->roditeljModel->dohvatiZakljucnuAdmin($request->input('predmet'), $request->input('ucenik'), 2);
        $ucenik = $this->roditeljModel->dohvatiJednogUcenika($request->input('id'));
        return response()->json(
            [
                "opravdano" => $opravdano,
                "neopravdano" => $neopravdano,
                "neregulisani" => $neregulisani,
                "predmeti" => $predmeti,
                "ocene" => $ocene,
                "prosek" => $prosek,
                "prosek2" => $prosek2,
                "zakljucna1" => $zakljucna1,
                "zakljucna2" => $zakljucna2,
                "ucenik" => $ucenik
            ]
        );
    }
}
