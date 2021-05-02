@extends('layouts.backend.app')

@section('title', 'Class Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
      @if (Request::is('admin/class'))
        <h2 class="mt-1 mb-2">Class</h2>
        <hr class="mb-3 garis">

        <button type="button" class="btn btn-primary mb-5">
          <a href="{{ route('admin.class.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
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
                      <th> Last Updated </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($classes as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} </td>
                        <td> <a href="{{ route('admin.class.show',$class->id) }}"><img src="{{ asset('storage/class/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a> </td>
                        @if (Auth::user()->name == $class->user->name)
                          <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                          @endif">
                            <a href="{{ route('admin.user.show',$class->user->id) }}" class="text-success">
                              {{ $class->user->name }} - 
                              @if ($class->updated_at == NULL)
                                {{ $class->created_at->format('d-m-Y') }}
                              @else
                                {{ $class->updated_at->format('d-m-Y') }}
                              @endif
                            </a> 
                          </td>
                        @else
                          <td data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> 
                            <a href="{{ route('admin.user.show',$class->user->id) }}" class="text-black">
                              {{ $class->user->name }} - 
                              @if ($class->updated_at == NULL)
                                {{ $class->created_at->format('d-m-Y') }}
                              @else
                                {{ $class->updated_at->format('d-m-Y') }}
                              @endif
                            </a>
                          </td>
                        @endif
                        <td> 
                          <a href="{{ route('admin.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a>   
                          <a href="{{ route('admin.class.edit',$class->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $class->name }} Class"><i class="mdi mdi-pencil"></i></a>  
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteClass({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Delete {{ $class->name }} Class">
                            <i class="mdi mdi-delete"></i>
                          </button>
                          <form id="delete-form-{{ $class->id }}" action="{{ route('admin.class.destroy',$class->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
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
        <h2 class="mt-1 mb-2">Class Request</h2>
        <hr class="mb-3 garis">

        <div class="card mb-4">
          <div class="card-header bg-info">
            Request for Confirm
          </div>
          <div class="card-body" style="background-color: #d2b4f2">
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
                        <td> {{ $class->name }} 
                          @if ($class->class_id == NULL)
                            <sup><span class="badge badge-pill badge-primary" style="font-size: 10px;">Create Req.</span></sup> 
                          @else
                            @if ($class->slug == !NULL)
                              <sup><span class="badge badge-pill badge-warning" style="font-size: 10px;">Edit Req.</span></sup> 
                            @else
                              <sup><span class="badge badge-pill badge-danger" style="font-size: 10px;">Delete Req.</span></sup> 
                            @endif
                          @endif
                        </td>
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
                          <a href="{{ route('admin.user.show',$class->user_id) }}" class="text-warning" style="text-decoration: none;">
                            {{ $class->user->name }} - 
                            @if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y') }}
                            @else
                              {{ $class->updated_at->format('d-m-Y') }}
                            @endif
                          </a> 
                        </td>
                        <td> 
                          <a href="{{ route('admin.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a>   
                          @if ($class->class_id == NULL)
                            <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $class->name }} Create Request. From {{ $class->user->name }}.">
                              <i class="mdi mdi-check"></i>
                            </button>
                            <form id="check-form-{{ $class->id }}" action="{{ route('admin.class.requestcreate',$class->id) }}" method="POST" style="display: none;">
                              @csrf
                                @method('PUT')
                                <input type="text" name="slug" value="Create Req.">
                            </form>
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $class->name }} Create Request. From {{ $class->user->name }}.">
                              <i class="mdi mdi-close"></i>
                            </button>
                            <form id="cancel-form-{{ $class->id }}" action="{{ route('admin.class.requestcancel',$class->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                                <input type="text" name="slug" value="Create Req.">
                            </form>
                          @elseif ($class->slug == !NULL)
                            <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $class->name }} Edit Request. From {{ $class->user->name }}.">
                              <i class="mdi mdi-check"></i>
                            </button>
                            <form id="check-form-{{ $class->id }}" action="{{ route('admin.class.requestedit',$class->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                              <input type="text" name="slug" value="Edit Req.">
                            </form>
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $class->name }} Edit Request. From {{ $class->user->name }}.">
                              <i class="mdi mdi-close"></i>
                            </button>
                            <form id="cancel-form-{{ $class->id }}" action="{{ route('admin.class.requestcancel',$class->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                              <input type="text" name="slug" value="Edit Req.">
                            </form>
                          @else
                            <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $class->name }} Delete Request. From {{ $class->user->name }}.">
                              <i class="mdi mdi-check"></i>
                            </button>
                            <form id="check-form-{{ $class->id }}" action="{{ route('admin.class.requestdelete',$class->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                              <input type="text" name="slug" value="Delete Req.">
                            </form>
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelBed({{ $class->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $class->name }} Delete Request. From {{ $class->user->name }}.">
                              <i class="mdi mdi-close"></i>
                            </button>
                            <form id="cancel-form-{{ $class->id }}" action="{{ route('admin.class.requestcancel',$class->id) }}" method="POST" style="display: none;">
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
                      <th> Image </th>
                      <th> Request By </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no = 1; @endphp
                    @foreach ($class_active as $class)
                      @if ($class->user->role->id == 2)
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
                          <td class="text-warning" data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y - H:i:s') }}
                          @else 
                              {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                          @endif"> 
                            <a href="{{ route('admin.user.show',$class->user_id) }}" class="text-warning" style="text-decoration: none;">
                              {{ $class->user->name }}
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
          <div class="card-body" style="background-color: #8cd492">
            @if ($class_accepted->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_iddd">
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
                    @foreach ($class_accepted as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} || 
                          @if ($class->slug == 'Create Req.')
                            <strong class="text-primary">Create Request.</strong>
                          @elseif ($class->slug == 'Edit Req.')
                            <strong class="text-warning">Edit Request.</strong>
                          @elseif ($class->slug == 'Delete Req.')
                            <strong class="text-danger">Delete Request.</strong>
                          @endif
                        </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('admin.class.show',$class->id) }}"><img src="{{ asset('storage/class/request/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td class="text-warning" data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                            {{ $class->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                            {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                        @endif">
                          <a href="{{ route('admin.user.show',$class->user_id) }}" class="text-warning" style="text-decoration: none;">
                            {{ $class->user->name }} -  
                            @if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y') }}
                            @else
                              {{ $class->updated_at->format('d-m-Y') }}
                            @endif
                          </a>
                        </td>
                        <td><a href="{{ route('admin.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a></td>
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
            @if ($class_canceled->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idddd">
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
                    @foreach ($class_canceled as $key=>$class)
                      <tr class="text-black">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $class->name }} || 
                          @if ($class->slug == 'Create Req.')
                            <strong class="text-primary">Create Request.</strong>
                          @elseif ($class->slug == 'Edit Req.')
                            <strong class="text-warning">Edit Request.</strong>
                          @elseif ($class->slug == 'Delete Req.')
                            <strong class="text-danger">Delete Request.</strong>
                          @endif
                        </td>
                        <td>
                          @if ($class->image == NULL)
                            No Image
                          @else
                            <a href="{{ route('admin.class.show',$class->id) }}"><img src="{{ asset('storage/class/request/'.$class->image) }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $class->name }}" title="Lihat Gambar {{ $class->name }}"></a>
                          @endif
                        </td>
                        <td class="text-warning" data-toggle="tooltip" data-placement="bottom" title="@if ($class->updated_at == NULL)
                            {{ $class->created_at->format('d-m-Y - H:i:s') }}
                        @else 
                            {{ $class->updated_at->format('d-m-Y - H:i:s') }}
                        @endif"> 
                          <a href="{{ route('admin.user.show',$class->user_id) }}" class="text-warning" style="text-decoration: none;">
                            {{ $class->user->name }} - 
                            @if ($class->updated_at == NULL)
                              {{ $class->created_at->format('d-m-Y') }}
                            @else
                              {{ $class->updated_at->format('d-m-Y') }}
                            @endif
                          </a>
                        </td>
                        <td><a href="{{ route('admin.class.show',$class->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $class->name }}"><i class="mdi mdi-eye"></i></a></td>
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