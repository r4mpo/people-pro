@extends('system.user.templates.main')
@section('title', 'Benefícios')

@section('content-page')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">

                                <a href="#" class="btn btn-success btn-icon-split mb-3">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus-circle"></i>
                                    </span>
                                    <span class="text">Adicionar benefício</span>
                                </a>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($beneficios as $beneficio)
                                            <tr class="text-center">
                                                <td>{{ $beneficio['id'] }}</td>
                                                <td>{{ $beneficio['nome'] }}</td>
                                                <td>{{ $beneficio['tipo'] }}</td>
                                                <td>
                                                    <i title="Visualizar" class="far fa-eye cursor-pointer color-green"></i>
                                                    <i title="Excluir" class="fas fa-trash-alt cursor-pointer color-red"></i>
                                                </td>
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
@endsection
