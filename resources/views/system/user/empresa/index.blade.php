@extends('system.user.templates.main')
@section('title', 'Empresa')
@section('content-page')

    <form action="{{ route('sistema.usuario.empresa.atualizar', ['id' => base64_encode($empresa->id)]) }}" method="post" class="mb-5">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="input-group mb-3">
                <span class="input-group-text">Digite e pesquise pelo seu CNPJ</span>
                <input type="text" value="{{ $empresa->cnpj_raiz }}" onkeypress="return apenasNumeros();" onkeydown="javascript: fMascCNPJ( this, mCNPJ );"
                    maxlength="18" class="form-control" placeholder="Digite aqui..." name="cnpj_raiz" id="cnpj_raiz">
                <button type="button" onclick="CnpjWs(document.getElementById('cnpj_raiz'))" class="input-group-text"><i class="fas fa-search"></i></button>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Razão Social</span>
                <input type="text" value="{{ $empresa->razao_social }}" class="form-control text-uppercase" placeholder="Digite aqui..." id="razao_social"
                    name="razao_social">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Nome Fantasia</span>
                <input type="text" value="{{ $empresa->nome_fantasia }}" class="form-control text-uppercase" placeholder="Digite aqui..." id="nome_fantasia"
                    name="nome_fantasia">
            </div>

            <hr>

            <div class="mb-3">
                <label for="capital_social" class="form-label">Informe o capital social da sua empresa</label>
                <div class="input-group">
                    <span class="input-group-text">Capital Social (Ex: R$1,00)</span>
                    <input type="text" value="{{ $empresa->capital_social }}" onkeyup="formatarMoeda(this)" maxlength="20" placeholder="Digite aqui..." class="form-control" id="capital_social"
                        name="capital_social">
                </div>
            </div>

            <hr>

            <div class="form-check">
                <p class="text-gray-800">Selecione a situação cadastral</p>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" @if($empresa->situacao_cadastral == 1) checked @endif name="situacao_cadastral" value="1" id="situacao_cadastral1">
                <label class="form-check-label" for="situacao_cadastral1">
                    Ativo
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" @if($empresa->situacao_cadastral == 0) checked @endif name="situacao_cadastral" value="0" id="situacao_cadastral2">
                <label class="form-check-label" for="situacao_cadastral2">
                    Inativo
                </label>
            </div>

            <hr>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">Data inicial das atividades</span>
                    <input type="date" class="form-control" value="{{$empresa->data_inicio_atividade}}" id="data_inicio_atividade" name="data_inicio_atividade">
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <label for="cep" class="form-label">Cep</label>

                <div class="input-group">
                    <input type="text" onkeyup="ViaCep(this)" value="{{$empresa->cep}}" onkeypress="return apenasNumeros();" maxlength="8" placeholder="Digite aqui..." class="form-control" id="cep" name="cep">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-2">
                    <label for="cidade" class="form-label">Cidade</label>

                    <div class="input-group">
                        <input type="text" value="{{$empresa->cidade}}" placeholder="Digite aqui..." class="form-control text-uppercase" id="cidade"
                            name="cidade">
                    </div>
                </div>

                <div class="mb-3 col-2">
                    <label for="logradouro" class="form-label">Logradouro</label>

                    <div class="input-group">
                        <input type="text" value="{{$empresa->logradouro}}" placeholder="Digite aqui..." class="form-control text-uppercase" id="logradouro"
                            name="logradouro">
                    </div>
                </div>
                <div class="mb-3 col-2">
                    <label for="bairro" class="form-label">Bairro</label>

                    <div class="input-group">
                        <input type="text" value="{{$empresa->bairro}}" placeholder="Digite aqui..." class="form-control text-uppercase" id="bairro"
                            name="bairro">
                    </div>
                </div>
                <div class="mb-3 col-2">
                    <label for="numero" class="form-label">Número</label>

                    <div class="input-group">
                        <input type="text" value="{{$empresa->numero}}" onkeypress="return apenasNumeros();" maxlength="20" placeholder="Digite aqui..." class="form-control text-uppercase" id="numero" name="numero">
                    </div>
                </div>
                <div class="mb-3 col-2">
                    <label for="complemento" class="form-label">Complemento</label>

                    <div class="input-group">
                        <input type="text" value="{{$empresa->complemento}}" placeholder="Digite aqui..." class="form-control text-uppercase" id="complemento"
                            name="complemento">
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="mb-3 col-3">
                    <label for="ddd1" class="form-label">DDD 1</label>

                    <div class="input-group">
                        <input type="text" value="{{$empresa->ddd1}}" onkeypress="return apenasNumeros();" maxlength="2" placeholder="Digite aqui..." class="form-control" id="ddd1"
                            name="ddd1">
                    </div>
                </div>

                <div class="mb-3 col-3">
                    <label for="telefone1" class="form-label">Telefone 1</label>

                    <div class="input-group">
                        <input type="text" value="{{$empresa->telefone1}}" placeholder="Digite aqui..." onkeyup="formatarTelefone(this)" class="form-control" id="telefone1"
                            name="telefone1">
                    </div>
                </div>

                <div class="mb-3 col-3">
                    <label for="ddd2" class="form-label">DDD 2</label>

                    <div class="input-group">
                        <input type="text" value="{{$empresa->ddd2}}" onkeypress="return apenasNumeros();" maxlength="2"  placeholder="Digite aqui..." class="form-control" id="ddd2" name="ddd2">
                    </div>
                </div>

                <div class="mb-3 col-3">
                    <label for="telefone2" class="form-label">Telefone 2</label>

                    <div class="input-group">
                        <input type="text" value="{{$empresa->telefone2}}" onkeyup="formatarTelefone(this)" placeholder="Digite aqui..." class="form-control" id="telefone2"
                            name="telefone2">
                    </div>
                </div>
            </div>

            <hr>

            <button type="submit" class="btn btn-success btn-icon-split">
                <span class="icon">
                    <i class="fas fa-paper-plane"></i>
                </span>
                <span class="text">Enviar</span>
            </button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="/js/masks.js"></script>
    <script src="/js/requests.js"></script>
@endsection
