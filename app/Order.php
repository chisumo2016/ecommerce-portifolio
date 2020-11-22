<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'customer_id',

    ];

    public  function  payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function  user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

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
        return $this->products->pluck('total')->sum();
    }



}
