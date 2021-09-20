<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzostanciRequest;
use App\Http\Requests\OcenaRequest;
use App\Http\Requests\OceniRequest;
use App\Http\Requests\UceniciRequest;
use App\Http\Requests\VladanjeRequest;
use App\Http\Requests\ZahtevRequest;
use App\Models\Odeljenje;
use App\Models\Ucenik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UceniciController extends OsnovniController
{
    private $odeljenjeModel;
    private $ucenikModel;

    public function index(){
        $this->odeljenjeModel = new Odeljenje();
        $this->data['odeljenja'] = $this->odeljenjeModel->dohvatiOdeljenja();
        return view('pages.admin.ucenici', $this->data);
    }

    public function show($id){
        $this->ucenikModel = new Ucenik();
        $this->data['ucenik'] = $this->ucenikModel->dohvatiUcenika($id);
        $this->data['predmeti'] = $this->ucenikModel->dohvatiPredmeteUcenika($id);
        $this->data['roditelji'] = $this->ucenikModel->dohvatiKontakte($id);
        $this->data['opravdani'] = $this->ucenikModel->dohvatiIzostanke($id, 1);
        $this->data['neopravdani'] = $this->ucenikModel->dohvatiIzostanke($id, 0);
        $this->data['neregulisani'] = $this->ucenikModel->dohvatiNeregulisane($id);
        $this->data['ocene'] = $this->ucenikModel->dohvatiOcene(session('korisnik')->id_korisnik, $id);
        $this->data['vrsta'] = $this->ucenikModel->dohvatiVrstu();
        $this->data['prosekPrvo'] = $this->ucenikModel->prosekPolug(session('korisnik')->id_korisnik, 1, $id);
        $this->data['prosekDrugo'] = $this->ucenikModel->prosekPolug(session('korisnik')->id_korisnik, 2, $id);
        $this->data['zakljucna1'] = $this->ucenikModel->dohvatiZakljucnu(session('korisnik')->id_korisnik, $id, 1);
        $this->data['zakljucna2'] = $this->ucenikModel->dohvatiZakljucnu(session('korisnik')->id_korisnik, $id, 2);
        return view('pages.ucenici.ucenik', $this->data);
    }

    public function filter(Request $request){
        try {
            $this->ucenikModel = new Ucenik();
            $ocene = $this->ucenikModel->dohvatiOceneAdmin($request->input('predmet'), $request->input('id'));
            $prosek = $this->ucenikModel->dohvatiProsek($request->input('predmet'), $request->input('id'), 1);
            $prosek2 = $this->ucenikModel->dohvatiProsek($request->input('predmet'), $request->input('id'), 2);
            $zakljucna1 = $this->ucenikModel->dohvatiZakljucnuAdmin($request->input('predmet'), $request->input('id'), 1);
            $zakljucna2 = $this->ucenikModel->dohvatiZakljucnuAdmin($request->input('predmet'), $request->input('id'), 2);
            return response()->json(['ocene' => $ocene, 'prosek' => $prosek, 'prosek2' => $prosek2, 'zakljucna1' => $zakljucna1, 'zakljucna2' => $zakljucna2]);
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function insert(UceniciRequest $request){
        try {
            move_uploaded_file($_FILES['slikaUcenika']['tmp_name'], public_path().'/assets/images/'.time() . $_FILES['slikaUcenika']['name']);
            $imageName = time() . $_FILES['slikaUcenika']['name'];

            if(session('korisnik')->id_uloga == 1){
                $id_odeljenje = $request->input('odeljenjeUcenika');
            }
            else if(session('korisnik')->id_uloga == 2){
                $id = \DB::table('odeljenje')->select('id_odeljenje')
                    ->where('id_korisnik', session('korisnik')->id_korisnik)
                    ->first();

                $id_odeljenje = $id->id_odeljenje;
            }

            $insert = \DB::table('ucenik')->insert([
                'ime' => $request->input('imeUcenika'),
                'prezime' => $request->input('prezimeUcenika'),
                'slika' => $imageName,
                'vladanje' => 5,
                'jmbg' => $request->input('jmbg'),
                'adresa' => $request->input('adresa'),
                'mesto_rodjenja' => $request->input('mestoRodj'),
                'datum_rodjena' => $request->input('datumRodj'),
                'id_odeljenje' => $id_odeljenje
            ]);

            if ($insert){
                return redirect()->route('ucenici')->with('success', 'Uspešno ste dodali učenika!');
            }
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function izostanci(Request $request){
        try {
            for($i=0; $i<count($request->input('idOdsutni')); $i++){
                \DB::table('odsutni')->where('id_odsutni', $request->input('idOdsutni')[$i])->update([
                   'opravdano' => $request->input('selectOpravdano')[$i]
                ]);
            }

            return redirect()->back()->with("success", "Uspešno regulisani izostanci.");

        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function oceni(OceniRequest $request){
        try {
            $polugodiste = \DB::table('polugodiste')->select('id_polugodiste')
                ->where('datum_od', '<=', Carbon::now())
                ->where('datum_do', '>=', Carbon::now())
                ->first();

            $predmet = \DB::table('korisnik_predmet')->select('id_predmet')
                ->where('id_korisnik', session('korisnik')->id_korisnik)
                ->first();

            $zakljucna = \DB::table('zakljucna_ocena')
                ->where('id_ucenik', $request->input('id'))
                ->where('id_predmet', $predmet->id_predmet)
                ->where('tip_ocene', 1)
                ->get();

            if(count($zakljucna)){
                $idpolugodiste = 2;
            }
            else {
                $idpolugodiste = $polugodiste->id_polugodiste;
            }

            $insert = \DB::table('ocene')->insert([
                'ocena' => $request->input('ocena'),
                'id_ucenik' => $request->input('id'),
                'id_polugodiste' => $idpolugodiste,
                'id_vrsta_ocene' => $request->input('vrsta'),
                'id_predmet' => $predmet->id_predmet,
                'datum' => Carbon::now()
            ]);

            if($insert){
                return "Uspešno ste ocenili učenika.";
            }
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function izbrisi(Request $request){
        try {
            \DB::table('korisnici')->where('id_korisnik', $request->input('izbrisiRoditelj'))->delete();
            return \App::make('redirect')->back()->with("success", "Uspešno obrisan kontakt.");
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function zahtev(ZahtevRequest $request){
        try {
            $insert = \DB::table('zahtev')->insert([
                'pogresna_ocena' => $request->input('pogresna'),
                'nova_ocena' => $request->input('nova'),
                'datum_ocene' => $request->input('datum'),
                'id_ucenik' => $request->input('id'),
                'id_korisnik' => session('korisnik')->id_korisnik,
                'id_vrsta_ocene' => $request->input('vrsta'),
            ]);

            if($insert){
                return "Uspešno poslat zahtev!";
            }
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function zakljuciOcenu(OcenaRequest $request){
        try {
            $predmet = \DB::table('korisnik_predmet')->select('id_predmet')
                ->where('id_korisnik', session('korisnik')->id_korisnik)
                ->first();

            if($request->input('polugodiste') != 0){
                $polugodiste = $request->input('polugodiste');
            }
            else {
                $polugodiste = 2;
            }

            $insert = \DB::table('zakljucna_ocena')->insert([
                'zakljucna_ocena' => $request->input('ocena'),
                'tip_ocene' => $polugodiste,
                'id_ucenik' => $request->input('id'),
                'id_predmet' => $predmet->id_predmet
            ]);

            if($insert){
                return "Uspešno ste zaključili ocenu!";
            }
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function vladanje(VladanjeRequest $request){
        try {
            \DB::table('ucenik')->where('id_ucenik', $request->input('iducenik'))
                ->update([
                    'vladanje' => $request->input('vladanje')
                ]);

            return redirect()->back()->with("success", "Uspešno izmenjena ocena iz vladanja!");
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
