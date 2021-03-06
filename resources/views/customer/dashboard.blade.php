@extends('layouts.backend.app')

@section('title', 'Customer Dashboard -')

@push('css')
    <style type="text/css">
        .display-4{
            font-weight: bold;
        }
        .card-body-icon{
            position: absolute;
            z-index: 0;
            top: 25px;
            right: 4px;
            opacity: 0.4;
            font-size: 90px;
        }
    </style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
    
                    <div class="card-body">
                        <div class="bg-success alert alert-dismissible fade show" role="alert" style="margin-top: -17px;">
                            Hello, <strong>{{ Auth::user()->name }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="accordion" id="bagian1">
                            <div class="card">
                                <div class="card-header bg-secondary" id="header2">
                                    <h5 class="float-left text-black mt-1">Booking</h5><button class="btn btn-link float-right text-black" type="button" data-toggle="collapse" data-target="#collapse2"><i class="fas fa-angle-double-down"></i></button>
                                </div>
                
                                <div class="collapse show" id="collapse2" aria-labelledby="header2" data-parent="#bagian1">
                                    <div class="card-body bg-dark">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-primary">
                                                    <div class="card-header">
                                                        Your Total Booking
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $booking->count() }}</div>
                                                      <a href="{{ route('customer.booking.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-info">
                                                    <div class="card-header">
                                                        On Going
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $booking_ongoing->count() }}</div>
                                                      <a href="{{ route('customer.booking.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-success">
                                                    <div class="card-header">
                                                        Finished
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $booking_accept->count() }}</div>
                                                      <a href="{{ route('customer.booking.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-danger">
                                                    <div class="card-header">
                                                        Canceled
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $booking_refuse->count() }}</div>
                                                      <a href="{{ route('customer.booking.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection