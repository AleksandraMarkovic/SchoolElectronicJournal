<?php

namespace App\Http\Controllers;

use App\Http\Requests\OdeljenjeRequest;
use App\Models\Korisnik;
use App\Models\Odeljenje;
use App\Models\Predmet;
use App\Models\Smer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OdeljenjaController extends OsnovniController
{
    private $staresinaModel;
    private $smerModel;
    private $predmetModel;
    private $odeljenjeModel;

    public function index(){
        $this->staresinaModel = new Korisnik();
        $this->data['korisnici'] = $this->staresinaModel->dohvatiStaresine();
        $this->smerModel = new Smer();
        $this->data['smerovi'] = $this->smerModel->dohvatiSmerove();
        return view('pages.admin.odeljenja', $this->data);
    }

    public function show($id){
        $this->odeljenjeModel = new Odeljenje();
        $this->data['ucenici'] = $this->odeljenjeModel->dohvatiOdeljenje($id);
        $this->data['podaci'] = $this->odeljenjeModel->dohvatiRazrednog($id);
        return view('pages.ucenici.odeljenje', $this->data);
    }

    public function filterPredmeti(Request $request){
        $this->predmetModel = new Predmet();
        $predmeti = $this->predmetModel->predmetiSmer($request->input('id'));
        return response()->json($predmeti);
    }

    public function insert(OdeljenjeRequest $request){
        try {
            $insert = \DB::table('odeljenje')->insertGetId([
                'broj_odeljenja' => $request->input('broj'),
                'godina' => $request->input('godina'),
                'id_korisnik' => $request->input('razredni'),
                'id_smer' => $request->input('smer')
            ]);

            if($insert) {
                foreach ($request->input('predmeti') as $p) {
                    \DB::table('odeljenje_predmet')->insert([
                        'id_odeljenje' => $insert,
                        'id_predmet' => explode('|', $p)[0],
                        'id_korisnik' => explode('|', $p)[1]
                    ]);
                }
            }

                return "Uspešno dodato odeljenje!";
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
