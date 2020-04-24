@extends('adminlte::page')

@section('title', 'Sales')

@section('content_header')
    <h1 class="product-title">Акция "{{$sale->name ?? ''}}"</h1>
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

    <div class="container">
        <div class="row">
            <div class="col">
                <div>Акция: {{$sale->name ?? ''}}</div>
                <div>Скидка: {{$sale->discount}} {{$sale->type == 'cost' ? 'руб.' : '%'}}</div>
                <div>Активна: {{$sale->active ? 'да' : 'нет'}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div>Товары в акции</div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Наименование</th>
                        <th>Информация</th>
                        <th>Категория</th>
                        <th>Цена, руб.</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($sale->products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->info}}</td>
                                <td>{{$product->category->name ?? '!!!категория отсутствует!!!'}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    <form method="post" action="{{route('sale.remove', [$sale->id, $product->id])}}">
                                        @csrf
                                        <button class="btn btn-danger btn-sm" onclick="confirm('Удалить товар из акции')">Удалить</button>
                                    </form>
                                </td>
                                <td></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Нет товаров</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
