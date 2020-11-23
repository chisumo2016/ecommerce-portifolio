<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\PanelProduct;
use App\Scopes\AvailableScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


    public  function  index()
    {
        //$products = Product::all();
        //$products = Product::withoutGlobalScope(AvailableScope::class)->get();
        $products = PanelProduct::without('images')->get();
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
        //$product = Product::create($request->validated());
        $product = PanelProduct::create($request->validated());

        //session()->flash('success',"New Product with id {$product->id} was created");

        return redirect()->route('products.index')
                        ->withSuccess("New Product with id {$product->id} was created");
    }

    public  function show(PanelProduct  $product)
    {
        //$product =Product::findOrFail($product);

        return view('products.show')->with([
            'product' => $product,

        ]);
    }

    public  function  edit(PanelProduct  $product)
    {
        return view('products.edit')->with([
            'product' => $product
            //'product' => Product::findOrFail($product),
        ]);
    }

    public  function  update(ProductRequest $request  ,PanelProduct  $product)
    {

        //$product =Product::findOrFail($product);
        $product->update($request->validated());

        return redirect()->route('products.index')
                        ->withSuccess("The Product with id {$product->id} was updated");

        // redirect  redirect()->back();  redirect()->route('products.index'); redirect()->action('ProductController@index');
        //return $product;
    }

    public  function  destroy(PanelProduct $product)
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
