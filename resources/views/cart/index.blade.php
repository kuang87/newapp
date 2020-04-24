@extends('front.layout')

@section('content')
    <div class="ogami-breadcrumb">
        <div class="container">
            {{ Breadcrumbs::render('cart') }}
        </div>
    </div>

    <div class="order-step">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="order-step_block">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <div class="step-block active">
                                    <div class="step">
                                        <h2>Корзина</h2><span>01</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="step-block">
                                    <div class="step">
                                        <h2>Оформление</h2><span>02</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="step-block">
                                    <div class="step">
                                        <h2>Завершение</h2><span>03</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End order step-->

    <div class="shopping-cart">
        <div class="container">
            @if(!Cart::isEmpty())
                <form method="post" action="{{route('cart.update')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="product-table">
                                <table class="table table-responsive">
                                    <colgroup>
                                        <col span="1" style="width: 15%">
                                        <col span="1" style="width: 30%">
                                        <col span="1" style="width: 15%">
                                        <col span="1" style="width: 15%">
                                        <col span="1" style="width: 15%">
                                        <col span="1" style="width: 10%">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="product-iamge" scope="col"></th>
                                        <th class="product-name" scope="col">Наименование</th>
                                        <th class="product-price" scope="col">Цена</th>
                                        <th class="product-quantity" scope="col">Количество</th>
                                        <th class="product-total" scope="col">Итого</th>
                                        <th class="product-clear" scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::getContent() as $item)
                                        <tr>
                                            <td class="product-iamge">
                                                <div class="img-wrapper"><img
                                                        src="{{url('images', $item->attributes->image ?? 'noimage.png')}}" alt=""></div>
                                            </td>
                                            <td class="product-name">{{$item->name}}</td>
                                            <td class="product-price">{{$item->price}} ₽</td>
                                            <td class="product-quantity">
                                                <input type="hidden" name="product[]" value="{{$item->id}}">
                                                <input class="quantity no-round-input" type="number" min="1"
                                                       name="pro_qty[]" value="{{$item->quantity}}">
                                            </td>
                                            <td class="product-total">{{$item->price * $item->quantity}} ₽</td>
                                            <td class="product-clear">
                                                <a class="button-borderless" href="{{route('cart.remove', $item->id)}}">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            <a class="no-round-btn black cart-update" href="{{route('cart.clear')}}">
                                Очистить корзину
                            </a>
                        </div>
                        <div class="col-12 col-sm-4 text-right">
                            <button class="no-round-btn pink cart-update">Пересчитать</button>
                        </div>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="row">
                        <div class="col-12">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="row justify-content-end">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="cart-total_block">
                            <h2>Итог</h2>
                            <table class="table">
                                <colgroup>
                                    <col span="1" style="width: 50%">
                                    <col span="1" style="width: 50%">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th>Заказ</th>
                                    <td>{{Cart::getSubTotal()}} ₽</td>
                                </tr>
                                <tr>
                                    <th>Доставка</th>
                                    <td>
                                        @if(Cart::getSubTotal() < 1000)
                                            <p> 500 ₽ </p>
                                        @else
                                            <p>Бесплатно</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Всего</th>
                                    <td>{{Cart::getTotal()}} ₽</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="checkout-method">
                                <a href="{{route('checkout')}}"><button class="normal-btn pink">Оформить заказ</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <h2>Ваша корзина пуста</h2>
                </div>
            @endif
        </div>
    </div>
    <!-- End shopping cart-->

@endsection
