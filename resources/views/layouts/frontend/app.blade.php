<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/calendar/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
</head>
<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
    <!-- header-start -->

    @include('layouts.frontend.partial.header')

	@yield('content')
    
    @include('layouts.frontend.partial.footer')
    
    <!-- JS here -->
<script src="{{ asset('assets/frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/ajax-form.js') }}"></script>
<script src="{{ asset('assets/frontend/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/scrollIt.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/nice-select.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.slicknav.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
<script src="{{ asset('assets/frontend/js/gijgo.min.js') }}"></script>

<!--contact js-->
<script src="{{ asset('assets/frontend/js/contact.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/mail-script.js') }}"></script>

<script src="{{ asset('assets/frontend/js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/calendar/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    
    $(function(){
        $('[data-toggle="tooltip"] ').tooltip()
    })            

</script>
<script type="text/javascript">
 $(function(){
  $(".enddate").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
      startDate: '+1d',
      endDate: '+28d',
  });
  $("#tgl_mulai").on('changeDate', function(selected) {
        var startDate = new Date(selected.date.valueOf());
        $("#tgl_akhir").datepicker('setStartDate', startDate);
        if($("#tgl_mulai").val() > $("#tgl_akhir").val()){
          $("#tgl_akhir").val($("#tgl_mulai").val());
        }
  });
 });
</script>
<script type="text/javascript">
    $(function(){
     $(".startdate").datepicker({
         format: 'yyyy-mm-dd',
         autoclose: true,
         todayHighlight: true,
         startDate: '+1d',
         endDate: '+2d',
     });
    });
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
</body>
</html>