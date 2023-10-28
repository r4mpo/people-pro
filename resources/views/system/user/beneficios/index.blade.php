@extends('system.templates.main')
@php use App\Models\User; @endphp
@section('title', 'Benefícios')
@section('content-page')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">

                                @can(User::CADASTRAR_BENEFICIOS)
                                    <a href="{{ route('sistema.usuario.beneficios.vincular_beneficio_usuario_view') }}"
                                        class="btn btn-success btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus-circle"></i>
                                        </span>
                                        <span class="text">Adicionar benefício</span>
                                    </a>
                                @endcan

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            @can(User::EXCLUIR_BENEFICIOS)
                                                <th>Ações</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($beneficios as $beneficio)
                                            <tr class="text-center">
                                                <td>{{ $beneficio['id'] }}</td>
                                                <td>{{ $beneficio['nome'] }}</td>
                                                <td>{{ $beneficio['tipo'] }}</td>
                                                @can(User::EXCLUIR_BENEFICIOS)
                                                    <td>
                                                        <i title="Desvincular" class="fas fa-trash-alt cursor-pointer color-red"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#excluirBeneficio{{ base64_decode($beneficio['id']) }}"></i>
                                                    </td>
                                                @endcan
                                            </tr>
                                            @include('system.user.beneficios.includes.desvincular_beneficio')
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
