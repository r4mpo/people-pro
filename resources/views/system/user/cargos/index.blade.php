@extends('system.templates.main')
@php use App\Models\User; @endphp
@section('title', 'Cargos')
@section('content-page')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                @can(User::CADASTRAR_CARGOS)
                                    <a href="{{ route('sistema.usuario.cargos.criar') }}"
                                        class="btn btn-success btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus-circle"></i>
                                        </span>
                                        <span class="text">Adicionar cargo</span>
                                    </a>
                                @endcan

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>Remuneração</th>
                                            <th>Setor</th>
                                            @canany([User::EDITAR_CARGOS, User::EXCLUIR_CARGOS])
                                                <th>Ações</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cargos as $cargo)
                                            <tr class="text-center">
                                                <td>{{ base64_encode($cargo->id) }}</td>
                                                <td>{{ $cargo->nome }}</td>
                                                <td>{{ $cargo->formatar_remuneracao() }}</td>
                                                <td>{{ $cargo->setor->nome }}</td>
                                                @canany([User::EDITAR_CARGOS, User::EXCLUIR_CARGOS])
                                                    <td>
                                                        @can(User::EDITAR_CARGOS)
                                                            <a title="Editar"
                                                                href="{{ route('sistema.usuario.cargos.editar', ['id' => base64_encode($cargo->id)]) }}"><i
                                                                    class="fas fa-pencil-alt color-blue"></i></a>
                                                        @endcan
                                                        @can(User::EXCLUIR_CARGOS)
                                                            <i title="Excluir" class="fas fa-trash-alt cursor-pointer color-red"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#excluirCargo{{ $cargo->id }}"></i>
                                                        @endcan
                                                    </td>
                                                @endcan
                                            </tr>
                                            @include('system.user.cargos.includes.excluir_cargo')
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
