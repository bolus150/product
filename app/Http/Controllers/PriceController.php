<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
use App\Price;

class PriceController extends Controller
{
    public function delete($id){
        Price::destroy($id);
        return back()->with('message', __('product.price_deleted'));
    }

    public function update(PriceRequest $request, $id){
        $price = Price::find($id);
        $price->price = $request->priceEdit;
        $price->save();

        return back()->with('message', __('product.price_edited'));
    }
}
