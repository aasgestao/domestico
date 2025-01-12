@extends('layouts.admin')

@section('content')

    <div class="mb-1 hstack gap-2">
        {{-- <h2 class="mt-3">Dashboard</h2> --}}

        <ol class="breadcrumb mb-3 ms-auto">
            <li class="breadcrumb-item">
                <a href="#" class="text-decoration-none">Inicio</a>
            </li>
            {{-- <li class="breadcrumb-item active">Cursos</li> --}}
        </ol>
    </div>

    <div class="card mb-4 border-light shadow content-wrapper">

        <div class="card-header hstack gap-2">
            <span>Dashboard</span>
            <span class="ms-auto">
                <button class="btn btn-outline-info" type="button" data-bs-toggle="offcanvas" data-bs-target="#criarRegistro" aria-controls="criarRegistro"><i class="fas fa-plus"></i>  Novo Registro</button>
                {{-- <button class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#receita" aria-controls="receita">Receita</button>
                <button class="btn btn-outline-danger btn-sm">Despesa</button> --}}
            </span>

        </div>
        <div class="card-body">
            <x-alert />
            {{-- conteudo --}}
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th></th>
                        <th>Janeiro</th>
                        <th>Fevereiro</th>
                        <th>Março</th>
                        <th>Abril</th>
                        <th>Maio</th>
                        <th>Junho</th>
                        <th>Julho</th>
                        <th>Agosto</th>
                        <th>Setembro</th>
                        <th>Outubro</th>
                        <th>Novembro</th>
                        <th>Dezembro</th>
                    </tr>
                </thead>
                    <tbody>
                        @if (!empty($contasPorMes))
                            @foreach ($contasPorMes as $contaMes)
                                @foreach ($contaMes->groupBy('categoria') as $categoria => $contasCategoria)
                                    <tr>{{ $categoria }}</tr>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <td>
                                            @php
                                                $mesAtual = Carbon::parse("2025-" . str_pad($i, 2, '0', STR_PAD_LEFT) . "-01")->format('Y-m');
                                                $contasMes = $contasCategoria->firstWhere('data', 'LIKE', "%$mesAtual%");
                                            @endphp
                                            {{ $contasMes ? $contasMes->valor : '-' }}
                                        </td>

                                    @endfor
                                @endforeach                            
                            @endforeach
                        @else
                           <tr>
                                <td colspan="13">Nenhum registro encontrado!</td>
                            </tr> 
                        @endif
                    </tbody>
            </table>
        </div>
    </div>

@endsection
            