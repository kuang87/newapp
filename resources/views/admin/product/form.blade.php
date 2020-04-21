@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
    <h1>Добавление/редактирование товара</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <div class="col-md-6">
                        <div class="panel-body">
                            @if(isset($product))
                                <form method="POST" action="{{route('products.update', $product->id)}}" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input class="form-control" required="" minlength="5" name="name" type="text" id="name" value="{{old('name', $product->name ?? null)}}">
                                </div>

                                <div class="form-group">
                                    <label for="code">Код</label>
                                    <input class="form-control" name="code" type="text" id="code" value="{{old('code', $product->code ?? null)}}">
                                </div>

                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input class="form-control" name="price" type="text" id="price" value="{{old('price', $product->price ?? null)}}">
                                </div>

                                <div class="form-group">
                                    <label for="info">Описание</label>
                                    <input class="form-control" name="info" type="text" id="info" value="{{old('info', $product->info ?? null)}}">
                                </div>

                                <div class="form-group">
                                    <label for="stock">На складе</label>
                                    <input class="form-control" name="stock" type="text" id="info" value="{{old('info', $product->stock ?? null)}}">
                                </div>

                                <div class="form-group">
                                    <label for="image">Изображение</label>
                                    <input class="form-control" name="image" type="file" id="image">
                                </div>

                                <div class="form-group">
                                    <label for="category">Категория</label>
                                    <select class="form-control" name="category_id">
                                        @forelse($categories as $category)
                                            <option @if(isset($product))
                                                        @if($product->category_id == $category->id) selected @endif
                                                    @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                            <option></option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group">
                                    <img src="{{url('images', $product->image ?? 'product01.png')}}" width="200" alt="Отсутствует">
                                </div>

                                <input class="btn btn-primary" type="submit" value="Сохранить">
                            </form>
                        </div>
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
            </main>
        </div>
    </div>
@stop
