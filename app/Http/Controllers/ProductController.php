<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public  function  index()
    {
        $products = Product::all();

        return view('products.index')->with([
            'products' => $products,
        ]);
    }

    public  function  create()
    {
        return view('products.create');
    }

    public  function  store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        //session()->flash('success',"New Product with id {$product->id} was created");

        return redirect()->route('products.index')
                        ->withSuccess("New Product with id {$product->id} was created");
    }

    public  function show(Product  $product)
    {
        //$product =Product::findOrFail($product);

        return view('products.show')->with([
            'product' => $product,

        ]);
    }

    public  function  edit($product)
    {
        return view('products.edit')->with([
            'product' => Product::findOrFail($product),
        ]);
    }

    public  function  update(ProductRequest $request  ,Product  $product)
    {

        //$product =Product::findOrFail($product);
        $product->update($request->validated());

        return redirect()->route('products.index')
                        ->withSuccess("The Product with id {$product->id} was updated");

        // redirect  redirect()->back();  redirect()->route('products.index'); redirect()->action('ProductController@index');
        //return $product;
    }

    public  function  destroy(Product  $product)
    {
        //$product =Product::findOrFail($product);
        $product->delete();

        return redirect()->route('products.index')
            ->withSuccess("The Product with id {$product->id} was removed");

    }
}


/*
 * request()->validate($rules);
 *   $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required','min:1'],
            'stock' => ['required','min:0'],
            'status' => ['required','in:available, unavailable'],

        ];
 */
