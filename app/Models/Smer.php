<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smer extends Model
{
    public function dohvatiSmerove() {
        return \DB::table('smer')->select("id_smer as id", 'naziv')->get();
    }
}
