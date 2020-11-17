<?php

namespace App;

use App\Image;
use App\Cart;
use App\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'price','stock','status'
    ];

    public  function  carts()
    {
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');  // m-m via polymorphic
        //return $this->belongsToMany(Cart::class)->withPivot('quantity'); //m-m
    }


    public  function  orders()
    {
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
        //return $this->belongsToMany(Order::class)->withPivot('quantity'); //m-m
    }

    public  function  images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

  //scope
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }



}
