@extends('auth.templates.main')
@section('title', 'Definir nova senha')
@section('content-page')
    <section class="form-01-main">
        <div class="form-cover">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-sub-main">
                            <div class="_main_head_as">
                                <a href="#">
                                    <img src="/auth/template/assets/images/vector.png">
                                </a>
                            </div>
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="form-group">
                                    <input id="email" name="email" class="form-control _ge_de_ol" type="email"
                                        placeholder="E-mail" required aria-required="true">
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control" name="password"
                                        placeholder="Senha" required>
                                    {{-- <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i> --}}
                                </div>

                                <div class="form-group">
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Confirmar senha" required>
                                    {{-- <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i> --}}
                                </div>


                                <div class="form-group">
                                    <div class="btn_uy text-uppercase">
                                        <button type="submit"><span>Redefinir</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
