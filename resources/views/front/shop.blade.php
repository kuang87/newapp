@extends('front.layout')

@section('content')
    @if(isset($category))
        <div class="ogami-breadcrumb">
            <div class="container">
                {{ Breadcrumbs::render('category', $category) }}
            </div>
        </div>
    @else
        <div class="ogami-breadcrumb">
            <div class="container">
                {{ Breadcrumbs::render('shop') }}
            </div>
        </div>
    @endif

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
                                        <app-product-extend v-bind:product-id="{{$product->id}}"
                                                            route-product-details="{{route('product.details', $product->id)}}"
                                                            image="{{url('images', $product->image  ?? 'noimage.png')}}"
                                                            category="{{$product->category->name ?? ''}}"
                                                            name="{{$product->name}}"
                                                            info="{{$product->info}}"
                                                            price="{{empty($product->spl_price) ? $product->price : $product->spl_price}}"
                                                            route-add-cart="{{route('cart.add', $product->id)}}"
                                        ></app-product-extend>
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

