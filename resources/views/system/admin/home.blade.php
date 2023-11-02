@php
    use App\Models\User;
@endphp

@extends('system.templates.main')
@section('title', 'Dashboard')

@section('content-page')
    <div class="row">
        <div class="col-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Qtd. Colaboradores
                                Ativos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dados['qtd_colaboradores_ativos'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Qtd. Colaboradores
                                Inativos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $dados['qtd_colaboradores_inativos'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    @if (count($dados['beneficios']) > 0)
        <div class="row">
            @foreach ($dados['beneficios'] as $beneficio)
                <div class="col-3">
                    <div class="card shadow mb-4">
                        <a href="#collapseCardExample{{ $beneficio->id }}" class="d-block card-header py-3"
                            data-toggle="collapse" role="button" aria-expanded="true"
                            aria-controls="collapseCardExample{{ $beneficio->id }}">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $beneficio->nome }}</h6>
                        </a>
                        <div class="collapse show" id="collapseCardExample{{ $beneficio->id }}">
                            <div class="card-body">
                                {{ $beneficio->definirValorTipo() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Qtd. Usuários do Sistema
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dados['qtd_usuarios_sistema'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/template/vendor/chart.js/Chart.min.js"></script>
    <script src="/template/js/demo/charts.js"></script>
@endsection
