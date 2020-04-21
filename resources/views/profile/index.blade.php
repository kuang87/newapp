@extends('front.layout')

@section('content')
    <div class="shop-layout">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    <div class="shop-sidebar" style="">
                        <button class="no-round-btn" id="filter-sidebar--closebtn" style="display: none;">Закрыть меню</button>
                        <div class="shop-sidebar_department">
                            <div class="department_top mini-tab-title underline">
                                <h2 class="title">Меню</h2>
                            </div>
                            @include('profile.menu')
                        </div>
                    </div>
                    <div class="filter-sidebar--background" style="display: none;"></div>
                </div>

                <div class="col-xl-9">
                    <div class="shop-grid-list">
                        <div class="shop-products">
                            <div class="shop-products_top mini-tab-title underline">
                                <div class="row align-items-center">
                                    <div class="col-6 col-xl-4">
                                        <h2 class="title">Мой профиль</h2>
                                    </div>
                                    <div class="col-6 text-right" style="display: none;">
                                        <div id="show-filter-sidebar" style="display: none;">
                                            <h5> <i class="fas fa-bars"></i>Меню</h5>
                                        </div>
                                    </div>
                                </div>
                                <!--Using column-->
                            </div>
                            <div class="shop-products_bottom">
                                <div class="row no-gutters-sm">
                                    Добро пожаловать в личный кабинет,&nbsp;<strong> {{ Auth::user()->name}}</strong>!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
