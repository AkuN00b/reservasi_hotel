@extends('layouts.frontend.app')

@section('title')
    Buy {{ $rooms->class->name }} Room {{ $rooms->bed->name }} Bed
@endsection

@push('css')
   
@endpush

@section('content')

@guest
    <div class="bradcam_area breadcam_bg_1">
        <h3 style="margin-top: -70px;">This Page Does Not Know You</h3>
    </div>

    <section class="blog_area single-post-area section-padding">
        <h3 class="text-center"><a href="{{ route('login') }}">Login Here</a></h3>
    </section>
@else
    <div class="bradcam_area breadcam_bg_1">
        <h3 style="margin-top: -70px;">Buy {{ $rooms->class->name }} Room {{ $rooms->bed->name }} Bed</h3>
    </div>

    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 posts-list">
                    <form action="#" method="POST">
                        <h3>Admin Info</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2 mt-2">Admin Name</div>
                            <div class="col-lg-10">
                                <div class="border">
                                    <input type="text" name="first_name" placeholder="First Name" required disabled hidden value="{{ Auth::user()->id }}" class="single-input text-black">
                                    <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ Auth::user()->name }}" class="single-input text-black">
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <h3>Customer Form</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2 mt-2">Customer Name</div>
                            <div class="col-lg-10">
                                <div class="border">
                                    <input type="text" name="first_name" placeholder="First Name" required class="single-input text-black">
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <h3>Room want to Reserve Detail</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-2 mt-2">Bed Name</div>
                            <div class="col-lg-10">
                                <div class="border">
                                    <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $beds->name }}" class="single-input text-black">
                                </div>                                
                            </div>
                        </div>

                        <br>
                
                        <div class="row">
                            <div class="col-lg-2 mt-2">Person Quantity</div>
                            <div class="col-lg-10">
                                <div class="border">
                                    <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $beds->person }}" class="single-input text-black">
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-2 mt-2">Class Name</div>
                            <div class="col-lg-10">
                                <div class="border">
                                    <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $classes->name }}" class="single-input text-black">
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-2 mt-2">Room Price</div>
                            <div class="col-lg-10">
                                <div class="border">
                                    <input type="text" name="first_name" placeholder="First Name" required disabled value="{{ $rooms->price }}" class="single-input text-black">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endguest

@endsection