<!DOCTYPE html>
<html lang="en">
<head>
    <title>МегаПИЦЦА</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
{{--    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">--}}
    <link rel="shortcut icon" href="{{asset('images/shortcut_logo.png')}}">
</head>

<body>
<div id="app">

    @include('front.menu')
    @yield('content')

    <div class="partner">
        <div class="container">
            <div class="partner_block d-flex justify-content-between">
                <div class="partner--logo"></div>
            </div>
        </div>
    </div>

    <div class="scrollup">
        <i class="fas fa-angle-up"></i>
    </div>
    <!-- End partner-->
    <footer class="pink">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 text-sm-center text-md-left">
                    <div class="footer-logo"><img src="{{asset('images/logo.png')}}" alt=""></div>
                    <div class="footer-contact">
                        <p>Адрес: Невский пр., Санкт-Петербург</p>
                        <p>Телефон: +7 111-111-111</p>
                        <p>Email: admin@admin.com</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-12 col-sm-4 text-sm-center text-md-left">
                            <div class="footer-quicklink">
                                <h5>Информация</h5><a href="{{route('contact')}}">Контакты</a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 text-sm-center text-md-left">
                            <div class="footer-quicklink">
                                <h5>Дополнительно</h5><a href="{{route('home')}}">Акции</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="newletter">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-md-7">
                        <div class="newletter_text text-center text-md-left">
                            <h5>Подпишитесь на нашу рассылку</h5>
                            <p>Получайте на e-mail специальные акции и предложения.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="newletter_input">
                            <input class="round-input" type="text" placeholder="Введите ваш email">
                            <button>Подписаться</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-credit">
            <div class="container">
                <div class="footer-creadit_block d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-baseline align-items-md-center">
                    <p class="author">Copyright © {{ date('Y') }}.</p>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
{{--<script src="{{asset('js/main.js')}}"></script>--}}

@stack('scripts')
</body>
</html>
