@extends('layouts.backend.app')

@section('title', 'Class Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
      @if (Request::is('receptionist/class'))
        <h2 class="mt-1 mb-2">Class</h2>
        <hr class="mb-3 garis">
        
        <button type="button" class="btn btn-primary mb-4">
          <a href="{{ route('receptionist.class.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create Request</a> 
        </button>

        <div class="card">
          <div class="card-header" style="background-color: #3c5f8f">
            Class Category
          </div>
          <div class="card-body" style="background-color: #aec9ef">
            @if ($classes->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Last Updated By - Time</th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($classes as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} </td>
                        <td> <a href="{{ route('receptionist.class.show',$class->id) }}"><img src="{{ asset('storage/class/'.$class->image) }}" alt="Gambar {{ $class->name }}" data-toggle="tooltip" data-placement="bottom" title="Lihat Gambar {{ $class->name }}"></a> </td>
                        @if (Auth::user()->name == $class->user->name)
                          <td class="text-success" data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y - H:i:s') }}
                          @else
                              {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> 
                            {{ $class->user->name }} - 
                            @if ($class->updated_at == NULL)
                               {{ $class->created_at->format('d-m-Y') }}
                            @else
                               {{ $class->updated_at->format('d-m-Y') }}
                            @endif
                          </td>
                        @else
                          <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> 
                            {{ $class->user->name }} - 
                            @if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y') }}
                            @else
                              {{ $class->updated_at->format('d-m-Y') }}
                            @endif
                          </td>
                        @endif
                        <td> 
                          <a href="{{ route('receptionist.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a>   
                          <a href="{{ route('receptionist.class.edit',$class->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit {{ $class->name }}"><i class="mdi mdi-pencil"></i></a>  
                          <a href="{{ route('receptionist.class.image-request.edit',$class->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit Image {{ $class->name }}"><i class="mdi mdi-image-broken"></i></a>
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $class->name }}">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="delete-form-{{ $class->id }}" action="{{ route('receptionist.class.requestdelete',$class->id) }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Class Data, <a href="{{ route('receptionist.class.create') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>
      @else
        <h2 class="mt-1 mb-2">Class Request</h2>
        <hr class="mb-3 garis">

        <button type="button" class="btn btn-primary mb-4">
          <a href="{{ route('receptionist.class.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create Request</a> 
        </button>

        <div class="card mb-4">
          <div class="card-header bg-primary">
            Your Active Request
          </div>
          <div class="card-body" style="background-color: #8cbae3">
            @if ($classes->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Updated Time </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($classes as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('receptionist.class.show',$class->id) }}"><img src="{{ asset('storage/class/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                          {{ $class->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                          {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                        @endif"> {{ $class->updated_at->format('d-m-Y') }} 
                        </td>
                        <td> 
                          <a href="{{ route('receptionist.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a>   
                          <a href="{{ route('receptionist.class.edit',$class->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit {{ $class->name }}"><i class="mdi mdi-pencil"></i></a>  
                          <a href="{{ route('receptionist.class.image-request.edit',$class->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Request Edit Image {{ $class->name }}"><i class="mdi mdi-image-broken"></i></a>
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $class->name }}">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="delete-form-{{ $class->id }}" action="{{ route('receptionist.class.requestdelete',$class->id) }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.class.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>    
        
        <div class="card mb-4">
          <div class="card-header bg-info">
            Your Recent Request, Wait For Confirmed
          </div>
          <div class="card-body" style="background-color: #c39aef">
            @if ($class_request->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Updated Time </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($class_request as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} || 
                          @if ($class->class_id == NULL)
                            <strong class="text-primary">Create Request. Wait for Confirmed. Thanks for Request :))</strong>
                          @else
                            @if ($class->slug == !NULL)
                              <strong class="text-warning">Edit Request. Wait for Confirmed. Thanks for Request :))</strong>
                            @else
                              <strong class="text-danger">Delete Request. Wait for Confirmed. Thanks for Request :))</strong>
                            @endif
                          @endif
                        </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('receptionist.class.show',$class->id) }}"><img src="{{ asset('storage/class/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                          {{ $class->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                          {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                        @endif"> {{ $class->updated_at->format('d-m-Y') }} 
                        </td>
                        <td> <a href="{{ route('receptionist.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.class.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header bg-success">
            Your Recent Accepted Request
          </div>
          <div class="card-body" style="background-color: #99f2a0">
            @if ($class_accepted->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_iddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Updated Time </th>
                      <th> Info </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($class_accepted as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} || 
                          @if ($class->slug == 'Create Req.')
                            <strong class="text-primary">Create Request. Thanks for Request :))</strong>
                          @elseif ($class->slug == 'Edit Req.')
                            <strong class="text-warning">Edit Request. Thanks for Request :))</strong>
                          @elseif ($class->slug == 'Delete Req.')
                            <strong class="text-danger">Delete Request. Thanks for Request :))</strong>
                          @endif
                        </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('receptionist.class.show',$class->id) }}"><img src="{{ asset('storage/class/request/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                          {{ $class->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                          {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                        @endif"> {{ $class->updated_at->format('d-m-Y') }} 
                        </td>
                        <td> <a href="{{ route('receptionist.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.class.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header bg-danger">
            Your Recent Canceled Request
          </div>
          <div class="card-body" style="background-color: #e69999">
            @if ($class_canceled->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Updated Time </th>
                      <th> Info </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($class_canceled as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} || 
                          @if ($class->slug == 'Create Req.')
                            <strong class="text-primary">Create Request. Thanks for Request :))</strong>
                          @elseif ($class->slug == 'Edit Req.')
                            <strong class="text-warning">Edit Request. Thanks for Request :))</strong>
                          @elseif ($class->slug == 'Delete Req.')
                            <strong class="text-danger">Delete Request. Thanks for Request :))</strong>
                          @endif
                        </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('receptionist.class.show',$class->id) }}"><img src="{{ asset('storage/class/request/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                          {{ $class->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                          {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                        @endif"> {{ $class->updated_at->format('d-m-Y') }} 
                        </td>
                        <td> <a href="{{ route('receptionist.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.class.index') }}" class="text-black">Request Here</a></center>
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