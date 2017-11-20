@extends('voyager::master')

@section('page_title', __('voyager.generic.viewing').' Orders')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">Orders</h1>

    </div>
@stop
@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                                <table class="table table-bordered" id="order-list-table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                        </tr>
                                    </thead>
                                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script>
    $(function() {
          $('#order-list-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{!! route('json/orders') !!}',
              columns: [
                  { data: 'id', name: 'id' },
                  { data: 'name', name: 'name' },
                  { data: 'email', name: 'email' },
                  { data: 'created_at', name: 'created_at' },
                  { data: 'updated_at', name: 'updated_at' }
              ]
          });
      });
    </script>
@stop
