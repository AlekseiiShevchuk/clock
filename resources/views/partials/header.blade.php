<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Clock - Admin Panel</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/levels') }}">Levels</a></li>
                <li><a href="{{ url('/movies') }}">Movies</a></li>
                @if (!Auth::guest())
                <form action="{{ url('/logout') }}" method="POST" class="navbar-form navbar-right">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
                @endif
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>