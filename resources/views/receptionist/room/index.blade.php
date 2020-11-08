@extends('layouts.backend.app')

@section('title', 'Room Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Room</h2>
        <hr class="mb-3 text-white" color="white">
        {{-- <button type="button" class="btn btn-primary mb-5">
            <a href="{{ route('admin.room.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
        </button> --}}
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Name </th>
                  <th> Price </th>
                  {{-- <th> Action </th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($rooms as $key=>$room)
                  <tr>
                    <td> {{ $key + 1 }} </td>
                    <td> {{ $room->class->name }} ({{ $room->bed->name }}) </td>
                    <td> @uang($room->price) </td>
                    {{-- <td> 
                      <a href="{{ route('admin.room.edit',$room->id) }}" class="btn btn-warning mr-2">Edit</a>  
                      <button class="btn btn-danger" type="button" onclick="deleteRoom({{ $room->id }})">
                        Delete
                      </button>
                      <form id="delete-form-{{ $room->id }}" action="{{ route('admin.room.destroy',$room->id) }}" method="POST" style="display: none;">
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
    function deleteRoom(id) {
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