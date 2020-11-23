<?php

namespace App;

use App\Image;
use App\Cart;
use App\Order;
use App\Scopes\AvailableScope;
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new AvailableScope());
    }


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


    /**
     * Get the total of prodyct.
     *
     * @return number
     */
    public function  getTotalAttribute()
    {
         return $this->price * $this->pivot->quantity;
    }



}
