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
    @if (Request::is('admin/room-number'))
      <h2 class="mt-1 mb-2">Room Number</h2>
      <hr class="mb-3 garis">

      <button type="button" class="btn btn-primary mb-5">
        <a href="{{ route('admin.room-number.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
      </button>
      
      <div class="card">
        <div class="card-header" style="background-color: #3c5f8f">
          Room Category
        </div>
        <div class="card-body" style="background-color: #aec9ef">
          @if ($roomnumbers->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_id">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Room </th>
                    <th> Last Updated By - Time </th>
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
                          {{ $rm->name }} <sup><span class="badge badge-pill badge-danger" style="font-size: 10px;">Booked</span></sup> 
                        @elseif ($rm->status == 9)
                          {{ $rm->name }} <sup><span class="badge badge-pill badge-info" style="font-size: 10px;">Non-Active</span></sup> 
                        @endif
                      </td>
                      <td> {{ $rm->room->class->name }} ({{ $rm->room->bed->name }}) </td>
                      @if (Auth::user()->name == $rm->user->name)
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($rm->updated_at == NULL)
                          {{ $rm->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                            {{ $rm->updated_at->format('d-m-Y - H:i:s') }}
                        @endif">
                          <a href="{{ route('admin.user.show',$rm->user->id) }}" class="text-success">
                            {{ $rm->user->name }} - 
                            @if ($rm->updated_at == NULL)
                              {{ $rm->created_at->format('d-m-Y') }}
                            @else
                              {{ $rm->updated_at->format('d-m-Y') }}
                            @endif
                          </a> 
                        </td>
                      @else
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($rm->updated_at == NULL)
                          {{ $rm->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                            {{ $rm->updated_at->format('d-m-Y - H:i:s') }}
                        @endif"> 
                          <a href="{{ route('admin.user.show',$rm->user->id) }}" class="text-black">
                            {{ $rm->user->name }} - 
                            @if ($rm->updated_at == NULL)
                              {{ $rm->created_at->format('d-m-Y') }}
                            @else
                              {{ $rm->updated_at->format('d-m-Y') }}
                            @endif
                          </a>
                        </td>
                      @endif
                      <td> 
                        <a href="{{ route('admin.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a>   
                        @if ($rm->status == 9)
                          <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteRoomNumber({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Activated {{ $rm->name }} Room Number">
                            <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                          </button>
                          <form id="deletes-form-{{ $rm->id }}" action="{{ route('admin.room-number.active',$rm->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          <a href="{{ route('admin.room-number.edit',$rm->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteRoom({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Delete {{ $rm->name }} Room Number">
                            <i class="mdi mdi-delete"></i>
                          </button>
                          <form id="delete-form-{{ $rm->id }}" action="{{ route('admin.room-number.destroy',$rm->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
                          </form>
                        @else
                          <button class="btn btn-info mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteRoomNumber({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Deactivated {{ $rm->name }} Room Number">
                            <i class="mdi mdi-close-circle-outline"></i>
                          </button>
                          <form id="deletes-form-{{ $rm->id }}" action="{{ route('admin.room-number.nonactive',$rm->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          <a href="javascript::void()" class="btn btn-warning mr-2 isDisabled mr-2 pl-3 pt-2 pb-2" aria-disabled="true" data-toggle="tooltip" data-placement="bottom" title="Disable to Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                          <button class="btn btn-danger pl-3 pt-2 pb-2 isDisabled" type="button" data-toggle="tooltip" data-placement="bottom" title="Disable to Delete {{ $rm->name }} Room Number" style="cursor: not-allowed;">
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
              </table>
            </div>
          @else
            <center class="text-black">No Any Data</center>
          @endif
        </div>
      </div>
    @else
      <h2 class="mt-1 mb-2">Room Number Request</h2>
      <hr class="mb-3 garis">

      <div class="card mb-4">
        <div class="card-header bg-info">
          Request for Confirm
        </div>
        <div class="card-body" style="background-color: #d2b4f2">
          @if ($roomnumbers->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_id">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Room </th>
                    <th> Request By </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roomnumbers as $key=>$rm)
                  <tr class="text-black">
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> 
                        {{ $rm->name }} || 
                        @if ($rm->room_number_id == NULL)
                          <strong class="text-primary">Create Request. Wait for Confirmed. Thanks for Request :))</strong>
                        @else
                          @if ($rm->status == 'Edit Req.')
                            <strong class="text-warning">Edit Request. Wait for Confirmed. Thanks for Request :))</strong>
                          @else
                            <strong class="text-danger">Delete Request. Wait for Confirmed. Thanks for Request :))</strong>
                          @endif
                        @endif
                      </td>
                      <td> {{ $rm->room->class->name }} ({{ $rm->room->bed->name }}) </td>
                      <td data-toggle="tooltip" data-placement="bottom" title="@if ($rm->updated_at == NULL)
                        {{ $rm->created_at->format('d-m-Y - H:i:s') }}
                      @else 
                          {{ $rm->updated_at->format('d-m-Y - H:i:s') }}
                      @endif"> 
                        <a href="{{ route('admin.user.show',$rm->user_id) }}" class="text-warning" style="text-decoration: none;">
                          {{ $rm->user->name }} - 
                          @if ($rm->updated_at == NULL)
                            {{ $rm->created_at->format('d-m-Y') }}
                          @else
                            {{ $rm->updated_at->format('d-m-Y') }}
                          @endif
                        </a> 
                      </td>
                      <td> 
                        <a href="{{ route('admin.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a>   
                        @if ($rm->room_number_id == NULL)
                          <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createRoom({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $rm->name }} Create Req. From {{ $rm->user->name }}.">
                            <i class="mdi mdi-check"></i>
                          </button>
                          <form id="check-form-{{ $rm->id }}" action="{{ route('admin.room-number.requestcreate',$rm->id) }}" method="POST" style="display: none;">
                            @csrf
                              @method('PUT')
                              <input type="text" name="status" value="Create Req.">
                          </form>
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelRoom({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $rm->name }} Create Req. From {{ $rm->user->name }}.">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="cancel-form-{{ $rm->id }}" action="{{ route('admin.room-number.requestcancel',$rm->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                              <input type="text" name="status" value="Create Req.">
                          </form>
                        @elseif ($rm->status == 'Edit Req.')
                          <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createRoom({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $rm->name }} Edit Req. From {{ $rm->user->name }}.">
                            <i class="mdi mdi-check"></i>
                          </button>
                          <form id="check-form-{{ $rm->id }}" action="{{ route('admin.room-number.requestedit',$rm->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            @if($rm->name == $rm->room_number->name)
                              <input type="text" name="name" value="{{ $rm->room_number->name }}">
                            @else
                              <input type="text" name="name" value="{{ $rm->name }}">
                            @endif
                            <input type="text" name="status" value="Edit Req.">
                          </form>
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelRoom({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $rm->name }} Edit Req. From {{ $rm->user->name }}.">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="cancel-form-{{ $rm->id }}" action="{{ route('admin.room-number.requestcancel',$rm->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="status" value="Edit Req.">
                          </form>
                        @else
                          <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createRoom({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $rm->name }} Delete Req. From {{ $rm->user->name }}.">
                            <i class="mdi mdi-check"></i>
                          </button>
                          <form id="check-form-{{ $rm->id }}" action="{{ route('admin.room-number.requestdelete',$rm->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="status" value="Delete Req.">
                          </form>
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelRoom({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $rm->name }} Delete Req. From {{ $rm->user->name }}.">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="cancel-form-{{ $rm->id }}" action="{{ route('admin.room-number.requestcancel',$rm->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="status" value="Delete Req.">
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
                  <th> Room </th>
                  <th> Request By </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach ($roomnumber_active as $rm)
                  @if ($rm->user->role->id == 2)
                    <tr class="text-black">
                      <td> {{ $no++ }} </td>
                      <td> 
                        @if ($rm->status == 1)
                          {{ $rm->name }} <sup><span class="badge badge-pill badge-success" style="font-size: 10px;">Active</span></sup> 
                        @elseif ($rm->status == 0)
                          {{ $rm->name }} <sup><span class="badge badge-pill badge-danger" style="font-size: 10px;">Booked</span></sup> 
                        @elseif ($rm->status == 9)
                          {{ $rm->name }} <sup><span class="badge badge-pill badge-info" style="font-size: 10px;">Non-Active</span></sup> 
                        @endif
                      </td>
                      <td> {{ $rm->room->class->name }} ({{ $rm->room->bed->name }}) </td>
                      <td data-toggle="tooltip" data-placement="bottom" title="@if ($rm->updated_at == NULL)
                        {{ $rm->created_at->format('d-m-Y - H:i:s') }}
                      @else 
                          {{ $rm->updated_at->format('d-m-Y - H:i:s') }}
                      @endif"> 
                        <a href="{{ route('admin.user.show',$rm->user_id) }}" class="text-warning" style="text-decoration: none;">
                          {{ $rm->user->name }} - 
                          @if ($rm->updated_at == NULL)
                            {{ $rm->created_at->format('d-m-Y') }}
                          @else
                            {{ $rm->updated_at->format('d-m-Y') }}
                          @endif
                        </a> 
                      </td>
                      <td> 
                        <a href="{{ route('admin.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a>   
                        @if ($rm->status == 9)
                          <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteRoomNumber({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Activated {{ $rm->name }} Room Number">
                            <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                          </button>
                          <form id="deletes-form-{{ $rm->id }}" action="{{ route('admin.room-number.active',$rm->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          <a href="{{ route('admin.room-number.edit',$rm->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteRoom({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Delete {{ $rm->name }} Room Number">
                            <i class="mdi mdi-delete"></i>
                          </button>
                          <form id="delete-form-{{ $rm->id }}" action="{{ route('admin.room-number.destroy',$rm->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
                          </form>
                        @else
                          <button class="btn btn-info mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteRoomNumber({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Deactivated {{ $rm->name }} Room Number">
                            <i class="mdi mdi-close-circle-outline"></i>
                          </button>
                          <form id="deletes-form-{{ $rm->id }}" action="{{ route('admin.room-number.nonactive',$rm->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          <a href="javascript::void()" class="btn btn-warning mr-2 isDisabled pl-3 pt-2 pb-2" aria-disabled="true" data-toggle="tooltip" data-placement="bottom" title="Disable to Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                          <button class="btn btn-danger pl-3 pt-2 pb-2 isDisabled" type="button" data-toggle="tooltip" data-placement="bottom" title="Disable to Delete {{ $rm->name }} Room Number" style="cursor: not-allowed;">
                            <i class="mdi mdi-delete"></i>
                          </button>
                          <form id="delete-form-{{ $rm->id }}" action="{{ route('admin.room-number.destroy',$rm->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
                          </form>
                        @endif
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
          @if ($roomnumber_accepted->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_iddd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Room </th>
                    <th> Request By </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roomnumber_accepted as $key=>$rm)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> 
                        {{ $rm->name }} || 
                        @if ($rm->status == 'Create Req.')
                          <strong class="text-primary">Create Request.</strong>
                        @elseif ($rm->status == 'Edit Req.')
                          <strong class="text-warning">Edit Request.</strong>
                        @elseif ($rm->status == 'Delete Req.')
                          <strong class="text-danger">Delete Request.</strong>
                        @endif
                      </td>
                      <td> {{ $rm->room->class->name }} ({{ $rm->room->bed->name }}) </td>
                      <td data-toggle="tooltip" data-placement="bottom" title="@if ($rm->updated_at == NULL)
                        {{ $rm->created_at->format('d-m-Y - H:i:s') }}
                      @else 
                          {{ $rm->updated_at->format('d-m-Y - H:i:s') }}
                      @endif"> 
                        <a href="{{ route('admin.user.show',$rm->user_id) }}" class="text-warning" style="text-decoration: none;">
                          {{ $rm->user->name }} - 
                          @if ($rm->updated_at == NULL)
                            {{ $rm->created_at->format('d-m-Y') }}
                          @else
                            {{ $rm->updated_at->format('d-m-Y') }}
                          @endif
                        </a> 
                      </td>
                      <td> 
                        <a href="{{ route('admin.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a>
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
        <div class="card-header bg-danger">
          Canceled Request
        </div>
        <div class="card-body" style="background-color: #e89e9e">
          @if ($roomnumber_canceled->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_idddd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Room </th>
                    <th> Request By </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roomnumber_canceled as $key=>$rm)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> 
                        {{ $rm->name }} || 
                        @if ($rm->status == 'Create Req.')
                          <strong class="text-primary">Create Request.</strong>
                        @elseif ($rm->status == 'Edit Req.')
                          <strong class="text-warning">Edit Request.</strong>
                        @elseif ($rm->status == 'Delete Req.')
                          <strong class="text-danger">Delete Request.</strong>
                        @endif
                      </td>
                      <td> {{ $rm->room->class->name }} ({{ $rm->room->bed->name }}) </td>
                      <td data-toggle="tooltip" data-placement="bottom" title="@if ($rm->updated_at == NULL)
                        {{ $rm->created_at->format('d-m-Y - H:i:s') }}
                      @else 
                          {{ $rm->updated_at->format('d-m-Y - H:i:s') }}
                      @endif"> 
                        <a href="{{ route('admin.user.show',$rm->user_id) }}" class="text-warning" style="text-decoration: none;">
                          {{ $rm->user->name }} - 
                          @if ($rm->updated_at == NULL)
                            {{ $rm->created_at->format('d-m-Y') }}
                          @else
                            {{ $rm->updated_at->format('d-m-Y') }}
                          @endif
                        </a> 
                      </td>
                      <td> 
                        <a href="{{ route('admin.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a>
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
          document.getElementById('deletes-form-'+id).submit();
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