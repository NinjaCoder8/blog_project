<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('common-head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-container.css') }}">
    <title>Add Blog</title>
</head>

<body>
    @include('navbar')
    <section class="form-container">
        <h1>{{ isset($blog) ? 'Update Blog' : 'Add Blog' }} </h1>
        <form method="POST" action="{{ isset($blog) ? route('blog.update', $blog->id) : route('blog.store') }}"
            enctype="multipart/form-data">
            @if (isset($blog))
                @method('PUT')
            @endif
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input required type="text" name="title" id="title" placeholder="Enter title"
                    value="{{ isset($blog) ? $blog->title : '' }}">
                @error('title')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea required name="body" id="body" cols="30" rows="10" placeholder="Enter description">{{ isset($blog) ? $blog->body : '' }}</textarea>
                @error('body')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input {{ !isset($blog) ? 'required' : '' }} type="file" name="image" id="image"
                    accept="image/jpeg, image/png">
                @error('image')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <button class="btn-primary cta-btn">{{ isset($blog) ? 'Edit Blog' : 'Add Blog' }}</button>

        </form>
    </section>
</body>

</html>
