<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;

class EmployeeController extends Controller
{
    //
    public function insertform()
    {
        return redirect('/pracownicy');
    }

    public function insert(Request $request)
    {

        $id_vet = $request->input('id_vet');

        $validate = $request->validate([
            'name' => 'required|string|max:45|min:2',
            'surname' => 'required|string|max:45|min:2',
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric|digits:9',
            'street' => 'required|string|max:45|min:3',
            'zip_code' => 'required|min:5|max:6',
            'city' => 'required|string|min:3|max:45'
        ]);

        if ($id_vet == 0) {
            $id = DB::table('users')->insertGetId(
                ['name' => $request->input('name'), 'email' => $request->input('email'), 'password' => Hash::make($request->input('password')), 'id_type' => 2, 'created_at' => \Carbon\Carbon::now()->toDateTimeString()]
            );
        } else
            $id = DB::table('users')->insertGetId(
                ['name' => $request->input('name'), 'email' => $request->input('email'), 'password' => Hash::make($request->input('password')), 'id_type' => 2, 'created_at' => \Carbon\Carbon::now()->toDateTimeString(), 'id_vet' => $id_vet]
            );

        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $street = $request->input('street');
        $zip_code = $request->input('zip_code');
        $city = $request->input('city');
        $id_vet = $request->input('id_vet');
        $data = array('name' => $name, "surname" => $surname, "phone" => $phone, "email" => $email, "street" => $street, "zip_code" => $zip_code, "city" => $city, "id_user" => $id);
        DB::table('employee')->insert($data);
        return redirect('/pracownicy');
    }


    public function update(Request $request)
    {


        $id_user = $request->input('id_user');
        $id_employee = $request->input('id_employee');
        $password = $request->input('password');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $street = $request->input('street');
        $zip_code = $request->input('zip_code');
        $city = $request->input('city');
        $data = array('name' => $name, "surname" => $surname, "phone" => $phone, "email" => $email, "street" => $street, "zip_code" => $zip_code, "city" => $city);

        $validate = $request->validate([
            'name' => 'required|string|max:45|min:2',
            'surname' => 'required|string|max:45|min:2',
            'email' => 'required|string|email|max:50',
            'password' => 'nullable|string|min:8',
            'phone' => 'required|numeric|digits:9',
            'street' => 'required|string|max:45|min:3',
            'zip_code' => 'required|min:5|max:6',
            'city' => 'required|string|min:3|max:45'
        ]);

        DB::table('employee')->where('id_employee', $id_employee)->update($data);

        if ($password == NULL) {


            DB::table('users')->where('id', $id_user)->update(
                ['name' => $name, 'email' => $email, 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
            );
        } else {

            DB::table('users')->where('id', $id_user)->update(
                ['name' => $name, 'email' => $email, 'password' => Hash::make($password), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
            );
        }

        return redirect('/pracownicy');
    }

    
}
