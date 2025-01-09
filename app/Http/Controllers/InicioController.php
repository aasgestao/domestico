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
    public function busca(Request $request) 
    {
        $busca = $request->input('busca');

        $categorias = CategoriaModel::orderBy('nome', 'ASC')->get();
        //$contas = ContasModel::all();
        

        //dd($query);
        $filtroContas = ContasModel::query()
            ->where(function($query) use ($busca) {
                $query->where('descricao', 'like', "%{$busca}%")
                    ->orWhere('categoria', 'like', "%{$busca}%")
                    ->orWhere('valor', 'like', "%{$busca}%")
                    ->orWhere('data', 'like', "%{$busca}%")
                    ->orWhere('tipo', 'like', "%{$busca}%");
            })
            ->orderBy('data', 'DESC')
            ->paginate(5);
        
        $contas = $filtroContas;

        // $totalGeral = ContasModel::sum('valor');

        // if($contas){
        //     $totalFiltrado = $contas->sum('valor');
        // }

        $total = $contas->count();

       dd($total);

        return view('/inicio/index', compact('contas',  'categorias'), ['title' => 'Resumo Financeiro']);


    }
}
