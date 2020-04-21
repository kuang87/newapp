@extends('emails.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            Уважаемый(ая) {{$user->name}},<br>
            Благодарим Вас за заказ.
            <p>Ваш заказ №{{$order->id}}</p>
        </div>
    </div>
</div>
@endsection
