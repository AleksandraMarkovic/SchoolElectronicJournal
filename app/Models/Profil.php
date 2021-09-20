<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    public function dohvatiProfil($id){
        return \DB::table("korisnici")->where("id_korisnik", $id)->get();
    }
}
