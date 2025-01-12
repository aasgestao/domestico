<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\CategoriaModel;
use App\Models\ContasModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {

        

        return view('layouts/login',
         data: [    'title'=> '2ACONT - Login Orçamento Domestico'
                ]);
    }
    public function login(LoginRequest $loginRequest)
    {
        //dd($loginRequest);

        $teste = $loginRequest->validated();

        //dd($teste);

        $authenticated = Auth::attempt([
            'email' => $loginRequest->email, 
            'password' => $loginRequest->password
        ]);

        //dd($authenticated);
        if (!$authenticated) {
            //redirecionar para a pagina de login

            return back()->withInput()->with('error', "Email ou senha incorreto.");


        }

        //buscar usuario
        $user = Auth::user();

        $user = User::find($user->id);
        //dd($user);
        return redirect()->route('inicio')->with('success', "Parabéns, logado com sucesso !!");       

    }
}
