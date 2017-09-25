@extends('app')

@section('title', t('auth.users.index.title'))

@section('content')
    <div class="container">
        <h2>{{t('auth.users.index.heading')}}</h2>
        <div class ="row">
            <div class="col-xs-8 col-sm-6">
                @include('_search')
            </div>
            <div class="col-xs-4 col-sm-6 text-right">
                <a href="{{url('auth/users/create')}}" class="btn btn-sm btn-info">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{t('common.buttons.new')}}
                </a>
            </div>
        </div>
        <div>
            @include('_message')
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>{!!sort_column('id',         t('models.user.id'))!!}</th>
                        <th>{!!sort_column('name',       t('models.user.name'))!!}</th>
                        <th>{!!sort_column('email',      t('models.user.email'))!!}</th>
                        <th>{!!sort_column('role',       t('models.user.role'))!!}</th>
                        {{--<th>{!!sort_column('updated_at', t('models.user.updated_at'))!!}</th>--}}
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
                                    <span class="glyphicon glyphicon-exclamation-sign" style="color:red" aria-hidden="true" title="{{t('auth.users.index.email_not_confirmed')}}"></span>
                                    <span class="btn-group btn-group-xs"><a href="{{url('auth/users/' . $user->id . '/confirm')}}" class="btn btn-default">{{t('auth.users.index.confirm_button')}}</a></span>
                                @endif
                            </td>
                            <td>{{$user->role}}</td>
                            {{--<td>{{format_datetime($user->updated_at)}}</td>--}}
                            <td class="text-right text-nowrap">
                                <a href="{{url('auth/users/' . $user->id)}}" class="btn btn-sm btn-info" title="{{t('common.show')}}">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                </a>
                                <a href="{{url('auth/users/' . $user->id . '/edit')}}" class="btn btn-sm btn-info" title="{{t('common.edit')}}">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <a href="{{url('auth/users/' . $user->id . '/replicate')}}" class="btn btn-sm btn-info" title="{{t('common.replicate')}}">
                                    <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
                                </a>
                                <form method="POST" action="{{url('auth/users/' . $user->id)}}" accept-charset="UTF-8" style="display: inline-block;">
                                    <input name="_method" value="DELETE" type="hidden"/>
                                    <input name="_token" value="{{csrf_token()}}" type="hidden"/>
                                    <button type="submit" title="{{t('common.delete')}}" class="btn btn-sm btn-danger delete-button">
                                        <span class="glyphicon glyphicon-trash no-spinner" aria-hidden="true"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($users->isEmpty())
                        <tr>
                            <td colspan="100" class="no-hit text-center"> - {{t('common.no_entries_found')}} - </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @include('_pagination')
    </div>
@endsection
