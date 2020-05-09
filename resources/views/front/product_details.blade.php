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
                            <div class="department_bottom">
                                <ul>
                                    <li> <a class="department-link" href="{{route('shop')}}">Все</a></li>
                                    @forelse($prodCategories as $prodCategory)
                                        <li><a class="department-link" href="{{route('product.category', $prodCategory->id)}}">{{$prodCategory->name}}</a></li>
                                    @empty
                                        <li></li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="filter-sidebar--background" style="display: none;"></div>
                </div>
                <div class="col-xl-9">
                    <div class="shop-detail">
                        <div class="mini-tab-title underline">
                            <div class="row align-items-center">
                                <div class="col-6 col-xl-4">
                                    <h2 class="title">Пицца</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="shop-detail_img">
                                    <div class="big-img">
                                        <img src="{{url('images', $product->image)}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="shop-detail_info">
                                    <h5 class="product-type color-type pink">{{$product->category->name}}</h5>
                                    <h2 class="product-name">{{$product->name}}</h2>
                                    <p class="product-describe">{{$product->info}}</p>
                                    <p class="delivery-status">Бесплатная доставка</p>
                                    <div class="price-rate">
                                        <h3 class="product-price">{{empty($product->spl_price) ? $product->price : $product->spl_price}} ₽</h3>
                                    </div>
                                    <div class="product-select">
                                        <a href="{{route('cart.add', $product->id)}}"><button class="add-to-cart normal-btn outline">В корзину</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="shop-detail_more-info">
                                    <div id="tab-so3" class="ui-tabs ui-corner-all ui-widget ui-widget-content">
                                        <ul class="mb-0 ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header" role="tablist">
                                            <li class="active ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tab-1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><a href="#tab-1" role="presentation" tabindex="-1" class="ui-tabs-anchor" id="ui-id-1">ОПИСАНИЕ</a></li>
                                        </ul>
                                        <div id="tab-1" aria-labelledby="ui-id-1" role="tabpanel" class="ui-tabs-panel ui-corner-bottom ui-widget-content" aria-hidden="false">
                                            <div class="description-block">
                                                <div class="description-item_block">
                                                    <div class="row align-items-center">
                                                        <div class="col-12 col-md-6">
                                                            <div class="description-item_text">
                                                                <h2>Ингредиенты</h2>
                                                                <p>{{$product->info}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

