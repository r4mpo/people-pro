@extends('system.user.templates.main')
@section('title', 'Adicionar benefício')
@section('content-page')
    <div class="container">
        <p>
            <a href="{{ route('sistema.usuario.beneficios.entrar') }}" class="text-gray-800"><i
                class="fas fa-backward"></i> Retornar</a>
        </p>

        <div class="row">
            <div class="col-4">
                <div class="border mb-1 border-dark p-4">
                    @if (count($beneficios) > 0)
                        <form action="{{ route('sistema.usuario.beneficios.vincular_beneficio_usuario_exe') }}"
                            method="post">
                            @csrf
                            <div class="mb-3">
                                <h1 class="h3 mb-3 text-gray-800">Selecione os benefícios desejados</h1>
                                <div class="row">
                                    @foreach ($beneficios as $beneficio)
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $beneficio->id }}"
                                                    name="beneficios[]" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{ $beneficio->nome }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-icon-split">
                                <span class="icon">
                                    <i class="fas fa-cog"></i>
                                </span>
                                <span class="text">Enviar</span>
                            </button>
                        </form>
                    @else
                        <h1 class="h3 mb-3 text-gray-800">Não há mais nenhum item disponível para um novo vínculo.</h1>
                    @endif
                </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vale-alimentação e Vale-refeição</h6>
                    </div>
                    <div class="card-body">
                        O vale-alimentação e o vale-refeição são benefícios que a empresa oferece aos seus funcionários para
                        auxiliar nas despesas com alimentação. O vale-alimentação é geralmente utilizado para compras em
                        supermercados e estabelecimentos alimentícios, enquanto o vale-refeição é destinado para refeições
                        prontas em restaurantes e lanchonetes.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vale-combustível</h6>
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
                        <h6 class="m-0 font-weight-bold text-primary">Plano Odontológico e de Saúde:</h6>
                    </div>
                    <div class="card-body">
                        São benefícios que proporcionam assistência médica e odontológica aos funcionários, garantindo o
                        acesso a consultas, exames, tratamentos e procedimentos relacionados à saúde e à odontologia.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Viagem de incentivo</h6>
                    </div>
                    <div class="card-body">
                        A viagem de incentivo é uma recompensa oferecida aos colaboradores que se destacam em suas
                        atividades, incentivando o bom desempenho e a motivação no ambiente de trabalho.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vale-cultura</h6>
                    </div>
                    <div class="card-body">
                        O vale-cultura é um benefício que possibilita aos funcionários o acesso a atividades culturais, como
                        cinema, teatro, shows e eventos artísticos, promovendo o enriquecimento cultural e o lazer.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">VB Despesas</h6>
                    </div>
                    <div class="card-body">
                        O VB Despesas é uma assistência financeira para despesas diversas, fornecendo suporte financeiro aos
                        colaboradores para situações emergenciais ou gastos pontuais.
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">VB Presente</h6>
                    </div>
                    <div class="card-body">
                        O VB Presente é um benefício de reconhecimento e gratidão oferecido pela empresa, geralmente em
                        ocasiões especiais, como aniversários, conquistas profissionais ou datas comemorativas, demonstrando
                        apreço pelo trabalho e dedicação dos funcionários.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
