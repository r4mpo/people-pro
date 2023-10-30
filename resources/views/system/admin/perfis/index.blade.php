@extends('system.templates.main')
@php use App\Models\User; @endphp
@section('title', 'Perfis de acesso')
@section('content-page')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                @can(User::CADASTRAR_PERFIS_ACESSO)
                                    <a href="{{ route('system.admin.perfis.create') }}"
                                        class="btn btn-success btn-icon-split mb-3">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus-circle"></i>
                                        </span>
                                        <span class="text">Adicionar perfil</span>
                                    </a>
                                @endcan

                                <table class="table table-bordered text-center" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Perfil de acesso</th>
                                            <th>Nº de ativos</th>
                                            <th>Criação</th>
                                            <th>Última atualização</th>
                                            @canany([User::EDITAR_PERFIS_ACESSO, User::EXCLUIR_PERFIS_ACESSO])
                                                <th>Ações</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($perfis as $perfil)
                                            <tr class="text-center">
                                                <td>{{ $perfil->id }}</td>
                                                <td>{{ $perfil->name }}</td>
                                                <td>{{ count(User::role($perfil->name)->get()) }}</td>
                                                <td>{{ date('d/m/Y', strtotime($perfil->created_at)) . ' às ' . date('h:i:s', strtotime($perfil->created_at)) }}
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($perfil->updated_at)) . ' às ' . date('h:i:s', strtotime($perfil->updated_at)) }}
                                                </td>
                                                @canany([User::EDITAR_PERFIS_ACESSO, User::EXCLUIR_PERFIS_ACESSO])
                                                    <td>
                                                        @if (strpos($perfil->name, 'Administrador') !== false or strpos($perfil->name, 'User') !== false)
                                                            <i class="fas fa-ban color-yellow cursor-pointer"
                                                                title="Sem opções de alteração"></i>
                                                        @else
                                                            @can(User::EDITAR_PERFIS_ACESSO)
                                                                <a title="Editar"
                                                                    href="{{ route('system.admin.perfis.editar', ['id' => base64_encode($perfil->id)]) }}"><i
                                                                        class="fas fa-pencil-alt color-blue"></i></a>
                                                            @endcan

                                                            @can(User::EXCLUIR_PERFIS_ACESSO)
                                                                <i title="Excluir" class="fas fa-trash-alt cursor-pointer color-red"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#excluirPerfil{{ $perfil->id }}"></i>
                                                            @endcan
                                                        @endif
                                                    </td>
                                                @endcanany
                                                @if (strpos($perfil->name, 'Administrador') === false or strpos($perfil->name, 'User') === false)
                                                    @include('system.admin.perfis.includes.excluir_perfil_acesso')
                                                @endif
                                            </tr>
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
