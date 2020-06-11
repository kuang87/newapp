@extends('front.layout')

@section('content')
<div class="banner_v2">
    <div class="container">
        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-12 col-xl-9">
                <div class="banner-block" style="background-image: url({{asset('images/homepage/derevo-bg.png')}})">
                    @if($favorites)
                    <div class="row no-gutters justify-content-center align-items-md-center">
                        <div class="col-10 col-md-5 col-xl-6">
                            <div class="banner-text text-center text-md-left">
                                <h5 class="color-subtitle pink">{{$favorites->category->name}}</h5>
                                <h2 class="title">{{$favorites->name}}</h2>
                                <h2>{{empty($favorites->spl_price) ? $favorites->price : $favorites->spl_price}} ₽</h2>
                                <p>{{$favorites->info}}</p><a class="normal-btn pink" href="{{route('product.details', $favorites->id)}}">Купить</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 col-xl-5">
                            <div class="banner-img">
                                <div class="img-block text-center"><img class="mymove" src="{{asset('images/' . $favorites->image  ?? 'noimage.png')}}" alt=""></div>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="row no-gutters justify-content-center align-items-md-center">
                            <div class="col-10 col-md-5 col-xl-6">
                                <div class="banner-text text-center text-md-left">
                                    <h5 class="color-subtitle pink">новинки</h5>
                                    <h2 class="title">Пицца</h2>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-12 col-md-5 col-xl-5">
                                <div class="banner-img">
                                    <div class="img-block text-center"><img class="mymove" src="{{url('images/noimage.png')}}" alt=""></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home3-product-block">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-3">
                <div class="sidebar-benefit">
                    <div class="benefit-block">
                        <div class="our-benefits column shadowless benefit-border">
                            <div class="row">
                                <div class="col-12 col-md-6 col-xl-12">
                                    <div class="benefit-detail d-flex flex-row align-items-center"><img class="benefit-img" src="{{asset('images/homepage/benefit-icon1.png')}}" alt="">
                                        <div class="benefit-detail_info">
                                            <h5 class="benefit-title">Бесплатная доставка</h5>
                                            <p class="benefit-describle">При заказе свыше 1000 ₽</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-12">
                                    <div class="benefit-detail d-flex flex-row align-items-center"><img class="benefit-img" src="{{asset('images/homepage/benefit-icon2.png')}}" alt="">
                                        <div class="benefit-detail_info">
                                            <h5 class="benefit-title">Доставка вовремя</h5>
                                            <p class="benefit-describle">Привезем в течение 1 часа</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-12">
                                    <div class="benefit-detail d-flex flex-row align-items-center"><img class="benefit-img" src="{{asset('images/homepage/benefit-icon3.png')}}" alt="">
                                        <div class="benefit-detail_info">
                                            <h5 class="benefit-title">Оплата по карте</h5>
                                            <p class="benefit-describle">Наличными или по карте курьеру</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sale-product">
                    <div class="sale-product_top mini-tab-title underline pink">
                        <h2 class="title">Акции</h2>
                    </div>
                    <div class="sale-product_bottom">
                        <div class="row">
                            <div class="col-12">
                                @forelse($saleProducts as $saleProduct)
                                    <div class="mini-product column">
                                        <div class="mini-product_img">
                                            <a href="{{route('product.details', $saleProduct->id)}}">
                                                <img src="{{url('images', $saleProduct->image  ?? 'noimage.png')}}" alt="">
                                            </a>
                                        </div>
                                        <div class="mini-product_info">
                                            <a href="{{route('product.details', $saleProduct->id)}}">{{$saleProduct->name}}</a>
                                            <p>{{$saleProduct->spl_price}} ₽
                                                <del>>{{$saleProduct->price}} ₽</del>
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="mini-product column">
                                        <div>Нет действующих акций</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2 text-right">
                            <a class="text-dark font-weight-bold text-decoration-none" href="{{route('product.sales')}}">Все акции</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-9">
                <div>
                    <div class="best-seller_top mini-tab-title underline pink">
                        <div class="row align-items-md-center">
                            <div class="col-12 col-md-4">
                                <h2 class="title">Популярная  пицца</h2>
                            </div>
                            <div class="col-12 col-md-8 text-lg-right">
                                <ul class="nav nav-tabs tab-control text-md-right">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-0">Все</a></li>
                                    @forelse($popularCategories as $popCategory)
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-{{$popCategory->id}}">{{$popCategory->name}}</a></li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content best-seller_bottom">
                        <div class="tab-pane fade show active" id="tab-0">
                            <div class="row no-gutters-sm">
                                @forelse($populars as $popular)
                                    <app-product v-bind:product-id="{{$popular->product_id}}"
                                                 route-product-details="{{route('product.details', $popular->product_id)}}"
                                                 image="{{url('images', $popular->product->image  ?? 'noimage.png')}}"
                                                 category="{{$popular->product->category->name ?? ''}}"
                                                 name="{{$popular->product->name}}"
                                                 price="{{empty($popular->product->spl_price) ? $popular->product->price : $popular->product->spl_price}}"
                                                 route-add-cart="{{route('cart.add', $popular->product_id)}}"
                                    ></app-product>
                                @empty
                                @endforelse
                            </div>
                        </div>

                        @forelse($popularCategories as $popCategory)
                            <div class="tab-pane fade" id="tab-{{$popCategory->id}}">
                                <div class="row no-gutters-sm">
                                    @forelse($populars as $popular)
                                        @if($popular->product->category_id === $popCategory->id)
                                            <app-product v-bind:product-id="{{$popular->product_id}}"
                                                         route-product-details="{{route('product.details', $popular->product_id)}}"
                                                         image="{{url('images', $popular->product->image  ?? 'noimage.png')}}"
                                                         category="{{$popular->product->category->name ?? ''}}"
                                                         name="{{$popular->product->name}}"
                                                         price="{{empty($popular->product->spl_price) ? $popular->product->price : $popular->product->spl_price}}"
                                                         route-add-cart="{{route('cart.add', $popular->product_id)}}"
                                            ></app-product>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End product block-->

@endsection
