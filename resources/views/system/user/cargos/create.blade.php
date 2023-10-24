@extends('system.user.templates.main')
@section('title', 'Adicionar Cargo')
@section('content-page')
    <div class="container">
        <p>
            <a href="{{ route('sistema.usuario.cargos.entrar') }}" class="text-gray-800"><i class="fas fa-backward"></i>
                Retornar</a>
        </p>

        <div class="row">
            <div class="col-12">
                <div class="border mb-1 border-dark p-4">
                    <form action="{{ route('sistema.usuario.cargos.cadastrar') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome do Cargo</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="fas fa-users-cog"></i></span>
                                        <input type="text" required placeholder="Digite aqui..." class="form-control" id="nome" name="nome">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="fas fa-pencil-alt"></i></span>
                                        <textarea type="text" req UIrequired placeholder="Digite aqui..." class="form-control" id="descricao" name="descricao"></textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="remuneracao" class="form-label">Remuneração</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                        <input type="text" required placeholder="Digite aqui..." onkeyup="formatarMoeda(this)" maxlength="20" class="form-control" id="remuneracao"
                                            name="remuneracao">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="setor_id" class="form-label">Setor</label><br>
                                <select class="mb-3" required name="setor_id" id="setor_id">
                                    <option selected>Selecione o setor do seu cargo</option>
                                    @foreach ($setores as $setor)
                                        <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                                    @endforeach
                                </select>

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Sobre o setor:</h6>
                                    </div>
                                    <div class="card-body">
                                        A correlação precisa entre um cargo profissional e seu setor de atuação é
                                        fundamental para o sucesso operacional das empresas. Estabelecer claramente as
                                        responsabilidades e expectativas associadas a cada função proporciona eficiência,
                                        produtividade e contribui para a sinergia entre os membros da equipe. Além disso,
                                        facilita a seleção de talentos, promove uma cultura organizacional coesa e aprimora
                                        a comunicação, resultando em um ambiente de trabalho mais eficaz e alinhado com os
                                        objetivos da empresa. </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Cadastrar</span>
                                </a>
        
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/masks.js"></script>
@endsection