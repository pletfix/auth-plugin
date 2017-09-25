@extends('app')

@section('title', t('auth.users.show.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">{{t('auth.users.show.heading', ['name' => $user->name])}}</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 highlight">
                                {{t('models.user.id')}}
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                {{$user->id}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 highlight">
                                {{t('models.user.name')}}
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                {{$user->name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 highlight">
                                {{t('models.user.email')}}
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                {{$user->email}}
                                @if(!empty($user->confirmation_token))
                                    <span class="glyphicon glyphicon-exclamation-sign" style="color:red;" aria-hidden="true" title="{{t('auth.users.show.email_not_confirmed')}}"></span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 highlight">
                                {{t('models.user.role')}}
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                {{$user->role}}
                            </div>
                        </div>
                        <hr/>
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-12 col-sm-4 highlight">--}}
                                {{--{{t('models.user.created_at')}}--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-12 col-sm-8">--}}
                                {{--{{format_datetime($user->created_at)}}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-12 col-sm-4 highlight">--}}
                                {{--{{t('models.user.updated_at')}}--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-12 col-sm-8">--}}
                                {{--{{format_datetime($user->updated_at)}}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<br/>--}}
                        <div class="row">
                            <div class="col-xs-12 col-sm-9 col-sm-offset-3">
                                <a href="{{url('auth/users/' . $user->id . '/edit')}}" class="btn btn-sm btn-info" title="{{t('common.edit')}}">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    {{t('common.buttons.edit')}}
                                </a>
                                <a href="{{url('auth/users')}}" class="btn btn-sm btn-default">{{t('common.buttons.cancel')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection