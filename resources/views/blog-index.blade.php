<!DOCTYPE html>
<html lang="en">

<head>
    @include('common-head')

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <script defer src="{{ asset('js/blog.js') }}"></script>

    <title>Blog Post</title>
</head>

<body>
    @include('navbar')

    <div class="login-status-container">
        @if (Auth::check())
            <div class="green-circle"></div> Logged in as&nbsp;<span class="user-name">{{ Auth::user()->name }}</span>
        @else
            <div class="red-circle"></div> Logged out
        @endif
    </div>

    <div class="page-title">
        <h1>Blog Posts</h1>
        <form method="GET" action="{{ route('blog.index') }}">
            <div class="form-group search-container">

                <input type="text" name="title" id="title" placeholder="Search"
                    value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">

            </div>
        </form>

    </div>
    </div>

    <hr />

    @if (!$blogs->count())
        <h2>No blogs found. Go add some!</h2>
    @endif
    @foreach ($blogs as $blog)
        <a href="{{ route('blog.show', $blog->id) }}">
            <div class="blog">
                <div class="details-container">
                    <h2>{{ $blog->title }}</h2>
                    <div class="blog-meta">
                        <em>Created by:<br /><span class="meta-data">{{ $blog->user->name }}</span></em>
                        <em>Created at:<br /><span class="meta-data">{{ $blog->created_at->format('j F, Y') }}</em>
                    </div>
                </div>
                <div class="img-container">
                    <img src="{{ $blog->featured_image_path }}" alt="{{ $blog->title }}">
                </div>
            </div>
        </a>
    @endforeach

    @if ($blogs->count())
        <section class="pagination">
            @for ($i = 1; $i <= $total_pages; $i++)
                <a class="{{ $i == $current_page ? 'selected' : '' }}"
                    href="{{ route('blog.index', ['page' => $i]) }}">{{ $i }}</a>
            @endfor
        </section>
    @endif
</body>

</html>
