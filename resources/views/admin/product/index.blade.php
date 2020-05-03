@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
    <h1 class="product-title">Все товары</h1>
@stop

@section('content')
    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <a href="{{route('products.create')}}" type="button" class="btn btn-success">Добавить товар</a>
    <a href="{{route('categories.create')}}" type="button" class="btn btn-primary">Создать категорию</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Изображение</th>
            <th>Наименование</th>
            <th>Информация</th>
            <th>Категория</th>
            <th>Цена, руб.</th>
            <th>Кол-во</th>
            <th>Акция</th>
            <th>Избранное</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td><img src="{{url('images', $product->image ?? 'product01.png')}}" width="100" alt="Отсутствует"></td>
                <td>{{$product->name}}</td>
                <td>{{$product->info}}</td>
                <td>{{$product->category->name ?? '!!!категория отсутствует!!!'}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->stock}}</td>
                <td>
                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#sales-{{$product->id}}">
                        акция
                    </button>
                    <div class="modal fade" id="sales-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post" action="{{route('sale.add', $product->id)}}">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Доступные акции</h4>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group">
                                        @forelse($sales as $sale)
                                            <div class="input-group-prepend mb-1">
                                                <div class="input-group-text">
                                                    <input type="radio" name="sale" value="{{$sale->id}}">
                                                </div>
                                                <input type="text" disabled class="form-control" value="{{$sale->name}}">
                                            </div>
                                        @empty
                                            <div>Нет доступных акций</div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Закрыть</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Применить</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @forelse($product->currentSales() as $currentSale)
                        <div class="text-info"><small><a href="{{route('sales.show', $currentSale->id)}}">{{$currentSale->name}}</a></small></div>
                    @empty
                    @endforelse
                </td>
                <td>
                    @if($product->favorites == true)
                        <form action="{{route('favorites.remove', $product->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-warning btn-sm" title="Убрать избранное"><i class="far fa-star"></i></button>
                        </form>
                    @else
                        <form action="{{route('favorites.add', $product->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-light btn-sm" title="В избранное"><i class="far fa-star"></i></button>
                        </form>
                    @endif

                </td>
                <td>
                    <form action="{{route('products.destroy', $product->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{route('products.edit', $product->id)}}">Редактировать</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11">Нет товаров</td>
            </tr>
        @endforelse

        </tbody>
    </table>

    <div class="pagination">
        {{$products->links()}}
    </div>

@stop
