@if(!auth()->isLoggedIn())
    <li {!! is_active('auth/login') ? 'class="active"' : '' !!}>
        <a href="{{url('auth/login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> {{t('auth.nav.login')}}</a>
    </li>
    <li {!! is_active('auth/register') ? 'class="active"' : '' !!}>
        <a href="{{url('auth/register')}}"><i class="fa fa-list-alt" aria-hidden="true"></i> {{t('auth.nav.register')}}</a>
    </li>
@else
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            {{auth()->name()}}
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li {!! is_active('auth/password') ? 'class="active"' : '' !!}>
                <a href="{{url('auth/password')}}"><i class="fa fa-key" aria-hidden="true"></i> {{t('auth.nav.change_password')}}</a>
            </li>
            <li {!! is_active('auth/logout') ? 'class="active"' : '' !!}>
                <a href="{{url('auth/logout')}}" onclick="event.preventDefault(); $(this).next().submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> {{t('auth.nav.logout')}}
                </a>
                <form action="{{url('auth/logout')}}" method="POST" style="display:none">
                    <input name="_token" value="{{csrf_token()}}" type="hidden"/>
                </form>
            </li>
        </ul>
    </li>
    @can('manage')
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench" aria-hidden="true"></i> {{t('auth.nav.administration')}}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                @can('manage-user')
                    <li {!! is_active('auth/users') ? 'class="active"' : '' !!}>
                        <a href="{{url('auth/users')}}">{{t('auth.nav.user_accounts')}}</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan
@endif
