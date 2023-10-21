<div class="container">
    <hr class="mb-2">
    <h1 class="h3 mb-1 text-gray-800">Editar informações de usuário</h1>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <div class="mb-3">
                <label for="name">Nome</label>
                <input id="name" name="name" type="text" class="mt-1 form-control w-50" value="{{Auth::user()->name}}" required>
                @if ($errors->get('name'))
                    @foreach ($errors->get('name') as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>

            <div class="mb-3">
                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" class="mt-1 form-control w-50" value="{{Auth::user()->email}}" required>
                @if ($errors->get('email'))
                    @foreach ($errors->get('email') as $error)
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