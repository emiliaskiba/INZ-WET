<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;

class SpecializationController extends Controller
{
    //
    public function insertform()
    {
        return redirect('/weterynarze');
    }

    public function insert(Request $request)
    {

        $name = $request->input('name');
        $validate = 0;

        $validated = $request->validate([
            'name' => 'required|string|max:45|min:2',
        ]);

        $specializations = DB::table('specialization')->get();
        foreach ($specializations as $specialization) {
            if ($specialization->name == $name)
                $validate = 1;
        }
        if ($validate == 1) {
            return redirect('/weterynarze')->with('message', 'Specjalizacja już istnieje');
        }
        if ($validate == 0) {
            $data = array('name' => $name);
            DB::table('specialization')->insert($data);
            return redirect('/weterynarze')->with('message', 'Specjalizacja została dodana');
        }
    }

    public function insertvetspecialization(Request $request)
    {

        $id_vet = $request->input('id_vet');
        $id_specialization = $request->input('id_specialization');
        $data = array('id_vet' => $id_vet, 'id_specialization' => $id_specialization);
        DB::table('vet_specialization')->insert($data);
        return redirect('/weterynarze')->with('message', 'Specjalizacja została dodana do profilu weterynarza');
    }

    public function deletevetspecialization(Request $request)
    {

        $id_vet = $request->input('id_vet');
        $id_specialization = $request->input('id_specialization');
        DB::table('vet_specialization')->where('id_vet', $id_vet)->where('id_specialization', $id_specialization)->delete();
        return redirect('/weterynarze')->with('message', 'Specjalizacja została usunięta z profilu weterynarza');
    }

    public function showspecialists(Request $request)
    {

        $id_specialization = $request->input('id_specialization');

        return redirect('/specjalisci')->with('specjalizacja', $id_specialization);
    }

    public function deletespecialization(Request $request)
    {

        $id_specialization = $request->input('id_specialization');
        DB::table('vet_specialization')->where('id_specialization', $id_specialization)->delete();
        DB::table('specialization')->where('id_specialization', $id_specialization)->delete();

        return redirect('/weterynarze')->with('message', 'Specjalizacja została usunięta');
    }
}
