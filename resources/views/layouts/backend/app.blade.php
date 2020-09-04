<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/backend/images/favicon.png') }}" />
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    @stack('css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.html -->
        @include('layouts.backend.partial.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.backend.partial.header')
            <div class="main-panel">
                @yield('content')<!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                <span class="text-muted float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
              </div>
            </footer>
            <!-- partial -->
          </div>
          <!-- main-panel ends -->
        </div>
        
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      {!! Toastr::message() !!}
  
      <script>
          @if($errors->any())
              @foreach($errors->all() as $error)
                  toastr.error('{{ $error }}', 'Error', {
                      closeButton: true,
                      progressBar: true,
                  });
              @endforeach
          @endif
      </script>
      @stack('js')
      <!-- endinject -->
      <!-- Custom js for this page -->
      <!-- End custom js for this page -->
    </body>
  </html>