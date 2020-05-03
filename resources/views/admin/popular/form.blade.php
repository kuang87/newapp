@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
    <h1>Добавление товаров</h1>
@stop

@section('content')
    <div class="row">
            <div class="col">
                <form method="POST" action="{{route('popular.add')}}">
                    @csrf
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Наименование</th>
                        <th>Категория</th>
                        <th>Цена, руб.</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td><input type="checkbox" name="products[]" value="{{$product->id}}"></td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category->name ?? '!!!категория отсутствует!!!'}}</td>
                                <td>{{$product->price}}</td>
                                <td></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">товары отсутствуют</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    <button class="btn btn-primary">Добавить</button>
                </form>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
    </div>
@stop
