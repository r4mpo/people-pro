<div class="modal fade" id="excluirColaborador{{ $colaborador->id }}" tabindex="-1" aria-labelledby="excluirColaboradorLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-gray-800" id="excluirColaboradorLabel">Ops!</h6>
            </div>
            <div class="modal-body">
                Tem certeza que deseja realmente excluir esta informação? Lembre-se de que
                dados excluídos do banco de dados não poderão ser recuperados, então tenha cuidado.
                Se ainda assim desejar se desfazer, clique no botão opcional "Excluir" logo abaixo.
            </div>
            <div class="modal-footer">
                <form
                    action="{{ route('sistema.usuario.colaboradores.excluir', ['id' => base64_encode($colaborador->id)]) }}"
                    method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir <i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
