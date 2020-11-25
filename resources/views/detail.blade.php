@extends('layouts.frontend.app')

@section('title')
    {{ $class->name }} Room Info
@endsection

@push('css')
   <style type="text/css">
      hr.hr01{
         height: 10px;
         border: 0;
         box-shadow: 0 10px 10px -10px #8c8c8c inset;
      }
   </style>
@endpush

@section('content')

<div class="bradcam_area breadcam_bg_1">
    <h3 style="margin-top: -70px;">{{ $class->name }} Room Info</h3>
</div>

<section class="blog_area single-post-area section-padding">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 posts-list">
             <div class="single-post">
                <div class="feature-img">
                   <img class="img-fluid" src="{{ asset('assets/frontend/img/blog/single_blog_1.png') }}" alt="">
                </div>
                <div class="blog_details">
                   <h2>{{ $class->name }} Detail</h2>
                   <p class="excert">
                      {!! $class->desc !!}
                   </p>
                   @if ($rooms->count() > 0)
                   <div class="mt-3 mb-3">
                     {{ $class->name }} Room Price <br><br>
                     <hr class="hr01" style="margin-top: -15px;">
                     <div class="progress-table-wrap">
                      <div class="progress-table">
                         <div class="table-head">
                            <div class="serial">#</div>
                            <div class="country">Bed (Person)</div>
                            <div class="visit">Price</div>
                            <div class="visit">Room Available</div>
                            <div class="percentage">Action</div>
                         </div>
                         @foreach ($rooms as $key=>$room)
                            <div class="table-row">
                               <div class="serial">{{ $key + 1 }}</div>
                               <div class="country">{{ $room->bed->name }} ({{ $room->bed->person }})</div>
                               <div class="visit">@uang($room->price)</div>
                               <div class="visit">{{ $room->roomNumber->count() }}</div>
                               <div class="percentage">
                                  @guest
                                    <a href="javascript:void(0)" 
                                       class="genric-btn primary-border btn-block" style="font-size: 20px"
                                       onclick="toastr.info('To add Booking Room. You need to Login First!','Info',
                                       {
                                       closeButton: true, 
                                       progressBar: true,
                                       })">
                                       Buy
                                    </a>
                                  @else
                                    <a href="{{ route('class.buypage',$room->id.'/'.$room->class_id.'/'.$room->bed_id.'/'.$room->class->slug.'/'.$room->bed->slug) }}" class="genric-btn primary-border btn-block" style="font-size: 20px">Buy</a>
                                  @endguest
                               </div>
                            </div>
                         @endforeach
                      </div>
                     </div>
                    </div>
                   @endif
                </div>
             </div>
             <div class="navigation-top">
                <div class="d-sm-flex justify-content-between text-center">
                   <div class="col-sm-4 text-center my-2 my-sm-0">
                      <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                   </div>
                   <ul class="social-icons">
                      <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                      <li><a href="#"><i class="fa fa-behance"></i></a></li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
</section>

@endsection