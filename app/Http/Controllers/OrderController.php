<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\CartService;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public  $cartService;

    public  function  __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = $this->cartService->getFromCookie();
        if (!isset($cart) ||  $cart->products->isEmpty()){
            return  redirect()->back()->withErrors('Yoour cart is Empy');
        }
        return  view('orders.create')->with([
            'cart'=>$cart,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user =  $request->user();
        $order =$user->orders()->create([ // we use the query builder
            'status'  => 'pending',
        ]);

        $cart = $this->cartService->getFromCookie();
        $cartProductsWithQuantity = $cart
                ->products
                ->mapwithKeys(function ($product){
                    $element[$product->id] = ['quantity' => $product->pivot->quantity] ;

                    return $element;
                });

        //dd($cartProductsWithQuantity);

        //obtaine d the list of product and attach the order
        $order->products()->attach($cartProductsWithQuantity->toArray());

        //return the response
    }


}
