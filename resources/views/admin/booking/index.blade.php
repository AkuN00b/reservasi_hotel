@extends('layouts.backend.app')

@section('title', 'Booking Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        @if (Request::is('admin/booking'))
          <h2 class="mt-1 mb-2">Booking / <a href="{{ route('admin.booking.customer') }}" style="color: white;">Customer Booking</a></h2>
        @else 
        <h2 class="mt-1 mb-2">Customer Booking / <a href="{{ route('admin.booking.index') }}" style="color: white;">Booking</a></h2>
        @endif
        <hr class="mb-3 text-white" color="white">
        <button type="button" class="btn btn-primary mb-5">
            <a href="{{ route('primary') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
        </button>
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap">
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
                  <tr>
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
                      @endif
                    </td>
                    <td> {{ $booking->name }} </td>
                    <td> {{ $booking->bed->name }} </td>
                    <td> {{ $booking->class->name }} </td>
                    <td>
                      @if ($booking->status == 2 || $booking->status == 4)
                        <div class="text-center">
                          <a href="{{ route('admin.booking.show',$booking->id) }}" class="btn btn-info mr-2">Detail</a>  
                          <a href="{{ route('admin.booking.edit',$booking->id) }}" class="btn btn-warning mr-2">Edit</a>  
                          <button class="btn btn-danger" type="button" onclick="deleteBed({{ $booking->id }})">
                            Delete
                          </button>
                          <form id="delete-form-{{ $booking->id }}" action="{{ route('admin.booking.destroy',$booking->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
                          </form>
                        </div>
                      @else
                        <div class="text-center">
                          <a href="{{ route('admin.booking.show',$booking->id) }}" class="btn btn-info mr-2">Detail</a>  
                          <a href="{{ route('admin.booking.edit',$booking->id) }}" class="btn btn-warning mr-2">Edit</a>  
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