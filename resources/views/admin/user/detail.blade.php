@extends('layouts.backend.app')

@section('title', 'User Detail -')

@push('css')
    
@endpush

@section('content')

<div class="content-wrapper">
    <div class="container p-3">
        <div class="card">
            <div class="card-header">
                Profile of <strong>{{ $user->username }}</strong> 
                <span class="float-right">
                    Status:
                    @if ($user->role->id == 1)
                        <p class="text-success float-right ml-2" style="margin-top: 1px; font-size: 16px;">{{ $user->role->name }}</p>
                    @elseif ($user->role->id == 2)
                        <p class="text-primary float-right ml-2" style="margin-top: 1px; font-size: 16px;">{{ $user->role->name }}</p>
                    @elseif ($user->role->id == 3)
                        <p class="text-warning float-right ml-2" style="margin-top: 1px; font-size: 16px;">{{ $user->role->name }}</p>
                    @endif
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <h6 class="mb-3 display-4">User Information:</h6>
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{ asset('assets/backend/images/faces/'.$user->image) }}" alt="Gambar {{ $user->name }}" style="padding: 0;
                                display: block;
                                max-height: 100%;
                                max-width: 100%;"><br><br>
                            </div>
                            <div class="col-lg-8">
                                Full Name: <strong>{{ $user->name }}</strong> <br>
                                Email: {{ $user->email }}<br>
                                Identity: {{ $user->identitas }} <br>
                                Identity Number: {{ $user->no_identitas }} <br>
                                Address: {{ $user->alamat }} <br>
                                Gender: {{ $user->jenis_kelamin }} <br>
                                About: {{ $user->about }} <br><br>
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