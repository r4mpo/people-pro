<div class="container mb-5">
    <hr class="mb-2">
    <h1 class="h3 mb-1 text-gray-800">Excluir conta de acesso ao PeoplePro</h1>

    @if ($errors->userDeletion->get('password'))
        @foreach ($errors->userDeletion->get('password') as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <div class="form-group text-justify">
            <div class="mb-3">
                <h1 class="h3 mb-1 text-gray-800">Prezado(a) {{ Auth::user()->name }},</h1>

                <p>Esperamos que esteja bem. Antes de proceder com a exclusão da sua conta em nossa plataforma,
                    gostaríamos de expressar o quanto sentimos por não ter atendido às suas expectativas. Valorizamos
                    cada
                    um dos nossos usuários e lamentamos que não tenhamos conseguido proporcionar a experiência que você
                    esperava.</p>

                <p>Entendemos que a exclusão da sua conta pode ser uma decisão difícil, e queremos assegurar que você
                    esteja ciente das implicações:</p>

                <ul>
                    <li>Perda de Dados: Ao excluir sua conta, todos os dados associados a ela serão permanentemente
                        removidos do
                        nosso sistema. Isso inclui informações de perfil, registro de colaboradores, informações
                        relacionadas ao financeiro da empresa
                        e quaisquer outros dados relacionados à sua conta. Não poderemos recuperar esses dados após a
                        exclusão.</li>

                    <li>Acesso Futuro: Você não terá mais acesso à sua conta após a exclusão. Isso significa que você
                        não poderá
                        utilizar os recursos e serviços associados à sua conta anterior.</li>

                    <li>Comunicações Futuras: Caso mude de ideia e deseje utilizar nossa plataforma novamente, será
                        necessário
                        criar uma nova conta e recomeçar do zero.</li>
                </ul>

                Se você estiver disposto a prosseguir com a exclusão da sua conta, por favor, preencha sua senha e
                clique no botão abaixo:
            </div>
        </div>

        <div class="mb-3">
            <label for="password">Senha de acesso</label>
            <input id="password" name="password" type="password" class="mt-1 form-control w-50" required>
            @if ($errors->updatePassword->get('password'))
                @foreach ($errors->updatePassword->get('password') as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
            @endif
        </div>

        <button type="submit" class="btn btn-danger btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-trash-alt"></i>
            </span>
            <span class="text">Excluir</span>
        </button>

    </form>
</div>