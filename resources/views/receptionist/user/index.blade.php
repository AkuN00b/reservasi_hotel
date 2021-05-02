@extends('layouts.backend.app')

@section('title', 'User Index -')

@push('css')
    
@endpush

@section('content')

<div class="content-wrapper">
    <div class="container">
      @if (Request::is('receptionist/user'))
        <h2 class="mt-1 mb-2">User</h2>
        <hr class="mb-3 garis">

        <button type="button" class="btn btn-primary mb-4">
            <a href="{{ route('receptionist.user.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
        </button>

        <div class="card">
          <div class="card-header" style="background-color: #3c5f8f">
            User Category
          </div>
          <div class="card-body" style="background-color: #aec9ef">
            @if ($users->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Image </th>
                        <th> Last Updated by - Time </th>
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
                                <sup>||</sup>
                                @if ($user->status == 1)
                                    <sup><span class="badge badge-pill badge-info" style="font-size: 10px;">Active</span></sup> 
                                @elseif ($user->status == 0)
                                    <sup><span class="badge badge-pill badge-danger" style="font-size: 10px;">Non-Active</span></sup> 
                                @endif
                            </td>
                            <td> 
                              @if ($user->image == 'default.png')
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/base/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @else 
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @endif
                            </td>
                            @if (Auth::user()->id == $user->user_id)
                              <td class="text-success" data-toggle="tooltip" data-placement="bottom" title="@if ($user->updated_at == NULL)
                                {{ $user->created_at->format('d-m-Y - H:i:s') }}
                              @else
                                {{ $user->updated_at->format('d-m-Y - H:i:s') }}
                              @endif"> 
                                {{ $user->user->name }} - 
                                @if ($user->updated_at == NULL)
                                  {{ $user->created_at->format('d-m-Y') }}
                                @else
                                  {{ $user->updated_at->format('d-m-Y') }}
                                @endif
                              </td>
                            @else
                              <td data-toggle="tooltip" data-placement="bottom" title="@if ($user->updated_at == NULL)
                                {{ $user->created_at->format('d-m-Y - H:i:s') }}
                              @else 
                                  {{ $user->updated_at->format('d-m-Y - H:i:s') }}
                              @endif">
                                {{ $user->user->name }} - 
                                @if ($user->updated_at == NULL)
                                  {{ $user->created_at->format('d-m-Y') }}
                                @else
                                  {{ $user->updated_at->format('d-m-Y') }}
                                @endif
                              </td>
                            @endif
                            <td> {{ $user->identitas }}: {{ $user->no_identitas }} </td>
                            <td> {{ $user->alamat }} </td>
                            <td> {{ $user->jenis_kelamin }} </td>
                            <td> {{ $user->email }} </td>
                            <td class="text-center"> 
                                @if(Auth::user()->id == $user->id)
                                    <a href="{{ route('receptionist.user.show',$user->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Your Profile Detail"><i class="mdi mdi-eye"></i></a>
                                    <a href="{{ route('receptionist.settings') }}" class="btn btn-info pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Your Profile Setting"><i class="mdi mdi-settings"></i></a>
                                @else
                                    <a href="{{ route('receptionist.user.show',$user->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $user->name }} Account"><i class="mdi mdi-eye"></i></a>
                                    @if ($user->status == 0)
                                        <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteUsers({{ $user->id }})" data-toggle="tooltip" data-placement="bottom" title="Activate {{ $user->name }} Account">
                                            <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                        </button>
                                        <form id="deletes-form-{{ $user->id }}" action="{{ route('receptionist.user.active',$user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @elseif ($user->status == 1)
                                        <button class="btn btn-danger mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteUsers({{ $user->id }})" data-toggle="tooltip" data-placement="bottom" title="Deactivate {{ $user->name }} Account">
                                            <i class="mdi mdi-close-circle-outline"></i>
                                        </button>
                                        <form id="deletes-form-{{ $user->id }}" action="{{ route('receptionist.user.nonactive',$user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @endif
                                    <a href="{{ route('receptionist.user.edit',$user->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $user->name }} Account"><i class="mdi mdi-grease-pencil"></i></a>  
                                    <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteUser({{ $user->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $user->name }} Account">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('receptionist.user.destroy',$user->id) }}" method="POST" style="display: none;">
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
                <center class="text-black">No Any User Data, <a href="{{ route('receptionist.user.create') }}" class="text-black">Create Here</a></center>
            @endif
          </div>
        </div>
      @else
        <h2 class="mt-1 mb-2">User Request</h2>
        <hr class="mb-3 garis">

        <button type="button" class="btn btn-primary mb-4">
            <a href="{{ route('receptionist.user.create') }}" class="text-white" style="text-decoration: none;"><i class="mdi mdi-plus-circle btn-icon-prepend"></i> Create</a> 
        </button>

        <div class="card mb-4">
          <div class="card-header bg-primary">
            Your Last Update
          </div>
          <div class="card-body" style="background-color: #8cbae3">
            @if ($users->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_id">
                  <thead>
                    <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Image </th>
                        <th> Updated Time </th>
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
                                <sup>||</sup>
                                @if ($user->status == 1)
                                    <sup><span class="badge badge-pill badge-info" style="font-size: 10px;">Active</span></sup> 
                                @elseif ($user->status == 0)
                                    <sup><span class="badge badge-pill badge-danger" style="font-size: 10px;">Non-Active</span></sup> 
                                @endif
                            </td>
                            <td>
                              @if ($user->image == 'default.png')
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/base/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @else 
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @endif
                            </td>
                            <td data-toggle="tooltip" data-placement="bottom" title="@if ($user->updated_at == NULL)
                              {{ $user->created_at->format('d-m-Y - H:i:s') }}
                            @else 
                              {{ $user->updated_at->format('d-m-Y - H:i:s') }}
                            @endif"> {{ $user->updated_at->format('d-m-Y') }} 
                            </td>
                            <td> {{ $user->identitas }}: {{ $user->no_identitas }} </td>
                            <td> {{ $user->alamat }} </td>
                            <td> {{ $user->jenis_kelamin }} </td>
                            <td> {{ $user->email }} </td>
                            <td class="text-center"> 
                                @if(Auth::user()->id == $user->id)
                                    <a href="{{ route('receptionist.user.show',$user->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Your Profile Detail"><i class="mdi mdi-eye"></i></a>
                                    <a href="{{ route('receptionist.settings') }}" class="btn btn-info pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Your Profile Setting"><i class="mdi mdi-settings"></i></a>
                                @else
                                    <a href="{{ route('receptionist.user.show',$user->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $user->name }} Account"><i class="mdi mdi-eye"></i></a>
                                    @if ($user->status == 0)
                                        <button class="btn btn-success mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteUsers({{ $user->id }})" data-toggle="tooltip" data-placement="bottom" title="Activate {{ $user->name }} Account">
                                            <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                        </button>
                                        <form id="deletes-form-{{ $user->id }}" action="{{ route('receptionist.user.active',$user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @elseif ($user->status == 1)
                                        <button class="btn btn-danger mr-2 pl-3 pt-2 pb-2" type="button" onclick="deleteUsers({{ $user->id }})" data-toggle="tooltip" data-placement="bottom" title="Deactivate {{ $user->name }} Account">
                                            <i class="mdi mdi-close-circle-outline"></i>
                                        </button>
                                        <form id="deletes-form-{{ $user->id }}" action="{{ route('receptionist.user.nonactive',$user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    @endif
                                    <a href="{{ route('receptionist.user.edit',$user->id) }}" class="btn btn-warning mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Edit {{ $user->name }} Account"><i class="mdi mdi-grease-pencil"></i></a>  
                                    <button class="btn btn-danger pl-3 pt-2 pb-2" type="button" onclick="deleteUser({{ $user->id }})" data-toggle="tooltip" data-placement="bottom" title="Request Delete {{ $user->name }} Account">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('receptionist.user.destroy',$user->id) }}" method="POST" style="display: none;">
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
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.user.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>
        
        <div class="card mb-4">
          <div class="card-header bg-info">
            Your Recent Request, Wait For Confirmed
          </div>
          <div class="card-body" style="background-color: #c39aef">
            @if ($user_request->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idd">
                  <thead>
                    <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Image </th>
                        <th> Updated Time </th>
                        <th> Identitas </th>
                        <th> Alamat </th>
                        <th> Jenis Kelamin </th>
                        <th> Email </th>
                        <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user_request as $key=>$user)
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
                                ||
                                <strong class="text-danger">Delete Request. Wait for Confirmed. Thanks for Request :))</strong>
                            </td>
                            <td>
                              @if ($user->image == 'default.png')
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/base/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @else 
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @endif
                            </td>
                            <td data-toggle="tooltip" data-placement="bottom" title="@if ($user->updated_at == NULL)
                              {{ $user->created_at->format('d-m-Y - H:i:s') }}
                            @else 
                              {{ $user->updated_at->format('d-m-Y - H:i:s') }}
                            @endif"> {{ $user->updated_at->format('d-m-Y') }} 
                            </td>
                            <td> {{ $user->identitas }}: {{ $user->no_identitas }} </td>
                            <td> {{ $user->alamat }} </td>
                            <td> {{ $user->jenis_kelamin }} </td>
                            <td> {{ $user->email }} </td>
                            <td><a href="{{ route('receptionist.user.show',$user->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $user->name }} Account"><i class="mdi mdi-eye"></i></a></td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.user.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header bg-success">
            Your Recent Accepted Request
          </div>
          <div class="card-body" style="background-color: #99f2a0">
            @if ($user_accepted->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_iddd">
                  <thead>
                    <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Image </th>
                        <th> Updated Time </th>
                        <th> Identitas </th>
                        <th> Alamat </th>
                        <th> Jenis Kelamin </th>
                        <th> Email </th>
                        <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user_accepted as $key=>$user)
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
                                ||
                                <strong class="text-danger">Delete Request</strong>
                            </td>
                            <td>
                              @if ($user->image == 'default.png')
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/base/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @else 
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @endif
                            </td>
                            <td data-toggle="tooltip" data-placement="bottom" title="@if ($user->updated_at == NULL)
                              {{ $user->created_at->format('d-m-Y - H:i:s') }}
                            @else 
                              {{ $user->updated_at->format('d-m-Y - H:i:s') }}
                            @endif"> {{ $user->updated_at->format('d-m-Y') }} 
                            </td>
                            <td> {{ $user->identitas }}: {{ $user->no_identitas }} </td>
                            <td> {{ $user->alamat }} </td>
                            <td> {{ $user->jenis_kelamin }} </td>
                            <td> {{ $user->email }} </td>
                            <td><a href="{{ route('receptionist.user.show',$user->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $user->name }} Account"><i class="mdi mdi-eye"></i></a></td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.user.index') }}" class="text-black">Request Here</a></center>
            @endif
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header bg-danger">
            Your Recent Canceled Request
          </div>
          <div class="card-body" style="background-color: #e69999">
            @if ($user_canceled->count() > 0)
              <div class="table-responsive">
                <table class="table table-bordered text-nowrap display" id="table_idddd">
                  <thead>
                    <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Image </th>
                        <th> Updated Time </th>
                        <th> Identitas </th>
                        <th> Alamat </th>
                        <th> Jenis Kelamin </th>
                        <th> Email </th>
                        <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user_canceled as $key=>$user)
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
                                ||
                                <strong class="text-danger">Delete Request</strong>
                            </td>
                            <td>
                              @if ($user->image == 'default.png')
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/base/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @else 
                                <a href="{{ route('receptionist.user.show',$user->id) }}"><img src="{{ asset('storage/account/'.$user->image) }}" alt="Gambar {{ $user->name }}" data-toggle="tooltip" data-placement="bottom" alt="Gambar {{ $user->name }}" title="Lihat Gambar {{ $user->name }}"></a>
                              @endif
                            </td>
                            <td data-toggle="tooltip" data-placement="bottom" title="@if ($user->updated_at == NULL)
                              {{ $user->created_at->format('d-m-Y - H:i:s') }}
                            @else 
                              {{ $user->updated_at->format('d-m-Y - H:i:s') }}
                            @endif"> {{ $user->updated_at->format('d-m-Y') }} 
                            </td>
                            <td> {{ $user->identitas }}: {{ $user->no_identitas }} </td>
                            <td> {{ $user->alamat }} </td>
                            <td> {{ $user->jenis_kelamin }} </td>
                            <td> {{ $user->email }} </td>
                            <td><a href="{{ route('receptionist.user.show',$user->id) }}" class="btn btn-primary mr-2 pl-3 pt-2 pb-2" data-toggle="tooltip" data-placement="bottom" title="Detail {{ $user->name }} Account"><i class="mdi mdi-eye"></i></a></td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <center class="text-black">No Any Request, <a href="{{ route('receptionist.user.index') }}" class="text-black">Request Here</a></center>
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
<script type="text/javascript">
    function deleteUsers(id) {
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