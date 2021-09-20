<?php

namespace App\Http\Controllers;

use App\Http\Requests\CasRequest;
use App\Models\Odeljenje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CasController extends OsnovniController
{
    private $odeljenjeModel;

    public function index($id){
        $this->odeljenjeModel = new Odeljenje();
        $this->data['ucenici'] = $this->odeljenjeModel->dohvatiOdeljenje($id);
        return view('pages.main.cas', $this->data);
    }

    public function insert(CasRequest $request){
        try {
            $predmet = \DB::table('korisnik_predmet')->select("id_predmet")
                ->where("id_korisnik", session('korisnik')->id_korisnik)
                ->first();

            $insert = \DB::table('cas')->insertGetId([
                'opis' => $request->input('opis'),
                'datum' => $request->input('datum'),
                'po_redu' => $request->input('brojCasa'),
                'napomena' => $request->input('napomena'),
                'id_korisnik' => session('korisnik')->id_korisnik,
                'id_predmet' => $predmet->id_predmet,
                'id_odeljenje' => $request->input('id')
            ]);

            if($insert){
                if($request->input('odsutniNiz') != null){
                    for($i=1; $i<=count($request->input('odsutniNiz')); $i++){
                        \DB::table('odsutni')->insert([
                            'id_cas' => $insert,
                            'id_ucenik' => $i
                        ]);
                    }

                }
                return "Uspešno upisan čas!";
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
