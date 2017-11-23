@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Create'))

@section('page_header')
  <div class="container-fluid">
    <h1 class="page-title">
        <i class="voyager-credit-cards"></i>Create Order
    </h1>
    <a href="{{url('admin/orders/')}}" class="btn btn-success btn-add-new">
        <i class="voyager-plus"></i> <span>View Orders</span>
    </a>
 </div>

@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">

                </div>
            </div>
        </div>
    </div>


    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>

    </script>
@stop
