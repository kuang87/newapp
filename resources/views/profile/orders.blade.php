@extends('front.layout')

@section('content')
    <div class="shop-layout">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    <div class="shop-sidebar" style="">
                        <button class="no-round-btn pink" id="filter-sidebar--closebtn" style="display: none;">Закрыть меню</button>
                        <div class="shop-sidebar_department">
                            <div class="department_top mini-tab-title underline">
                                <h2 class="title">Меню</h2>
                            </div>
                            @include('profile.menu')
                        </div>
                    </div>
                    <div class="filter-sidebar--background" style="display: none;"></div>
                </div>

                <div class="col-xl-9">
                    <div class="shop-grid-list">
                        <div class="shop-products">
                            <div class="shop-products_top mini-tab-title underline">
                                <div class="row align-items-center">
                                    <div class="col-6 col-xl-4">
                                        <h2 class="title">Мои заказы</h2>
                                    </div>
                                </div>
                                <!--Using column-->
                            </div>
                            <div class="col">
                                <div class="row no-gutters-sm">
                                    <div class="col-12">
                                        <table class="table table-responsive">
                                            <colgroup>
                                                <col span="1" style="width: 20%">
                                                <col span="1" style="width: 25%">
                                                <col span="1" style="width: 30%">
                                                <col span="1" style="width: 25%">
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th scope="row">№ заказа</th>
                                                <th scope="row">Дата</th>
                                                <th scope="row">Статус</th>
                                                <th scope="row">Сумма</th>
                                                <th scope="row">Подробнее</th>
                                            </tr>
                                            @forelse($orders as $order)
                                                <tr>
                                                    <td>
                                                        {{$order->id}}
                                                    </td>
                                                    <td>
                                                        {{$order->created_at->format('d.m.Y')}}
                                                    </td>
                                                    <td>
                                                        {{$order->status()->status}}
                                                    </td>
                                                    <td>
                                                        {{$order->total}}
                                                    </td>
                                                    <td>
                                                        <a href="{{route('profile.showOrder', $order->id)}}">Просмотр</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td colspan="5">
                                                    Вы не сделали ещё ни одного заказа
                                                </td>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
