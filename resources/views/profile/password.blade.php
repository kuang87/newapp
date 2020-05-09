@extends('front.layout')

@section('content')
    <div class="shop-layout">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    <div class="shop-sidebar" style="">
                        <button class="no-round-btn pink" id="filter-sidebar--closebtn" style="display: none;">Закрыть меню</button>
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
                                        <h2 class="title">Смена пароля</h2>
                                    </div>
                                </div>
                                <!--Using column-->
                            </div>
                            <div class="col">
                                <div class="row no-gutters-sm">
                                    <div class="col-12">
                                        @if (session('message'))
                                            <div class="alert alert-warning">
                                                {{ session('message') }}
                                            </div>
                                        @endif

                                        <form action="{{route('profile.updatePassword')}}" method="post">
                                            @csrf
                                            <div class="form-group col-md-6">
                                                <label for="password_current">Текущий пароль: </label>
                                                <input type="password" class="no-round-input-bg" id="password_current" name="password_current" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="password">Новый пароль: </label>
                                                <input type="password" class="no-round-input-bg" id="password" name="password" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="password_confirmation">Повторите пароль: </label>
                                                <input type="password" class="no-round-input-bg" id="password_confirmation" name="password_confirmation" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <button class="normal-btn pink submit-btn">Сохранить</button>
                                            </div>
                                        </form>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
