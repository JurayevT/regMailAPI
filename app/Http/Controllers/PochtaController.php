<?php

namespace App\Http\Controllers;

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
            ['fish', 'dataBirth', 'tel_nomer', 'passport', 'jshshir', 'lavozim', 'login', 'parol', 'maqsad'], 'required'
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
            'login' => 'email'
        ]);
        if ($valid->fails())
            return response([
                'message' => "Login uchun elektron pochta tanlang!"
            ], 303);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
