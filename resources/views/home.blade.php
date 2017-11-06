@extends('layouts.master')
@section('breadcrumb')
   <div class="col m8 offset-m2">
      <app-search></app-search>
   </div>
@endsection
@section('content')
        <app-home></app-home>  <!--Vue js component   https://alligator.io/vuejs/component-lifecycle/ -->
        <products></products>
@endsection
@section('extra-js')
    <script>

    </script>
@endsection
