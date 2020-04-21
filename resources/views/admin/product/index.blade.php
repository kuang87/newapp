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
            <th></th>
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
                    @if($product->discount == 'valid')
                        Да
                    @endif
                </td>
                <td>
                    @if($product->discount == 'valid')
                        <form action="{{route('discount.cancel', $product->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-secondary btn-sm">Убрать акцию</button>
                        </form>
                    @else
                        <form action="{{route('discount.apply', $product->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-warning btn-sm">В акцию</button>
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
@stop
