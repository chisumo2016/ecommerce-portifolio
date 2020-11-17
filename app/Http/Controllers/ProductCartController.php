<?php

namespace App\Http\Controllers;

use App\Product;
use App\cart;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $cart =  Cart::create(); // we dont pass any additionaal paremeter

        //cureent quantity if exist
        $quantity = $cart->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;


        $cart->products()->attach([
            $product->id => ['quantity' => $quantity + 1],
        ]);

        return  redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, cart $cart)
    {
        //
    }
}
