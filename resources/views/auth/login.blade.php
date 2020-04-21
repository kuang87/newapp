@extends('front.layout')

@section('content')
    <div class="account">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 mx-auto">
                    <h1 class="title">Вход</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label for="email">E-Mail адрес</label>
                        <input class="no-round-input" id="email" type="email"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        <label for="password">Пароль</label>
                        <input class="no-round-input" id="password"
                               type="password" name="password" required autocomplete="current-password">

                        @if ($errors->any())
                            <div class="row">
                                <div class="col-12">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="account-method">
                            <div class="account-save">
                                <input type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Запомнить меня</label>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="account-forgot"><a href="{{ route('password.request') }}">Забыли пароль?</a>
                                </div>
                            @endif
                        </div>
                        <div class="account-function">
                            <button class="no-round-btn pink" type="submit">Войти</button>
                            @if (Route::has('register'))
                                <a class="create-account" href="{{ route('register') }}">Регистрация</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
