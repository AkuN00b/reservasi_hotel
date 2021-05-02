@extends('layouts.backend.app')

@section('title', 'User Edit -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Edit User</h2>
        <hr class="mb-3 garis">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <form class="forms-sample" method="POST" action="{{ route('receptionist.user.update', $user->id) }}">
          @csrf
          @method('PUT')
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="User Name">
            </div>
            <div class="form-group">
              <label for="identitas">Identitas</label>
              <select name="identitas" id="identitas" class="form-control" style="color: white">
                <option value="" holder>--- Pilih Jenis Identitas ---</option>
                <option value="KTP" {{ $user->identitas == 'KTP' ? 'selected' : '' }}>KTP</option>
                <option value="SIM" {{ $user->identitas == 'SIM' ? 'selected' : '' }}>SIM</option>
                <option value="Passport" {{ $user->identitas == 'Passport' ? 'selected' : '' }}>Passport</option>
              </select>
            </div>
            <div class="form-group">
              <label for="no_identitas">No Identitas</label>
              <input type="text" class="form-control" id="no_identitas" name="no_identitas" value="{{ $user->no_identitas }}" placeholder="Nomor Identitas">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $user->alamat }}" placeholder="Alamat">
            </div>
            <div class="form-group">
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" style="color: white">
                <option value="" holder>--- Pilih Jenis Kelamin ---</option>
                <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="role_id">Role</label>
              <select name="role_id" id="role_id" class="form-control" style="color: white">
                <option value="" holder>--- Pilih Role ---</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ ($user->role_id == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="about">About</label>
              <input type="text" class="form-control" id="about" name="about" value="{{ $user->about }}" placeholder="About">
            </div>
            {{-- <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
              <input type="password" class="form-control pwd" id="password" name="password" value="password_user" placeholder="Password">
              <div class="input-group-append">
                <button class="btn btn-sm btn-success reveal" type="button">
                    <i class="mdi mdi-eye"></i>
                </button>
              </div>
              </div>
            </div> --}}
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
        </form>

        <h2 class="mt-5 mb-2">Update User Image</h2>
        <hr class="mb-3 garis">
        <form action="{{ route('receptionist.user.image-update', $user->id) }}" class="forms-sample" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
            <div class="form-group">
              <label for="image">Image File</label>
              <input type="file" name="image" id="image" class="form-control">
            </div>
            Preview Image: <br>
            @if ($user->image == 'default.png')
              <img src="{{ asset('storage/account/base/'.$user->image) }}" alt="Gambar {{ $user->name }}" style="padding: 0;
              display: block;
              max-height: 30%;
              max-width: 30%;"><br><br>
            @else 
              <img src="{{ asset('storage/account/'.$user->image) }}" alt="Gambar {{ $user->name }}" style="padding: 0;
              display: block;
              max-height: 30%;
              max-width: 30%;"><br><br>
            @endif
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <button type="reset" class="btn btn-dark">Cancel</button>
        </form>
    </div>
</div>
@endsection
