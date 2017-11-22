@extends('voyager::master')

@section('page_title', __('voyager.generic.viewing').' Orders')

@section('page_header')
    <div class="container-fluid">
      <h1 class="page-title">
          <i class="voyager-credit-cards"></i> Orders
      </h1>
      <a href="{{url('admin/orders/create')}}" class="btn btn-success btn-add-new">
          <i class="voyager-plus"></i> <span>Add New</span>
      </a>
      <a class="btn btn-danger" id="bulk_delete_btn"><i class="voyager-trash"></i> <span>Bulk delete</span></a>
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
                                   <th></th>
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

    <!-- Modal -->
    <div id="delete-order-modal" class="modal modal-danger fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete this Order?</h4>
          </div>
          <div class="modal-footer">
            <input type="hidden" class="form-control" name="deleted_user_id" id="deleted-user-id" value="" required autofocus>
            <button type="button" class="btn btn-info" data-dismiss="modal">No, Thank you</button>
            <button type="submit" id="delete-btn-submit" class="btn btn-danger">Yes</button>
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

   var tableData = $('#order-list-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{!! route('json/orders') !!}',
              columns: [
                  { data: 'checkmark', name: 'checkmark',printable:true,},
                  { data: 'id', name: 'id' },
                  { data: 'title', name: 'title' },
                  { data: 'status', name: 'status' },
                  { data: 'created_at', name: 'created_at' },
                  { data: 'updated_at', name: 'updated_at' },
                  { data: 'action', name:'action', printable:true,orderable: false, searchable: false }
              ]
          });

        $('.delete').on('click', function(e){

          console.log(e);

        });

        $( "#order-list-table tbody tr" ).on( "click", function() {
          console.log( $( this ).text() );
        });

      // Save edited row $(selector).post(URL,data,function(data,status,xhr),dataType)
 		   $("#delete-btn-submit").on("click", function(event) {
               var order_id = $('#deleted-order-id').val();
               //console.log(user_id);
               deleteOrder(user_id);
           });
        function deleteOrder(id){
            $.get('{{url("orders/delete")}}/' + id, function() {
              $('a[data-id="row-' + id + '"]').parent().parent().remove();
              $('#delete-user-modal').modal('hide');
              tableData.ajax.reload();
            }).fail(function() { alert('Unable to fetch data, please try again later.') });
         }

     $("#bulk_delete_btn").on("click", function(event) {
             var order_ids = [];
              $('input[name="selected_orders[]"]:checked').each(function() {
                 order_ids.push(this.value);
                 //console.log(this.value);
              });
              console.log(order_ids);
             event.preventDefault();           //deleteUser(user_id);
         });


     function bulkDeletion(order_ids){

         if(order_ids.length > 0 ){

         }
     }

    });


 // Remove row
    function removeRow(id) {
      if ( 'undefined' != typeof id ) {
         $.getJSON(
               '{{url("admin/orders")}}/'+ id,
                function(obj) {
                   //console.log(obj);
                   $('#deleted-user-id').val(obj.id);
                   $('#delete-order-modal').modal('show');
                })
                .fail(function() {
                  alert('Unable to fetch data, please try again later.')
                });
      } else alert('Unknown row id.');
    }


    </script>
@stop
