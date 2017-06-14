<span class="collapsed hidden-lg hidden-md hidden-sm">
    @if(auth()->isLoggedIn())
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        {{auth()->name()}}
    @endif
</span>