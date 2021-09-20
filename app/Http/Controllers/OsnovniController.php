<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class OsnovniController extends Controller
{
    public $data;
    private $meniModel;

    public function __construct(){
        $this->meniModel = new Menu();
        $this->data["meni"] = $this->meniModel->dohvatiMeni();
    }
}
