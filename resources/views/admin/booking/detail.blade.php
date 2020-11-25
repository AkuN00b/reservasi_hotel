@extends('layouts.backend.app')

@section('title', 'Booking Detail Index -')

@push('css')
    
@endpush

@section('content')

<div class="content-wrapper">
    <div class="container p-5">
        <div class="card">
            <div class="card-header">
                Invoice: <strong>{{ $bookings->id }}</strong> 
                <span class="float-right">
                    Status:
                    @if ($bookings->status == 0)
                        <p class="text-warning float-right ml-2" style="margin-top: 1px; font-size: 16px;">Waiting for Confirmation</p>
                    @elseif ($bookings->status == 1)
                        <p class="text-primary float-right ml-2" style="margin-top: 1px; font-size: 16px;">Accepted</p>
                    @elseif ($bookings->status == 2)
                        <p class="text-danger float-right ml-2" style="margin-top: 1px; font-size: 16px;">Canceled</p>
                    @elseif ($bookings->status == 3)
                        <p class="text-success float-right ml-2" style="margin-top: 1px; font-size: 16px;">Checked In</p>
                    @elseif ($bookings->status == 4)
                        <p class="text-info float-right ml-2" style="margin-top: 1px; font-size: 16px;">Checked Out</p>
                    @endif
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <h6 class="mb-3">Payment Information:</h6>
                        <div>
                            User Name: <strong>{{ $bookings->user->name }}</strong>
                        </div>
                        <div>Order Name: {{ $bookings->name }}</div><br>
                        @if ($bookings->image == NULL)

                        @else
                            <div>Image: </div>
                        @endif
                    </div>
                </div>
    
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Bed Category</th>
                                <th>Class Category</th>
                                <th class="right">Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="left">{{ $bookings->bed->name }}</td>
                                <td class="left">{{ $bookings->class->name }}</td>
                                <td class="right">@uang($bookings->room->price)</td>
                                <td>
                                    @if ($bookings->status == 0)
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
                                        <form id="decline-form-{{ $bookings->id }}" action="{{ route('admin.booking.decline',$bookings->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
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
                                        <form id="checkout-form-{{ $bookings->id }}" action="{{ route('admin.booking.checkout',$bookings->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @elseif ($bookings->status == 4)
                                        The booking was finished.
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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