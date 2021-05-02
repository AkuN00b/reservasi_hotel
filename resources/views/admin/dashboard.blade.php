@extends('layouts.backend.app')

@section('title', 'Admin Dashboard -')

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
                                    <h5 class="float-left text-black mt-1">Bed</h5><button class="btn btn-link float-right text-black" type="button" data-toggle="collapse" data-target="#collapse2"><i class="fas fa-angle-double-down"></i></button>
                                </div>
                
                                <div class="collapse show" id="collapse2" aria-labelledby="header2" data-parent="#bagian1">
                                    <div class="card-body bg-dark">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-primary">
                                                    <div class="card-header">
                                                        Total (Your Edit)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-paw"></i>
                                                      </div>
                                                      <div class="display-4">{{ $bed->count() }} ({{ $bed_req_active->count() }})</div>
                                                      <a href="{{ route('admin.bed.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-info">
                                                    <div class="card-header text-nowrap">
                                                        Recep. Edit (Need Conf.)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-paw"></i>
                                                      </div>
                                                      <div class="display-4">{{ $bed_request->count() }} ({{ $bed_req_ongoing->count() }})</div>
                                                      <a href="{{ route('admin.bed.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-success">
                                                    <div class="card-header">
                                                        Accepted Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-paw"></i>
                                                      </div>
                                                      <div class="display-4">{{ $bed_req_accepted->count() }}</div>
                                                      <a href="{{ route('admin.bed.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-danger">
                                                    <div class="card-header">
                                                        Canceled Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-paw"></i>
                                                      </div>
                                                      <div class="display-4">{{ $bed_req_canceled->count() }}</div>
                                                      <a href="{{ route('admin.bed.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <div class="accordion" id="bagian2">
                            <div class="card">
                                <div class="card-header bg-secondary" id="header2">
                                    <h5 class="float-left text-black mt-1">Class</h5><button class="btn btn-link float-right text-black" type="button" data-toggle="collapse" data-target="#collapse3"><i class="fas fa-angle-double-down"></i></button>
                                </div>
                
                                <div class="collapse show" id="collapse3" aria-labelledby="header2" data-parent="#bagian2">
                                    <div class="card-body bg-dark">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-primary">
                                                    <div class="card-header">
                                                        Total (Your Edit)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-more"></i>
                                                      </div>
                                                      <div class="display-4">{{ $class->count() }} ({{ $class_req_active->count() }})</div>
                                                      <a href="{{ route('admin.class.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-info">
                                                    <div class="card-header text-nowrap">
                                                        Recep. Edit (Need Conf.)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-more"></i>
                                                      </div>
                                                      <div class="display-4">{{ $class_request->count() }} ({{ $class_req_ongoing->count() }})</div>
                                                      <a href="{{ route('admin.class.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-success">
                                                    <div class="card-header">
                                                        Accepted Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-more"></i>
                                                      </div>
                                                      <div class="display-4">{{ $class_req_accepted->count() }}</div>
                                                      <a href="{{ route('admin.class.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-danger">
                                                    <div class="card-header">
                                                        Canceled Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-more"></i>
                                                      </div>
                                                      <div class="display-4">{{ $class_req_canceled->count() }}</div>
                                                      <a href="{{ route('admin.class.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <div class="accordion" id="bagian4">
                            <div class="card">
                                <div class="card-header bg-secondary" id="header4">
                                    <h5 class="float-left text-black mt-1">Room</h5><button class="btn btn-link float-right text-black" type="button" data-toggle="collapse" data-target="#collapse5"><i class="fas fa-angle-double-down"></i></button>
                                </div>
                
                                <div class="collapse show" id="collapse5" aria-labelledby="header4" data-parent="#bagian4">
                                    <div class="card-body bg-dark">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-primary">
                                                    <div class="card-header">
                                                        Total (Your Edit)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-seat-individual-suite"></i>
                                                      </div>
                                                      <div class="display-4">{{ $room->count() }} ({{ $room_req_active->count() }})</div>
                                                      <a href="{{ route('admin.room.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-info">
                                                    <div class="card-header text-nowrap">
                                                        Recep. Edit (Need Conf.)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-seat-individual-suite"></i>
                                                      </div>
                                                      <div class="display-4">{{ $room_request->count() }} ({{ $room_req_ongoing->count() }})</div>
                                                      <a href="{{ route('admin.room.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-success">
                                                    <div class="card-header">
                                                        Accepted Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-seat-individual-suite"></i>
                                                      </div>
                                                      <div class="display-4">{{ $room_req_accepted->count() }}</div>
                                                      <a href="{{ route('admin.room.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-danger">
                                                    <div class="card-header">
                                                        Canceled Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-seat-individual-suite"></i>
                                                      </div>
                                                      <div class="display-4">{{ $room_req_canceled->count() }}</div>
                                                      <a href="{{ route('admin.room.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <div class="accordion" id="rm4">
                            <div class="card">
                                <div class="card-header bg-secondary" id="rmh4">
                                    <h5 class="float-left text-black mt-1">Room Number</h5><button class="btn btn-link float-right text-black" type="button" data-toggle="collapse" data-target="#rmc5"><i class="fas fa-angle-double-down"></i></button>
                                </div>
                
                                <div class="collapse show" id="rmc5" aria-labelledby="rmh4" data-parent="#rm4">
                                    <div class="card-body bg-dark">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-primary">
                                                    <div class="card-header">
                                                        Total (Your Edit)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-key-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $roomnumber->count() }} ({{ $roomnumber_req_active->count() }})</div>
                                                      <a href="{{ route('admin.room-number.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-info">
                                                    <div class="card-header text-nowrap">
                                                        Recep. Edit (Need Conf.)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-key-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $roomnumber_request->count() }} ({{ $roomnumber_req_ongoing->count() }})</div>
                                                      <a href="{{ route('admin.room-number.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-success">
                                                    <div class="card-header">
                                                        Accepted Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-key-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $roomnumber_req_accepted->count() }}</div>
                                                      <a href="{{ route('admin.room-number.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-danger">
                                                    <div class="card-header">
                                                        Canceled Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-key-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $roomnumber_req_canceled->count() }}</div>
                                                      <a href="{{ route('admin.room-number.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <div class="accordion" id="user4">
                            <div class="card">
                                <div class="card-header bg-secondary" id="userh4">
                                    <h5 class="float-left text-black mt-1">User</h5><button class="btn btn-link float-right text-black" type="button" data-toggle="collapse" data-target="#userc5"><i class="fas fa-angle-double-down"></i></button>
                                </div>
                
                                <div class="collapse show" id="userc5" aria-labelledby="userh4" data-parent="#user4">
                                    <div class="card-body bg-dark">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-primary">
                                                    <div class="card-header">
                                                        Total (Your Edit)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-outline"></i>
                                                      </div>
                                                      <div class="display-4">{{ $user->count() }} ({{ $user_req_active->count() }})</div>
                                                      <a href="{{ route('admin.user.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-info">
                                                    <div class="card-header text-nowrap">
                                                        Recep. Edit (Need Conf.)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-outline"></i>
                                                      </div>
                                                      <div class="display-4">{{ $user_request->count() }} ({{ $user_req_ongoing->count() }})</div>
                                                      <a href="{{ route('admin.user.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-success">
                                                    <div class="card-header">
                                                        Accepted Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-outline"></i>
                                                      </div>
                                                      <div class="display-4">{{ $user_req_accepted->count() }}</div>
                                                      <a href="{{ route('admin.user.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-danger">
                                                    <div class="card-header">
                                                        Canceled Req.
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-outline"></i>
                                                      </div>
                                                      <div class="display-4">{{ $user_req_canceled->count() }}</div>
                                                      <a href="{{ route('admin.user.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <div class="accordion" id="booking4">
                            <div class="card">
                                <div class="card-header bg-secondary" id="bookingh4">
                                    <h5 class="float-left text-black mt-1">Booking</h5><button class="btn btn-link float-right text-black" type="button" data-toggle="collapse" data-target="#bookingc5"><i class="fas fa-angle-double-down"></i></button>
                                </div>
                
                                <div class="collapse show" id="bookingc5" aria-labelledby="bookingh4" data-parent="#booking4">
                                    <div class="card-body bg-dark">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-primary">
                                                    <div class="card-header">
                                                        Total (Your Booking)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $booking->count() }} ({{ $booking_req_active->count() }})</div>
                                                      <a href="{{ route('admin.booking.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-info">
                                                    <div class="card-header">
                                                        Need Conf. (On Going)
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $booking_req_ongoing->count() }} ({{ $booking_request->count() }})</div>
                                                      <a href="{{ route('admin.booking.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-success">
                                                    <div class="card-header">
                                                        Finished Booking
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $booking_req_accepted->count() }}</div>
                                                      <a href="{{ route('admin.booking.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <div class="card bg-danger">
                                                    <div class="card-header">
                                                        Canceled Booking
                                                    </div>
                                                    <div class="card-body">
                                                      <div class="card-body-icon mt-3">
                                                        <i class="mdi mdi-account-multiple-plus"></i>
                                                      </div>
                                                      <div class="display-4">{{ $booking_req_canceled->count() }}</div>
                                                      <a href="{{ route('admin.booking.index') }}"><p class="card-text text-white">Detail <i class="fas fa-angle-double-right ml-2"></i> </p></a>
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