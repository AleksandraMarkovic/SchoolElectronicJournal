<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use App\Models\Predmet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NastavniciController extends OsnovniController
{
    private $nastavniciModel;

    public function index(){
        $this->nastavniciModel = new Korisnik();
        $this->data['nastavnici'] = $this->nastavniciModel->dohvatiNastavnike();
        return view('pages.admin.nastavnici', $this->data);
    }

    public function delete(Request $request){
        try {
            \DB::table('korisnici')->where('id_korisnik', $request->input('nastavnikid'))->delete();
            return redirect()->route("nastavnici")->with("success", "Uspešno obrisan nastavnik!");
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
