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
                    <div class="blog-grid">
                        <div class="row">
                            @forelse($sales as $sale)
                                <div class="col-md-6">
                                    <div class="blog-block">
                                        <div class="blog-img"><a href="{{route('product.sale', $sale->id)}}"><img src="{{url('images', $sale->image ?? 'sale.jpg')}}" alt="blog image"></a></div>
                                        <div class="blog-text">
                                            <h5 class="blog-tag">Скидка</h5>
                                            <h6>
                                                <a class="blog-title" href="{{route('product.sale', $sale->id)}}">{{$sale->name}}</a>
                                            </h6>
                                            <div class="blog-credit">
                                                <p class="credit comment">До {{date('d.m', strtotime($sale->expired))}}</p>
                                            </div>
                                            <p class="blog-describe">
                                                {{$sale->description}}
                                            </p>
                                        </div>
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
@endsection
