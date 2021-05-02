@extends('layouts.backend.app')

@section('title', 'Booking Detail -')

@push('css')
    
@endpush

@section('content')

<div class="content-wrapper">
    <div class="container p-3">
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
                    @elseif ($bookings->status == 5)
                        <p class="text-warning float-right ml-2" style="margin-top: 1px; font-size: 16px;">Waiting for Transaction</p>
                    @endif
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <h6 class="mb-3 display-4">Payment Information:</h6>
                        @if ($bookings->user->role->id == 3)
                            Full Name: <strong>{{ $bookings->user->name }}</strong> <br>
                            Email: {{ $bookings->email }}<br>
                            Identity: {{ $bookings->identitas }} <br>
                            Identity Number: {{ $bookings->no_identitas }} <br>
                            Address: {{ $bookings->alamat }} <br>
                            Gender: {{ $bookings->jenis_kelamin }} <br>
                            Start Date: {{ $bookings->tgl_awal }} <br>
                            End Date: {{ $bookings->tgl_akhir }} <br>
                            Total Date: {{ $bookings->durasi }} day(s) <br><br>

                            Created Time: {{ $bookings->created_at->format('d-m-Y - H:i:s') }} <br>
                            Updated Time: {{ $bookings->updated_at->format('d-m-Y - H:i:s') }} <br><br>
                        @else
                            <div class="row">
                                <div class="col-lg-6">
                                    Customer Data: <br><br>
                                    Full Name: <strong>{{ $bookings->name }}</strong> <br>
                                    Email: {{ $bookings->email }}<br>
                                    Identity: {{ $bookings->identitas }} <br>
                                    Identity Number: {{ $bookings->no_identitas }} <br>
                                    Address: {{ $bookings->alamat }} <br>
                                    Gender: {{ $bookings->jenis_kelamin }} <br>
                                    Start Date: {{ $bookings->tgl_awal }} <br>
                                    End Date: {{ $bookings->tgl_akhir }} <br>
                                    Total Date: {{ $bookings->durasi }} day(s) <br><br>
                                </div>
                                <div class="col-lg-6">
                                    @if ($bookings->user->role->id == 1) 
                                        Admin Data: <br><br>
                                    @elseif ($bookings->user->role->id == 2)
                                        Receptionist Data: <br><br>
                                    @endif
                                    Full Name: <strong>{{ $bookings->user->name }}</strong> <br>
                                    Email: {{ $bookings->user->email }}<br>
                                    Identity: {{ $bookings->user->identitas }} <br>
                                    Identity Number: {{ $bookings->user->no_identitas }} <br>
                                    Address: {{ $bookings->user->alamat }} <br>
                                    Gender: {{ $bookings->user->jenis_kelamin }} <br><br>

                                    Created Time: {{ $bookings->created_at->format('d-m-Y - H:i:s') }} <br>
                                    Updated Time: {{ $bookings->updated_at->format('d-m-Y - H:i:s') }} <br><br>

                                    <button type="button" class="btn btn-info btn-sm btn-icon-text">
                                        <a href="{{ route('admin.user.show',$bookings->user->id) }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-account-card-details btn-icon-prepend"></i> View Profile</a>
                                    </button>
                                </div>
                            </div>
                        @endif

                        @if ($bookings->user->role->id == 3)
                            <button type="button" class="btn btn-info btn-sm btn-icon-text mb-3">
                                <a href="{{ route('admin.user.show',$bookings->user->id) }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-account-card-details btn-icon-prepend"></i> View Profile</a>
                            </button><br>
                        @endif
                        
                        @if ($bookings->status == 0)
                            <form class="forms-sample mt-2" method="POST" action="{{ route('admin.booking.roomupdate',$bookings->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="room_number_id">Room Number</label>
                                    <select name="room_number_id" id="room_number_id" class="form-control text-white">
                                        <option value="" holder>Select Room Number</option>
                                        @foreach ($roomnumber as $rm)
                                            <option value="{{ $rm->id }}">{{ $rm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                    
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-dark">Cancel</button>
                            </form>
                        @else

                        @endif

                        @if ($bookings->image == NULL)

                        @elseif ($bookings->image == !NULL && $bookings->status == 5) 
                            <h3 class="display-4">The Proof Transaction is Already Available !!</h3>
                            <button type="button" class="btn btn-success btn-sm btn-icon-text" data-toggle="modal" data-target="#image">
                                <i class="mdi mdi-eye btn-icon-prepend"></i> View Image
                            </button>
                            <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Proof Booking {{ $bookings->user->name }}</h4>
                                    </div>
                                    <center>  
                                        <img src="{{ asset('storage/proof-transaction/'.$bookings->image) }}" alt="Gambar {{ $bookings->name }}"  style="padding: 0;
                                        display: block;
                                        margin: 0 auto;
                                        max-height: 100%;
                                        max-width: 100%;">
                                    </center>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                    </div>
                                </div>
                                </div>
                            </div><br><br>
                        @else
                            <button type="button" class="btn btn-success btn-sm btn-icon-text" data-toggle="modal" data-target="#image">
                                <i class="mdi mdi-eye btn-icon-prepend"></i> View Image
                            </button>
                            <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Proof Booking {{ $bookings->user->name }}</h4>
                                    </div>
                                    <center>  
                                        <img src="{{ asset('storage/proof-transaction/'.$bookings->image) }}" alt="Gambar {{ $bookings->name }}"  style="padding: 0;
                                        display: block;
                                        margin: 0 auto;
                                        max-height: 100%;
                                        max-width: 100%;">
                                    </center>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                    </div>
                                </div>
                                </div>
                            </div><br><br>
                        @endif
                    </div>
                </div>
    
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Bed Category</th>
                                <th>Class Category</th>
                                @if ($bookings->room_number_id == !NULL)
                                    <th>Room Number</th>
                                @else

                                @endif
                                <th>Day(s)</th>
                                <th class="right">Price</th>
                                <th>Grand Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="left">{{ $bookings->bed->name }}</td>
                                <td class="left">{{ $bookings->class->name }}</td>
                                @if ($bookings->room_number_id == !NULL)                                
                                    <td class="left">{{ $bookings->room_number->name }}</td>
                                @else

                                @endif
                                <td class="right">{{ $bookings->durasi }}</td>
                                <td class="right">@uang($bookings->room->price)</td>
                                <td class="right">@uang($bookings->total)</td>
                                <td>
                                    @if ($bookings->status == 0)
                                        @if ($bookings->room_number_id == NULL)
                                            <button class="btn btn-success mr-2" type="button" onclick="buyingBooking({{ $bookings->id }})" disabled>
                                                <i class="mdi mdi-check"></i>
                                            </button>
                                            <form id="buying-form-{{ $bookings->id }}" action="{{ route('admin.booking.buying',$bookings->id.'/'.$bookings->room_number_id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @elseif ($bookings->room_number_id == !NULL)
                                            <button class="btn btn-success mr-2" type="button" onclick="buyingBooking({{ $bookings->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirmed Booking">
                                                <i class="mdi mdi-check"></i>
                                            </button>
                                            <form id="buying-form-{{ $bookings->id }}" action="{{ route('admin.booking.buying',$bookings->id.'/'.$bookings->room_number_id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @endif
                                    @elseif ($bookings->status == 1)
                                        <button class="btn btn-success mr-2" type="button" onclick="checkInBooking({{ $bookings->id }})" data-toggle="tooltip" data-placement="bottom" title="Check In">
                                            <i class="mdi mdi-login"></i>
                                        </button>
                                        <form id="checkin-form-{{ $bookings->id }}" action="{{ route('admin.booking.checkin',$bookings->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @elseif ($bookings->status == 2)
                                        The booking was canceled.
                                    @elseif ($bookings->status == 3)
                                        <button class="btn btn-danger mr-2" type="button" onclick="checkOutBooking({{ $bookings->id }})" data-toggle="tooltip" data-placement="bottom" title="Check Out">
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

                                            <button class="btn btn-danger" type="button" onclick="declineBooking({{ $bookings->id }})" data-toggle="tooltip" data-placement="bottom" title="Cancel Booking">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                            <form id="decline-form-{{ $bookings->id }}" action="{{ route('admin.booking.decline',$bookings->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @elseif ($bookings->image == !NULL)
                                            <button class="btn btn-success mr-2" type="button" onclick="approvalBooking({{ $bookings->id }})" data-toggle="tooltip" data-placement="bottom" title="Approve Transaction">
                                                <i class="mdi mdi-check"></i>
                                            </button>
                                            <form id="approval-form-{{ $bookings->id }}" action="{{ route('admin.booking.approve',$bookings->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>

                                            <button class="btn btn-danger" type="button" onclick="declineBooking({{ $bookings->id }})" data-toggle="tooltip" data-placement="bottom" title="Cancel Booking">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                            <form id="decline-form-{{ $bookings->id }}" action="{{ route('admin.booking.decline',$bookings->id.'/'.$bookings->room_number_id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @endif
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