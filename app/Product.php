<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'password',
    ];

    public function prices() {
        return $this->hasMany('\App\Price');
    }

    public function storeProductWithPrice($request) {
        $product = self::create($request->all());

        Price::create(array(
            'product_id' => $product->id,
            'price' => $request->price,
            'active' => 1
        ));
        return true;
    }
    public function updateProductWithPrice($request) {
        self::where('id', $this->id)->update(array(
            'name' => $request->name,
            'description' => $request->description,
        ));
        if(!empty($request->price)) {
            Price::create(array(
                'product_id' => $this->id,
                'price' => $request->price,
                'active' => 1
            ));
        }
        return true;
    }
}
