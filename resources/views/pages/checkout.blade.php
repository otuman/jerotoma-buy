@extends('layouts.master')
@section('title')
  Checkout
@endsection
@section('below-header')
   <div class="col m8 offset-m2">
      <app-search></app-search>
   </div>
@endsection
@section('content')

    <div class="container">
        <div class="page-header text-center">
           <h2>Checkout</h3>
        </div>
        @if(sizeof(Cart::content()) > 0)
            <div class="row" style="margin-bottom:0">
              <div class="col m12">
                  <div class="card-panel">
                    <div class="card-title">Shipping Details</div>
                    <hr>
                    <div class="card-content">
                        <form data-toggle="validator" role="form" id="shipping-form">
                        @include('pages.shipping-form')
                        </form>
                    </div>
                  </div>
                  <div class="card-panel">
                    <div class="card-title">Product(s)</div>
                    <hr>
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
                              @foreach (Cart::content() as $item)
                                <tr>
                                    <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a></td>
                                    <td>${{$item->price }}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>${{$item->subtotal }}</td>
                                </tr>
                              @endforeach
                           </tbody>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
        <div class="row">
                <div class="col m6 s12 offset-m6">
                  <div class="card-panel">
                  <div class="card-title">Order Summary</div>
                  <hr>
                  <div class="card-content">
                    <div class="table-responsive">
                          <table class="table table striped bordered">
                            <tbody>
                              <tr>
                                 <td class="">Subtotal :</td>
                                 <td>${{ Cart::instance('default')->subtotal() }}</td>
                              </tr>
                             <tr>
                                 <td class="">HST :</td>
                                 <td>${{ Cart::instance('default')->tax() }}</td>
                             </tr>
                             <tr>
                                 <td class="">Total :</td>
                                 <td class="">${{ Cart::total() }}</td>
                             </tr>
                          </tbody>
                      </table>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="row">
            <div class="col m6 offset-m3">
             <div id="inform-user" class="alert alert-danger" style="display:none;">
                 <strong>Validation!</strong> Please make sure all required field aren't empty
             </div>
            </div>
          </div>
          <div class="row">
            <div class="col m6 offset-m3">
              <div class="checkbox">
                <input type="checkbox" value="" id="checkbox-terms-and-conditions">
                <label for="checkbox-terms-and-conditions">Check here to continue</label>
              </div>
              <div class="input-field">
                  <div id="paypal-button-container"></div>
              </div>
            </div>
          </div>
      @else
        <div class="row">
            <div class="col-md-12">
              <h3>You have no items in your shopping cart</h3>
              <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a>
           </div>
       </div>
      @endif
      <div class="spacer"></div>
</div> <!-- end container -->

