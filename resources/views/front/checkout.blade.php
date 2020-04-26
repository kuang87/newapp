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
                                <div class="step-block step-block--1">
                                    <div class="step">
                                        <h2>Корзина</h2><span>01</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="step-block active">
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

    @if (\Session::has('cartError') || Cart::getSubTotal() == 0)
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Ваша корзина пуста</h2>
                </div>
            </div>
        </div>
    @else
        <div class="shop-checkout">
            <div class="container">
                <form action="{{route('checkout-validate')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <h2 class="form-title">Детали заказа</h2>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstName">Имя*</label>
                                    <input type="text" class="no-round-input-bg" id="firstName" name="firstName" placeholder="" value="{{old('firstName', Auth::user()->name ?? null)}}" required>
                                    @error('firstName')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Телефон</label>
                                    <input type="text" class="no-round-input-bg phone" name="phone" placeholder="" value="{{old('phone')}}" required>
                                    @error('phone')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-muted">(Дополнительно)</span></label>
                                <input type="email" name="email" class="no-round-input-bg" id="email" value="{{old('email', Auth::user()->email ?? null)}}">
                                @error('email')
                                <div class="error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h2 class="form-title">Способ доставки</h2>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-sm btn-outline-secondary active">
                                        <input type="radio" name="options" id="option1" value="self" autocomplete="off" checked required> Самовывоз
                                    </label>
                                    <label class="btn btn-sm btn-outline-secondary">
                                        <input type="radio" name="options" id="option2" value="delivery" autocomplete="off" required> Доставка
                                    </label>
                                    @error('options')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city">Город</label>
                                <select class="no-round-input-bg" id="city" name="city" required>
                                    <option value="1">Санкт-Петербург</option>
                                </select>
                                @error('city')
                                <div class="error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Адрес</label>
                                <input type="text" class="no-round-input-bg" id="address" name="address" value="{{old('address', Auth::user()->address()->latest()->first()->address ?? null)}}">
                                @error('address')
                                <div class="error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="save-info" id="save-info">
                                <label for="save-info">Сохранить информацию для следующего заказа</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <h2 class="form-title">Ваш заказ</h2>
                            <div class="shopping-cart">
                                <div class="cart-total_block">
                                    <table class="table">
                                        <colgroup>
                                            <col span="1" style="width: 50%">
                                            <col span="1" style="width: 50%">
                                        </colgroup>
                                        <tbody>
                                        @foreach(Cart::getContent() as $item)
                                            <tr>
                                                <th class="name">{{$item->name}} × {{$item->quantity}}</th>
                                                <td class="price black" style="border-top: 0">{{$item->price * $item->quantity}} ₽</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th>Итого</th>
                                            <td class="price">{{Cart::getSubTotal()}} ₽</td>
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
                                            <td class="total">{{Cart::getTotal()}} ₽</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <input id="cash" name="paymentMethod" type="radio" value="cash" checked required>
                                    <label for="cash">Наличными</label>
                                </div>
                                <div class="form-group">
                                    <input id="debit" name="paymentMethod" type="radio" value="card" required>
                                    <label for="debit">Банковской картой</label>
                                </div>
                                <button class="normal-btn pink submit-btn">Завершить</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif


@endsection

@push('scripts')
<script>
    window.addEventListener('load', function(e){

        [].forEach.call( document.querySelectorAll('.phone'), function(input) {
            input.addEventListener("input", mask, false);
            input.addEventListener("focus", mask, false);
            input.addEventListener("blur", mask, false);
            input.addEventListener("keydown", mask, false);
        });

        function mask(event) {
            let keyCode = event.keyCode;
            let pos = this.selectionStart;
            if (pos < 3) event.preventDefault();

            let matrix = "+7 (___) ___ ____";
            let i = 0;
            let def = matrix.replace(/\D/g, "");
            let val = this.value.replace(/\D/g, "");

            let new_value = matrix.replace(/[_\d]/g, function(a) {
                return i < val.length ? val.charAt(i++) || def.charAt(i) : a
            });
            i = new_value.indexOf("_");
            if (i != -1) {
                i < 5 && (i = 3);
                new_value = new_value.slice(0, i)
            }
            let reg = matrix.substr(0, this.value.length).replace(/_+/g,
                function(a) {
                    return "\\d{1," + a.length + "}"
                }).replace(/[+()]/g, "\\$&");
            reg = new RegExp("^" + reg + "$");
            if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
            if (event.type == "blur" && this.value.length < 5)  this.value = ""
        }
    });
</script>
@endpush
