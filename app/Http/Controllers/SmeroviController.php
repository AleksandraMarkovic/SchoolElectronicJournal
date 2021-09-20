<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmerRequest;
use App\Models\Smer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SmeroviController extends OsnovniController
{
    private $smerModel;

    public function index(){
        $this->smerModel = new Smer();
        $this->data['podaci'] = $this->smerModel->dohvatiSmerove();
        return view('pages.admin.smerovi', $this->data);
    }

    public function insert(SmerRequest $request){
        try {
            $provera = \DB::table('smer')->where("naziv", $request->input('naziv'))->first();

            if($provera){
                return response(['error'=>true,'errorMsg'=>"Smer već postoji!"],400);
            }

            $insert = \DB::table('smer')->insert([
                'naziv' => $request->input('naziv')
            ]);

            if($insert){
                return "Uspešno ste dodali smer!";
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function delete(Request $request){
        try {
            \DB::table('smer')->where('id_smer', $request->input('smerid'))->delete();
            return redirect()->route("smerovi")->with("success", "Uspesno obrisan smer!");
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
