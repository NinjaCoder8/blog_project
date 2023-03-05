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
    <title>Login</title>
</head>

<body>
    @include('navbar')
    <section class="form-container">
        <h1>Login</h1>
        <form method="POST" action="{{ route('auth.login') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input required type="email" name="email" id="email" placeholder="Enter email">
                @error('email')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" name="password" id="password" placeholder="Enter password">
                @error('password')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>



            <button class="btn-primary cta-btn">Login</button>

        </form>
    </section>
</body>

</html>
