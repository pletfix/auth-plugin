@extends('app')

@section('title', 'Register successful')

@section('content')
    @if($user !== null && empty($user->confirmation_token))

        <h3>Hallo {{$user->name}}.</h3>

        <p>Du hast es geschafft! Deine Registrierung ist abgeschlossen.</p>

        @if(!auth()->isLoggedIn())
            <a href="{{url('auth/login')}}" class="btn btn-sm btn-info">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Jetzt einloggen
            </a>
        @endif

    @endif
@endsection