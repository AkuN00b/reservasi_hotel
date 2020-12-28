@extends('layouts.backend.app')

@section('title', 'Booking Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        @if (Request::is('receptionist/booking'))
          <h2 class="mt-1 mb-2">Booking / <a href="{{ route('receptionist.booking.customer') }}" style="color: white;">Customer Booking</a></h2>
        @else 
        <h2 class="mt-1 mb-2">Customer Booking / <a href="{{ route('receptionist.booking.index') }}" style="color: white;">Booking</a></h2>
        @endif
        <hr class="mb-3 garis">
        <button type="button" class="btn btn-primary mb-5">
            <a href="{{ route('primary') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
        </button>
        <div class="card">
          <div class="card-header" style="background-color: #3c5f8f">
            @if (Request::is('receptionist/booking'))
              All Booking
            @else
              Customer Booking
            @endif
          </div>
          <div class="card-body" style="background-color: #aec9ef">
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_id">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> User Name </th>
                    <th> Order Name </th>
                    <th> Bed Category </th>
                    <th> Class Category </th> 
                    <th> Action </th> 
                  </tr>
                </thead>
                <tbody>
                  @foreach ($bookings as $key=>$booking)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $booking->user->name }} 
                        @if ($booking->status == 0)
                            <sup><span class="badge badge-pill badge-warning" style="font-size: 10px;">Waiting for Confirmation</span></sup>
                        @elseif ($booking->status == 1)
                            <sup><span class="badge badge-pill badge-primary" style="font-size: 10px;">Accepted</span></sup> 
                        @elseif ($booking->status == 2)
                            <sup><span class="badge badge-pill badge-danger" style="font-size: 10px;">Canceled</span></sup> 
                        @elseif ($booking->status == 3)
                            <sup><span class="badge badge-pill badge-success" style="font-size: 10px;">Checked In</span></sup> 
                        @elseif ($booking->status == 4)
                            <sup><span class="badge badge-pill badge-info" style="font-size: 10px;">Checked Out</span></sup> 
                        @elseif ($booking->status == 5)
                            <sup><span class="badge badge-pill badge-warning" style="font-size: 10px;">Wait for Transaction</span></sup> 
                        @endif
                      </td>
                      <td> {{ $booking->name }} </td>
                      <td> {{ $booking->bed->name }} </td>
                      <td> {{ $booking->class->name }} </td>
                      <td>
                        @if ($booking->status == 2 || $booking->status == 4)
                          <div class="text-center">
                            <a href="{{ route('receptionist.booking.show',$booking->id) }}" class="btn btn-info mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="{{ $booking->name }} Booking Detail"><i class="mdi mdi-eye"></i></a>  
                            <a href="{{ route('receptionist.booking.edit',$booking->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="{{ $booking->name }} Booking Edit"><i class="mdi mdi-pencil"></i></a>  
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $booking->id }})" data-toggle="tooltip" data-placement="bottom" title="{{ $booking->name }} Booking Delete">
                              <i class="mdi mdi-delete"></i>
                            </button>
                            <form id="delete-form-{{ $booking->id }}" action="{{ route('receptionist.booking.destroy',$booking->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                          </div>
                        @else
                          <div class="text-center">
                            <a href="{{ route('receptionist.booking.show',$booking->id) }}" class="btn btn-info mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="{{ $booking->name }} Booking Detail"><i class="mdi mdi-eye"></i></a>  
                            <a href="{{ route('receptionist.booking.edit',$booking->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="{{ $booking->name }} Booking Edit"><i class="mdi mdi-pencil"></i></a>  
                          </div>
                        @endif
                      </td>
                    </tr>
                    @endforeach
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
    function deleteBed(id) {
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
            document.getElementById('delete-form-'+id).submit();
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