<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoznikaRequest;
use App\Http\Requests\ProfilRequest;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfilController extends OsnovniController
{
    private $profilModel;

    public function index(){
        $this->profilModel = new Profil();
        $this->data['profil'] = $this->profilModel->dohvatiProfil(session('korisnik')->id_korisnik);
        return  view("pages.main.profil", $this->data);
    }

    public function updateProfil(ProfilRequest $request){
        try {
            move_uploaded_file($_FILES['slikaProfil']['tmp_name'], public_path().'/assets/images/'.time() . $_FILES['slikaProfil']['name']);
            $imageName = time() . $_FILES['slikaProfil']['name'];
            \DB::table("korisnici")->where("id_korisnik", session('korisnik')->id_korisnik)->update([
                'kor_ime' => $request->input('kor_imeProfil'),
                'email' => $request->input('emailProfil'),
                'slika' => $imageName,
                'telefon' => $request->input('brojTelefona')
            ]);

            return redirect()->route('profil')->with('success', 'Uspešno ste izmenili profil!');

        }
        catch (\Exception $e){
            Log::error($e->getMessage());
        }

    }

    public function izmeniLozinku(LoznikaRequest $request){
        $lozinka = \DB::table("korisnici")->where('id_korisnik', session('korisnik')->id_korisnik)
            ->select("sifra")->first();

        if($lozinka->sifra == md5($request->input('staraLozinka'))){
            \DB::table("korisnici")->where("id_korisnik", session('korisnik')->id_korisnik)->update([
                'sifra' => md5($request->input('ponovoLozinka'))
            ]);

            return redirect()->route('profil')->with('success', 'Uspešno ste izmenili lozinku!');
        }
        else {
            return redirect()->route('profil')->with('error', 'Pogrešna stara lozinka!');
        }
    }
}
