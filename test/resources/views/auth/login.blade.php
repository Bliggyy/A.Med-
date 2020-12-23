<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href=" {{ asset('assets/favicon1.ico') }} ">
    <title>Login | A.med</title>

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
                <img src=" {{ asset('assets/finallogo.png') }} " alt="logo">
                <div>
                    <h1>L O G I N</h1>
                    <div class="login_bx">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input id="email" type="email" class="login_inp @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                       
                            <input id="password" type="password" class="login_inp @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input class="login_rem" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link login_forgot" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <br>
                            <button type="submit" class="login_sub">
                                {{ __('Login') }}
                            </button>
                        </form>
                        <p>No account yet? <a class="btn-link" href="{{ route('register') }}">{{ __('Signup here !') }}</a></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>