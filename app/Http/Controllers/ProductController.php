<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Price;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $method = 'store';
        return view('product.form', compact('method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request) {
        $product = new Product();
        $product->storeProductWithPrice($request);

        return back()->with(array('message' => __('product.product_added')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $method = 'update/'. $id;
        $product = Product::with('prices')->find($id);
        return view('product.form', compact('product', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product) {
        $product->updateProductWithPrice($request, $id);
        return back()->with(array('message' => __('product.product_edited')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $prices = Price::where('product_id', $id)->get();

        foreach ($prices as $price)
            Price::destroy($price->id);

        Product::destroy($id);

        return back()->with('message', __('product.product_deleted'));
    }
}
