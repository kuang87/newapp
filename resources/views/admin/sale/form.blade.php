@extends('adminlte::page')

@section('title', 'Sales')

@section('content_header')
    <h1>Добавление/редактирование акций и скидок</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 col-lg-6 pt-3 px-4">
                        <div class="panel-body">
                            @if(isset($sale))
                                <form method="POST" action="{{route('sales.update', $sale->id)}}" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form method="POST" action="{{route('sales.store')}}" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input class="form-control" name="name" type="text" id="name" value="{{old('name', $sale->name ?? null)}}">
                                </div>

                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <input class="form-control" name="description" type="text" id="description" value="{{old('description', $sale->description ?? null)}}">
                                </div>

                                <div class="form-group col-4">
                                    <label for="discount">Размер скидки</label>
                                    <input class="form-control" name="discount" type="number" id="discount" value="{{old('discount', $sale->discount ?? null)}}">
                                </div>

                                <div class="form-group">
                                    <label for="type">Тип скидки (стоимость/%)
                                        <select class="form-control" name="type">
                                            <option value="cost" selected>Стоимость</option>
                                            <option value="percent">Процент, %</option>
                                        </select>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" @if(isset($sale->active) && $sale->active == 1) checked @endif id="active" name="active" value="1">
                                        <label class="form-check-label" for="active">
                                            Действует
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-4">
                                    <label for="expired">Дата окончания</label>
                                    <input class="form-control" name="expired" type="date" id="expired" value="{{old('expired', $sale->expired ?? null)}}">
                                </div>


                                <input class="btn btn-primary" type="submit" value="Сохранить">
                            </form>
                        </div>
            </main>
        </div>
    </div>
@stop
