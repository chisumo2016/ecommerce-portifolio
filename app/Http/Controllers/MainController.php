<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public  function  index()
    {
        //DB::connection()->enableQueryLog(); //loading eager
        //$products= Product::available()->get();  //local scope in product model

       // $products = Product::with('images')->get();
        $products = Product::all();

        return view('welcome')->with([
            'products' => $products,
            //'products' => Product::all(),
        ]);
    }
}

//$products = Product::where('status', 'available')->get();
