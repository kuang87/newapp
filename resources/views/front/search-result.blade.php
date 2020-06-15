@extends('front.layout')

@section('content')
    <div class="ogami-breadcrumb">
        <div class="container">
            {{ Breadcrumbs::render('search') }}
        </div>
    </div>

    <div class="blog-layout">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                </div>
                <div class="col-12 col-xl-9">
                    @forelse($categories as $category)
                        <div class="blog-detail">
                            <div class="row">
                                <div class="col-12">
                                    <div class="blog-detail_block">
                                        <a class="blog-subtitle" href="{{route('product.category', $category->id)}}">{{$category->name}}</a>
                                    </div>
                                    <div class="blog-detail_footer">
                                        <div class="row no-gutters-sm">
                                            @forelse($category->filterProducts($products) as $product)
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
                                </div>
                            </div>
                        </div>
                    @empty
                        Ничего не найдено
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
