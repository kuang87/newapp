<header class="pink">
    <div class="header-block d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="header-left d-flex flex-column flex-md-row align-items-center">
                        <div class="d-flex align-items-center"><i class="fas fa-envelope"></i>&nbsp;admin@admin.com</div>
                        <div class="d-flex align-items-center ml-5"><i class="fas fa-phone"></i>+7 111 111 111</div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="header-right d-flex flex-column flex-md-row justify-content-md-end justify-content-center align-items-center">
                        <div class="login d-flex">
                            @guest
                                <a href="{{ route('login') }}"><i class="fas fa-user"></i>Войти</a>
                            @else
                                <a href="{{ route('profile') }}"><i class="fas fa-user"></i>{{ Auth::user()->name }}</a>&nbsp;
                                (
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <small>выйти</small>
                                </a>
                                )
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--        Top menu--}}
    <nav class="navigation d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-2"><a class="logo" href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt=""></a></div>
                <div class="col-8">
                    <div class="navgition-menu d-flex align-items-center justify-content-center">
                        <ul class="mb-0">
                            <li class="toggleable"><a class="menu-item" href="{{url('/')}}">Главная</a></li>
                            <li class="toggleable"><a class="menu-item" href="{{route('shop')}}">Пицца</a>
                                <ul class="sub-menu">
                                    @forelse($prodCategories as $prodCategory)
                                        <li><a href="{{route('product.category', $prodCategory->id)}}">{{$prodCategory->name}}</a></li>
                                    @empty
                                        <li></li>
                                    @endforelse
                                </ul>
                            </li>
                            <li class="toggleable"><a class="menu-item" href="{{route('contact')}}">Контакты</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-2">
                    <div class="product-function d-flex align-items-center justify-content-end">
                        <div id="cart">
                            <app-mini-cart route-cart="{{route('cart')}}"></app-mini-cart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div id="mobile-menu">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="mobile-menu_block d-flex align-items-center"><a class="mobile-menu--control" href="#"><i class="fas fa-bars"></i></a>
                        <div id="ogami-mobile-menu">
                            <button class="no-round-btn pink" id="mobile-menu--closebtn">Закрыть</button>
                            <div class="mobile-menu_items">
                                <ul class="mb-0 d-flex flex-column">
                                    <li class="toggleable"> <a class="menu-item active" href="{{url('/')}}">Главная</a><span class="sub-menu--expander"></span>
                                    </li>
                                    <li class="toggleable"><a class="menu-item" href="{{route('shop')}}">Пицца</a><span class="sub-menu--expander"><i class="far fa-plus-square"></i></span>
                                        <ul class="sub-menu">
                                            @forelse($prodCategories as $prodCategory)
                                            <li><a href="{{route('product.category', $prodCategory->id)}}">{{$prodCategory->name}}</a></li>
                                            @empty
                                            <li></li>
                                            @endforelse
                                        </ul>
                                    </li>
                                    <li class="toggleable"> <a class="menu-item" href="{{route('cart')}}">Корзина</a><span class="sub-menu--expander"></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="mobile-login">
                                <h2>Мой профиль</h2>
                                @guest
                                    <a href="{{ route('login') }}">Войти</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Регистрация</a>
                                    @endif
                                @else
                                    <a href="{{ route('profile') }}">{{ Auth::user()->name }}</a>
                                @endguest
                            </div>
                        </div>
                        <div class="ogamin-mobile-menu_bg"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mobile-menu_logo text-center d-flex justify-content-center align-items-center"><a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt=""></a></div>
                </div>
                <div class="col-3">
                    <div class="mobile-product_function d-flex align-items-center justify-content-end">
                        <app-mini-cart route-cart="{{route('cart')}}></app-mini-cart>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="navigation-filter">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4 col-xl-3 order-2 order-md-1">
                    <div class="department-menu_block down">
                        <div class="department-menu d-flex justify-content-between align-items-center"><i class="fas fa-bars"></i>Все разделы<span><i class="fas fa-angle-up"></i></span></div>
                        <div class="department-dropdown-menu down">
                            <ul>
                                @forelse($prodCategories as $prodCategory)
                                    <li><a href="{{route('product.category', $prodCategory->id)}}"><i class="fas fa-socks"></i>{{$prodCategory->name}}</a></li>
                                @empty
                                    <li></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8 col-xl-9 order-1 order-md-2">
                    <div class="row">
                        <div class="col-12 col-xl-8">
                            <div class="website-search">
                                <div class="row no-gutters">
                                    <div class="col-10 col-md-10 col-lg-10 col-xl-11">
                                        <div class="search-input">
                                            <input class="no-round-input no-border" type="text" placeholder="Поиск">
                                        </div>
                                    </div>
                                    <div class="col-2 col-md-2 col-lg-2 col-xl-1">
                                        <button class="no-round-btn pink"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-0 col-xl-4">
                            <div class="phone-number">
                                <div class="phone-number_icon"><i class="fas fa-phone"></i></div>
                                <h2>+7 812 111 111</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
