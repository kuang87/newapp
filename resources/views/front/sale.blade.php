@extends('front.layout')

@section('content')
    <div class="ogami-breadcrumb">
        <div class="container">
            {{ Breadcrumbs::render('sales') }}
        </div>
    </div>

    <div class="blog-layout">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                </div>
                <div class="col-12 col-xl-9">
                    <div class="blog-detail">
                        <div class="row">
                            <div class="col-12">
                                <div class="blog-detail_block">
                                    <h1 class="blog-subtitle">{{$sale->name ?? 'Не найдено'}}</h1>
                                    <p class="blog-describe">{{$sale->description ?? 'Не найдено'}}</p>
                                    <p class="blog-describe"><strong>Товары, участвующие в акции:</strong></p>
                                    <div class="row no-gutters-sm">
                                        @forelse($sale->products as $product)
                                            <app-product v-bind:product-id="{{$product->id}}"
                                                         route-product-details="{{route('product.details', $product->id)}}"
                                                         image="{{url('images', $product->image  ?? 'noimage.png')}}"
                                                         category="{{$product->category->name ?? ''}}"
                                                         name="{{$product->name}}"
                                                         price="{{empty($product->spl_price) ? $product->price : $product->spl_price}}"
                                                         route-add-cart="{{route('cart.add', $product->id)}}"
                                            ></app-product>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                                <div class="blog-detail_footer">
                                    <div class="row align-items-sm-center">
                                        <div class="col-12 col-sm-6">
                                            <div class="blog-sidebar_tags">
                                                <a class="tag-btn" href="{{route('product.sales')}}">скидка</a>
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
