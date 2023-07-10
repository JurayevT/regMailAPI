<?php

namespace App\Http\Controllers;

use App\Models\Pochta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PochtaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pochtalar = Pochta::query()->where('active')->get();

        return response([
            'pochtalar' => $pochtalar,
            'message' => "Barcha yuborilgan pochtalar"
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            ['fullName', 'birthdate', 'phoneNumber', 'passport', 'pinfl', 'position', 'login', 'password', 'message'], 'required'
        ]);
        if ($valid->fails())
            return response([
                'message' => "Formadagi barcha maydonlarni to'ldiring!"
            ], 303);

        $valid = Validator::make($request->all(), [
            'login' => 'email'
        ]);
        if ($valid->fails())
            return response([
                'message' => "Login uchun elektron pochta tanlang!"
            ], 303);

        $valid = Validator::make($request->all(), [
            'login' => 'unique:App\Models\Pochta,login'
        ]);
        if ($valid->fails())
            return response([
                'message' => "Bu login avval foydalanilgan.\nIltimos qayta kiriting!"
            ], 303);
            
        $valid = Validator::make($request->all(), [
            'password' => 'confirmed' // password_confirmation
        ]);
        if ($valid->fails())
            return response([
                'message' => "Parolni bir xil kiriting!"
            ], 303);
        
        $valid = Validator::make($request->all(), [
            'password' => 'min:8'
        ]);
        if ($valid->fails())
            return response([
                'message' => "Parol kamida 8 ta belgidan iborat bo'lsin!"
            ], 303);

        $valid = Validator::make($request->all(), [
            'pinfl' => 'min:14|max:14'
        ]);
        if ($valid->fails())
            return response([
                'message' => "JShShIR maydoni 14 ta belgidan iborat bo'lsin!"
            ], 303);

        $data = new Pochta;
        $data->fullName = $request->fullName;
        $data->birthdate = $request->birthdate;
        $data->phoneNumber = $request->phoneNumber;
        $data->passport = $request->passport;
        $data->pinfl = $request->pinfl;
        $data->position = $request->position;
        $data->login = $request->login;
        $data->password = $request->password;
        $data->message = $request->message;
        $data->save();

        return response([
            'data' => $data,
            'message' => "Sizning ma'lumotlariz bazaga saqlandi"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pochta = Pochta::query()->where('active')->findOrFail($id);

        return response([
            'pochta' => $pochta,
            'message'=> "Tanlagan pochtangiz mq'lumotlari"
        ]);
    }

    public function checkPost(Request $req, $id)
    {
        $pochta = Pochta::findOrFail($id);

        if ($req->answer == '1') {
            $pochta->status = 1;
            $pochta->save();

            return response([
                'message' => "Pochta ochildi deb belgilandi"
            ]);
        }
        if ($req->answer == '2') {
            $pochta->status = 2;
            $pochta->save();

            return response([
                'message' => "Pochta ochib bo'lmadi.\nFoydalanuvchi ma'lumotlarida kamchilik bor."
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
        
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
        
    // }
}
