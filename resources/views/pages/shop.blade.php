@extends('layouts.master')
@section('title')
    {{ config('app.name', 'Kings Pizza | The Best Pizza in Town') }}
@endsection
@section('content')

    <div class="container">
        <div class="page-header text-center">All Products </div>
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

        @foreach ($products->chunk(4) as $items)
            <div class="row">
                @foreach ($items as $product)
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
        @endforeach

    </div> <!-- end container -->

@endsection
