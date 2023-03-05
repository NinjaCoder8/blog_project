<!DOCTYPE html>
<html lang="en">

<head>
    @include('common-head')
    <title>{{ $blog->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
</head>

<body>
    @include('navbar')
    <section class="blog-show">
        <img src="{{ $blog->featured_image_path }}" alt="">
        <h1>{{ $blog->title }}</h1>
        @if (Auth::check() && Auth::user()->id == $blog->user_id)
            <div class="btn-group">
                <a href="{{ route('blog.edit', $blog->id) }}">
                    <button class="btn-secondary">
                        Edit
                    </button>
                </a>
                <form method="POST" action="{{ route('blog.destroy', $blog->id) }}">
                    @method('DELETE')
                    @csrf
                    <button class="delete-btn btn-danger" type="submit">Delete</button>
                </form>

            </div>
        @endif
        <div class="clearfix"></div>
        <div class="blog-meta">
            <em>Created by:<br /><span class="meta-data">{{ $blog->user->name }}</span></em>
            <em>Created at:<br /><span class="meta-data">{{ $blog->created_at->format('j F, Y') }}</em>
        </div>
        <hr />
        <p>{{ $blog->body }}</p>
    </section>

</body>

</html>
