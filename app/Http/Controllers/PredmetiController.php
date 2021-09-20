<?php

namespace App\Http\Controllers;

use App\Http\Requests\PredmetRequest;
use App\Models\Predmet;
use App\Models\Smer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PredmetiController extends OsnovniController
{
    private $predmetModel;
    private $smerModel;

    public function index(){
        $this->predmetModel = new Predmet();
        $this->data['podaci'] = $this->predmetModel->dohvatiPredmete();
        $this->smerModel = new Smer();
        $this->data['smerovi'] = $this->smerModel->dohvatiSmerove();
        return view('pages.admin.predmeti', $this->data);
    }

    public function insert(PredmetRequest $request){
        try {
            $insert = \DB::table('predmet')->insertGetId([
                'naziv' => $request->input('naziv')
            ]);

            if($insert){
                for($i=1; $i<=count($request->input('smerovi')); $i++){
                    \DB::table('smer_predmet')->insert([
                        'id_predmet' => $insert,
                        'id_smer' => $i
                    ]);
                }

                return "Uspešno ste dodali predmet!";
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function delete(Request $request){
        try {
            \DB::table('predmet')->where('id_predmet', $request->input('predmetid'))->delete();
            return redirect()->route("predmeti")->with("success", "Uspesno obrisan predmet!");
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
