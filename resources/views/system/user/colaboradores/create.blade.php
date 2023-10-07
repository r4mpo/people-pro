@extends('system.user.templates.main')
@section('title', 'Adicionar Colaborador')
@section('content-page')
    <div class="container">
        <p>
            <a href="{{ route('sistema.usuario.colaboradores.entrar') }}" class="text-gray-800"><i class="fas fa-backward"></i>
                Retornar</a>
        </p>

        <div class="row mb-3">
            <div class="col-12">
                <div class="border mb-1 border-dark p-4">
                    <form action="{{ route('sistema.usuario.colaboradores.cadastrar') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome do Colaborador</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="fas fa-people-carry"></i></span>
                                        <input required type="text" placeholder="Digite aqui..." class="form-control"
                                            id="nome" name="nome">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="fas fa-envelope"></i></span>
                                        <input required type="email" class="form-control" id="email" name="email"
                                            placeholder="Digite aqui...">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon3"><i
                                                    class="fas fa-id-card-alt"></i></span>
                                            <input required type="text" placeholder="Digite aqui..."
                                                oninput="formatarCpfInput(this)" maxlength="11" class="form-control"
                                                id="cpf" name="cpf">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="rg" class="form-label">RG</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon3"><i
                                                    class="fas fa-id-card-alt"></i></span>
                                            <input required type="text" placeholder="Digite aqui..."
                                                oninput="formatarRgInput(this)" maxlength="10" class="form-control"
                                                id="rg" name="rg">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mt-2">
                                    <div class="col-4">
                                        <label for="cargo_id" class="form-label">Cargo</label><br>
                                        <select required class="mb-3" name="cargo_id" id="cargo_id">
                                            <option selected>Selecione o cargo do seu colaborador</option>
                                            @foreach ($cargos as $cargo)
                                                <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="situacao" class="form-label">Situação</label><br>
                                        <select required class="mb-3" name="situacao" id="situacao"
                                            onchange="desabilitarInputComCampoDeSelecao(this, 1, document.getElementById('data_fim'))">
                                            <option selected>Selecione a situação do seu colaborador</option>
                                            @foreach ($situacoes as $situacao)
                                                <option value="{{ $situacao['value'] }}">{{ $situacao['option'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="escolaridade" class="form-label">Escolaridade</label><br>
                                        <select required class="mb-3" name="escolaridade" id="escolaridade">
                                            <option selected>Selecione a escolaridade do seu colaborador</option>
                                            @foreach ($escolaridades as $escolaridade)
                                                <option value="{{ $escolaridade['value'] }}">{{ $escolaridade['option'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="data_nascimento" class="form-label">Data de nascimento</label><br>
                                        <input required class="mb-3" name="data_nascimento" type="date"
                                            id="data_nascimento">
                                    </div>

                                    <div class="col-4">
                                        <label for="data_inicio" class="form-label">Data de início na empresa</label><br>
                                        <input required class="mb-3" name="data_inicio" type="date" id="data_inicio">
                                    </div>

                                    <div class="col-4">
                                        <label for="data_fim" class="form-label">Data final na empresa</label><br>
                                        <input required class="mb-3" name="data_fim" type="date" id="data_fim">
                                    </div>

                                </div>

                                <hr>

                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon3"><i
                                                    class="fas fa-phone"></i></span>
                                            <input required type="text" placeholder="Digite aqui..."
                                                oninput="formatarTelefoneComDDD(this)" maxlength="15"
                                                class="form-control" id="telefone" name="telefone">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="qtd_dependentes" class="form-label">Qtd. Dependentes</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon3"><i
                                                    class="fas fa-baby"></i></span>
                                            <input required type="text" placeholder="Digite aqui..."
                                                onkeypress="return apenasNumeros();" maxlength="2" class="form-control"
                                                id="qtd_dependentes" name="qtd_dependentes">
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mt-2">
                                    <div class="mb-3 col-12">
                                        <label for="cep" class="form-label">Cep</label>

                                        <div class="input-group">
                                            <input required type="text" onkeyup="ViaCep(this)"
                                                onkeypress="return apenasNumeros();" maxlength="8"
                                                placeholder="Digite aqui..." class="form-control" id="cep"
                                                name="cep">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-2">
                                        <label for="cidade" class="form-label">Cidade</label>

                                        <div class="input-group">
                                            <input required type="text" placeholder="Digite aqui..."
                                                class="form-control text-uppercase" id="cidade" name="cidade">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-3">
                                        <label for="logradouro" class="form-label">Logradouro</label>

                                        <div class="input-group">
                                            <input required type="text" placeholder="Digite aqui..."
                                                class="form-control text-uppercase" id="logradouro" name="logradouro">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label for="bairro" class="form-label">Bairro</label>

                                        <div class="input-group">
                                            <input required type="text" placeholder="Digite aqui..."
                                                class="form-control text-uppercase" id="bairro" name="bairro">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="numero" class="form-label">Número</label>

                                        <div class="input-group">
                                            <input required type="text" onkeypress="return apenasNumeros();"
                                                maxlength="20" placeholder="Digite aqui..."
                                                class="form-control text-uppercase" id="numero" name="numero">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label for="complemento" class="form-label">Complemento</label>

                                        <div class="input-group">
                                            <input required type="text" placeholder="Digite aqui..."
                                                class="form-control text-uppercase" id="complemento" name="complemento">
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-3">
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/masks.js"></script>
    <script src="/js/requests.js"></script>
@endsection
