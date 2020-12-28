<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/backend/images/favicon.png') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-6 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left"><a href="{{ route('primary') }}" data-toggle="tooltip" data-placement="right" title="Kembali ke Menu Utama"><i class="mdi mdi-arrow-left-bold-circle-outline text-white"></i></a></h3>
                <h3 class="card-title text-left" style="margin-top: -15px;">Login / <a href="{{ route('register') }}" style="text-decoration: none;">Register</a></h3>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-sm-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                        <div class="col-12">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>

                        <div class="col-md-12 input-group" id="show_hide_password">
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} pwd" name="password" required>
                            <div class="input-group-append">
                              <button class="btn btn-sm btn-success" type="button"><i class="mdi mdi-eye-off"></i></button>
                            </div>    

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 offset-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-12">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                    <ul class="mt-3">
                      <li>
                        <p>Email: Password</p>
                      </li>
                      <li>
                        <p>adminhotel@gmail.com: adminhotel11</p>
                      </li>
                      <li>
                        <p>receptionisthotel@gmail.com: receptionisthotel22</p>
                      </li>
                      <li>
                        <p>customerhotel@gmail.com: customerhotel33</p>
                      </li>
                    </ul>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/backend/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/backend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/backend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/backend/js/misc.js') }}"></script>
    <script src="{{ asset('assets/backend/js/settings.js') }}"></script>
    <script src="{{ asset('assets/backend/js/todolist.js') }}"></script>
    <script type="text/javascript">
    
      $(function(){
          $('[data-toggle="tooltip"] ').tooltip()
      })            
  
    </script>

    
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
    <!-- endinject -->
  </body>
</html>