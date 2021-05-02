@extends('layouts.backend.app')

@section('title', 'Class Image Index -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Class Image Request</h2>
        <hr class="mb-3 garis">

        <div class="card mb-4">
          <div class="card-header bg-primary">
            Request for Confirm
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
                      <th> Request By </th>
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
                            <a href="{{ route('admin.class.show',$class->id) }}"><img src="{{ asset('storage/class/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                            {{ $class->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                            {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                        @endif">
                          <a href="{{ route('admin.user.show',$class->user_image->id) }}" class="text-warning" style="text-decoration: none;">
                            {{ $class->user_image->name }} - 
                            @if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y') }}
                            @else
                              {{ $class->updated_at->format('d-m-Y') }}
                            @endif
                          </a>
                        </td>
                        <td> 
                            <a href="{{ route('admin.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a>
                            <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $class->name }} Image Request. From {{ $class->user_image->name }}.">
                                <i class="mdi mdi-check"></i>
                            </button>
                            <form id="check-form-{{ $class->id }}" action="{{ route('admin.class.request-image.approve',$class->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $class->name }} Image Request. From {{ $class->user_image->name }}.">
                                <i class="mdi mdi-close"></i>
                            </button>
                            <form id="cancel-form-{{ $class->id }}" action="{{ route('admin.class.request-image.reject',$class->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
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
          <div class="card-header bg-info">
            Active Request
          </div>
          <div class="card-body" style="background-color: #c39aef">
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Request By </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no = 1; @endphp
                    @foreach ($class_active as $key=>$class)
                      @if ($class->user_image->role->id == 2)
                        <tr class="text-black">
                          <td> {{ $no++ }} </td>
                          <td> {{ $class->name }} </td>
                          <td>
                            @if ($class->image == NULL)
                              No Image
                            @else
                              <a href="{{ route('admin.class.show',$class->id) }}"><img src="{{ asset('storage/class/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                            @endif
                          </td>
                          <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                          @endif">
                            <a href="{{ route('admin.user.show',$class->user_image->id) }}" class="text-warning" style="text-decoration: none;">
                              {{ $class->user_image->name }} - 
                              @if ($class->updated_at == NULL)
                                {{ $class->created_at->format('d-m-Y') }}
                              @else
                                {{ $class->updated_at->format('d-m-Y') }}
                              @endif
                            </a>
                          </td>
                          <td> 
                            <a href="{{ route('admin.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a>   
                            <a href="{{ route('admin.class.edit',$class->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $class->name }}"><i class="mdi mdi-pencil"></i></a>  
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Delete {{ $class->name }}">
                              <i class="mdi mdi-close"></i>
                            </button>
                            <form id="delete-form-{{ $class->id }}" action="{{ route('admin.class.destroy',$class->id) }}" method="POST" style="display: none;">
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
          <div class="card-body" style="background-color: #99f2a0">
            @if ($class_accepted->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_iddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Request By </th>
                      <th> Info </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($class_accepted as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('admin.class.show',$class->id) }}"><img src="{{ asset('storage/class/request/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                            {{ $class->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                            {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                        @endif">
                          <a href="{{ route('admin.user.show',$class->user_image->id) }}" class="text-warning" style="text-decoration: none;">
                            {{ $class->user_image->name }} - 
                            @if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y') }}
                            @else
                              {{ $class->updated_at->format('d-m-Y') }}
                            @endif
                          </a>
                        </td>
                        <td> <a href="{{ route('admin.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a> </td>
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
          <div class="card-body" style="background-color: #e69999">
            @if ($class_canceled->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Image </th>
                      <th> Request By </th>
                      <th> Info </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($class_canceled as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('admin.class.show',$class->id) }}"><img src="{{ asset('storage/class/request/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                            {{ $class->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                            {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                        @endif">
                          <a href="{{ route('admin.user.show',$class->user_image->id) }}" class="text-warning" style="text-decoration: none;">
                            {{ $class->user_image->name }} - 
                            @if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y') }}
                            @else
                              {{ $class->updated_at->format('d-m-Y') }}
                            @endif
                          </a>
                        </td>
                        <td> <a href="{{ route('admin.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a> </td>
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
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function createBed(id) {
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
  function cancelBed(id) {
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
@endpush