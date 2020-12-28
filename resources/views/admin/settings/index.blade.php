@extends('layouts.backend.app')

@section('title', 'Settings -')

@section('content') 
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Settings "{{ Auth::user()->username }}"</h2>
        <hr class="mb-3 garis">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <div class="row">
          <form class="forms-sample col-lg-6 border-right mb-4" method="POST" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('PUT')
            <h4 class="mb-4" style="text-decoration: underline;">Update Data Account</h4>
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Input Name" value="{{ Auth::user()->name }}">
              </div>
              <div class="form-group">
                <label for="identitas">Identitas</label>
                <select name="identitas" id="identitas" class="form-control" style="color: white">
                  <option value="" holder>--- Pilih Jenis Identitas ---</option>
                  <option value="KTP" {{ Auth::user()->identitas == 'KTP' ? 'selected' : '' }}>KTP</option>
                  <option value="SIM" {{ Auth::user()->identitas == 'SIM' ? 'selected' : '' }}>SIM</option>
                  <option value="Passport" {{ Auth::user()->identitas == 'Passport' ? 'selected' : '' }}>Passport</option>
                </select>
              </div>
              <div class="form-group">
                  <label for="no_identitas">Nomor Identitas</label>
                  <input type="text" class="form-control" id="no_identitas" name="no_identitas" placeholder="Input Nomor Identitas" value="{{ Auth::user()->no_identitas }}">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Input Alamat" value="{{ Auth::user()->alamat }}">
                </div>
                <div class="form-group">
                  <label for="jenis_kelamin">Jenis Kelamin</label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" style="color: white">
                    <option value="" holder>--- Pilih Jenis Kelamin ---</option>
                    <option value="Laki-laki" {{ Auth::user()->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ Auth::user()->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Input Username" value="{{ Auth::user()->username }}">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Input Email" value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group">
                  <label for="role_id">Role</label>
                  <input type="text" class="form-control" id="role_id" name="role_id" placeholder="Input Role" value="{{ Auth::user()->role->name }}" disabled readonly style="color: black;">
                </div>
                <div class="form-group">
                  <label for="about">About</label>
                  <input type="text" class="form-control" id="about" name="about" placeholder="Input About" value="{{ Auth::user()->about }}">
                </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="reset" class="btn btn-dark">Cancel</button>
          </form>

          <form action="{{ route('admin.password.update') }}" class="forms-sample col-lg-6" method="POST">
            @csrf
            @method('PUT')
            <h4 class="mb-4" style="text-decoration: underline;">Update Password Account</h4>
              <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Input your Old Password">
              </div>
              <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Input your New Password">
              </div>
              <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Input your New Password Again">
              </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
          </form>
        </div>
    </div>
</div>
@endsection
