<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Response;
use App\Helpers;
use App\Item;
use App\Order;
use App\Shipping;
use Cart;
use Auth;

class CheckoutController extends Controller
{

     public function __construct(){

        $this->middleware('auth');
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Log::info(env('PAYPAL_SANDBOX_CLIENT_ID',''));
        //Log::info(env('PAYPAL_SANDBOX_CLIENT_ID',''));
        //Log::info($this->getAccessToken());
       //var_dump($this->getPaymentJSONData());
       $user = Auth::user();
       return view('pages.checkout', compact('user'));
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
         $paymentID = $request->paymentID;
         $payerID = $request->payerID;
         $intent  = $request->intent;
         $paymentToken = $request->paymentToken;
         $returnUrl    = $request->returnUrl;
        // $shipping     = $request->shipping;
         $responseToken = toObject($this->getAccessToken());
         $cartItems = Cart::content();

         $createOrderItems = array(
               'user_id'=> Auth::user()->id,
               'title'=>'Description needed',
               'order_total'=>Cart::total(),
               'order_tax_total'=>Cart::instance('default')->tax(),
               'order_shipping_total'=> 0,
               'status'=>'unpaid',
               'payment_method'=>'',
               'paymentID'=>$paymentID,
               'payerID'=>$payerID,
               'paymentToken'=>$paymentToken,
               'accessToken'=>$responseToken->access_token,
               'intent'=>$intent,
               'cartItems'=> $cartItems,
               'shipping'=> [
                 'first_name'=>$request->first_name,
                 'last_name'=> $request->last_name,
                 'address_1'=> $request->address_1,
                 'address_2'=> $request->address_2,
                 'city'=> $request->city,
                 'country_code'=>$request->country_code,
                 'postal_code'=> $request->postal_code,
                 'phone'=> $request->phone,
                 'isDefault'=> $request->isDefault,
                 'special_note'=> $request->special_note,
                 'state'=> $request->state,
               ]
         );

        $order = $this->createOrder($createOrderItems);


         $data = array(
           'payer_id'=>$payerID,
           'transactions'=>$this->getTransactionItems($order),
         );
         $url = 'https://api.sandbox.paypal.com/v1/payments/payment/'.$paymentID.'/execute/';
         $headers = array(
            'Authorization: Bearer '.$responseToken->access_token
         );

         //$headers = array( 'MyFirstHeader: 123', 'MySecondHeader: 456' )
         //$data = array( 'foz' => 'baz' )
         //$url = 'http://www.foo.com/bar'
     $jsonData = $this->executePaymant($url, $data, $headers);
      //Log::info($jsonData);
       //Log::info($accesstoken);
      if(($jsonData['state'] == 'approved') && ($jsonData['payer']['status'] == 'VERIFIED') ){
         $order  = Order::find($jsonData['transactions'][0]['invoice_number']);
         $order->status = 'paid';
         $order->cart = $jsonData['cart'];
         $order->save();

      }
      return response()->json($jsonData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {     $order = Order::find($id);


       return view('pages.checkout-response', compact('order'));
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
        //
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
    public function checkoutResponse($id){

     $order = Order::find($id);
     return view('pages.checkout-response', compact('order'));
    }
    public function testNested(Request $request)
    {
       var_dump($request->address);
    }

    public function executePaymant($url, $data, $headers){
       //$headers = array( 'MyFirstHeader: 123', 'MySecondHeader: 456' )
       //$data = array( 'foz' => 'baz' )
       //$url = 'http://www.foo.com/bar'
       // Send a POST request to: http://www.foo.com/bar with arguments 'foz' = 'baz' using JSON and return as associative array

    $path = storage_path('app/execute-paymant.log');
    return Curl::to($url)
            ->withHeaders($headers)
            ->withData($data)
            ->enableDebug($path)
            ->asJson(true)
            ->post();
    }


  public function getAccessToken(){
     // https://developer.paypal.com/docs/api/overview/#get-an-access-token
        $url = 'https://api.sandbox.paypal.com/v1/oauth2/token';
        $headers = array(
          'Accept: application/json',
          'Accept-Language: en_US',
          'Content-Type: application/x-www-form-urlencoded'
        );
        $data = 'grant_type=client_credentials';
        $path = storage_path('app/access-token.log');
        $response = Curl::to($url)
            ->withHeaders($headers)
            ->withOption('USERPWD', env('PAYPAL_SANDBOX_CLIENT_ID','').':'.env('PAYPAL_SANDBOX_SECRET',''))
            ->withData($data)
            ->enableDebug($path)
            ->post();


     return json_decode($response, true);
    }

    public function getPaymentJSONData(){

        $jsonData = array(
            'intent'=> "sale",
            'payer'=> [
              'payment_method'=> "paypal"
            ],
            //'transactions'=> $this->getTransactionItems(),
            'note_to_payer'=> "Contact us for any questions on your order.",
            'redirect_urls'=> [
            'return_url'=> "https://www.paypal.com/return",
            'cancel_url'=> "https://www.paypal.com/cancel"
            ]
          );

      return response()->json($jsonData);
    }

   public function getTransactionItems(Order $order){

         $cartItems = Cart::content();
         $items = array();
          foreach ($cartItems as $key => $item) {
            $items[] =  [
             'name'=> $item->name,
             'description'=> "Brown hat.",
             'quantity'=> $item->qty,
             'price'=> $item->price,
             'tax'=> 0.00, //$item->priceTax
             'sku'=> '1',
             'currency'=> "CAD"
           ];
          }
          $shipping = $order->shipping;
          //var_dump($shipping);
          $amount = [
             'total'=> Cart::total(),
             'currency'=> 'CAD',
             'details'=>[
                'subtotal'=> Cart::instance('default')->subtotal(),
                'tax'=> Cart::instance('default')->tax(),
                'shipping'=> "0.00",
                'handling_fee'=> "0.00",
                'shipping_discount'=> "0.00",
                'insurance'=> "0.00"
              ]
          ];

        $transactions = [
           [
           'amount'=>$amount,
           'description'=> "The payment transaction description.",
           'custom'=> "EBAY_EMS_90048630024435",
           'invoice_number'=> $order->id,
           'payment_options'=> [
               'allowed_payment_method'=> "INSTANT_FUNDING_SOURCE"
           ],
           'soft_descriptor'=> "ECHI5786786",
           'item_list'=>[
               'items'=>$items,
               'shipping_address'=> [
                   'recipient_name'=> $shipping->firstName.' '.$shipping->lastName,
                   'line1'=> $shipping->address_1,
                   'line2'=> $shipping->address_2,
                   'city'=> $shipping->city,
                   'country_code'=> $shipping->country_code,
                   'postal_code'=> $shipping->postal_code,
                   'phone'=> $shipping->phone,
                   'state'=> $shipping->state
               ]
           ]
         ]
     ];

     return $transactions;
   }

   /**
    * Create order and its metas and Store in the database.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

   public function createOrder($data){

      if (Auth::check() && count(Cart::content()) > 0) {

        $order = new Order();
        $order->user_id = $data['user_id'];
        $order->title   = $data['title'];
        $order->order_total   = $data['order_total'];
        $order->order_tax_total   = $data['order_tax_total'];
        $order->order_shipping_total   = $data['order_shipping_total'];
        $order->status   = $data['status'];
        $order->payment_method   = $data['payment_method'];
        $order->paymentID   = $data['paymentID'];
        $order->payerID   = $data['payerID'];
        $order->paymentToken   = $data['paymentToken'];
        $order->accessToken   = $data['accessToken'];
        $order->intent   = $data['intent'];
        $order->save();

        foreach($data['cartItems'] as $key => $cartItem){
             $itemdb  = new Item();
             $itemdb->order_id = $order->id;
             $itemdb->item_name = $cartItem->name;
             $itemdb->item_qty = $cartItem->qty;
             $itemdb->item_price = $cartItem->price;
             $itemdb->tax = 0.00;
             $itemdb->options = "Numerilize";
             $itemdb->save();
        }
        Log::info($data['shipping']);
        $shipping = new Shipping();
        $shipping->user_id = $data['user_id'];
        $shipping->order_id = $order->id;
        $shipping->isDefault = $data['shipping']['isDefault'];
        $shipping->firstName = $data['shipping']['first_name'];
        $shipping->lastName = $data['shipping']['last_name'];
        $shipping->address_1 = $data['shipping']['address_1'];
        $shipping->address_2 = $data['shipping']['address_2'];
        $shipping->phone = $data['shipping']['phone'];
        $shipping->city = $data['shipping']['city'];
        $shipping->state = $data['shipping']['state'];
        $shipping->postal_code = $data['shipping']['postal_code'];
        $shipping->country_code = $data['shipping']['country_code'];
        $shipping->special_note = $data['shipping']['special_note'];
        $shipping->save();

        return Order::find($order->id);
      }


   }


}
