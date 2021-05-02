@extends('layouts.backend.app')

@section('title', 'User Detail -')

@push('css')
    
@endpush

@section('content')

<div class="content-wrapper">
    <div class="container p-3">
        <div class="card">
            <div class="card-header">
                Profile of 
                @if ($user->username == NULL)
                    <strong>{{ $user->name }}</strong>
                @else
                    <strong>{{ $user->username }}</strong>
                @endif

                @if ($user->req_status != 1)
                    || <strong class="text-danger">Delete Req.</strong>
                @endif

                @if ($user->req_status == 0)
                    <sup><span class="badge badge-pill badge-warning ml-1" style="font-size: 12px;">Waiting for Confirmation</span></sup> 
                @elseif ($user->req_status == 2)
                    <sup><span class="badge badge-pill badge-success ml-1" style="font-size: 12px;">Accepted</span></sup> 
                @elseif ($user->req_status == 9)
                    <sup><span class="badge badge-pill badge-danger ml-1" style="font-size: 12px;">Canceled</span></sup> 
                @endif
                <span class="float-right">
                    Status:
                    @if ($user->req_status == 0)
                        @if ($user->users->status == 0)
                            <sup><span class="badge badge-pill badge-danger float-right ml-1" style="font-size: 12px;">Non-Active</span></sup> 
                        @elseif ($user->users->status == 1)
                            <sup><span class="badge badge-pill badge-info float-right ml-1" style="font-size: 12px;">Active</span></sup> 
                        @endif
                    @elseif ($user->req_status == 1)
                        @if ($user->status == 0)
                            <sup><span class="badge badge-pill badge-danger float-right ml-1" style="font-size: 12px;">Non-Active</span></sup> 
                        @elseif ($user->status == 1)
                            <sup><span class="badge badge-pill badge-info float-right ml-1" style="font-size: 12px;">Active</span></sup> 
                        @endif
                    {{-- @else 
                        <sup><span class="badge badge-pill badge-danger float-right ml-1" style="font-size: 12px;">Non-Active</span></sup>  --}}
                    @endif

                    @if ($user->role->id == 1)
                        <p class="text-success float-right ml-1" style="margin-top: 1px; font-size: 16px;">{{ $user->role->name }}</p> 
                    @elseif ($user->role->id == 2)
                        <p class="text-primary float-right ml-1" style="margin-top: 1px; font-size: 16px;">{{ $user->role->name }}</p> 
                    @elseif ($user->role->id == 3)
                        <p class="text-warning float-right ml-1" style="margin-top: 1px; font-size: 16px;">{{ $user->role->name }}</p> 
                    @endif
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <h6 class="mb-3 display-4">User Information:</h6>
                        <div class="row">
                            <div class="col-lg-4">
                                @if ($user->image == 'default.png')
                                    <img src="{{ asset('storage/account/base/'.$user->image) }}" alt="Gambar {{ $user->name }}" style="padding: 0;
                                    display: block;
                                    margin: 0 auto;
                                    max-height: 100%;
                                    max-width: 100%;"><br><br>
                                @else 
                                    <img src="{{ asset('storage/account/'.$user->image) }}" alt="Gambar {{ $user->name }}" style="padding: 0;
                                    display: block;
                                    margin: 0 auto;
                                    max-height: 100%;
                                    max-width: 100%;"><br><br>
                                @endif
                            </div>
                            <div class="col-lg-8">
                                Full Name: <strong>{{ $user->name }}</strong> <br>
                                Email: {{ $user->email }}<br>
                                Identity: {{ $user->identitas }} <br>
                                Identity Number: {{ $user->no_identitas }} <br>
                                Address: {{ $user->alamat }} <br>
                                Gender: {{ $user->jenis_kelamin }} <br>
                                About: {{ $user->about }} <br>
                                Last Updated By: {{ $user->user->name }} <br>

                                @if ($user->created_at == !NULL)
                                    Created Time: {{ $user->created_at->format('d-m-Y - H:i:s') }} <br>
                                @else
                                    Created Time: No Data Available <br>
                                @endif

                                @if ($user->updated_at == !NULL)
                                    @if ($user->req_status == 1)
                                        Updated Time: {{ $user->updated_at->format('d-m-Y - H:i:s') }}
                                    @elseif ($user->req_status == 2)
                                        Accepted for Delete Req: {{ $user->updated_at->format('d-m-Y - H:i:s') }} 
                                    @elseif ($user->req_status == 9)
                                        Rejected for Delete Req: {{ $user->updated_at->format('d-m-Y - H:i:s') }} 
                                    @endif <br>
                                @else
                                    Update Time: No Data Available <br>
                                @endif <br>

                                @if (Auth::user()->id == $user->id)
                                    <button type="button" class="btn btn-success btn-sm btn-icon-text">
                                        <a href="{{ route('admin.settings') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-settings btn-icon-prepend"></i> Settings </a>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>              
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
                        
                        
                        
