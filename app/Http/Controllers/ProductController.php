<?php

namespace App\Http\Controllers;

use App\Price;
use App\Product;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('product.create');
    }

    /**
     * @param ProductCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductCreateRequest $request) {
        $product = new Product();
        $product->storeProductWithPrice($request);

        return back()->with(array('message' => __('product.product_added')));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product) {
        return view('product.edit', compact('product'));
    }

    /**
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product) {
        $product->updateProductWithPrice($request);
        return back()->with(array('message' => __('product.product_edited')));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        $prices = Price::where('product_id', $id)->get();

        foreach ($prices as $price)
            Price::destroy($price->id);

        Product::destroy($id);

        return back()->with('message', __('product.product_deleted'));
    }
}
