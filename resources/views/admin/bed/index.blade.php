@extends('layouts.backend.app')

@section('title', 'Bed Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
      @if (Request::is('admin/bed'))
        <h2 class="mt-1 mb-2">Bed</h2>
        <hr class="mb-3 garis">

        <button type="button" class="btn btn-primary mb-5">
          <a href="{{ route('admin.bed.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
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
                      <th> Last Updated by </th>
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
                          <td> <a href="{{ route('admin.user.show',$bed->user->id) }}" class="text-success">{{ $bed->user->name }}</a> </td>
                        @else
                          <td> <a href="{{ route('admin.user.show',$bed->user->id) }}" class="text-black">{{ $bed->user->name }}</a> </td>
                        @endif
                        <td>
                          <a href="{{ route('admin.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a>   
                          <a href="{{ route('admin.bed.edit',$bed->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $bed->name }}"><i class="mdi mdi-pencil"></i></a>  
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Delete {{ $bed->name }}">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="delete-form-{{ $bed->id }}" action="{{ route('admin.bed.requestdelete',$bed->id) }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center>No Any Data</center>
            @endif
          </div>
        </div>
      @else
        <h2 class="mt-1 mb-2">Bed Request</h2>
        <hr class="mb-3 garis">

        <div class="card mb-4">
          <div class="card-header bg-info">
            Request for Confirm
          </div>
          <div class="card-body" style="background-color: #d2b4f2">
            @if ($beds->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Amount of Person </th>
                      <th> Request by </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($beds as $key=>$bed)
                    <tr class="text-black">
                      <td> {{ $key + 1 }} </td>
                        <td> {{ $bed->name }} 
                          @if ($bed->bed_id == NULL)
                            <sup><span class="badge badge-pill badge-primary" style="font-size: 10px;">Create Req.</span></sup> 
                          @else
                            @if ($bed->slug == !NULL)
                              <sup><span class="badge badge-pill badge-warning" style="font-size: 10px;">Edit Req.</span></sup> 
                            @else
                              <sup><span class="badge badge-pill badge-danger" style="font-size: 10px;">Delete Req.</span></sup> 
                            @endif
                          @endif
                        </td>
                        <td> {{ $bed->person }} </td>
                        <td> <a href="{{ route('admin.user.show',$bed->user_id) }}" class="text-warning" style="text-decoration: none;">{{ $bed->user->name }}</a> </td>
                        <td> 
                          <a href="{{ route('admin.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a>   
                          @if ($bed->bed_id == NULL)
                            <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $bed->name }} Create Request. From {{ $bed->user->name }}.">
                              <i class="mdi mdi-check"></i>
                            </button>
                            <form id="check-form-{{ $bed->id }}" action="{{ route('admin.bed.requestcreate',$bed->id) }}" method="POST" style="display: none;">
                              @csrf
                                @method('PUT')
                                <input type="text" name="slug" value="Create Req.">
                            </form>
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $bed->name }} Create Request. From {{ $bed->user->name }}.">
                              <i class="mdi mdi-close"></i>
                            </button>
                            <form id="cancel-form-{{ $bed->id }}" action="{{ route('admin.bed.requestcancel',$bed->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                                <input type="text" name="slug" value="Create Req.">
                            </form>
                          @elseif ($bed->slug == !NULL)
                            <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $bed->name }} Edit Request. From {{ $bed->user->name }}.">
                              <i class="mdi mdi-check"></i>
                            </button>
                            <form id="check-form-{{ $bed->id }}" action="{{ route('admin.bed.requestedit',$bed->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                              <input type="text" name="slug" value="Edit Req.">
                            </form>
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $bed->name }} Edit Request. From {{ $bed->user->name }}.">
                              <i class="mdi mdi-close"></i>
                            </button>
                            <form id="cancel-form-{{ $bed->id }}" action="{{ route('admin.bed.requestcancel',$bed->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                              <input type="text" name="slug" value="Edit Req.">
                            </form>
                          @else
                            <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="createBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Confirm {{ $bed->name }} Delete Request. From {{ $bed->user->name }}.">
                              <i class="mdi mdi-check"></i>
                            </button>
                            <form id="check-form-{{ $bed->id }}" action="{{ route('admin.bed.requestdelete',$bed->id) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                              <input type="text" name="slug" value="Delete Req.">
                            </form>
                            <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="cancelBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Reject {{ $bed->name }} Delete Request. From {{ $bed->user->name }}.">
                              <i class="mdi mdi-close"></i>
                            </button>
                            <form id="cancel-form-{{ $bed->id }}" action="{{ route('admin.bed.requestcancel',$bed->id) }}" method="POST" style="display: none;">
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
              <center>No Any Request</center>
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
                    <th> Amount of Person </th>
                    <th> Request by </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach ($bed_active as $bed)
                    @if ($bed->user->role->id == 2)
                      <tr class="text-black">
                        <td> {{ $no++ }} </td>
                        <td> {{ $bed->name }} </td>
                        <td> {{ $bed->person }} </td>
                        <td> <a href="{{ route('admin.user.show',$bed->user_id) }}" class="text-warning" style="text-decoration: none;">{{ $bed->user->name }}</a> </td>
                        <td> 
                          <a href="{{ route('admin.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a>   
                          <a href="{{ route('admin.bed.edit',$bed->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $bed->name }}"><i class="mdi mdi-pencil"></i></a>  
                          <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteBed({{ $bed->id }})" data-toggle="tooltip" data-placement="bottom" title="Delete {{ $bed->name }}">
                            <i class="mdi mdi-close"></i>
                          </button>
                          <form id="delete-form-{{ $bed->id }}" action="{{ route('admin.bed.destroy',$bed->id) }}" method="POST" style="display: none;">
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
            @if ($bed_accepted->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_iddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Amount of Person </th>
                      <th> Request By </th>
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
                        <td> <a href="{{ route('admin.user.show',$bed->user_id) }}" class="text-warning" style="text-decoration: none;">{{ $bed->user->name }}</a> </td>
                        <td><a href="{{ route('admin.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center>No Any Request</center>
            @endif
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header bg-danger">
            Canceled Request
          </div>
          <div class="card-body" style="background-color: #e89e9e">
            @if ($bed_canceled->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idddd">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Amount of Person </th>
                      <th> Request By </th>
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
                        <td> <a href="{{ route('admin.user.show',$bed->user_id) }}" class="text-warning" style="text-decoration: none;">{{ $bed->user->name }}</a> </td>
                        <td><a href="{{ route('admin.bed.show',$bed->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $bed->name }}"><i class="mdi mdi-eye"></i></a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center>No Any Request</center>
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