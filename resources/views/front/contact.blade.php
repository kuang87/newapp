@extends('front.layout')

@section('content')
    <div class="contact-us">
        <div class="container">
            <div class="contact-method">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="method-block"><i class="fas fa-map-marker-alt"></i></i>
                            <div class="method-block_text">
                                <p>Невский пр.</p>
                                <p>Санкт-Петербург</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="method-block"><i class="far fa-envelope"></i>
                            <div class="method-block_text">
                                <p> <span>Телефон: </span>+7 111-111-111 </p>
                                <p><span>Email: </span>admin@admin.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="method-block"><i class="far fa-clock"></i>
                            <div class="method-block_text">
                                <p> <span>Пн-Пт: </span>10:00 – 22:00</p>
                                <p><span>Вс: </span>11:00 – 20:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
