@extends('layouts.backend.app')

@section('title', 'User Create -')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h2 class="mt-1 mb-2">Create User</h2>
        <hr class="mb-3 garis">
        <a class="text-white" href="{{ url()->previous() }}" style="text-decoration: none">< Back</a><br><br>

        <form class="forms-sample" method="POST" action="{{ route('admin.user.store') }}">
          @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="User Name">
            </div>
            <div class="form-group">
              <label for="identitas">Identitas</label>
              <select name="identitas" id="identitas" class="form-control" style="color: white">
                <option value="" holder>--- Pilih Jenis Identitas ---</option>
                <option value="KTP">KTP</option>
                <option value="SIM">SIM</option>
                <option value="Passport">Passport</option>
              </select>
            </div>
            <div class="form-group">
              <label for="no_identitas">No Identitas</label>
              <input type="number" class="form-control" id="no_identitas" name="no_identitas" placeholder="Nomor Identitas">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
            </div>
            <div class="form-group">
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" style="color: white">
                <option value="" holder>--- Pilih Jenis Kelamin ---</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group" id="show_hide_password">
              <label for="password">Password</label>
              <div class="input-group">
              <input type="password" class="form-control pwd" id="password" name="password" value="password_user" placeholder="Password">
              <div class="input-group-append">
                <button class="btn btn-sm btn-success reveal" type="button">
                    <i class="mdi mdi-eye"></i>
                </button>
              </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-dark">Cancel</button>
        </form>
    </div>
</div>
@endsection

@push('js')
  <script type="text/javascript">
    $(document).ready(function() {
      $("#show_hide_password button").on('click', function(event) {
          event.preventDefault();
          if($('#show_hide_password input').attr("type") == "text"){
              $('#show_hide_password input').attr('type', 'password');                
              $('#show_hide_password i').removeClass( "mdi mdi-eye" );
              $('#show_hide_password i').addClass( "mdi mdi-eye-off" );
          }else if($('#show_hide_password input').attr("type") == "password"){
              $('#show_hide_password input').attr('type', 'text');
              $('#show_hide_password i').removeClass( "mdi mdi-eye-off" );
              $('#show_hide_password i').addClass( "mdi mdi-eye" );
          }
      });
  });
  </script>
@endpush
