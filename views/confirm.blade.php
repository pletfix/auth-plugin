@extends('app')

@section('title', t('auth.confirm.title'))

@section('content')
    <div class="container">
        @if($user !== null && empty($user->confirmation_token))

            <h3>{{t('auth.confirm.hello', ['name' => $user->name])}}!</h3>

            <p>{{t('auth.confirm.welcome')}}</p>

            @if(!auth()->isLoggedIn())
                <a href="{{url('auth/login')}}" class="btn btn-sm btn-info">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> {{t('auth.confirm.login')}}
                </a>
            @endif

        @endif
    </div>
@endsection