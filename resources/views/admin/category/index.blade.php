@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
    <h1 class="product-title">Все категории</h1>
@stop

@section('content')
    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <a href="{{route('categories.create')}}" type="button" class="btn btn-primary">Создать категорию</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Наименование</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>
                    <form action="{{route('categories.destroy', $category->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{route('categories.edit', $category->id)}}">Редактировать</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Нет товаров</td>
            </tr>
        @endforelse

        </tbody>
    </table>
@stop
