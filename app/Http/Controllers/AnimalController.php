<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;

class AnimalController extends Controller
{


    public function createanimal(Request $request)
    {

        $id_owner = $request->input('id_owner');
        $name = $request->input('name');
        $breed = $request->input('breed');
        $species = $request->input('species');
        $sex = $request->input('sex');
        $date_of_birth = $request->input('date_of_birth');

        $validate = $request->validate([
            'name' => 'required|string|max:30',
            'species' =>'required|max:20',
            'breed' =>'nullable|string|max:20',
            'sex' => 'nullable',
            'date_of_birth' =>'nullable',
        ]);

        $data = array('id_owner' => $id_owner, 'name' => $name, "species" => $species, "breed" => $breed, "sex" => $sex, "date_of_birth" => $date_of_birth);
        DB::table('animal')->insert($data);
        return redirect('/zwierzetaklienta');
    }


    public function updateanimal(Request $request)
    {

        $id_animal = $request->input('id_animal');
        $name = $request->input('name');
        $breed = $request->input('breed');
        $species = $request->input('species');
        $sex = $request->input('sex');
        $date_of_birth = $request->input('date_of_birth');

        $validate = $request->validate([
            'name' => 'required|string|max:30',
            'species' =>'required|max:20',
            'breed' =>'nullable|string|max:20',
            'sex' => 'nullable',
            'date_of_birth' =>'nullable',
        ]);
        
        $data = array('name' => $name, "species" => $species, "breed" => $breed, "sex" => $sex, "date_of_birth" => $date_of_birth);
        DB::table('animal')->where('id_animal', $id_animal)->update($data);


        return redirect('/zwierzetaklienta');
    }
    public function usunzwierze(Request $request)
    {

       
        $id_animal = $request->input('id_animal');
        $control =0;
        $visits = DB::table('visit')->where('id_animal', $id_animal )->get();
        foreach ($visits as $visit) {
            $control= $control+1;
        }
        if($control ==0)
        {
            DB::table('animal')->where('id_animal', $id_animal)->delete();
            return redirect('/zwierzetaklienta')->with('message', 'Zwierzę zostało usunięte');
        }
        else {
            return redirect('/edycjazwierze')->with('id_animal', $id_animal)->with('message', 'Zwierzę odbyło wizytę, nie może zostać usunięte.');
        }


        
    }


    public function archiwizujzwierze(Request $request)
    {


        $id_animal = $request->input('id_animal');
        DB::table('animal')->where('id_animal', $id_animal)->update(['archive' => 1]);


        return redirect('/zwierzetaklienta')->with('message', 'Zwierzę zostało zarchiwizowane');
    }

    public function odarchiwizujzwierze(Request $request)
    {


        $id_animal = $request->input('id_animal');
        DB::table('animal')->where('id_animal', $id_animal)->update(['archive' => 0]);


        return redirect('/zwierzetaklienta')->with('message', 'Zwierzę zostało przywrócone');
    }
    public function historialeczeniaid(Request $request)
    {


        $id_animal = $request->input('id_animal');
    
        return redirect('/historialeczenia')->with('id_animal', $id_animal);
    }
}
