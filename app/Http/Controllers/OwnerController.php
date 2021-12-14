<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;

class OwnerController extends Controller
{
    //
    public function insertform()
    {
        return redirect('/klienci');
    }

    public function insert(Request $request)
    {
        $id = DB::table('users')->insertGetId(
            ['name' => $request->input('name'), 'email' => $request->input('email'), 'password' => Hash::make($request->input('password')), 'id_type' => 3, 'created_at' => \Carbon\Carbon::now()->toDateTimeString()]
        );

        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $data = array('name' => $name, "surname" => $surname, "phone" => $phone, "email" => $email, "id_user" => $id);

        $validate = $request->validate([
            'name' => 'required|string|max:30|min:2',
            'surname' => 'required|string|max:30|min:2',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric|digits:9',
            'email' =>'required|string|email|max:50',
        ]);

        DB::table('owner')->insert($data);
        return redirect('/klienci');
    }


    public function update(Request $request)
    {

        $id_user = $request->input('id_user');
        $id_owner = $request->input('id_owner');
        $password = $request->input('password');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $validate = $request->validate([
            'name' => 'required|string|max:30|min:2',
            'surname' => 'required|string|max:30|min:2',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric|digits:9',
            'email' =>'required|string|email|max:50',
        ]);

        $data = array('name' => $name, "surname" => $surname, "phone" => $phone, "email" => $email);
        DB::table('owner')->where('id_owner', $id_owner)->update($data);

        if ($password == NULL) {
            DB::table('users')->where('id', $id_user)->update(
                ['name' => $name, 'email' => $email, 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
            );
        } else {
            DB::table('users')->where('id', $id_user)->update(
                ['name' => $name, 'email' => $email, 'password' => Hash::make($password), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
            );
        }
        return redirect('/klienci');
    }


    public function newowner(Request $request)
    {

        $id_user = $request->input('user_id');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $validate = $request->validate([
            'name' => 'required|string|max:30|min:2',
            'surname' => 'required|string|max:30|min:2',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric|digits:9',
            'email' =>'required|string|email|max:50',
        ]);

        $data = array('name' => $name, "surname" => $surname, "phone" => $phone, "email" => $email, "id_user" => $id_user);
        DB::table('owner')->insert($data);



        return redirect('/home');
    }


    public function updateclient(Request $request)
    {

        $id_user = $request->input('id_user');
        $id_owner = $request->input('id_owner');
        $password = $request->input('password');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');

        $validate = $request->validate([
            'name' => 'required|string|max:30|min:2',
            'surname' => 'required|string|max:30|min:2',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric|digits:9',
            'email' =>'required|string|email|max:50',
        ]);

        $data = array('name' => $name, "surname" => $surname, "phone" => $phone, "email" => $email);
        DB::table('owner')->where('id_owner', $id_owner)->update($data);

        if ($password == NULL) {
            DB::table('users')->where('id', $id_user)->update(
                ['name' => $name, 'email' => $email, 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
            );
        } else {
            DB::table('users')->where('id', $id_user)->update(
                ['name' => $name, 'email' => $email, 'password' => Hash::make($password), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
            );
        }
        return redirect('/home');
    }
}
