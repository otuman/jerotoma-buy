@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="page-header text-center">
           <h1>{{ $product->name }}</h1>
        </div>
        <p><a href="{{ url('/shop') }}">Shop</a> / {{ $product->name }}</p>
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="product" class="img-responsive">
            </div>

            <div class="col-md-8">
                <h3>${{ $product->price }}</h3>
                <form action="{{ url('/cart') }}" method="POST" class="side-by-side">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="submit" class="btn btn-success btn-sm" value="Add to Cart">
                </form>

                <form action="{{ url('/wishlist') }}" method="POST" class="side-by-side">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="submit" class="btn btn-primary btn-sm" value="Add to Wishlist">
                </form>
                <h3>Descriptions</h3>
                <p>{{ $product->description }} </p>

            </div> <!-- end col-md-8 -->
        </div> <!-- end row -->

        <div class="spacer"></div>

        <div class="row">
            <h3>You may also like...</h3>

            @foreach ($interested as $product)
                <div class="col-md-3">
                    <div class="thumbnail">
                        <div class="caption text-center">
                            <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('storage/products/' . $product->image) }}" alt="product" class="img-responsive"></a>
                            <a href="{{ url('shop', [$product->slug]) }}"><h3>{{ $product->name }}</h3>
                            <p>{{ $product->price }}</p>
                            </a>
                        </div> <!-- end caption -->

                    </div> <!-- end thumbnail -->
                </div> <!-- end col-md-3 -->
            @endforeach

        </div> <!-- end row -->

        <div class="spacer"></div>


    </div> <!-- end container -->

@endsection
