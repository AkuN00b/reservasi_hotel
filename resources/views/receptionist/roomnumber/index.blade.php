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
    @if (Request::is('receptionist/room-number'))
      <h2 class="mt-1 mb-2">Room Number</h2>
      <hr class="mb-3 garis">

      <button type="button" class="btn btn-primary mb-4">
        <a href="{{ route('receptionist.room-number.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create Request</a> 
      </button>

      <div class="card">
        <div class="card-header" style="background-color: #3c5f8f">
          Room Number Category
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
                      <th> Last Updated by - Time </th>
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
                          <td class="text-success" data-toggle="tooltip" data-placement="bottom" title="@if ($rm->updated_at == NULL)
                            {{ $rm->created_at->format('d-m-Y - H:i:s') }}
                          @else
                            {{ $rm->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> 
                            {{ $rm->user->name }} - 
                            @if ($rm->updated_at == NULL)
                              {{ $rm->created_at->format('d-m-Y') }}
                            @else
                              {{ $rm->updated_at->format('d-m-Y') }}
                            @endif
                          </td>
                        @else
                          <td data-toggle="tooltip" data-placement="bottom" title="@if ($rm->updated_at == NULL)
                            {{ $rm->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $rm->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> 
                            {{ $rm->user->name }} - 
                            @if ($rm->updated_at == NULL)
                              {{ $rm->created_at->format('d-m-Y') }}
                            @else
                              {{ $rm->updated_at->format('d-m-Y') }}
                            @endif
                          </td>
                        @endif
                        <td> 
                          <a href="{{ route('receptionist.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a>   
                          @if ($rm->status == 9)
                            <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Activated {{ $rm->name }} Room Number">
                              <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                            </button>
                            <form id="delete-form-{{ $rm->id }}" action="{{ route('receptionist.room-number.active',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <a href="{{ route('receptionist.room-number.edit',$rm->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBeds({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $rm->name }} Room Number">
                              <i class="mdi mdi-delete"></i>
                            </button>
                            <form id="deletes-form-{{ $rm->id }}" action="{{ route('receptionist.room-number.destroy',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                          @else
                            <button class="btn btn-info mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Deactivated {{ $rm->name }} Room Number">
                              <i class="mdi mdi-close-circle-outline"></i>
                            </button>
                            <form id="delete-form-{{ $rm->id }}" action="{{ route('receptionist.room-number.nonactive',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <a href="javascript::void()" class="btn btn-warning mr-2 isDisabled pl-3 pt-2 pb-2" aria-disabled="true" data-toggle="tooltip" data-placement="bottom" title="Disable to Request Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                            <button class="btn btn-danger pl-3 pt-2 pb-2 isDisabled" type="button" data-toggle="tooltip" data-placement="bottom" title="Disable to Request Delete {{ $rm->name }} Room Number" style="cursor: not-allowed;">
                              <i class="mdi mdi-delete"></i>
                            </button>
                            <form id="delete-form-{{ $rm->id }}" action="{{ route('receptionist.room-number.destroy',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table><br><br>
              </div>
            @else 
              <center class="text-black">No Any Room Number Data</center>
            @endif
        </div>
      </div>
    @else
      <h2 class="mt-1 mb-2">Room Number Request</h2>
      <hr class="mb-3 garis">

      <button type="button" class="btn btn-primary mb-4">
        <a href="{{ route('receptionist.room-number.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create Request</a> 
      </button>

      <div class="card mb-4">
        <div class="card-header bg-primary">
          Your Active Request
        </div>
        <div class="card-body" style="background-color: #8cbae3">
            @if ($roomnumbers->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Room </th>
                      <th> Updated Time </th>
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
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($rm->updated_at == NULL)
                          {{ $rm->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                          {{ $rm->updated_at->format('d-m-Y - H:i:s') }}
                        @endif"> {{ $rm->updated_at->format('d-m-Y') }} 
                        </td>
                        <td> 
                          <a href="{{ route('receptionist.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a>   
                          @if ($rm->status == 9)
                            <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Activated {{ $rm->name }} Room Number">
                              <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                            </button>
                            <form id="delete-form-{{ $rm->id }}" action="{{ route('receptionist.room-number.active',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <a href="{{ route('receptionist.room-number.edit',$rm->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBeds({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $rm->name }} Room Number">
                              <i class="mdi mdi-delete"></i>
                            </button>
                            <form id="deletes-form-{{ $rm->id }}" action="{{ route('receptionist.room-number.destroy',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                          @else
                            <button class="btn btn-info mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $rm->id }})" data-toggle="tooltip" data-placement="bottom" title="Deactivated {{ $rm->name }} Room Number">
                              <i class="mdi mdi-close-circle-outline"></i>
                            </button>
                            <form id="delete-form-{{ $rm->id }}" action="{{ route('receptionist.room-number.nonactive',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <a href="javascript::void()" class="btn btn-warning mr-2 isDisabled pl-3 pt-2 pb-2" aria-disabled="true" data-toggle="tooltip" data-placement="bottom" title="Disable to Request Edit {{ $rm->name }} Room Number"><i class="mdi mdi-pencil"></i></a>  
                            <button class="btn btn-danger pl-3 pt-2 pb-2 isDisabled" type="button" data-toggle="tooltip" data-placement="bottom" title="Disable to Request Delete {{ $rm->name }} Room Number" style="cursor: not-allowed;">
                              <i class="mdi mdi-delete"></i>
                            </button>
                            <form id="delete-form-{{ $rm->id }}" action="{{ route('receptionist.room-number.destroy',$rm->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table><br><br>
              </div>
            @else 
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.room-number.index') }}" class="text-black">Request Here</a></center>
            @endif
        </div>
      </div>
      
      <div class="card mb-4">
        <div class="card-header bg-info">
          Your Recent Request, Wait For Confirmed
        </div>
        <div class="card-body" style="background-color: #c39aef">
          @if ($roomnumber_request->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_idd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Room </th>
                    <th> Updated Time </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roomnumber_request as $key=>$rm)
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
                      @endif"> {{ $rm->updated_at->format('d-m-Y') }} 
                      </td>
                      <td> <a href="{{ route('receptionist.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a> </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request, <a href="{{ route('receptionist.room-number.index') }}" class="text-black">Request Here</a></center>
          @endif
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-success">
          Your Recent Accepted Request
        </div>
        <div class="card-body" style="background-color: #99f2a0">
          @if ($roomnumber_accepted->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_iddd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Room </th>
                    <th> Updated Time </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roomnumber_accepted as $key=>$rm)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $rm->name }} || 
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
                      @endif"> {{ $rm->updated_at->format('d-m-Y') }} 
                      </td>
                      <td> 
                        <a href="{{ route('receptionist.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a>   
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request, <a href="{{ route('receptionist.room-number.index') }}" class="text-black">Request Here</a></center>
          @endif
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-danger">
          Your Recent Canceled Request
        </div>
        <div class="card-body" style="background-color: #e69999">
          @if ($roomnumber_canceled->count() > 0)
            <div class="table-responsive">
              <table class="table table-bordered text-nowrap display" id="table_idddd">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Room </th>
                    <th> Updated Time </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roomnumber_canceled as $key=>$rm)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                      <td> {{ $rm->name }} || 
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
                      @endif"> {{ $rm->updated_at->format('d-m-Y') }} 
                      </td>
                      <td> 
                        <a href="{{ route('receptionist.room-number.show',$rm->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $rm->name }}"><i class="mdi mdi-eye"></i></a>   
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <center class="text-black">No Any Request, <a href="{{ route('receptionist.room-number.index') }}" class="text-black">Request Here</a></center>
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
<script type="text/javascript">
  function deleteBeds(id) {
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