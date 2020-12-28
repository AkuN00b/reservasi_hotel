@extends('layouts.backend.app')

@section('title', 'Booking Detail Index -')

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
                        <p class="text-info float-right ml-2" style="margin-top: 1px; font-size: 16px;">Waiting for Transaction</p>
                    @endif
                </span>
            </div>
            <div class="card-body">
                @if ($bookings->status == 5)
                    <b style="font-size: 30px;">Your Ref. Transaction: {{ $bookings->transaction_id }}</b> <br><br>
                    How to buy: <br>
                    1. Insert Your Card. Select a language. Enter your ATM PIN. <br>
                    2. Then, select the Other Menu. <br>
                    3. Select Transfer and select the type of account that you will use (Example: "From a Savings Account"). <br>
                    4. Select Virtual Account Billing. <br>
                    5. Enter your Virtual Account number (Your Ref. Transaction: {{ $bookings->transaction_id }}). <br>
                    6. The bill that must be paid will appear on the confirmation screen. <br>
                    7. Confirm, if it is appropriate, continue the transaction. <br>
                    8. Your transaction has been completed. <br>
                    9. Capture your Proof Transaction, send <a href="{{ route('customer.booking.edit', $bookings->id) }}" class="text-white"><strong>HERE</strong></a>. <br>
                    <hr class="garis mt-5 mb-5">
                @elseif ($bookings->status == 4)
                    <h1 class="display-1 text-center">THANK YOU !!!</h1>
                    <h5 class="display-4 text-center">Your Booking has Finished. Thank you for use our Hotel</h5>
                    <hr class="garis mt-5 mb-5">
                @elseif ($bookings->status == 1)
                    <h1 class="display-2 text-center">Your Room Number is <br> <b class="display-1">{{ $bookings->room_number->name }}</b></h1>
                    <h5 class="display-4 text-center">Provide Proof of Payment to The Receptionist if You Want to Check In</h5>
                    <hr class="garis mt-5 mb-5">
                @elseif ($bookings->status == 3)
                    <h1 class="display-1 text-center">Free WiFi Access !!</h1>
                    <h1 class="display-3 text-center">Username: room{{ $bookings->room_number->name }} <br> Password: {{ $bookings->room_number->room->bed->slug }}.{{ $bookings->room_number->room->class->slug }}.{{ $bookings->room_number->name }}</h1>
                    <h5 class="display-5 text-center">Enjoy our Network !!</h5>
                    <hr class="garis mt-5 mb-5">
                @endif
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <h6 class="mb-3 display-4">Payment Information:</h6>
                        Full Name: <strong>{{ $bookings->user->name }}</strong> <br>
                        Email: {{ $bookings->email }}<br>
                        Identity: {{ $bookings->identitas }} <br>
                        Identity Number: {{ $bookings->no_identitas }} <br>
                        Address: {{ $bookings->alamat }} <br>
                        Gender: {{ $bookings->jenis_kelamin }} <br>
                        Start Date: {{ $bookings->tgl_awal }} <br>
                        End Date: {{ $bookings->tgl_akhir }} <br>
                        @if ($bookings->status == 1)
                            Room Number: {{ $bookings->room_number->name }} <br><br>
                        @else
                            <br>
                        @endif

                        @if ($bookings->image == NULL)

                        @else
                            @if ($bookings->status == 5)
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
                                </div>
                            @else

                            @endif
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
                                        Waiting for Confirmation   
                                    @elseif ($bookings->status == 1)
                                        Accepted || <b>Your Room Number: {{ $bookings->room_number->name }}</b>
                                    @elseif ($bookings->status == 2)
                                        The booking was canceled.
                                    @elseif ($bookings->status == 3)
                                        Checked In.
                                    @elseif ($bookings->status == 4)
                                        The booking was finished.
                                    @elseif ($bookings->status == 5)                                 
                                        @if ($bookings->image == NULL)
                                            <a href="{{ route('customer.booking.edit', $bookings->id) }}" class="btn btn-warning btn-block">Send Your Proof</a>
                                        @elseif ($bookings->image == !NULL)
                                            Waiting for Approval
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

@endpush