@extends('system.user.templates.main')
@section('title', 'Dashboard')

@section('content-page')
    <div class="row">
        <div class="col-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Qtd. Colaboradores Ativos
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
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Qtd. Colaboradores Ativos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dados['qtd_colaboradores_inativos'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="container">
        <div class="row">
            <p class="text-justify"><em>{{ $dados['info'] }}</em></p>
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

    <input type="hidden" name="url_graficos" id="url_graficos" value="{{ $dados['url_graficos'] }}">
    <input type="hidden" name="token" id="token" value="{{ $dados['token'] }}">

    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quantidades de Colaboradores por Setor</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                    <hr>
                    PeoplePro Charts Analyst
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quantidades de Colaboradores por Cargo</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <hr>
                    PeoplePro Charts Analyst
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Salários para cada cargo</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                    PeoplePro Charts Analyst
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/template/vendor/chart.js/Chart.min.js"></script>
    <script src="/template/js/demo/charts.js"></script>
@endsection
