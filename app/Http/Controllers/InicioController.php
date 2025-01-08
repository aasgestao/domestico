<?php

namespace App\Http\Controllers;

use App\Models\CategoriaModel;
use App\Models\ContasModel;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {

        $categorias = CategoriaModel::orderBy('nome', 'ASC')->get();
        $contas = ContasModel::all();
        //dd($categorias);

        return view('/inicio/index',compact('contas', 'categorias'), ['title'=> 'Resumo Financeiro']);
    }
}
