<div class="container">
    <hr class="mb-2">
    <h1 class="h3 mb-1 text-gray-800">Editar senha de usuário</h1>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <div class="mb-3">
                <label for="current_password">Senha atual</label>
                <input id="current_password" name="current_password" type="password" class="mt-1 form-control w-50"
                    required>
                @if ($errors->updatePassword->get('current_password'))
                    @foreach ($errors->updatePassword->get('current_password') as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

            <div class="mb-3">
                <label for="password">Nova senha</label>
                <input id="password" name="password" type="password" class="mt-1 form-control w-50" required>
                @if ($errors->updatePassword->get('password'))
                    @foreach ($errors->updatePassword->get('password') as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

            <div class="mb-3">
                <label for="password">Confirmar senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    class="mt-1 form-control w-50" required>
                @if ($errors->updatePassword->get('password_confirmation'))
                    @foreach ($errors->updatePassword->get('password_confirmation') as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-pencil-alt"></i>
            </span>
            <span class="text">Editar</span>
        </button>
    </form>
</div>