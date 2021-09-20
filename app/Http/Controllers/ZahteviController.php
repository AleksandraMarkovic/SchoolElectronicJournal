<?php

namespace App\Http\Controllers;

use App\Models\Zahtev;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ZahteviController extends OsnovniController
{
    private $zahteviModel;

    public function index(){
        $this->zahteviModel = new Zahtev();
        $this->data['zahtevi'] = $this->zahteviModel->dohvatiZahteve();
        return view('pages.direktor.zahtevi', $this->data);
    }


    public function odobri(Request $request){
        try {
            \DB::table('zahtev')->where('id_zahtev', $request->input('zahtev'))
                ->update([
                    'odobreno' => 1
                ]);

            \DB::table('ocene')
                ->where('datum', $request->input('datumZ'))
                ->where('id_ucenik', $request->input('ucenik'))
                ->where('id_vrsta_ocene', $request->input('vrsta'))
                ->update([
                   'ocena' => $request->input('nova')
                ]);

            return redirect()->route('zahtevi')->with('success', 'Zahtev odobren!');
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }


    public function odbij(Request $request){
        try {
            \DB::table('zahtev')->where('id_zahtev', $request->input('zahtev'))
                ->update([
                    'odobreno' => 0
                ]);

            return redirect()->route('zahtevi')->with('error', 'Zahtev odbijen.');
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
