<?php

namespace App\Http\Controllers;

use App\Models\ContasModel;
use Illuminate\Http\Request;

class ContasController extends Controller
{
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'data'=> 'required',
            'tipo'=> 'required',
            'valor'=> 'required',
            'categoria'=> 'required',
            'descricao'=> 'required',
        ]);

        //dd($request);
        $contaCriada = ContasModel::create([
                'data' => $request->data,
                'tipo' => $request->tipo,
                'valor' => $request->valor,
                'categoria' => $request->categoria,
                'descricao' => $request->descricao,
            ]);

        $idConta = $contaCriada->id;


        return redirect()->to('inicio')->with('success', 'Conta criada com sucesso !!!');
    }
}
