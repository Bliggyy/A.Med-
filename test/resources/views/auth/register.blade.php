<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href=" {{ asset('assets/favicon1.ico') }} ">
    <title>Signup | A.med</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('header')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href=" {{ asset('css/style.css') }} " rel="stylesheet">

</head>
<body>
    <div id="app">
        <main class="">
            <div class="login">
                <img src='../../assets/finallogo.png' alt="logo">
                <h1>S I G N U P</h1>
                <div class="login_bx">
                    <h2>Select Account Type</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <select class="form-control" name="account_type" required>
                            <option selected disabled>Select an Account Type</option>
                            <option value="patient">Patient</option>
                            <option value="doctor">Doctor</option>
                        </select>
                        <input id="username" type="text" class="login_inp @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="name" type="text" class="login_inp" name="name" value="{{ old('name') }}" placeholder="Name" required>
                        <input id="email" type="email" class="login_inp @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password" type="password" class="login_inp @error('password') is-invalid @enderror" name="password" required placeholder="Password" autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input id="password-confirm" type="password" class="login_inp" name="password_confirmation" required placeholder="Confirm Password" autocomplete="new-password">
                        <button type="submit" class="login_sub">
                            {{ __('Register') }}
                        </button>
                    </form>
                    <p>Already have an account? <a class="btn-link" href="{{ route('login') }}">{{ __('Login here !') }}</a></p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
