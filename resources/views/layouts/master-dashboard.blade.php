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
    <link href="{{ asset('assets/vendors/bootstrap/css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
         @yield('title')
    </title>   <!-- Styles -->
      @include('layouts.metadata')
      @yield('extra-css')
</head>
<body>
  <div id="app">
    @include('layouts.header-dashboard')
    @yield('content')
    @include('layouts.footer')
  </div>
  <!-- JavaScript -->
  <script src="{{ asset('assets/vendors/bootstrap/js/app.js') }}"></script>
   @yield('extra-js')
  <script>
    $(document).ready(function(){

        });
  </script>
</body>
</html>
