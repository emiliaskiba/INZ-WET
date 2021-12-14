<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;

class VisitController extends Controller
{
    //
    public function insertform()
    {
        return redirect('/wizyty');
    }

    public function insert(Request $request)
    {

        $id_vet = $request->input('id_vet');
        $id_type = $request->input('id_type');
        $date = $request->input('date');
        $time = $request->input('time');
        $data = array('id_vet' => $id_vet, "id_type" => $id_type, "date" => $date, "time" => $time);

        $validate = $request->validate([
            'id_vet' => 'required',
            'id_type' =>'required',
            'date' =>'required',
            'time' =>'required|max:5',
        ]);

        DB::table('visit')->insert($data);
        return redirect('/wizyty');
    }


    public function vetvisit(Request $request)
    {
        $choosevet1 = $request->input('vetchoose');
        return view('wizyty')->with([$choosevet1]);
    }



    public function confirmvisit(Request $request)
    {
        $id_visit = $request->input('id_visit');
        DB::table('visit')->where('id_visit', $id_visit)->update(
            ['confirmation' => true]
        );
        return redirect('/wizyty');
    }

    public function reservationcreate(Request $request)
    {
        $id_visit = $request->input('id_visit');
        $id_owner = $request->input('id_owner');
        $id_animal = $request->input('id_animal');
        $message = $request->input('message');

        $validate = $request->validate([
            'message' => 'nullable|string|max:500',
            'id_animal' =>'required',
            'id_owner' =>'required',
            'id_visit' =>'required',
        ]);

        DB::table('visit')->where('id_visit', $id_visit)->update(
            ['id_owner' => $id_owner, 'id_animal' => $id_animal, 'reservation' => true, 'message' => $message]
        );
        return redirect('/wizytyklienta');
    }

    public function edytujwizyte(Request $request)
    {
        $id_visit = $request->input('id_visit');
        $message = $request->input('message');
        $id_animal = $request->input('id_animal');

        $validate = $request->validate([
            'message' => 'nullable|string|max:500',
            'id_animal' =>'required',
        ]);

        DB::table('visit')->where('id_visit', $id_visit)->update(
            ['message' => $message, 'id_animal' => $id_animal]
        );
        return redirect('/wizytyklienta')->with('message', 'Wizyta została zedytowana');
    }
    public function odwolajwizyteklient(Request $request)
    {
        $id_visit = $request->input('id_visit');

        DB::table('visit')->where('id_visit', $id_visit)->update(['message' => NULL, 'id_animal' => NULL, 'id_owner' => NULL, 'reservation' => NULL, 'confirmation' => NULL]);

        return redirect('/wizytyklienta')->with('message', 'Wizyta została odwołana');
    }

    public function uzupelnijwizyte(Request $request)
    {
        $id_visit = $request->input('id_visit');
        $price = $request->input('price');
        $orders = $request->input('orders');
        $description = $request->input('description');
        $code = $request->input('code');
        $access_code = $request->input('access_code');

        $validate = $request->validate([
            'price' => 'nullable|numeric|max:10',
            'orders' =>'nullable|string|max:800',
            'description' =>'nullable|string|max:800',
            'code' =>'nullable|max:50',
            'access_code' =>'nullable|numeric|max:4',
        ]);


        $control = 0;
        $history = DB::table('history')->where('id_visit', $id_visit)->get();
        foreach ($history as $visithistory) {
            $control = 1;
        }
        if ($control == 0) {
            if ($code != NULL) {
                $id = DB::table('prescription')->insertGetId(['code' => $code, 'access_code' => $access_code]);
                DB::table('history')->insert(['id_visit' => $id_visit, 'orders' => $orders, 'description' => $description, 'id_prescription' => $id]);
            } else {
                DB::table('history')->insert(['id_visit' => $id_visit, 'orders' => $orders, 'description' => $description]);
            }
        }
        elseif($control == 1) {

            if ($code != NULL) {
                $prescriptionid;
                
                foreach($history as $visithistory) { $prescriptionid = $visithistory->id_prescription; }
                DB::table('prescription')->where('id_prescription', $prescriptionid)->update(['code' => $code, 'access_code' => $access_code]);

                DB::table('history')->where('id_visit', $id_visit)->update(['orders' => $orders, 'description' => $description]);
            } else {
                DB::table('history')->where('id_visit', $id_visit)->update(['id_visit' => $id_visit, 'orders' => $orders, 'description' => $description]);
            }
        }
        DB::table('visit')->where('id_visit', $id_visit)->update(['price' => $price]);
        return redirect('/wizytypracownika');
    }
}
