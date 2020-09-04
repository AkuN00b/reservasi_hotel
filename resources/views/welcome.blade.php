@extends('layouts.frontend.app')

@section('title', 'Welcome')

@section('content')

<!-- slider_area_end -->
<div class="bradcam_area breadcam_bg_1">
    <h3 style="margin-top: -70px;">Welcome To {{ config('app.name', 'Laravel') }}</h3>
</div>

<!-- Start Align Area -->
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <h3 class="mb-30">Bedroom Class</h3>
            <div class="row mb-30">
                <div class="col-md-3">
                    <img src="{{ asset('assets/frontend/img/elements/d.jpg') }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-9 mt-sm-20">
                    <p>Recently, the US Federal government banned online casinos from operating in America by making
                        it illegal to
                        transfer money to them through any US bank or payment system. As a result of this law, most
                        of the popular
                        online casino networks such as Party Gaming and PlayTech left the United States. Overnight,
                        online casino
                        players found themselves being chased by the Federal government. But, after a fortnight, the
                        online casino
                        industry came up with a solution and new online casinos started taking root. These began to
                        operate under a
                        different business umbrella, and by doing that, rendered the transfer of money to and from
                        them legal. A major
                        part of this was enlisting electronic banking systems that would accept this new
                        clarification and start doing
                        business with me. Listed in this article are the electronic banking systems that accept
                        players from the United
                        States that wish to play in online casinos.</p>
                        <a href="#" class="genric-btn info">Info</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Align Area -->

@endsection