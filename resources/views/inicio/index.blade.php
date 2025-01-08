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
            <div class="container">
                <table class="table table-reponsive table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Tipo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($contas))
                            @foreach ($contas as $conta)
                                <tr>
                                    <td>{{ $conta->id }}</td>
                                    <td> {{ Carbon\Carbon::parse($conta->data)->format('d/m/Y') }}</td>
                                    <td>{{ $conta->descricao }}</td>
                                    <td>{{ $conta->valor }}</td>
                                    <td>{{ $conta->tipo }}</td>
                                    <td>
                                        Edit - Del</td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


    </div>

{{-- offcanvas de receita --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="criarRegistro" aria-labelledby="criarRegistroLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="criarRegistroLabel">Lançamento</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form action="{{ route('contas.store') }}" method="post">
        @csrf
        @method('POST')

        <div class="form-floating mb-3">
            <select class="form-control" name="tipo" id="tipo">
                <option value="">Selecione ...</option>
                <option value="despesa">Despesa</option>
                <option value="receita">Receita</option>
            </select>
            <label for="tipo">Tipo: </label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-control" name="categoria" id="categoria">
                <option value="">Selecione ...</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->nome }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
            <label for="categoria">Categoria: </label>
        </div>

        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="data" name="data" >
            <label for="data">Data:</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="valor" name="valor" >
            <label for="valor">Valor:</label>
        </div>
        <div class="form-floating mb-3">
            <textarea name="descricao" id="descricao"  class="form-control" rows="20"></textarea>
            <label for="descricao">Descricão:</label>
        </div>
        
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" type="submit"> Criar </button>
        </div>
    </form>
    
  </div>
</div>

@endsection
