@extends('auth.templates.main')
@section('title', 'Recuperar senha')
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
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email" name="email" class="form-control _ge_de_ol" type="email"
                                        placeholder="E-mail" required aria-required="true">
                                </div>

                                <div class="form-group">
                                    <div class="check_box_main">
                                        Já tem conta? <a href="{{ route('login') }}" class="pas-text">Entre</a>.
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="btn_uy text-uppercase">
                                        <button type="submit"><span>Recuperar</span></button>
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
