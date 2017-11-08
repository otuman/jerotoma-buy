@extends('layouts.master')
@section('title')
  Checkout Response
@endsection
@section('below-header')
   <div class="col m8 offset-m2">
      <app-search></app-search>
   </div>
@endsection
@endsection
@section('content')
    <div class="container">
        <h2 class="center-align">Confirmation</h2>
        <div class="row">
            <div class="col m12">
                  <div class="card-panel green lighten-2 white-text text-darken-2">
                     <strong>Success!</strong> Thank you for choosing Pizzashop, you've successifully paid <strong>${{ $order->order_total }}</strong> for the order #{{$order->id}}
                  </div>
                  <div class="card-panel">
                    <div class="card-title">Customer information</div>
                    <div class="card-content">
                         <div class="table-responsive">
                               <table class="table table striped bordered">
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
                <div class="card-panel">
                  <div class="card-title">Product(s)</div>
                  <div class="card-content">
                    <table class="table striped bordered">
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
                <div class="row">
                        <div class="col m6 offset-m6">
                          <div class="card-panel">
                          <div class="card-title">Order Summary</div>
                          <div class="card-content">
                            <div class="table-responsive">
                                  <table class="table striped bordered">
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
            </div>
        </div>

           <div class="spacer"></div>
    </div>
@endsection
