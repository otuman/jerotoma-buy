<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.shop')->with('products', $products);
    }
    public function getProducts(){
       $products = Product::all()->chunk(4);
       return response()->json($products);
    }
    public function getSearch(Request $request){
      $data = array(
        's'=>$request->search,
        'message'=>'Thank for using this'
      );
      return response()->json($data);
    }
    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $interested = Product::where('slug', '!=', $slug)->get()->random(4);

        return view('pages.product')->with(['product' => $product, 'interested' => $interested]);
    }


}
