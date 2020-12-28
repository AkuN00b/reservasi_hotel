@extends('layouts.backend.app')

@section('title', 'Room Number List Index -')

@push('css')
  <style type="text/css">
    .isDisabled {
      color: currentColor;
      cursor: not-allowed;
      opacity: 0.5;
      text-decoration: none;
    }
  </style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Room Number List</h2>
        <hr class="mb-3 garis">
        <button type="button" class="btn btn-primary mb-5">
            <a href="{{ route('admin.room-number.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
        </button>
        <div class="card">
          <div class="card-header" style="background-color: #3c5f8f">
            Room Number List
          </div>
          <div class="card-body" style="background-color: #aec9ef">
            <div class="table-responsive">
              @if ($roomnumbers->count() > 0)
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Room </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($roomnumbers as $key=>$rm)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> 
                          @if ($rm->status == 1)
                            {{ $rm->name }} <sup><span class="badge badge-pill badge-success" style="font-size: 10px;">Active</span></sup> 
                          @elseif ($rm->status == 0)
                            {{ $rm->name }} <sup><span class="badge badge-pill badge-danger" style="font-size: 10px;">Non-Active</span></sup> 
                          @endif
                        </td>
                        <td> {{ $rm->room->class->name }} ({{ $rm->room->bed->name }}) </td>
                        <td> 
                          @if ($rm->status == 1)
                            <a href="{{ route('admin.room-number.edit',$rm->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteRoomNumber({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Delete {{ $rm->name }} Room Number">
                              <i class="mdi mdi-delete"></i>
                            </button>
                            <form id="delete-form-{{ $rm->id }}" action="{{ route('admin.room-number.destroy',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                          @else
                            <a href="javascript::void()" class="btn btn-warning mr-2 isDisabled pl-3 pt-2 pb-2" aria-disabled="true" data-toggle="tooltip" data-placement="bottom" title="Disable to Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteRoomNumber({{ $rm->id }})" disabled data-toggle="tooltip" data-placement="bottom" title="Disable to Delete {{ $rm->name }} Room Number">
                              <i class="mdi mdi-delete"></i>
                            </button>
                            <form id="delete-form-{{ $rm->id }}" action="{{ route('admin.room-number.destroy',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table><br><br>
              @else 
                <p class="text-center">Sorry, Data is Not Available</p>
              @endif
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function deleteRoomNumber(id) {
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