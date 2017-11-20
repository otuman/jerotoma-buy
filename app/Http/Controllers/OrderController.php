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
        return Datatables::of(Order::all())->make(true);
    }
}
