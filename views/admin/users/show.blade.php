@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">{{$user->name}}'s Benutzerprofil</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 highlight">
                            ID
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            {{$user->id}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 highlight">
                            Benutzername
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            {{$user->name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 highlight">
                            E-Mail-Adresse
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            {{$user->email}}
                            <br/>
                            @if($user->confirmed)
                                <span class="glyphicon glyphicon-ok" style="color:green" aria-hidden="true" title="Verfifiziert"></span>
                            @else
                                <span class="glyphicon glyphicon-exclamation-sign" style="color:red;" aria-hidden="true" title="Echtheit noch nicht bestätigt"></span>
                                <i>Echtheit noch nicht bestätigt.</i>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 highlight">
                            Benutzerrolle
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            {{$user->role}}
                        </div>
                    </div>
                    <hr/>
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-12 col-sm-4 highlight">--}}
                            {{--Angelegt--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12 col-sm-8">--}}
                            {{--{{format_datetime($user->created_at)}}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-12 col-sm-4 highlight">--}}
                            {{--Bearbeitet--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12 col-sm-8">--}}
                            {{--{{format_datetime($user->updated_at)}}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<br/>--}}
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-sm-offset-3">
                            <a href="{{url('admin/users/' . $user->id . '/edit')}}" class="btn btn-sm btn-info" title="bearbeiten">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                Bearbeiten
                            </a>
                            <a href="{{url('admin/users')}}" class="btn btn-sm btn-default">Zurück</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection