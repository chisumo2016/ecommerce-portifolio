<?php

namespace App\Http\Controllers;

use App\Order;
use App\Services\CartService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
       return  DB::transaction(function () use($request) {
            $user =  $request->user();
            $order =$user->orders()->create([ // we use the query builder
                'status'  => 'pending',
            ]);

            $cart = $this->cartService->getFromCookie();
            $cartProductsWithQuantity = $cart
                ->products
                ->mapwithKeys(function ($product){
                    $quantity =  $product->pivot->quantity;

                    if ($product->stock < $quantity){
                        throw  validationException::withMessages([
                            'cart' => "There  is not enough stock for the quantity you required of { $product->title}"
                        ]);
                    }
                    //reduce the stock available for that product
                    $product->decrement('stock', $quantity);
                    $element[$product->id] = ['quantity' => $quantity] ;
                    //$element[$product->id] = ['quantity' => $product->pivot->quantity] ;

                    return $element;
                });

            //dd($cartProductsWithQuantity);

            //obtaine d the list of product and attach the order
            $order->products()->attach($cartProductsWithQuantity->toArray());

            //return the response

            return redirect()->route('orders.payments.create', ['order'=> $order->id]);
        }, 5);
    }
}
