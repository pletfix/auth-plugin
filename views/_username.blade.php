<span class="collapsed hidden-lg hidden-md hidden-sm">
    @if(auth()->isLoggedIn())
        <span class="glyphicon glyphicon-user" aria-hidden="true" style="top:10px"></span>
        <span style="position:relative;top:10px">{{auth()->name()}}</span>
    @endif
</span>