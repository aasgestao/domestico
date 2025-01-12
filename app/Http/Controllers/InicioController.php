<?php

namespace App\Http\Controllers;

use App\Models\CategoriaModel;
use App\Models\ContasModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

use function PHPUnit\Framework\isNumeric;

class InicioController extends Controller
{
    public function index(Request $request)
    {
        $categorias = CategoriaModel::orderBy('nome', 'ASC')->get();

        $data_inicial = $request->input('data_inicial');
        $data_final = $request->input('data_final');
        $clientes = ContasModel::get('descricao')  ;
        
        //$contas = ContasModel::all();
        
        //dd($clientes);
        //Iniciando a query
        
        $query = ContasModel::query();

        //dd($query);
        if ($request->filled('busca')) {
            $busca = $request->input('busca');
            $query->where(function ($query) use ($busca) {
                $query->where('descricao', 'like', "%{$busca}%")
                    ->orWhere('categoria', 'like', "%{$busca}%")
                    ->orWhere('valor', 'like', "%{$busca}%")
                    ->orWhere('data', 'like', "%{$busca}%")
                    ->orWhere('tipo', 'like', "%{$busca}%");
            });

        }
        
        if($data_inicial && $data_final) {
            //dd('We are here');
            $query->whereBetween('data', [$data_inicial, $data_final]);
        }

        $contas = $query->orderBy('created_at', 'DESC')->paginate();

        $total = $query->sum('valor');

        $qtdContas = $query->count();

        return view('/inicio/index', compact('contas', 'categorias', 'total', 'qtdContas', 'clientes'), ['title' => 'Resumo Financeiro']);

    }
    public function report(Request $request) 
    {
        
        $categorias = CategoriaModel::orderBy('nome', 'ASC')->get();
        //$contas = ContasModel::all();
        
        $contas = ContasModel::all();
        
        //agrupar por mês
        $contasPorMes = $contas->groupBy(function($conta) {
            return Carbon::parse($conta->data)->format('m/Y');
        });

        //dd($contas, $contasPorMes);


        return view('/inicio/report', compact('contasPorMes',  'categorias'), ['title' => 'Resumo Financeiro']);


    }
}
