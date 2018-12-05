@extends('local.default')

@section('content')

<div class="page-title" style='background-image: url("{{ asset("/theme/images/page-title.png") }}")'>
    <h1>About us</h1>
</div>

<section id="about-us">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="about-img">
                    <img src="{{ asset('/theme/images/about-img.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="about-content">
                    <h2>Who we are</h2>
                    <p>Photographs are a way of preserving a moment in our lives for the rest of our lives. Many of us have at least been tempted at the flashy array of photo printers which seemingly leap off the shelves at even the least tech-savvy. It surely seems old fashioned to talk about 35mm film and non-digital cameras in today’s day and age.</p>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection