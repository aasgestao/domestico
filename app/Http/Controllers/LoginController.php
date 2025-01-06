<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('layouts/login');
    }
    public function login(Request $request)
    {
        $email = $request->email;
        $senha = $request->senha;

        $user_email = 'aasgestao@gmail.com';
        $user_senha = '123456';

        if($user_senha == $senha && $user_email == $email){

            return redirect()->route('inicio');
        }else{

            return back()->with('error', 'Usuario ou senha incorretos !!!');
        }
    }
}
