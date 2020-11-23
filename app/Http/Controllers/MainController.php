<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public  function  index()
    {
        $products= Product::available()->get();  //local scope in product model

        return view('welcome')->with([
            'products' => $products,
            //'products' => Product::all(),
        ]);
    }
}

//$products = Product::where('status', 'available')->get();