{{--                         
                                    @elseif ($bookings->status == 1)
                                        <button class="btn btn-success mr-2" type="button" onclick="checkInBooking({{ $bookings->id }})">
                                            <i class="mdi mdi-login"></i>
                                        </button>
                                        <form id="checkin-form-{{ $bookings->id }}" action="{{ route('admin.booking.checkin',$bookings->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @elseif ($bookings->status == 2)
                                        The booking was canceled.
                                    @elseif ($bookings->status == 3)
                                        <button class="btn btn-danger mr-2" type="button" onclick="checkOutBooking({{ $bookings->id }})">
                                            <i class="mdi mdi-logout"></i>
                                        </button>
                                        <form id="checkout-form-{{ $bookings->id }}" action="{{ route('admin.booking.checkout',$bookings->id.'/'.$bookings->room_number_id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @elseif ($bookings->status == 4)
                                        The booking was finished.
                                    @elseif ($bookings->status == 5)
                                        @if ($bookings->image == NULL) 
                                            <button class="btn btn-success mr-2" type="button" onclick="approvalBooking({{ $bookings->id }})" disabled>
                                                <i class="mdi mdi-check"></i>
                                            </button>
                                            <form id="approval-form-{{ $bookings->id }}" action="{{ route('admin.booking.approve',$bookings->id.'/'.$bookings->room_number_id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>

                                            <button class="btn btn-danger" type="button" onclick="declineBooking({{ $bookings->id }})">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                            <form id="decline-form-{{ $bookings->id }}" action="{{ route('admin.booking.decline',$bookings->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @elseif ($bookings->image == !NULL)
                                            <button class="btn btn-success mr-2" type="button" onclick="approvalBooking({{ $bookings->id }})">
                                                <i class="mdi mdi-check"></i>
                                            </button>
                                            <form id="approval-form-{{ $bookings->id }}" action="{{ route('admin.booking.approve',$bookings->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>

                                            <button class="btn btn-danger" type="button" onclick="declineBooking({{ $bookings->id }})">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                            <form id="decline-form-{{ $bookings->id }}" action="{{ route('admin.booking.decline',$bookings->id.'/'.$bookings->room_number_id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @endif --}}
                   

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function buyingBooking(id) {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-2',
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '<h5 style="color: black;">Are you sure? <br> You wont be able to revert this!</h5>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('buying-form-'+id).submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            '<h5 style="color: black;">Cancelled</h5>',
            '<h5 style="color: black;">Your data is safe :)</h5>',
            'error',
            )
        }
        })
    }
</script>
<script type="text/javascript">
    function approvalBooking(id) {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-2',
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '<h5 style="color: black;">Are you sure? <br> You wont be able to revert this!</h5>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('approval-form-'+id).submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            '<h5 style="color: black;">Cancelled</h5>',
            '<h5 style="color: black;">Your data is safe :)</h5>',
            'error',
            )
        }
        })
    }
</script>
<script type="text/javascript">
    function declineBooking(id) {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-2',
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '<h5 style="color: black;">Are you sure? <br> You wont be able to revert this!</h5>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('decline-form-'+id).submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            '<h5 style="color: black;">Cancelled</h5>',
            '<h5 style="color: black;">Your data is safe :)</h5>',
            'error',
            )
        }
        })
    }
</script>
<script type="text/javascript">
    function checkInBooking(id) {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-2',
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '<h5 style="color: black;">Are you sure? <br> You wont be able to revert this!</h5>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('checkin-form-'+id).submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            '<h5 style="color: black;">Cancelled</h5>',
            '<h5 style="color: black;">Your data is safe :)</h5>',
            'error',
            )
        }
        })
    }
</script>
<script type="text/javascript">
    function checkOutBooking(id) {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-2',
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: '<h5 style="color: black;">Are you sure? <br> You wont be able to revert this!</h5>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('checkout-form-'+id).submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            '<h5 style="color: black;">Cancelled</h5>',
            '<h5 style="color: black;">Your data is safe :)</h5>',
            'error',
            )
        }
        })
    }
</script>
@endpush