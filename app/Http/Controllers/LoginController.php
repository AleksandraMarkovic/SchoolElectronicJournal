<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends OsnovniController
{
    public function index(){
        return view("pages.main.login");
    }

    public function login(LoginRequest $request){
        $kor_ime = $request->input('kor_ime');
        $sifra = md5($request->input('sifra'));

        try {
            $korisnik = \DB::table('korisnici')
                ->where('kor_ime', $kor_ime)
                ->where('sifra', $sifra)
                ->first();

            if($korisnik) {
                $request->session()->put('korisnik', $korisnik);

                if(session('korisnik')->id_uloga == 2){
                    $odeljenje = \DB::table('odeljenje')->select('id_odeljenje as id_odeljenje')
                        ->where('id_korisnik', session('korisnik')->id_korisnik)
                        ->first();

                    $request->session()->put('odeljenje', $odeljenje);

                    $predmet = \DB::table('korisnik_predmet')->select('korisnik_predmet.id_predmet as id_predmet', 'predmet.naziv as naziv')
                        ->join('predmet', 'predmet.id_predmet', '=', 'korisnik_predmet.id_predmet')
                        ->where('korisnik_predmet.id_korisnik', session('korisnik')->id_korisnik)
                        ->first();

                    $request->session()->put('predmet', $predmet);
                }

                if(session('korisnik')->id_uloga == 4){
                    return "/roditelj";
                }
                else {
                    return "/home";
                }
            }
            else {
                return response(['error'=>true,'errorMsg'=>"Proverite podatke i pokušajte ponovo."],400);
            }
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function logout(Request $request){
        if(session('korisnik')->id_uloga == 2){
            $request->session()->pull("odeljenje");
        }
        $request->session()->pull("korisnik");
        return redirect()->route("loginPage");
    }
}
