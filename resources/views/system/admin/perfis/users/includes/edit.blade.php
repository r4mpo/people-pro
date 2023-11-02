<div class="modal fade" id="editarPerfilUser{{ $user['id'] }}" tabindex="-1" aria-labelledby="editarPerfilUserLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('system.admin.perfis.usuarios.edit', ['id' => base64_encode($user['id'])]) }}"
                method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h6 class="text-gray-800" id="editarPerfilUserLabel">Deseja alterar perfil de acesso de
                        {{ $user['nome'] }}?</h6>
                </div>
                <div class="modal-body">
                    <label for="role" class="form-label">Cargo</label><br>
                    <select class="mb-3" required name="role" id="role">
                        <option selected disabled>Selecione cargo para {{ $user['nome'] }}:</option>
                        @foreach ($perfis as $perfil)
                            <option @selected($perfil->name == $user['perfil']) value="{{ $perfil->name }}">{{ $perfil->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Alterar <i class="fas fa-pencil-alt"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
