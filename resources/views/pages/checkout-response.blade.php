@extends('layouts.master')
@section('title')
  Checkout Response
@endsection
@section('content')
    <div class="container">
        <div class="page-header text-center">
           Confirmation
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                  <div class="alert alert-success">
                     <strong>Success!</strong> Thank you for choosing Pizzashop, you've successifully paid <strong>${{ $order->order_total }}</strong> for the order #{{$order->id}}
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">Customer information</div>
                    <div class="panel-body">
                         <div class="table-responsive">
                               <table class="table table-hover">
                                 <tbody>
                                   <tr>
                                      <td class="">Full name :</td>
                                      <td>{{ $order->shipping->firstName }} {{ $order->shipping->lastName }}</td>
                                   </tr>
                                  <tr>
                                      <td class="">Address : </td>
                                      <td>
                                        {{ $order->shipping->address_1 }},
                                        {{ $order->shipping->address_2 }}
                                        {{ $order->shipping->city }},
                                        {{ $order->shipping->state }},
                                        {{ $order->shipping->postal_code }}
                                      </td>
                                  </tr>
                                  <tr>
                                       <td class="">Country :</td>
                                       <td>{{ $order->shipping->country_code }}</td>
                                  </tr>
                               </tbody>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                <div class="panel-heading">Product(s)</div>
                <div class="panel-body">
                  <table class="table table-hover">
                      <thead>
                          <tr>
                               <th>Name</th>
                               <th>Price</th>
                               <th>Quantity</th>
                               <th>Total</th>
                          </tr>
                      </thead>

                      <tbody>
                          @foreach ($order->items as $item)
                            <tr>
                                <td>{{$item->item_name }}</td>
                                <td>${{$item->item_price }}</td>
                                <td>{{$item->item_qty}}</td>
                                <td>${{$item->item_price * $item->item_qty }}</td>
                            </tr>
                          @endforeach
                       </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                  <div class="panel-heading">Order Summary</div>
                  <div class="panel-body">
                    <div class="table-responsive">
                          <table class="table table-hover">
                            <tbody>
                              <tr>
                                 <td class="">Subtotal :</td>
                                 <td>${{ $order->order_total }}</td>
                              </tr>
                             <tr>
                                 <td class="">HST :</td>
                                 <td>${{ $order->order_tax_total }}</td>
                             </tr>
                             <tr>
                                 <td class="">Total :</td>
                                 <td class="">${{ $order->order_total }}</td>
                             </tr>
                          </tbody>
                      </table>
                      </div>
                   </div>
                </div>
             </div>
          </div>
           <div class="spacer"></div>
    </div>
@endsection
