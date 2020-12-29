@extends('layouts.backend.app')

@section('title', 'User Index -')

@push('css')
    
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">User</h2>
        <hr class="mb-3 garis">
        <button type="button" class="btn btn-primary mb-5">
            <a href="{{ route('admin.user.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
        </button>
        <div class="card">
            <div class="card-header" style="background-color: #3c5f8f">
                User Data List
            </div>
            <div class="card-body" style="background-color: #aec9ef">
                @if ($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap display" id="table_id">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Name </th>
                          <th> Identitas </th>
                          <th> Alamat </th>
                          <th> Jenis Kelamin </th>
                          <th> Email </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $key=>$user)
                          <tr class="text-black">
                            <td> {{ $key + 1 }} </td>
                            <td> {{ $user->name }} 
                                @if ($user->role->id == 1)
                                    <sup><span class="badge badge-pill badge-success" style="font-size: 10px;">{{ $user->role->name }}</span></sup> 
                                @elseif ($user->role->id == 2)
                                    <sup><span class="badge badge-pill badge-primary" style="font-size: 10px;">{{ $user->role->name }}</span></sup> 
                                @elseif ($user->role->id == 3)
                                    <sup><span class="badge badge-pill badge-warning" style="font-size: 10px;">{{ $user->role->name }}</span></sup> 
                                @endif
                            </td>
                            <td> {{ $user->identitas }}: {{ $user->no_identitas }} </td>
                            <td> {{ $user->alamat }} </td>
                            <td> {{ $user->jenis_kelamin }} </td>
                            <td> {{ $user->email }} </td>
                            <td class="text-center"> 
                                @if(Auth::user()->id == $user->id)
                                    <a href="{{ route('admin.user.show',$user->id) }}" class="btn btn-success mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Your Profile Detail"><i class="mdi mdi-eye"></i></a>
                                    <a href="{{ route('admin.settings') }}" class="btn btn-info pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Your Profile Setting"><i class="mdi mdi-settings"></i></a>
                                @else
                                    <a href="{{ route('admin.user.show',$user->id) }}" class="btn btn-success mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="{{ $user->name }} Profile Detail"><i class="mdi mdi-eye"></i></a>
                                    <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="{{ $user->name }} Profile Edit"><i class="mdi mdi-grease-pencil"></i></a>  
                                    <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteUser({{ $user->id }})" data-toggle="tooltip" data-placement="bottom" title="{{ $user->name }} Profile Delete">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.user.destroy',$user->id) }}" method="POST" style="display: none;">
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
                    <center class="text-black">No Any User Data</center>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function deleteUser(id) {
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