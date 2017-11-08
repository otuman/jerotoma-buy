@extends('layouts.master')
@section('title')
  Product - {{ $product->name }}
@endsection
@section('below-header')
   <div class="col m8 offset-m2">
      <app-search></app-search>
   </div>
@endsection
@section('content')

    <div class="container">
        <div class="page-header text-center">
           <h1>{{ $product->name }}</h1>
        </div>
        <p><a href="{{ url('/shop') }}">Shop</a> / {{ $product->name }}</p>
        <div class="row">
          <div class="col s12 m12">
             <div class="card horizontal">
              <div class="card-image">
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="product" class="responsive-img">
              </div>
              <div class="card-stacked">
                <div class="card-content">
                  <h3>${{ $product->price }}</h3>
                  <form action="{{ url('/cart') }}" method="POST">
                      {!! csrf_field() !!}
                      <input type="hidden" name="id" value="{{ $product->id }}">
                      <input type="hidden" name="name" value="{{ $product->name }}">
                      <input type="hidden" name="price" value="{{ $product->price }}">
                      <button class="btn-floating btn waves-effect waves-light red" type="submit" name="action" style="float:left; margin-right:10px;">
                        <i class="material-icons small">add_shopping_cart</i>
                      </button>
                  </form>

                  <form action="{{ url('/wishlist') }}" method="POST">
                      {!! csrf_field() !!}
                      <input type="hidden" name="id" value="{{ $product->id }}">
                      <input type="hidden" name="name" value="{{ $product->name }}">
                      <input type="hidden" name="price" value="{{ $product->price }}">
                      <button class="btn-floating btn waves-effect waves-light red" style="float:left;" type="submit" name="action">
                        <i class="material-icons small">favorite</i>
                      </button>
                  </form>
                  <div class="clearfix"></div>
                  <h3>Descriptions</h3>
                  <p>{{ $product->description }} </p>
                </div>
                <div class="card-action">
                  <a href="#">This is a link</a>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- end row -->

        <div class="spacer"></div>

        <div class="row">
            <h3>You may also like...</h3>

            @foreach ($interested as $product)
                <div class="col m3">
                     <div class="card">
                          <div class="card-image">
                            <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('storage/products/' . $product->image) }}" alt="product" class="img-responsive"></a>
                          </div>
                          <div class="card-content">
                            <a href="{{ url('shop', [$product->slug]) }}">{{ $product->name }}
                            <p>{{ $product->price }}</p>
                            </a>
                          </div>
                          <div class="card-action">
                            <a href="#">This is a link</a>
                          </div>
                    </div>
                </div> <!-- end col-md-3 -->
            @endforeach

        </div> <!-- end row -->

        <div class="spacer"></div>


    </div> <!-- end container -->

@endsection
