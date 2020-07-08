<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public  function  index()
    {
        return view('products.index');
    }

    public  function  create()
    {
        return 'A form to create a product';
    }

    public  function  store()
    {
        //
    }

    public  function show($product)
    {
        return view('products.show');
    }

    public  function  edit($product)
    {
        return "Showing the form to edit the  {$product}";
    }

    public  function  update($product)
    {
        return "Showing the form to edit the  {$product}";
    }

    public  function  destroy($product)
    {

    }
}
