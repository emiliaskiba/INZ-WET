<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;

class VetController extends Controller
{
    //
    public function insertform()
    {
        return redirect('/weterynarze');
    }

    public function insert(Request $request)
    {
       
        $name = $request->input('name');
        $surname = $request->input('surname');
        $license = $request->input('license');
        $biography = $request->input('biography');
        $data = array('name' => $name, "surname" => $surname, "license" => $license, "biography" => $biography);
           $validate = $request->validate([
                'name' => 'required|string|max:255',
                'surname' =>'required|string|max:255',
                'license' => 'required|string|max:8',
                'biography' =>'nullable|string|max:300',

            ]);

       if ($validate == true){

       
        
        $id = DB::table('vet')->insertGetId($data);
        return redirect('/weterynarze')->with('message', 'Dodano weterynarza');
       }
       else 
       return redirect('/weterynarze')->with('message', 'Wprowadzono błędne dane');
    }

    public function update(Request $request)
    {

        $id_vet = $request->input('id_vet');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $license = $request->input('license');
        $biography = $request->input('biography');
        $data = array('name' => $name, "surname" => $surname, "license" => $license, "biography" => $biography);
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'surname' =>'required|string|max:255',
            'license' => 'required|string|max:8',
            'biography' =>'nullable|string|max:300',

        ]);

        DB::table('vet')->where('id_vet', $id_vet)->update($data);
        return redirect('/weterynarze')->with('message', 'Zaaktualizowano dane');
    }

    public function archiwizujwet(Request $request)
    {


        $id_vet = $request->input('id_vet');
        DB::table('vet')->where('id_vet', $id_vet)->update(['archive' => 1]);


        return redirect('/weterynarze')->with('message', 'Weterynarz został zarchiwizowany');
    }

    public function odarchiwizujwet(Request $request)
    {


        $id_vet = $request->input('idvet');
        DB::table('vet')->where('id_vet', $id_vet)->update(['archive' => NULL]);
        return redirect('/weterynarze')->with('message', 'Weterynarz został przywrócony' );
    }
}
