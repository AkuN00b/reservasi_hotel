@extends('layouts.backend.app')

@section('title', 'Bed Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
      @if (Request::is('receptionist/bed'))
        <h2 class="mt-1 mb-2">Bed</h2>
        <hr class="mb-3 garis">

        <button type="button" class="btn btn-primary mb-4">
          <a href="{{ route('receptionist.bed.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create Request</a> 
        </button>

        <div class="card">
          <div class="card-header" style="background-color: #3c5f8f">
            Bed Category
          </div>
          <div class="card-body" style="background-color: #aec9ef">
            @if ($beds->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Amount of Person </th>
                      <th> Last Updated by - Time </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($beds as $key=>$bed)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $bed->name }} </td>
                        <td> {{ $bed->person }} </td>
                        @if (Auth::user()->name == $bed->user->name)
                          <td class="text-success" data-toggle="tooltip" data-placement="bottom" title="@if ($bed->updated_at == NULL)
                              {{ $bed->created_at->format('d-m-Y - H:i:s') }}
                          @else
                              {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> 
                            {{ $bed->user->name }} - 
                            @if ($bed->updated_at == NULL)
                               {{ $bed->created_at->format('d-m-Y') }}
                            @else
                               {{ $bed->updated_at->format('d-m-Y') }}
                            @endif
                          </td>
                        @else
                          <td data-toggle="tooltip" data-placement="bottom" title="@if ($bed->updated_at == NULL)
                              {{ $bed->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> 
                            {{ $bed->user->name }} - 
                            @if ($bed->updated_at == NULL)
                              {{ $bed->created_at->format('d-m-Y') }}
                            @else
                              {{ $bed->updated_at->format('d-m-Y') }}
                            @endif
                          </td>
                        @endif
                        <td> 
                          <a href="{{ route('receptionist.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a>   
                          <a href="{{ route('receptionist.bed.edit',$bed->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit {{ $bed->name }}"><i class="mdi mdi-pencil"></i></a>  
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $bed->name }}">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="delete-form-{{ $bed->id }}" action="{{ route('receptionist.bed.requestdelete',$bed->id) }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Bed Data</center>
            @endif
          </div>
        </div>
      @else
        <h2 class="mt-1 mb-2">Bed Request</h2>
        <hr class="mb-3 garis">

        <button type="button" class="btn btn-primary mb-4">
          <a href="{{ route('receptionist.bed.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create Request</a> 
        </button>

        <div class="card mb-4">
          <div class="card-header bg-primary">
            Your Active Request
          </div>
          <div class="card-body" style="background-color: #8cbae3">
            @if ($beds->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Amount of Person </th>
                      <th> Updated Time </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($beds as $key=>$bed)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $bed->name }} </td>
                        <td> {{ $bed->person }} </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($bed->updated_at == NULL)
                              {{ $bed->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> {{ $bed->updated_at->format('d-m-Y') }} 
                        </td>
                        <td> 
                          <a href="{{ route('receptionist.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a>   
                          <a href="{{ route('receptionist.bed.edit',$bed->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit {{ $bed->name }}"><i class="mdi mdi-pencil"></i></a>  
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $bed->name }}">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="delete-form-{{ $bed->id }}" action="{{ route('receptionist.bed.requestdelete',$bed->id) }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.bed.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>
        
        <div class="card mb-4">
          <div class="card-header bg-info">
            Your Recent Request, Wait For Confirmed
          </div>
          <div class="card-body" style="background-color: #c39aef">
            @if ($bed_request->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Amount of Person </th>
                      <th> Created Time </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($bed_request as $key=>$bed)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $bed->name }} || 
                          @if ($bed->bed_id == NULL)
                            <strong class="text-primary">Create Request. Wait for Confirmed. Thanks for Request :))</strong>
                          @else
                            @if ($bed->slug == !NULL)
                              <strong class="text-warning">Edit Request. Wait for Confirmed. Thanks for Request :))</strong>
                            @else
                              <strong class="text-danger">Delete Request. Wait for Confirmed. Thanks for Request :))</strong>
                            @endif
                          @endif
                        </td>
                        <td> {{ $bed->person }} </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($bed->updated_at == NULL)
                              {{ $bed->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> {{ $bed->created_at->format('d-m-Y') }} 
                        </td>
                        <td> <a href="{{ route('receptionist.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.bed.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header bg-success">
            Your Recent Accepted Request
          </div>
          <div class="card-body" style="background-color: #99f2a0">
            @if ($bed_accepted->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_iddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Amount of Person </th>
                      <th> Updated Time </th>
                      <th> Info </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($bed_accepted as $key=>$bed)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $bed->name }} || 
                          @if ($bed->slug == 'Create Req.')
                            <strong class="text-primary">Create Request.</strong>
                          @elseif ($bed->slug == 'Edit Req.')
                            <strong class="text-warning">Edit Request.</strong>
                          @elseif ($bed->slug == 'Delete Req.')
                            <strong class="text-danger">Delete Request.</strong>
                          @endif
                        </td>
                        <td> {{ $bed->person }} </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($bed->updated_at == NULL)
                              {{ $bed->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> {{ $bed->updated_at->format('d-m-Y') }} 
                        </td>
                        <td> <a href="{{ route('receptionist.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.bed.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header bg-danger">
            Your Recent Canceled Request
          </div>
          <div class="card-body" style="background-color: #e69999">
            @if ($bed_canceled->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Amount of Person </th>
                      <th> Updated Time </th>
                      <th> Info </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($bed_canceled as $key=>$bed)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $bed->name }} || 
                          @if ($bed->slug == 'Create Req.')
                            <strong class="text-primary">Create Request.</strong>
                          @elseif ($bed->slug == 'Edit Req.')
                            <strong class="text-warning">Edit Request.</strong>
                          @elseif ($bed->slug == 'Delete Req.')
                            <strong class="text-danger">Delete Request.</strong>
                          @endif
                        </td>
                        <td> {{ $bed->person }} </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($bed->updated_at == NULL)
                              {{ $bed->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $bed->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> {{ $bed->updated_at->format('d-m-Y') }} 
                        </td>
                        <td> <a href="{{ route('receptionist.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.bed.index') }}" class="text-black">Request Here</a></center>
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
@endpush