@extends('system.templates.main')
@php use App\Models\User; @endphp
@section('title', 'Perfis e Usuários')
@section('content-page')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Empresa</th>
                                            <th>Perfil</th>
                                            @can(User::EDITAR_PERFIS_USUARIOS)
                                                <th>Ações</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr class="text-center">
                                                <td>{{ $user['nome'] }}</td>
                                                <td>{{ $user['email'] }}</td>
                                                <td>{{ $user['empresa'] }}</td>
                                                <td>{{ $user['perfil'] }}</td>
                                                @can(User::EDITAR_PERFIS_USUARIOS)
                                                    <td>
                                                        @if (strpos($user['perfil'], 'Administrador') !== false or $user['id'] === Auth::user()->id)
                                                            <i class="fas fa-ban color-yellow cursor-pointer"
                                                                title="Sem opções de alteração"></i>
                                                        @else
                                                            <i title="Editar"
                                                                class="fas fa-pencil-alt color-blue cursor-pointer"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editarPerfilUser{{ $user['id'] }}"></i>
                                                        @endif
                                                    </td>
                                                @endcan
                                                @if (strpos($user['perfil'], 'Administrador') === false or $user['id'] !== Auth::user()->id)
                                                    @include('system.admin.perfis.users.includes.edit')
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
