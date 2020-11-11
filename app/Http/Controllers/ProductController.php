<?php

namespace App\Http\Controllers;

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

    public  function  store()
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required','min:1'],
            'stock' => ['required','min:0'],
            'status' => ['required','in:available, unavailable'],

        ];

        request()->validate($rules);


        if (request()->stock == 0 && request()->status == 'available'){
            session()->flash('error', 'If available must have stock');
            //session()->put('error', 'If available must have stock');
            //return  redirect()->back()->withInput(request()->all());
            return  redirect()->back()->withInput(request()->all())
                ->withErrors('If available must have stock');
        }

        //session()->forget('error');
        $product = Product::create(request()->all());

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

    public  function  update(Product  $product)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required','min:1'],
            'stock' => ['required','min:0'],
            'status' => ['required','in:available, unavailable'],

        ];

        request()->validate($rules);


        //$product =Product::findOrFail($product);
        $product->update(request()->all());

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
