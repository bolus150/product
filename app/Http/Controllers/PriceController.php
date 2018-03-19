<?php

namespace App\Http\Controllers;

use App\Price;
use App\Http\Requests\PriceRequest;

class PriceController extends Controller
{
    /**
     * @param Price $price
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Price $price){
        return view('price.edit', compact('price'));
    }

    /**
     * @param PriceRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PriceRequest $request, Price $price) {
        $price->price = $request->price;
        $price->save();

        return back()->with('message', __('product.price_edited'));
    }

    /**
     * @param Price $price
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Price $price){
        $price->delete();
        return back()->with('message', __('product.price_deleted'));
    }
}
