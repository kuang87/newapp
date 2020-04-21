@extends('front.layout')

@section('content')
<div class="banner_v2">
    <div class="container">
        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-12 col-xl-9">
                <div class="banner-block" style="background-image: url({{asset('images/homepage/derevo-bg.png')}})">
                    @if($productDiscount)
                    <div class="row no-gutters justify-content-center align-items-md-center">
                        <div class="col-10 col-md-5 col-xl-6">
                            <div class="banner-text text-center text-md-left">
                                <h5 class="color-subtitle pink">{{$productDiscount->category->name}}</h5>
                                <h2 class="title">{{$productDiscount->name}}</h2>
                                <p>{{$productDiscount->info}}</p><a class="normal-btn pink" href="{{route('cart.add', $productDiscount->id)}}">Купить</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 col-xl-5">
                            <div class="banner-img">
                                <div class="img-block text-center"><img class="mymove" src="{{asset('images/' . $productDiscount->image  ?? 'noimage.png')}}" alt=""></div>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="row no-gutters justify-content-center align-items-md-center">
                            <div class="col-10 col-md-5 col-xl-6">
                                <div class="banner-text text-center text-md-left">
                                    <h5 class="color-subtitle pink">Butter & Eggs</h5>
                                    <h2 class="title">Spice 100% Organnic</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p><a class="normal-btn pink" href="#">Shop now</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-5 col-xl-5">
                                <div class="banner-img">
                                    <div class="img-block text-center"><img class="mymove" src="images/noimage.png" alt=""></div>
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
                                <div class="mini-product column">
                                    <div class="mini-product_img"><a href="#"><img src="" alt=""></a></div>
                                    <div class="mini-product_info"> <a href="#">Fresh Met</a>
                                        <p>$37.00
                                            <del>$45.00</del>
                                        </p>
                                    </div>
                                </div>
                            </div>
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
                                    @forelse($prodCategories as $prodCategory)
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-{{$prodCategory->id}}">{{$prodCategory->name}}</a></li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content best-seller_bottom">
                        <div class="tab-pane fade show active" id="tab-0">
                            <div class="row no-gutters-sm">
                                @forelse($products as $product)
                                    <div class="col-6 col-md-4">
                                        <div class="product pink"><a class="product-img" href="{{route('product.details', $product->id)}}"><img src="{{url('images', $product->image  ?? 'noimage.png')}}" alt=""></a>
                                            <h5 class="product-type">{{$product->category->name ?? ''}}</h5>
                                            <h3 class="product-name">{{$product->name}}</h3>
                                            <h3 class="product-price">{{$product->price}} ₽</h3>
                                            <div class="product-select">
                                                <button class="add-to-wishlist round-icon-btn pink"><i class="far fa-heart"></i></button>
                                                <a href="{{route('cart.add', $product->id)}}"><button class="add-to-cart round-icon-btn pink"><i class="fas fa-cart-arrow-down"></i></button></a>
                                                <a href="{{route('product.details', $product->id)}}"><button class="round-icon-btn pink"><i class="fas fa-info"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>

                        @forelse($prodCategories as $prodCategory)
                            <div class="tab-pane fade" id="tab-{{$prodCategory->id}}">
                                <div class="row no-gutters-sm">
                                    @forelse($prodCategory->products as $product)
                                        <div class="col-6 col-md-4">
                                            <div class="product pink"><a class="product-img" href="{{route('product.details', $product->id)}}"><img src="{{url('images', $product->image ?? 'noimage.png')}}" alt=""></a>
                                                <h5 class="product-type">{{$product->category->name ?? ''}}</h5>
                                                <h3 class="product-name">{{$product->name}}</h3>
                                                <h3 class="product-price">{{$product->price}} ₽</h3>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i class="far fa-heart"></i></button>
                                                    <a href="{{route('cart.add', $product->id)}}"><button class="add-to-cart round-icon-btn pink"><i class="fas fa-cart-arrow-down"></i></button></a>
                                                    <a href="{{route('product.details', $product->id)}}"><button class="round-icon-btn pink"><i class="fas fa-info"></i></button></a>
                                                </div>
                                            </div>

                                        </div>
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
