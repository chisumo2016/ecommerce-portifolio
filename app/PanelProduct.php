<?php

namespace App;

use App\Product;
use App\Scopes\AvailableScope;

class PanelProduct extends Product
{
    //protected  $table = 'products';
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        //static::addGlobalScope(new AvailableScope());
    }
}
