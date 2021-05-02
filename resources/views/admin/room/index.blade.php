@extends('layouts.backend.app')

@section('title', 'Room Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
  <div class="container">
    @if (Request::is('admin/room'))
      <h2 class="mt-1 mb-2">Room</h2>
      <hr class="mb-3 garis">

      <button type="button" class="btn btn-primary mb-5">
        <a href="{{ route('admin.room.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
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
                    <th> Last Updated by - Time </th>
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
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($room->updated_at == NULL)
                          {{ $room->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                            {{ $room->updated_at->format('d-m-Y - H:i:s') }}
                        @endif">
                          <a href="{{ route('admin.user.show',$room->user->id) }}" class="text-success">
                            {{ $room->user->name }} - 
                            @if ($room->updated_at == NULL)
                              {{ $room->created_at->format('d-m-Y') }}
                            @else
                              {{ $room->updated_at->format('d-m-Y') }}
                            @endif
                          </a> 
                        </td>
                      @else
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($room->updated_at == NULL)
                          {{ $room->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                            {{ $room->updated_at->format('d-m-Y - H:i:s') }}
                        @endif"> 
                          <a href="{{ route('admin.user.show',$room->user->id) }}" class="text-black">
                            {{ $room->user->name }} - 
                            @if ($room->updated_at == NULL)
                              {{ $room->created_at->format('d-m-Y') }}
                            @else
                              {{ $room->updated_at->format('d-m-Y') }}
                            @endif
                          </a>
                        </td>
                      @endif
                      <td>
                        <a href="{{ route('admin.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a>   
                        <a href="{{ route('admin.room.edit',$room->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-pencil"></i></a>  
                        <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Delete {{ $room->class->name }}({{ $room->bed->name }})">
                          <i class="mdi mdi-close"></i>
                        </button>
                        <form id="delete-form-{{ $room->id }}" action="{{ route('admin.room.requestdelete',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Data</center>
          @endif
        </div>
      </div>
    @else
      <h2 class="mt-1 mb-2">Room Request</h2>
      <hr class="mb-3 garis">

      <div class="card mb-4">
        <div class="card-header bg-info">
          Request for Confirm
        </div>
        <div class="card-body" style="background-color: #d2b4f2">
          @if ($rooms->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_id">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Price </th>
                    <th> Request By </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($rooms as $key=>$room)
                  <tr class="text-black">
                    <td> {{ $key + 1 }} </td>
                      <td> {{ $room->class->name }}({{ $room->bed->name }}) ||
                        @if ($room->room_id == NULL)
                          <sup><span class="badge badge-pill badge-primary" style="font-size: 10px;">Create Req.</span></sup> 
                        @else
                          @if ($room->slug == !NULL)
                            <sup><span class="badge badge-pill badge-warning" style="font-size: 10px;">Edit Req.</span></sup> 
                          @else
                            <sup><span class="badge badge-pill badge-danger" style="font-size: 10px;">Delete Req.</span></sup> 
                          @endif
                        @endif
                      </td>
                      <td> @uang($room->price) </td>
                      <td data-toggle="tooltip" data-placement="bottom" title="@if ($room->updated_at == NULL)
                        {{ $room->created_at->format('d-m-Y - H:i:s') }}
                      @else 
                          {{ $room->updated_at->format('d-m-Y - H:i:s') }}
                      @endif"> 
                        <a href="{{ route('admin.user.show',$room->user_id) }}" class="text-warning" style="text-decoration: none;">
                          {{ $room->user->name }} - 
                          @if ($room->updated_at == NULL)
                            {{ $room->created_at->format('d-m-Y') }}
                          @else
                            {{ $room->updated_at->format('d-m-Y') }}
                          @endif
                        </a> 
                      </td>
                      <td> 
                        <a href="{{ route('admin.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a>   
                        @if ($room->room_id == NULL)
                          <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $room->class->name }}({{ $room->bed->name }}) Create Request. From {{ $room->user->name }}.">
                            <i class="mdi mdi-check"></i>
                          </button>
                          <form id="check-form-{{ $room->id }}" action="{{ route('admin.room.requestcreate',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                              @method('PUT')
                              <input type="text" name="slug" value="Create Req.">
                          </form>
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $room->class->name }}({{ $room->bed->name }}) Create Request. From {{ $room->user->name }}.">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="cancel-form-{{ $room->id }}" action="{{ route('admin.room.requestcancel',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                              <input type="text" name="slug" value="Create Req.">
                          </form>
                        @elseif ($room->slug == !NULL)
                          <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $room->class->name }}({{ $room->bed->name }}) Edit Request. From {{ $room->user->name }}.">
                            <i class="mdi mdi-check"></i>
                          </button>
                          <form id="check-form-{{ $room->id }}" action="{{ route('admin.room.requestedit',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="slug" value="Edit Req.">
                          </form>
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $room->class->name }}({{ $room->bed->name }}) Edit Request. From {{ $room->user->name }}.">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="cancel-form-{{ $room->id }}" action="{{ route('admin.room.requestcancel',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="slug" value="Edit Req.">
                          </form>
                        @else
                          <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $room->class->name }}({{ $room->bed->name }}) Delete Request. From {{ $room->user->name }}.">
                            <i class="mdi mdi-check"></i>
                          </button>
                          <form id="check-form-{{ $room->id }}" action="{{ route('admin.room.requestdelete',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="slug" value="Delete Req.">
                          </form>
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $room->class->name }}({{ $room->bed->name }}) Delete Request. From {{ $room->user->name }}.">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="cancel-form-{{ $room->id }}" action="{{ route('admin.room.requestcancel',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="slug" value="Delete Req.">
                          </form>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request</center>
          @endif
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-primary">
          Active Request
        </div>
        <div class="card-body" style="background-color: #99bff0">
          <div class="table-responsive">
            <table class="table table-bordered text-nowrap display" id="table_idd">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Name </th>
                  <th> Price </th>
                  <th> Request By </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach ($room_active as $room)
                  @if ($room->user->role->id == 2)
                    <tr class="text-black">
                      <td> {{ $no++ }} </td>
                      <td> {{ $room->class->name }}({{ $room->bed->name }}) </td>
                      <td> @uang($room->price) </td>
                      <td data-toggle="tooltip" data-placement="bottom" title="@if ($room->updated_at == NULL)
                        {{ $room->created_at->format('d-m-Y - H:i:s') }}
                      @else 
                          {{ $room->updated_at->format('d-m-Y - H:i:s') }}
                      @endif"> 
                        <a href="{{ route('admin.user.show',$room->user_id) }}" class="text-warning" style="text-decoration: none;">
                          {{ $room->user->name }} - 
                          @if ($room->updated_at == NULL)
                            {{ $room->created_at->format('d-m-Y') }}
                          @else
                            {{ $room->updated_at->format('d-m-Y') }}
                          @endif
                        </a> 
                      </td>
                      <td> 
                        <a href="{{ route('admin.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a>   
                        <a href="{{ route('admin.room.edit',$room->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-pencil"></i></a>  
                        <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteRoom({{ $room->id }})" data-toggle="tooltip" data-placement="bottom" title="Delete {{ $room->class->name }}({{ $room->bed->name }})">
                          <i class="mdi mdi-close"></i>
                        </button>
                        <form id="delete-form-{{ $room->id }}" action="{{ route('admin.room.destroy',$room->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-success">
          Accepted Request
        </div>
        <div class="card-body" style="background-color: #8cd492">
          @if ($room_accepted->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_iddd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Price </th>
                    <th> Request By </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($room_accepted as $key=>$room)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $room->class->name }}({{ $room->bed->name }}) || 
                        @if ($room->slug == 'Create Req.')
                          <strong class="text-primary">Create Request.</strong>
                        @elseif ($room->slug == 'Edit Req.')
                          <strong class="text-warning">Edit Request.</strong>
                        @elseif ($room->slug == 'Delete Req.')
                          <strong class="text-danger">Delete Request.</strong>
                        @endif
                      </td>
                      <td> @uang($room->price) </td>
                      <td data-toggle="tooltip" data-placement="bottom" title="@if ($room->updated_at == NULL)
                        {{ $room->created_at->format('d-m-Y - H:i:s') }}
                      @else 
                          {{ $room->updated_at->format('d-m-Y - H:i:s') }}
                      @endif"> 
                        <a href="{{ route('admin.user.show',$room->user_id) }}" class="text-warning" style="text-decoration: none;">
                          {{ $room->user->name }} - 
                          @if ($room->updated_at == NULL)
                            {{ $room->created_at->format('d-m-Y') }}
                          @else
                            {{ $room->updated_at->format('d-m-Y') }}
                          @endif
                        </a> 
                      </td>
                      <td><a href="{{ route('admin.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request</center>
          @endif
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-danger">
          Canceled Request
        </div>
        <div class="card-body" style="background-color: #e89e9e">
          @if ($room_canceled->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_idddd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Price </th>
                    <th> Request By </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($room_canceled as $key=>$room)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $room->class->name }}({{ $room->bed->name }}) || 
                        @if ($room->slug == 'Create Req.')
                          <strong class="text-primary">Create Request.</strong>
                        @elseif ($room->slug == 'Edit Req.')
                          <strong class="text-warning">Edit Request.</strong>
                        @elseif ($room->slug == 'Delete Req.')
                          <strong class="text-danger">Delete Request.</strong>
                        @endif
                      </td>
                      <td> @uang($room->price) </td>
                      <td data-toggle="tooltip" data-placement="bottom" title="@if ($room->updated_at == NULL)
                        {{ $room->created_at->format('d-m-Y - H:i:s') }}
                      @else 
                          {{ $room->updated_at->format('d-m-Y - H:i:s') }}
                      @endif"> 
                        <a href="{{ route('admin.user.show',$room->user_id) }}" class="text-warning" style="text-decoration: none;">
                          {{ $room->user->name }} - 
                          @if ($room->updated_at == NULL)
                            {{ $room->created_at->format('d-m-Y') }}
                          @else
                            {{ $room->updated_at->format('d-m-Y') }}
                          @endif
                        </a> 
                      </td>
                      <td><a href="{{ route('admin.room.show',$room->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $room->class->name }}({{ $room->bed->name }})"><i class="mdi mdi-eye"></i></a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request</center>
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
  function cancelRoom(id) {
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
          document.getElementById('cancel-form-'+id).submit();
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
  function createRoom(id) {
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
          document.getElementById('check-form-'+id).submit();
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