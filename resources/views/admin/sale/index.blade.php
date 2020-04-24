@extends('adminlte::page')

@section('title', 'Sales')

@section('content_header')
    <h1 class="product-title">Все акции</h1>
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

    <div>
        <a href="{{route('sales.create')}}" type="button" class="btn btn-success">Добавить акцию</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Наименование</th>
            <th>Описание</th>
            <th>Размер скидки</th>
            <th>Тип скидки (стоимость/%)</th>
            <th>Действует</th>
            <th>Дата окончания</th>
            <th>Товаров</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($sales as $sale)
            <tr>
                <td>{{$sale->id}}</td>
                <td><a href="{{route('sales.show', $sale->id)}}">{{$sale->name}}</a></td>
                <td>{{$sale->description}}</td>
                <td>{{$sale->discount}}</td>
                <td>{{$sale->type}}</td>
                <td>{{$sale->active}}</td>
                <td>{{$sale->expired}}</td>
                <td>{{$sale->products()->count()}}</td>
                <td>
                    <form action="{{route('sales.destroy', $sale->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" onclick="confirm('Удалить акцию?')">Удалить</button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{route('sales.edit', $sale->id)}}">Редактировать</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11">Нет акций</td>
            </tr>
        @endforelse

        </tbody>
    </table>
@stop
