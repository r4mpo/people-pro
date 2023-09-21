<div class="modal fade" id="excluirBeneficio{{ base64_decode($beneficio['id']) }}" tabindex="-1"
    aria-labelledby="excluirBeneficioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-gray-800" id="excluirBeneficioLabel">Ops!</h6>
            </div>
            <div class="modal-body">
                Tem certeza que deseja realmente se desvincular desta informação? Lembre-se de que
                dados excluídos do banco de dados não poderão ser recuperados, então tenha cuidado.
                Se ainda assim desejar se desvincular, clique no botão opcional "Desvincular" logo abaixo.
            </div>
            <div class="modal-footer">
                <form action="{{ route('sistema.usuario.beneficios.desvincular_beneficio_usuario_exe') }}" method="post">
                    @csrf
                    <input type="hidden" name="beneficio_id" id="beneficio_id" value="{{ base64_decode($beneficio['id']) }}">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Desvincular <i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
