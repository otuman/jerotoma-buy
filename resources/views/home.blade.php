@extends('layouts.master')
@section('below-header')
     <app-search></app-search>   
@endsection
@section('content')
        <app-home></app-home>  <!--Vue js component   https://alligator.io/vuejs/component-lifecycle/ -->
        <products></products>
@endsection
@section('extra-js')
    <script>

    </script>
@endsection
