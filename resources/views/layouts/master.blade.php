<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0, user-scalable=0">
    <meta name="msvalidate.01" content="99912E2D5F9EDEC5CE23B7B3CF5E1698" />
    <meta name="google-site-verification" content="uLTLxShU6SktENFMnCaiYremXGGG9vsn77o5cKQVtn8" />
    <style type="text/css" media="all">
      @import url('https://fonts.googleapis.com/css?family=Press+Start+2P');
    </style>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
         @yield('title')
    </title>   <!-- Styles -->
      @include('layouts.metadata')
      @yield('extra-css')
      <style>
            .shadow-wrapper{
              position: absolute;
              width: 100%;
              height: 100%;
              background-color:rgba(0, 0, 0, 0.7);
              z-index:90;
              overflow:hidden;
              display: none;
            }
      </style>
</head>
<body>
  <div id="app">
    @include('layouts.header')
    @include('layouts.breadcrumb')
    <div class="shadow-wrapper"></div>
     @yield('content')
    @include('layouts.footer')
  </div>
  <!-- JavaScript -->
  <script src="{{ asset('/js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  @yield('extra-js')
  <script>
    $(document).ready(function(){
          $(".button-collapse").sideNav();
          $(".dropdown-button").dropdown();
          $('select').material_select();
          $("#search").blur(function(){
               $('.shadow-wrapper').css("display", "none").fadeOut(2000);
            });
          $("#search").focusin(function(){
              $('.shadow-wrapper').css("display", "block").fadeIn(2000);;
          });
        });
  </script>
</body>
</html>
