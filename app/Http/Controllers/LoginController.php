<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\CategoriaModel;
use App\Models\ContasModel;
use Illuminate\Http\Request;

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
        
        $loginRequest->validated();

        //$loginRequest->validated();

        //dd($request);

        $email = $loginRequest->email;
        $senha = $loginRequest->senha;

        $user_email = 'aasgestao@gmail.com';
        $user_senha = '123456';

        if($user_senha == $senha && $user_email == $email){

            return redirect()->route('inicio')->with('success', 'PARABEEEÉNS, login realizado com sucesso !!');
        }else{

            return back()->with('error', 'Usuário ou senha incorretos !!!');
        }
    }
}
