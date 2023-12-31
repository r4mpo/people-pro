@extends('system.templates.main')
@section('title', 'Adicionar Financeiro')
@section('content-page')
    <div class="container">
        <p>
            <a href="{{ route('sistema.usuario.financeiros.entrar') }}" class="text-gray-800"><i class="fas fa-backward"></i>
                Retornar</a>
        </p>

        <div class="row mb-3">
            <div class="col-12">
                <div class="border mb-1 border-dark p-4">
                    <form action="{{ route('sistema.usuario.financeiros.cadastrar') }}" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="far fa-keyboard"></i></span>
                                        <textarea required name="descricao"
                                            placeholder="Ex: 'Pagamento de fatura do servidor'. Escreva uma descrição que remeta exatamente ao que foi destinado essa finança."
                                            id="descricao" cols="110" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="documento" class="form-label">Arquivo</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="fas fa-file-pdf"></i></span>
                                        <input required type="file" accept="jpeg,png,pdf" name="documento" id="documento">
                                    </div>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
