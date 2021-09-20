<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistracijaRequest;
use App\Http\Requests\RoditeljRequest;
use App\Models\Predmet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegistracijaController extends OsnovniController
{
    private $predmetiModel;

    public function index(){
        $this->predmetiModel = new Predmet();
        $this->data['predmeti'] = $this->predmetiModel->dohvatiPredmete();
        return view('pages.admin.registracija', $this->data);
    }

    public function insert(RegistracijaRequest $request){
        try {
            if(filesize( $request->file('slikaReg') )){
                move_uploaded_file($_FILES['slikaReg']['tmp_name'], public_path().'/assets/images/'.time() . $_FILES['slikaReg']['name']);
                $imageName = time() . $_FILES['slikaReg']['name'];
            }
            else {
                $imageName = 'user.png';
            }

            $insert = \DB::table('korisnici')->insertGetId([
                'ime' => $request->input('imeRegistracija'),
                'prezime' => $request->input('prezimeRegistracija'),
                'kor_ime' => $request->input('korImeReg'),
                'email' => $request->input('emailReg'),
                'sifra' => md5($request->input('sifraReg')),
                'slika' => $imageName,
                'id_uloga' => $request->input('ulogaReg'),
            ]);

            if($insert){
                \DB::table('korisnik_predmet')->insert([
                   'id_korisnik' => $insert,
                   'id_predmet' => $request->input('predmetReg')
                ]);

                return redirect()->route('registracijaForma')->with('success', 'Uspešno ste registrovali korisnika!');
            }
            else {
                return redirect()->route('registracijaForma')->with('error', 'Došlo je do greške, pokušajte ponovo!');
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function insertRoditelj(RoditeljRequest $request){
        try {
            $insert = \DB::table('korisnici')->insertGetId([
                'ime' => $request->input('ime'),
                'prezime' => $request->input('prezime'),
                'kor_ime' => $request->input('kor_ime'),
                'email' => $request->input('email'),
                'sifra' => md5($request->input('lozinka')),
                'slika' => 'user.png',
                'telefon' => $request->input('broj'),
                'id_uloga' => 4
            ]);

            if($insert){
                \DB::table('roditelj_ucenik')->insert([
                   'id_korisnik' => $insert,
                   'id_ucenik' => $request->input('id')
                ]);

                return "Uspešno dodat kontakt!";
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
