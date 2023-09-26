@extends('system.user.templates.main')
@section('title', 'Setores')
@section('content-page')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">

                                <a href="{{ route('sistema.usuario.setores.criar') }}"
                                    class="btn btn-success btn-icon-split mb-3">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus-circle"></i>
                                    </span>
                                    <span class="text">Adicionar setor</span>
                                </a>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($setores as $setor)
                                            <tr class="text-center">
                                                <td>{{ base64_encode($setor->id) }}</td>
                                                <td>{{ $setor->nome }}</td>
                                                <td>
                                                    <a href="{{ route('sistema.usuario.setores.editar', ['id' => base64_encode($setor->id)]) }}"><i class="fas fa-pencil-alt color-blue"></i></a>
                                                    <i title="Desvincular" class="fas fa-trash-alt cursor-pointer color-red"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#excluirSetor{{ $setor->id }}"></i>
                                                </td>
                                            </tr>
                                            @include('system.user.setores.includes.excluir_setor')
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
