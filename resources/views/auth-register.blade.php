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
    <title>Register</title>

</head>

<body>
    @include('navbar')
    <section class="form-container">
        <h1>Register</h1>
        <form method="POST" action="{{ route('auth.register') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input required type="text" name="name" id="name" placeholder="Enter name">
                @error('name')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>
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
                <input required type="password" minlength="8" name="password" id="password"
                    placeholder="Enter password">
                @error('password')
                    <span class="form-error">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Re-enter password:</label>
                <input required type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Re-enter password">
            </div>


            <button class="btn-primary cta-btn">Register</button>

        </form>
    </section>
</body>

</html>
