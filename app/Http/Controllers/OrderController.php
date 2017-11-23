<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use App\Order;
use Yajra\Datatables\Datatables;
use Request as DataRequest;


class OrderController extends Controller
{

     public $currentRoute;

     public function __construct(){
         $route = Route::current();
         $this->currentRoute = $route->getName();
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
         $response =(object)[
           'currentRoute'=>$this->currentRoute
         ];
         return view('vendor/voyager/orders/edit-add', compact('response'));
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

         if(DataRequest::ajax()){
        $response = response()->json([
               'id' => $order->id,
               'title' => $order->title,
               'user_ide' => $order->user_id,
               'payment_method' => $order->payment_method,
               'total' => $order->order_total,
               'status' => $order->status
             ]);
         return $response;
       }

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
            $response =(object)[
              'order'=>Order::find($id),
              'currentRoute'=>$this->currentRoute
            ];

         return view('vendor/voyager/orders/edit-add', compact('response'));
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
                            return '<a href="javascript:;" title="Delete" class="btn btn-sm btn-danger pull-right delete" onclick="removeRow('.$order->id.')" data-id="'.$order->id.'" id="delete-1">
                                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
                                   </a>
                                   <a href="'.url("admin/orders").'/'.$order->id.'/edit" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                     <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span>
                                   </a>
                                   <a href="'.url("admin/orders").'/'.$order->id.'" title="View" class="btn btn-sm btn-warning pull-right">
                                      <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">View</span>
                                   </a>';
                })
               ->editColumn('status', function(Order $order){
                 return $this->getOrderStatus($order);
               })
               ->addColumn('checkmark', function(Order $order){
                 return '<input class="order-checked-box" type="checkbox" name="selected_orders[]" value="'.$order->id.'">';
               })
               ->rawColumns(['checkmark', 'action','status'])
               ->removeColumn('cart')
               ->removeColumn('paymentID')
               ->removeColumn('payerID')
               ->removeColumn('paymentToken')
               ->removeColumn('accessToken')
               ->removeColumn('intent')
               ->make(true);
    }

    public function getOrderStatus($order){
        $options  = array(
          'paid','unpaid','pending'
        );
        $select  = '<select passive="true" class="form-control" id="change-status-'.$order->id.'" onchange=getSelectedStatus('.$order->id.')>';

           foreach ($options as $key => $option) {
            if($option == $order->status) {
              $select .= '<option selected value ='.$option.'>'.$option.'</option>';
            }else{
              $select .= '<option value ='.$option.'>'.$option.'</option>';
            }
           }
          $select .= '</select>';
      return $select;
    }

}
