@extends('app')

@section('title', t('auth.login.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{t('auth.login.heading')}}
                    </div>
                    <div class="panel-body">
                        @include('_errors')
                        <form class="form-horizontal" role="form" method="POST" action="{{url('auth/login')}}">
                            <input name="_token" value="{{csrf_token()}}" type="hidden"/>
                            <div class="form-group{{error('email') ? ' has-error' : ''}}">
                                <label for="email" class="col-md-4 control-label">
                                    {{t('models.user.email')}}
                                </label>
                                <div class="col-md-8">
                                    <input id="email" name="email" value="{{old('email')}}" type="email" class="form-control" required="required" autofocus="autofocus"/>
                                    @if (error('email'))
                                        <span class="help-block">
                                            <strong>{{error('email')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{error('password') ? ' has-error' : ''}}">
                                <label for="password" class="col-md-4 control-label">
                                    {{t('models.user.password')}}
                                </label>
                                <div class="col-md-8">
                                    <input id="password" name="password" type="password" class="form-control" required="required"/>
                                    @if (error('password'))
                                        <span class="help-block">
                                            <strong>{{error('password')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input id="remember" name="remember" type="checkbox" {{old('remember') ? 'checked="checked"' : ''}}/> {{t('auth.login.remember_me')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> {{t('auth.login.submit')}}
                                    </button>
                                    <a class="btn btn-link" href="{{url('auth/reset')}}">
                                        {{t('auth.login.forgot_password')}}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