@endsection
@section('extra-js')
   <script>
    //https://developer.paypal.com/demo/checkout/#/pattern/validation
    //https://developer.paypal.com/docs/integration/direct/express-checkout/integration-jsv4/customize-the-checkout-flow/
     $(document).ready(function(){
        var firstName = $('#first_name'),
            lastName = $('#last_name'),
            address_1 = $('#address_1'),
            address_2 = $('#address_2'),
            phone = $('#phone'),
            city = $('#city'),
            state = $('#state'),
            postal_code = $('#postal_code'),
            country = $('#country'),
            special_note = $('#special_note'),
            termsCheckBox = $('#checkbox-terms-and-conditions'),
            isDefault  = $('#isDefault');

        function isValid() {

             if(firstName.val() == '' || lastName.val() == '' ||  address_1.val() == '' || phone.val() == '' ||
                city.val() == '' ||  state.val() == '' || postal_code.val() == '' || country.val() == '' || !termsCheckBox.is(':checked') ){
                return false;
             }else{

               return true;
             }
        }

        function watchChanges(handler) {
            termsCheckBox.change(handler);
            firstName.change(handler);
            lastName.change(handler);
            address_1.change(handler);
            phone.change(handler);
            city.change(handler);
            postal_code.change(handler);
            state.change(handler);
            country.change(handler);
        }

        function toggleValidationMessage() {
            document.querySelector('#inform-user').style.display = (isValid() ? 'none' : 'block');
        }

        function toggleButton(actions) {
             return isValid() ? actions.enable() : actions.disable();
        }
         //var data =   $.getJSON("{{route('json/checkout/payments')}}");
         // console.log(data);
         paypal.Button.render({
              env: 'sandbox', // Or 'sandbox',
                 // Show the buyer a 'Pay Now' button in the checkout flow
              commit: true,
              locale:'en_CA',
               // Specify the style of the button
             style: {
                   label: 'pay',
                   size:  'large',    // small | medium | large | responsive
                   shape: 'rect',     // pill | rect
                   color: 'gold',     // gold | blue | silver | black
               },
               // Specify allowed and disallowed funding sources
               //
               // Options:
               // - paypal.FUNDING.CARD
               // - paypal.FUNDING.CREDIT
               // - paypal.FUNDING.ELV
            /*   funding: {
                   allowed: [ paypal.FUNDING.CARD, paypal.FUNDING.CREDIT ],
                   disallowed: [ ]
               },*/
               // PayPal Client IDs - replace with your own
              // Create a PayPal app: https://developer.paypal.com/developer/applications/create
              client:{
                  sandbox:'{{env('PAYPAL_SANDBOX_CLIENT_ID','')}}',
                  production:'<insert production client id>'
              },
              validate: function(actions) {
                  toggleButton(actions);
                  watchChanges(function() {
                      toggleButton(actions);
                  });
              },

              onClick: function() {
                  toggleValidationMessage();

              },
               // payment() is called when the button is clicked
              payment:function(data, actions) {

                  // Make a call to the REST api to create the payment
                  return actions.payment.create({
                      payment: {
                          intent: "sale",
                         payer: {
                           payment_method: "paypal"
                         },
                          transactions: [{
                            amount: {
                               total: '{{ Cart::total() }}',
                               currency: 'CAD',
                               details:{
                                subtotal: '{{ Cart::instance('default')->subtotal() }}',
                                tax: '{{ Cart::instance('default')->tax() }}',
                                shipping: '0.00',
                                handling_fee: '0.00',
                                shipping_discount: '0.00',
                                insurance: '0.00'
                               }
                            },
                            description: "The payment transaction description."
                          }
                        ]
                      }
                    });
              },
                 // onAuthorize() is called when the buyer approves the payment
             onAuthorize: function(data, actions) {

                 // Set up a url on your server to execute the payment
                  var EXECUTE_URL = "{{route('paypal/payment/execute/')}}";
                  var token = '{{Session::token()}}';
                  // Set up the data you need to pass to your server

                 // Set up the data you need to pass to your server
                 var postData = {
                       paymentID: data.paymentID,
                       payerID: data.payerID,
                       intent:data.intent,
                       paymentToken:data.paymentToken,
                       returnUrl:data.returnUrl,
                       first_name:firstName.val(),
                       last_name: lastName.val(),
                       address_1: address_1.val(),
                       address_2: address_2.val(),
                       city: city.val(),
                       country_code:'CA',
                       postal_code: postal_code.val(),
                       phone: phone.val(),
                       special_note: special_note.val(),
                       state: state.val(),
                       isDefault: isDefault.is(':checked') ? 1 : 0,                          //  shipping:address,
                       _token: token
                  };

                 // Make a call to your server to execute the payment
                 return paypal.request.post(EXECUTE_URL, postData)
                     .then(function (res) {
                         console.log(res);
                         var url = '{{url('checkout/response')}}/';
                         if(res.payer.status == 'VERIFIED' && res.state == 'approved'){
                           window.location.replace(url+res.transactions[0].invoice_number);
                         }


                     });
             },
             onCancel: function(data){
                console.log(data);
            }
          }, '#paypal-button-container');
     });
    </script>
@endsection
