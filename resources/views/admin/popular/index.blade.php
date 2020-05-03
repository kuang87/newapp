@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
    <h1 class="product-title">Популярные товары</h1>
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
        <a href="{{route('popular.create')}}" type="button" class="btn btn-success">Добавить товары</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Товар</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($populars as $popular)
            <tr>
                <td>{{$popular->product->id}}</td>
                <td>{{$popular->product->name}}</td>
                <td>
                </td>
                <td>
                    <form action="{{route('popular.remove', $popular->product->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">товары отсутствуют</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{$populars->links()}}
    </div>
@stop
