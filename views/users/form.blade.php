@extends('app')

@section('title', t('auth.users.form.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{t('auth.users.form.heading') . (isset($user->id) ? ' #' . $user->id : '')}}
                    </div>
                    <div class="panel-body">
                        @include('_errors')
                        <form method="POST" action="{{url('auth/users' . (isset($user->id) ? '/' . $user->id : ''))}}" accept-charset="UTF-8" class="form-horizontal">
                            @if(isset($user->id))
                                <input name="_method" value="PATCH" type="hidden"/>
                            @endif
                            <input name="_token" value="{{csrf_token()}}" type="hidden"/>
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">
                                    {{t('models.user.name')}}
                                </label>
                                <div class="col-md-8">
                                    <input id="name" name="name" value="{{old('name') ?: $user->name}}" type="text" class="form-control" placeholder="{{t('models.user.name')}}" required="required"/>
                                </div>
                            </div>
                            <div class="form-group{{error('email') ? ' has-error' : ''}}">
                                <label for="email" class="col-md-4 control-label">
                                    {{t('models.user.email')}}
                                </label>
                                <div class="col-md-8">
                                    <input id="email" name="email" value="{{old('email') ?: $user->email}}" type="text" class="form-control" placeholder="{{t('models.user.email')}}" required="required"/>
                                    @if(isset($user) && !empty($user->confirmation_token))
                                        <div style="padding-top: 5px">
                                            <span class="glyphicon glyphicon-exclamation-sign" style="color:red" aria-hidden="true" title="{{t('auth.users.show.email_not_confirmed')}}"></span>
                                            <i>{{t('auth.users.form.email_not_confirmed')}}</i>
                                        </div>
                                    @endif
                                    @if (error('email'))
                                        <span class="help-block">
                                            <strong>{{error('email')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{error('role') ? ' has-error' : ''}}">
                                <label for="role" class="col-md-4 control-label">
                                    {{t('models.user.role')}}
                                </label>
                                <div class="col-md-8">
                                    <select id="role" name="role" class="form-control" data-placeholder="{{t('models.user.role')}}" required="required">
                                        <option selected="selected" value=""></option>
                                        @foreach(config('auth.roles') as $role => $title)
                                            <option value="{{$role}}" {!!$role === (old('role') ?: $user->role) ? 'selected="selected"' : ''!!}>{{$title}}</option>
                                        @endforeach
                                    </select>
                                    @if (error('role'))
                                        <span class="help-block">
                                            <strong>{{error('role')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if(isset($user->id) && !error('password') && !error('password_confirmation'))
                                <div class="panel" style="padding-bottom: 5px">
                                    <a href="#password-panel" data-toggle="collapse">{{t('auth.users.form.change_password')}}</a>
                                    <div id="password-panel" class="collapse">
                            @endif
                                        <div class="form-group{{error('password') ? ' has-error' : ''}}">
                                            <label for="password" class="col-md-4 control-label">
                                                {{t('models.user.password')}}
                                            </label>
                                            <div class="col-md-8">
                                                <input id="password" name="password" type="password" class="form-control" placeholder="{{t('models.user.password')}}"/>
                                                @if (error('password'))
                                                    <span class="help-block">
                                                        <strong>{{error('password')}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{error('password_confirmation') ? ' has-error' : ''}}">
                                            <label for="password-confirm" class="col-md-4 control-label">
                                                {{t('auth.users.form.confirm_password')}}
                                            </label>
                                            <div class="col-md-8">
                                                <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="{{t('auth.users.form.confirm_password')}}" title=""/>
                                                @if (error('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{error('password_confirmation')}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                            @if(isset($user->id) && !error('password') && !error('password_confirmation'))
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-4">
                                    <button class="btn btn-primary" type="submit">
                                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> {{t('common.buttons.save')}}
                                    </button>
                                    <a href="{{url('auth/users')}}" class="btn btn-default">{{t('common.buttons.cancel')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection