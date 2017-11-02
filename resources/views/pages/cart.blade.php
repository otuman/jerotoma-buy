@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="page-header text-center">
           <h1>Your Cart</h1>
        </div>
        <p><a href="{{ url('shop') }}">Home</a> / Cart</p>
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        @if (sizeof(Cart::content()) > 0)

            <table class="bordered responsive-table">
                <thead>
                    <tr>
                        <th class="table-image"></th>
                        <th>Product</th>
                        <th>Price</th>
                         <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (Cart::content() as $item)
                    <tr>
                        <td class="table-image"><a href="{{ url('shop', [$item->model->slug]) }}"><img src="{{ asset('storage/products/' . $item->model->image) }}" alt="product" class="responsive-img"></a></td>
                        <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }} </a></td>
                        <td>${{ $item->price }}</td>
                        <td>
                             <select class="quantity" data-id="{{ $item->rowId }}">
                                 <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                 <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                 <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                 <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                 <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option>
                             </select>
                         </td>
                        <td>${{ $item->subtotal }}</td>
                        <td>
                            <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg"></i></button>
                            </form>
                            <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-heart fa-lg"></i></button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                        <td>${{ Cart::instance('default')->subtotal() }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">Tax</td>
                        <td>${{ Cart::instance('default')->tax() }}</td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr class="border-bottom">
                        <td class="table-image"></td>
                        <td style="padding: 40px;"></td>
                        <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                        <td class="table-bg">${{ Cart::total() }}</td>
                        <td class="column-spacer"></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>

            <a href="{{ url('/shop') }}" class="btn btn-primary">Continue Shopping</a> &nbsp;
            <a href="{{route('checkout')}}" class="btn btn-success">Proceed to Checkout</a>

            <div style="float:right">
                <form action="{{ url('/emptyCart') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger" value="Empty Cart">
                </form>
            </div>

        @else

            <h3>You have no items in your shopping cart</h3>
            <a href="{{ url('/shop') }}" class="btn btn-primary btn-lg">Continue Shopping</a>

        @endif

        <div class="spacer"></div>

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
