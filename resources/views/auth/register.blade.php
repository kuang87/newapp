@extends('front.layout')

@section('content')
<div class="account">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
                <h1 class="title">Регистрация</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <label for="name">Логин</label>
                    <input id="name" type="text" class="no-round-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    <label for="email">E-Mail</label>
                    <input id="email" type="email" class="no-round-input" name="email" value="{{ old('email') }}" required autocomplete="email">

                    <label for="password">Пароль</label>
                    <input id="password" type="password" class="no-round-input" name="password" required autocomplete="new-password">


                    <label for="password-confirm">Подтверждение пароля</label>
                    <input id="password-confirm" type="password" class="no-round-input" name="password_confirmation" required autocomplete="new-password">

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

                    <div class="account-function">
                        <button type="submit" class="no-round-btn pink">Регистрация</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
