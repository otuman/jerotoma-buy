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
                                           <!-- <th></th> -->
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Order Total</th>
                                            <th>Status</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                 // { data: 'check', name: 'check'},
                  { data: 'id', name: 'id' },
                  { data: 'title', name: 'title' },
                  { data: 'status', name: 'status' },
                  { data: 'created_at', name: 'created_at' },
                  { data: 'updated_at', name: 'updated_at' },
                  { data: 'action', name: 'action', printable:true,orderable: false, searchable: false }
              ]
          });
      });
    </script>
@stop
