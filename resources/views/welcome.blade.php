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
            @foreach ($class as $cl)
                <div class="row mb-30">
                    <div class="col-md-3 mt-10">
                        <a href="{{ route('class.details',$cl->id.'/'.$cl->slug) }}"><img src="{{ asset('storage/class/'.$cl->image) }}" alt="Gambar {{ $cl->name }}" class="img-fluid"></a>
                    </div>
                    <div class="col-md-9">
                        <a href="{{ route('class.details',$cl->id.'/'.$cl->slug) }}"><b style="font-size: 30px;">{{ $cl->name }} Class</b></a>
                        <p>{!! str_limit($cl->desc,300) !!}</p>
                        <a href="{{ route('class.details',$cl->id.'/'.$cl->slug) }}" class="genric-btn info">{{ $cl->name }} Class Info</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- End Align Area -->

@endsection