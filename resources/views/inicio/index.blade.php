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
        {{-- Filtros --}}
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Filtros / Pesquisa
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form  action="{{ route('inicio')}}" method="get">
                            @csrf
                            @method('get')
                            <div class="row">
                                <div class="form-floating col-3">
                                    {{-- <label for="cliente" class="form-label">Cliente</label>
                                    <select class="form-control" name="cliente" id="">
                                        {{ print_r($clientes) }}
                                        @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->decricao }}">{{ $cliente->decricao }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                                <div class="form-floating col-2">
                                    <input type="date" name="data_inicial" placeholder="Data_inicio" class="form-control" >
                                    <label for="data_inicial" > Data inicio: </label>
                                </div>
                                <div class="form-floating col-2">
                                    <input type="date" name="data_final" placeholder="Data_inicio" class="form-control" >
                                    <label for="data_final" > Data Final: </label>
                                </div>
                                <div class="input-group col">
                                    <input class="form-control" type="text" name="busca" placeholder="Buscar por..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Final Filtros --}}
        <div class="card-body">
            <div class="card-header">
                <div class="row text-center">
                    <div class="">
                    <strong><span> Total de Contas: R$ {{ $total }}</span></strong>
                </div>
                </div>
            </div>
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
                            <th class="text-center">Status</th>
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
                                    @if ($conta->status == "Pago")
                                    <td class="text-center"><button data-id="{{ $conta->id }}"  type="button" class="btn btn-default alterStatus" data-bs-toggle="modal" data-bs-target="#statusModal"> 
                                        <i class="fa-solid fa-circle-check" style="color: green"></i></button>
                                    </td>
                                        
                                    @else
                                        <td class="text-center"><button data-id="{{ $conta->id }}"  type="button" class="btn btn-default alterStatus" data-bs-toggle="modal" data-bs-target="#statusModal"> 
                                        <i class="fa-solid fa-circle-xmark"style="color: red"></i></td></button>
                                    @endif
                                    <td>
                                        Edit - Del</td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
                
                    <span class="d-flex justify-content-end">Registros : {{ $qtdContas }} </span>
                {{-- {{ $contas->links() }} --}}
            </div>
            <div id="totais">
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
        <div class="form-floating mb-3">
            <select class="form-control" name="status" id="status">
                <option value="Pago">Pago</option>
                <option selected value="Em aberto">Em aberto</option>
            </select>
            <label for="status">Status: </label>
        </div>
        
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" type="submit"> Criar </button>
        </div>
    </form>
    
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="statusModalLabel">Alterando status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('contas.status')}}" method="post">
            @csrf
            @method('post')

        <input type="hidden" name="id" id="idConta" value="">    
        <div class="form-floating mb-3">
            <select class="form-control" name="status" id="status">
                <option value="Pago">Pago</option>
                <option selected value="Em aberto">Em aberto</option>
            </select>
            <label for="status">Status: </label>
        </div>
        
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Atualizar</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<script>
    document.querySelectorAll('.alterStatus').forEach(button => {
        button.addEventListener('click', function() {
            //recuper os valores do botao
            const idConta = this.getAttribute('data-id');
            const dataIdConta = document.querySelector('#idConta');
            console.log(idConta);
            console.log(dataIdConta);

            //preencher dados do modal

            dataIdConta.value = idConta;


        });
    });
</script>

@endsection
