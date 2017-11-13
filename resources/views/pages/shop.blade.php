@extends('layouts.master')
@section('title')
    {{ config('app.name', 'Kings Pizza | The Best Pizza in Town') }}
@endsection
@section('below-header')
   <div class="col m8 offset-m2">
      <app-search></app-search>
   </div>
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
                                <a href="{{ url('shop', [$product->slug]) }}"><img src="{{ asset('storage/products/'.$product->image) }}" alt="{{$product->name}}" class="responsive-img activator"></a>
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
                              <div class="row">
                                 <div class="col m12">
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
                                       <button class="btn-floating btn waves-effect waves-light red right"  type="submit" name="action">
                                         <i class="material-icons small">favorite</i>
                                       </button>
                                   </form>
                                 </div>
                              </div>
                            </div>
                        </div> <!-- end thumbnail -->
                    </div> <!-- end col-md-3 -->
                @endforeach
            </div> <!-- end row -->
        @endforeach

    </div> <!-- end container -->

@endsection
