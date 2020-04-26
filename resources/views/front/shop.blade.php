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
                    <div class="shop-grid-list">
                        <div class="shop-products">
                            <div class="shop-products_top mini-tab-title underline">
                                <div class="row align-items-center">
                                    <div class="col-6 col-xl-4">
                                        <h2 class="title">Пицца</h2>
                                    </div>
                                    <div class="col-6 text-right" style="display: none;">
                                        <div id="show-filter-sidebar" style="display: none;">
                                            <h5> <i class="fas fa-bars"></i>Меню</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-8">
                                        <div class="product-option">
                                            <div class="product-filter pb-4">
                                            </div>
                                            <div class="view-method">
                                                <p class="active" id="grid-view"><i class="fas fa-th-large"></i></p>
                                                <p id="list-view" class=""><i class="fas fa-list"></i></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Using column-->
                            </div>
                            <div class="shop-products_bottom">
                                <div class="row no-gutters-sm">
                                    @forelse($products as $product)
                                        <div class="col-6 col-md-4">
                                            <div class="product animated grid-view zoomIn">
                                                <div class="product-img_block">
                                                    <a class="product-img" href="{{route('product.details', $product->id)}}"><img src="{{url('images', $product->image  ?? 'noimage.png')}}" alt=""></a>
                                                </div>
                                                <div class="product-info_block">
                                                    <a class="product-name" href="{{route('product.details', $product->id)}}">{{$product->name}}</a>
                                                    <h3 class="product-price">{{empty($product->spl_price) ? $product->price : $product->spl_price}} ₽</h3>
                                                    <p class="product-describe">{{$product->info}}</p>
                                                </div>
                                                <div class="product-select">
                                                    <button class="add-to-wishlist round-icon-btn pink"><i class="far fa-heart"></i></button>
                                                    <a href="{{route('cart.add', $product->id)}}"><button class="add-to-cart round-icon-btn pink"><i class="fas fa-cart-arrow-down"></i></button></a>
                                                    <a href="{{route('product.details', $product->id)}}"><button class="round-icon-btn pink"><i class="fas fa-info"></i></button></a>
                                                </div>
                                                <div class="product-select_list">
                                                    <p class="delivery-status">Доставка бесплатно<br>(от 1000 ₽)</p>
                                                    <h3 class="product-price">
                                                        {{empty($product->spl_price) ? $product->price : $product->spl_price}} ₽
                                                    </h3>
                                                    <a href="{{route('cart.add', $product->id)}}"><button class="add-to-cart normal-btn outline">В корзину</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col">Нет товаров в данной категории</div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="shop-pagination">
                                {{$products->links('pagination.main')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

