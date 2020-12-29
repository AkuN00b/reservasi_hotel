@extends('layouts.backend.app')

@section('title', 'Room Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
  <div class="container">
    @if (Request::is('receptionist/room'))
      <h2 class="mt-1 mb-2">Room</h2>
      <hr class="mb-3 garis">

      <button type="button" class="btn btn-primary mb-4">
        <a href="{{ route('receptionist.room.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create Request</a> 
      </button>

      <div class="card">
        <div class="card-header" style="background-color: #3c5f8f">
          Room Category
        </div>
        <div class="card-body" style="background-color: #aec9ef">
          @if ($rooms->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_id">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Price </th>
                    <th> Last Updated by </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rooms as $key=>$room)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $room->class->name }}({{ $room->bed->name }}) </td>
                      <td> @uang($room->price) </td>
                      @if (Auth::user()->name == $room->user->name)
                        <td class="text-success"> {{ $room->user->name }} </td>
                      @else
                        <td> {{ $room->user->name }} </td>
                      @endif
                      <td> 
                        <a href="{{ route('receptionist.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a>   
                        <a href="{{ route('receptionist.room.edit',$room->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-pencil"></i></a>  
                        <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $room->class->name }}({{ $room->bed->name }})">
                          <i class="mdi mdi-close"></i>
                        </button>
                        <form id="delete-form-{{ $room->id }}" action="{{ route('receptionist.room.requestdelete',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Room Data, <a href="{{ route('receptionist.room.create') }}" class="text-black">Request Here</a></center>
          @endif
        </div>
      </div>
    @else
      <h2 class="mt-1 mb-2">Room Request</h2>
      <hr class="mb-3 garis">

      <button type="button" class="btn btn-primary mb-4">
        <a href="{{ route('receptionist.room.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create Request</a> 
      </button>

      <div class="card mb-4">
        <div class="card-header bg-primary">
          Your Active Request
        </div>
        <div class="card-body" style="background-color: #8cbae3">
          @if ($rooms->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_id">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Price </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rooms as $key=>$room)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $room->class->name }}({{ $room->bed->name }}) </td>
                      <td> @uang($room->price) </td>
                      <td> 
                        <a href="{{ route('receptionist.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a>   
                        <a href="{{ route('receptionist.room.edit',$room->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-pencil"></i></a>  
                        <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $room->class->name }}({{ $room->bed->name }})">
                          <i class="mdi mdi-close"></i>
                        </button>
                        <form id="delete-form-{{ $room->id }}" action="{{ route('receptionist.room.requestdelete',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request, <a href="{{ route('receptionist.room.index') }}" class="text-black">Request Here</a></center>
          @endif
        </div>
      </div>
      
      <div class="card mb-4">
        <div class="card-header bg-info">
          Your Recent Request, Wait For Confirmed
        </div>
        <div class="card-body" style="background-color: #c39aef">
          @if ($room_request->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_idd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Price </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($room_request as $key=>$room)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $room->class->name }}({{ $room->bed->name }}) || 
                        @if ($room->room_id == NULL)
                          <strong class="text-primary">Create Request. Wait for Confirmed. Thanks for Request :))</strong>
                        @else
                          @if ($room->slug == !NULL)
                            <strong class="text-warning">Edit Request. Wait for Confirmed. Thanks for Request :))</strong>
                          @else
                            <strong class="text-danger">Delete Request. Wait for Confirmed. Thanks for Request :))</strong>
                          @endif
                        @endif
                      </td>
                      <td> @uang($room->price) </td>
                      <td> <a href="{{ route('receptionist.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a> </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request, <a href="{{ route('receptionist.room.index') }}" class="text-black">Request Here</a></center>
          @endif
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-success">
          Your Recent Accepted Request
        </div>
        <div class="card-body" style="background-color: #99f2a0">
          @if ($room_accepted->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_iddd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Price </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($room_accepted as $key=>$room)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $room->class->name }}({{ $room->bed->name }}) || 
                        @if ($room->slug == 'Create Req.')
                          <strong class="text-primary">Create Request. Thanks for Request :))</strong>
                        @elseif ($room->slug == 'Edit Req.')
                          <strong class="text-warning">Edit Request. Thanks for Request :))</strong>
                        @elseif ($room->slug == 'Delete Req.')
                          <strong class="text-danger">Delete Request. Thanks for Request :))</strong>
                        @endif
                      </td>
                      <td> @uang($room->price) </td>
                      <td> <a href="{{ route('receptionist.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a> </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request, <a href="{{ route('receptionist.room.index') }}" class="text-black">Request Here</a></center>
          @endif
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-danger">
          Your Recent Canceled Request
        </div>
        <div class="card-body" style="background-color: #e69999">
          @if ($room_canceled->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_idddd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Price </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($room_canceled as $key=>$room)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $room->class->name }}({{ $room->bed->name }}) || 
                        @if ($room->slug == 'Create Req.')
                          <strong class="text-primary">Create Request. Thanks for Request :))</strong>
                        @elseif ($room->slug == 'Edit Req.')
                          <strong class="text-warning">Edit Request. Thanks for Request :))</strong>
                        @elseif ($room->slug == 'Delete Req.')
                          <strong class="text-danger">Delete Request. Thanks for Request :))</strong>
                        @endif
                      </td>
                      <td> @uang($room->price) </td>
                      <td> <a href="{{ route('receptionist.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a> </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request, <a href="{{ route('receptionist.room.index') }}" class="text-black">Request Here</a></center>
          @endif
        </div>
      </div>
    @endif
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