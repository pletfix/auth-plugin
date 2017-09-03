@extends('app')

@section('content')
    <h2>{{t('authentication.index.title')}}</h2>
    <div class ="row">
        <div class="col-xs-8 col-sm-6">
            @include('_search')
        </div>
        <div class="col-xs-4 col-sm-6 text-right">
            <a href="{{url('admin/users/create')}}" class="btn btn-sm btn-info">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{t('authentication.index.new-button')}}
            </a>
        </div>
    </div>
    <div>
        @include('_message')
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered multiactions">
            <thead>
                <tr>
                    <th>{!!sort_column('id',         t('authentication.models.id'))!!}</th>
                    <th>{!!sort_column('name',       t('authentication.models.username'))!!}</th>
                    <th>{!!sort_column('email',      t('authentication.models.email'))!!}</th>
                    <th>{!!sort_column('role',       t('authentication.models.role'))!!}</th>
                    {{--<th>{!!sort_column('updated_at', t('authentication.models.updated_at'))!!}</th>--}}
                    <th class="text-right"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>
                            {{$user->email}}
                            @if(!empty($user->confirmation_token))
                                <span class="glyphicon glyphicon-exclamation-sign" style="color:red" aria-hidden="true" title="{{t('authentication.index.not_confirmed')}}"></span>
                                <span class="btn-group btn-group-xs"><a href="{{url('admin/users/' . $user->id . '/confirm')}}" class="btn btn-default">{{t('authentication.index.confirmed')}}</a></span>
                            @endif
                        </td>
                        <td>{{$user->role}}</td>
                        {{--<td>{{format_datetime($user->updated_at)}}</td>--}}
                        <td class="text-right text-nowrap doNotCheckLine">
                            <a href="{{url('admin/users/' . $user->id)}}" class="btn btn-sm btn-info" title="anzeigen">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a>
                            <a href="{{url('admin/users/' . $user->id . '/edit')}}" class="btn btn-sm btn-info" title="bearbeiten">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                            <a href="{{url('admin/users/' . $user->id . '/replicate')}}" class="btn btn-sm btn-info" title="duplizieren">
                                <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
                            </a>
                            <form method="POST" action="{{url('admin/users/' . $user->id)}}" accept-charset="UTF-8" style="display: inline-block;">
                                <input name="_method" value="DELETE" type="hidden"/>
                                <input name="_token" value="{{csrf_token()}}" type="hidden"/>
                                <button type="submit" title="löschen" class="btn btn-sm btn-danger delete-button">
                                    <span class="glyphicon glyphicon-trash no-spinner" aria-hidden="true"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if($users->isEmpty())
                    <tr>
                        <td colspan="100" class="no-hit text-center">- keine Einträge gefunden -</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    @include('_pagination')
@endsection
