@extends('system.user.templates.main')
@section('title', 'Financeiros')
@section('content-page')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">

                                <a href="{{ route('sistema.usuario.financeiros.criar') }}"
                                    class="btn btn-success btn-icon-split mb-3">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus-circle"></i>
                                    </span>
                                    <span class="text">Adicionar financeiro</span>
                                </a>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <td>Código</td>
                                            <td>Descrição</td>
                                            <td>Documento</td>
                                            <td>Ações</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($financeiros as $financeiro)
                                            <tr class="text-center">
                                                <td>{{ base64_encode($financeiro['id']) }}</td>
                                                <td>{{ $financeiro['descricao'] }}</td>
                                                <td><a href="{{ $financeiro['documento'] }}">Baixar</a></td>
                                                <td>
                                                    <a title="Editar"
                                                        href="{{ route('sistema.usuario.financeiros.editar', ['id' => base64_encode($financeiro['id'])]) }}"><i
                                                            class="fas fa-pencil-alt color-blue"></i></a>
                                                    <i title="Excluir" class="fas fa-trash-alt cursor-pointer color-red"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#excluirFinanceiro{{ $financeiro['id'] }}"></i>
                                                </td>
                                            </tr>
                                            @include('system.user.financeiros.includes.excluir_financeiros')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/template/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/template/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/template/js/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
@endsection
