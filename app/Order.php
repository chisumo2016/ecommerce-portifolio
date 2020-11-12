<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

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
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }



}
