<nav class="navbar navbar-grey navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
        <div class="navbar-header a-center">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-home" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-home">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user())
                    <li><a href="/logout" >Logout</a></li>
                @else
                    <li><a href="#login" data-toggle="modal" data-target="#login">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@include('modals.login')