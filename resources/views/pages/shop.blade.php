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
                    <div class="col m3">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('storage/products/' . $product->image) }}" alt="product" class="responsive-img activator"></a>
                            </div> <!-- end caption -->
                            <div class="card-content">
                              <span class="activator grey-text text-darken-4">{{ $product->name }}<i class="material-icons right">more_vert</i></span>
                              <p><a href="{{ url('shop', [$product->slug]) }}">This is a link</a></p>
                            </div>
                            <div class="card-reveal">
                              <span class="card-title grey-text text-darken-4">{{$product->name}}<i class="material-icons right">close</i></span>
                              <p>{{ $product->name }}</p>
                            </div>
                            <div class="card-action">
                              <a class="btn-floating btn waves-effect waves-light red"><i class="large material-icons">add_shopping_cart</i></a>
                              <a class="btn-floating btn waves-effect waves-light red right"><i class="large material-icons">favorite</i></a>
                            </div>
                        </div> <!-- end thumbnail -->
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

    </div> <!-- end container -->

@endsection
