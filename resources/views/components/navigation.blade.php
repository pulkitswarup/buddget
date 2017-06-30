<nav class="navbar navbar-default">
    <div>
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}" style="padding: 0; margin-left: 10px;">
                <img src="{{ asset('images/logo-final-image.png')}}" style="width: auto; height: 100%; display: inline-block;"/>
                <img src="{{ asset('images/logo-final-text.png')}}" style="width: auto; height: 75%; display: inline-block; padding-top: 5px;"/>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('aboutus') }}">About</a></li>
                @else
                    <li><a href="{{ route('expenses.index') }}">Expenses</a></li>
                    <li><a href="{{ route('groups.index') }}">Groups</a></li>
                    <li><a href="#">Reports</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('aboutus') }}">About</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('user.edit', ['user' => Auth::user()->id ]) }}">Manage Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('password.change') }}">Change Password</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
