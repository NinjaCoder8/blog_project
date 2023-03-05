<header>
    <a href="/">My Blog</a>
    <nav>
        <ul>
            @if (Auth::check())
                <li><a href="{{ route('blog.create') }}">Add Blog</a></li>
                <li><a href="{{ route('auth.logout') }}">Logout</a></li>
            @else
                <li><a href="{{ route('auth.login') }}">Login</a></li>
                <li><a href="{{ route('auth.register') }}">Register</a></li>
            @endif
        </ul>
    </nav>

</header>
