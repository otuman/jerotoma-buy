<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Yajra\Datatables\Datatables;


class OrderController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
     }

     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index(){

         return view('vendor/voyager/orders/browse');
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         //
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         //
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
          $order = Order::find($id);

          logger('I got here');

         return view('vendor/voyager/orders/edit-add', compact('order'));
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         //
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {

     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         //


     }

       /**
   * Process datatables ajax request.
   *
   * @return \Illuminate\Http\JsonResponse
   */
    public function getJsonOrders()
    {
        $order = Order::all();


       return Datatables::of($order)
                ->addColumn('action', function(Order $order){
                            return '<a href="javascript:;" title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="'.$order->id.'" id="delete-1">
                                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
                                   </a>
                                   <a href="'.url("admin/orders").'/'.$order->id.'/edit" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                     <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                                   </a>
                                   <a href="'.url("admin/orders").'/'.$order->id.'" title="View" class="btn btn-sm btn-warning pull-right">
                                      <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">View</span>
                                   </a>';
                })
               //->addColumn('check', '<input type="checkbox" name="selected_users[]" value="">')
               ->removeColumn('cart')
               ->removeColumn('paymentID')
               ->removeColumn('payerID')
               ->removeColumn('paymentToken')
               ->removeColumn('accessToken')
               ->removeColumn('intent')
               ->make(true);
    }
}
