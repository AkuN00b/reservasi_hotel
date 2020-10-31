@extends('layouts.backend.app')

@section('title', 'Booking Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Booking</h2>
        <hr class="mb-3 text-white" color="white">
        {{-- <button type="button" class="btn btn-primary mb-5">
            <a href="{{ route('admin.bed.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
        </button> --}}
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap">
              <thead>
                <tr>
                  <th> # </th>
                  <th> user_id </th>
                  <th> name </th>
                  <th> bed_id </th>
                  <th> class_id </th>  
                </tr>
              </thead>
              <tbody>
                @foreach ($bookings as $key=>$booking)
                  <tr>
                    <td> {{ $key + 1 }} </td>
                    <td> {{ $booking->user->name }} </td>
                    <td> {{ $booking->name }} </td>
                    <td> {{ $booking->bed->name }} </td>
                    <td> {{ $booking->class->name }} </td>
                    {{-- <td> 
                      <a href="{{ route('admin.bed.edit',$bed->id) }}" class="btn btn-warning mr-2">Edit</a>  
                      <button class="btn btn-danger" type="button" onclick="deleteBed({{ $bed->id }})">
                        Delete
                      </button>
                      <form id="delete-form-{{ $bed->id }}" action="{{ route('admin.bed.destroy',$bed->id) }}" method="POST" style="display: none;">
                          @csrf
                          @method('DELETE')
                      </form>
                    </td> --}}
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