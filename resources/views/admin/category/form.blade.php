@extends('adminlte::page')

@section('title', 'AdminPanel')

@section('content_header')
    <h1>Добавление/редактирование категории</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="col-md-6">
                    <div class="panel-body">
                            @if(isset($category))
                                <form method="POST" action="{{route('categories.update', $category->id)}}" enctype="multipart/form-data">
                                    @method('PUT')
                            @else
                                <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input class="form-control" required="" minlength="5" name="name" type="text" id="name" value="{{old('name', $category->name ?? null)}}">
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
