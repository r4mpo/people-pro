@extends('system.user.templates.main')
@section('title', 'Editar: ' . $setor->nome)
@section('content-page')
    <div class="container">
        <p>
            <a href="{{ route('sistema.usuario.setores.entrar') }}" class="text-gray-800"><i class="fas fa-backward"></i>
                Retornar</a>
        </p>
        <div class="row">
            <div class="col-4">
                <div class="border mb-1 border-dark p-4">
                    <form action="{{ route('sistema.usuario.setores.atualizar', ['id' => base64_encode($setor->id)]) }}"
                        method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-cog"></i></span>
                                    <input type="text" class="form-control" value="{{ $setor->nome }}" id="nome"
                                        name="nome" placeholder="Setor">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-cog"></i></span>
                                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição">{{ $setor->descricao }}</textarea>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-success btn-icon-split">
                            <span class="icon">
                                <i class="fas fa-cog"></i>
                            </span>
                            <span class="text">Atualizar</span>
                        </button>
                    </form>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Setor de Tecnologia:</h6>
                    </div>
                    <div class="card-body">
                        O setor financeiro proporciona gestão eficaz de recursos, análise de dados para tomada de decisões
                        estratégicas e acesso a soluções financeiras avançadas, otimizando o desempenho financeiro da
                        empresa.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Setor Financeiro:</h6>
                    </div>
                    <div class="card-body">
                        O vale-combustível é um benefício que ajuda os colaboradores a cobrir os gastos com deslocamento
                        para o trabalho, contribuindo para reduzir os custos relacionados ao transporte.
                    </div>
                </div>

            </div>

            <div class="col-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Setor de Recursos Humanos:</h6>
                    </div>
                    <div class="card-body">
                        O setor de RH promove o desenvolvimento dos colaboradores, gerenciamento de talentos e melhoria do
                        clima organizacional, aumentando a produtividade, a satisfação dos funcionários e a retenção de
                        talentos.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Setor de Logística:</h6>
                    </div>
                    <div class="card-body">
                        O setor logístico oferece otimização da cadeia de suprimentos, redução de custos operacionais e
                        agilidade na distribuição, garantindo a entrega eficiente dos produtos e a satisfação dos clientes.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Setor de Marketing:</h6>
                    </div>
                    <div class="card-body">
                        O setor de marketing possibilita estratégias personalizadas, análise de mercado e promoção da marca,
                        gerando maior visibilidade, fidelização de clientes e crescimento nos negócios.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Setor de Vendas:</h6>
                    </div>
                    <div class="card-body">
                        O setor de vendas facilita a prospecção de clientes, o gerenciamento de vendas e o acompanhamento do
                        ciclo de vendas, resultando em maior volume de negócios e ampliação da base de clientes.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Setor de Pesquisa e Desenvolvimento:</h6>
                    </div>
                    <div class="card-body">
                        O setor de P&D impulsiona a inovação, o aprimoramento de produtos e a expansão de mercados,
                        garantindo a relevância da empresa no cenário competitivo e a liderança em seu segmento.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
