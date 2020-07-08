<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public  function  index()
    {
        return 'This is the list of products';
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
        return "Showing product {$product}";
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
