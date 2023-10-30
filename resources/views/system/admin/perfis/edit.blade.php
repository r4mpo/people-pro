@extends('system.templates.main')
@section('title', 'Editar: ' . $role->name)
@section('content-page')
    <div class="container">
        <p>
            <a href="{{ route('system.admin.perfis.index') }}" class="text-gray-800"><i class="fas fa-backward"></i>
                Retornar</a>
        </p>

        <div class="row">
            <div class="col-12">
                <div class="border mb-1 border-dark p-4">
                    <form action="{{ route('system.admin.perfis.atualizar', ['id' => base64_encode($role->id)]) }}"
                        method="post">
                        @csrf
                        @method('PUT') <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nome do Perfil de Acesso</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="fas fa-users-cog"></i></span>
                                        <input type="text" value="{{$role->name}}" required placeholder="Digite aqui..." class="form-control"
                                            id="name" name="name">
                                    </div>
                                </div>

                                @foreach ($rotas as $rota)
                                    <div class="container text-center">
                                        <h3 class="text-success">{{ $rota->rota }}</h3>
                                        @foreach ($menus as $menu)
                                            @if ($menu->rota == $rota->rota)
                                                <p class="text-info">{{ $menu->menu }}</p>
                                                @foreach ($submenus as $submenu)
                                                    @if ($submenu->rota == $rota->rota and $submenu->menu == $menu->menu)
                                                        @php $hr = 0; @endphp
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p class="margin-text-roles-left text-dark">
                                                                    {{ $submenu->submenu }}</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check margin-text-roles-right">
                                                                    @php $br = 0; @endphp
                                                                    @foreach ($permissoes as $permissao)
                                                                        @if ($permissao->rota == $rota->rota and $permissao->menu == $menu->menu and $permissao->submenu == $submenu->submenu)
                                                                            <div>
                                                                                <input
                                                                                    class="form-check-input margin-text-roles-right"
                                                                                    type="checkbox" @checked($role->hasPermissionTo($permissao->name)) name="permissions[]"
                                                                                    value="{{ $permissao->name }}"
                                                                                    id="flexCheckDefault">
                                                                                <label class="form-check-label"
                                                                                    for="flexCheckDefault">
                                                                                    {{ $permissao->name }}
                                                                                </label>
                                                                            </div>

                                                                            @php $br++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        @for ($i = 0; $i < $br; $i++)
                                                            <br>
                                                        @endfor
                                                        @php $hr++; @endphp
                                                    @endif
                                                @endforeach
                                                @if ($hr > 0)
                                                    <hr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Atualizar</span>
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
