@extends('system.templates.main')
@section('title', 'Perfil')
@section('content-page')
    @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.delete-user-form')
@endsection
