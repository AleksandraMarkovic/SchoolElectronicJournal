<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCasRequest;
use App\Models\Cas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DnevnikController extends OsnovniController
{
    private $casModel;

    public function index($id){
        $this->casModel = new Cas();
        $this->data['datumi'] = $this->casModel->dohvatiDatume($id);
        return view('pages.main.dnevnik', $this->data);
    }

    public function paginacija($id){
        $this->casModel = new Cas();
        $datumi = $this->casModel->dohvatiDatume($id);
        return response()->json($datumi);
    }

    public function filterDatum(Request $request, $id){
        try {
            $this->casModel = new Cas();
            $datumi = $this->casModel->filterDatum($request->input('datum'), $id);
            return response()->json($datumi);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function filter(Request $request){
        try {
            $this->casModel = new Cas();
            $casovi = $this->casModel->filter($request->input('datum'));
            return response()->json($casovi);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function odustni(Request $request){
        try {
            $this->casModel = new Cas();
            $odsutni = $this->casModel->dohvatiOdsutne($request->input('id'));
            return response()->json($odsutni);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function obrisi(Request $request){
        try {
            \DB::table('cas')->where('id_cas', $request->input('id'))->delete();
            return "Uspešno obrisan čas.";
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function edit(Request $request){
        $this->casModel = new Cas();
        $info = $this->casModel->dohvatiZaCas($request->input('id'));
        return response()->json($info);
    }

    public function update(UpdateCasRequest $request){
        try {
            \DB::table('cas')->where('id_cas', $request->input('casId'))->update([
               'opis' => $request->input('nastavnaJedUpdate'),
               'napomena' => $request->input('napomenaUpdate')
            ]);

            return redirect()->back()->with('success', "Uspešno izmenjen čas.");
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
