@extends('layouts.master')

@section('content')
    <div class="container">
        <p><a href="{{ url('shop') }}">Home</a> / Cart</p>
        <h1>Your Cart</h1>
        <hr>
         @if (sizeof(Cart::content()) > 0)
            <div class="row">
              <div class="col m12">
                @if(session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif
                @if (session()->has('error_message'))
                    <div class="alert alert-danger">
                        {{ session()->get('error_message') }}
                    </div>
                @endif

                    <table class="bordered responsive-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                 <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (Cart::content() as $item)
                            <tr>
                                <td class="table-image"><a href="{{ url('shop', [$item->model->slug]) }}"><img src="{{ asset('storage/products/' . $item->model->image) }}" alt="product" class="responsive-img"></a></td>
                                <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }} </a></td>
                                <td>${{ $item->price }}</td>
                                <td>
                                  <div class="row">
                                     <div class="input-field col m4">
                                       <select class="quantity grey lighten-3" data-id="{{ $item->rowId }}">
                                           <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                           <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                           <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                           <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                           <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                                       </select>
                                     </div>
                                  </div>
                                 </td>
                                <td>${{ $item->subtotal }}</td>
                                <td>
                                    <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                        {!! csrf_field() !!}
                                        <button type="submit" class="btn-floating btn waves-effect waves-light green"><i class="material-icons small">favorite</i></button>
                                    </form>
                                    <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                       {!! csrf_field() !!}
                                       <input type="hidden" name="_method" value="DELETE">
                                       <button type="submit" class="btn-floating btn waves-effect waves-light red"><i class="material-icons small">delete</i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
              </div>
            </div>
            <div class="row">
              <div class="col s6 offset-s6">
                <div class="card-panel">
                   <div class="card-action"> <h4 class="card-title">Cart Summary</h4></div>
                    <div class="card-content">
                      <table class="striped responsive-table">
                         <tbody>
                           <tr>
                             <td>Subtotal</td>
                             <td>${{ Cart::instance('default')->subtotal() }}</td>
                           </tr>
                           <tr>
                             <td>Tax</td>
                             <td>${{ Cart::instance('default')->tax() }}</td>
                           </tr>
                           <tr>
                             <td>Your Total</td>
                             <td>${{ Cart::total() }}</td>
                           </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
               <div class="col m6">
                 <a href="{{ url('/shop') }}" class="waves-effect waves-light btn">Continue Shopping</a> &nbsp;
                 <a href="{{route('checkout')}}" class="waves-effect waves-light btn">Proceed to Checkout</a>
               </div>
               <div class="col m6">
                 <div class="right">
                     <form action="{{ url('/emptyCart') }}" method="POST">
                         {!! csrf_field() !!}
                         <input type="hidden" name="_method" value="DELETE">
                         <input type="submit" class="waves-effect waves-light btn red" value="Empty Cart">
                     </form>
                 </div>
               </div>
            </div>
           @else
           <div class="row">
              <div class="col m12">
                <h2>You have no item in your Cart</h2>
                <a href="{{ url('/shop') }}" class="waves-effect waves-light btn">Continue Shopping</a> &nbsp;
              </div>
           </div>

          @endif
    </div> <!-- end container -->

@endsection
@section('extra-js')
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity').on('change', function() {

                var token = '{{Session::token()}}';
                var id = $(this).attr('data-id')

                $.ajax({
                  type: "PATCH",
                  url: '{{ url("/cart") }}' + '/' + id,
                  data: {
                    'quantity': this.value,
                    '_token': token
                  },
                  success: function(data) {
                    window.location.href = "{{ url('cart') }}";
                  },
                  error:function(xhr, status){
                    console.log(xhr);
                  }
                });

            });

        })();
    </script>
@endsection
