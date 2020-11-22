<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public  function  products()
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
        //return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    /**
     * Get the total of cart.
     *
     * @return number
     */
    public function  getTotalAttribute()
    {
        return $this->products->pluck('total')->sum(); //collection
    }
}
