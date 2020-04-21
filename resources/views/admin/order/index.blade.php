@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
    <h1 class="product-title">Все заказы</h1>
@stop

@section('content')
    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Статус</th>
            <th>Пользователь</th>
            <th>Сумма</th>
            <th>Адрес</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->status()->status}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->address}}</td>
                <td>
                    <form action="{{route('orders.confirm', $order->id)}}" method="POST">
                        @csrf
                        @if($order->status == 2 || $order->status == 3)
                            <button class="btn disabled btn-success btn-sm" onclick="event.preventDefault()">Подтвердить</button>
                        @else
                            <button class="btn btn-success btn-sm">Подтвердить</button>
                        @endif
                    </form>
                </td>
                <td>
                    <form action="{{route('orders.cancel', $order->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        @if($order->status == 3)
                            <button class="btn disabled btn-danger btn-sm" onclick="event.preventDefault()">Отменить</button>
                        @else
                            <button class="btn btn-danger btn-sm">Отменить</button>
                        @endif
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Нет заказов</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{$orders->links()}}
    </div>
@stop
