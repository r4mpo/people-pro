@extends('system.user.templates.main')
@section('title', 'Adicionar Setor')
@section('content-page')
    <div class="container">
        <p>
            <a href="{{ route('sistema.usuario.setores.entrar') }}" class="text-gray-800"><i class="fas fa-backward"></i>
                Retornar</a>
        </p>
        <form action="{{ route('sistema.usuario.setores.cadastrar') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-cog"></i></span>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Setor">
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-success btn-icon-split">
                <span class="icon">
                    <i class="fas fa-cog"></i>
                </span>
                <span class="text">Cadastrar</span>
            </button>
        </form>
    </div>
@endsection
