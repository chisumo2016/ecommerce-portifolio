<?php

namespace App\Http\Controllers;

use App\Product;
use App\cart;
use Illuminate\Support\Facades\Cookie;
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
        //$cart =  Cart::create()->cookie(); // we dont pass any additionaal paremeter

        $cart = $this->getFromCookieOrCreate();

        //cureent quantity if exist

        $quantity = $cart->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;

   //attach , sync , syncWithoutDetaching

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity + 1],
        ]);

        $cookie = Cookie::make('cart',$cart->id, 7 * 24 * 60 ); // name of cart , id , how many times

        return  redirect()->back()->cookie($cookie);
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

    public function  getFromCookieOrCreate()
    {
        $cartId =  Cookie::get('cart');

        $cart = Cart::find($cartId);

        return  $cart ?? Cart::create();
    }
}
