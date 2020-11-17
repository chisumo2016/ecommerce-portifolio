<?php

namespace   Database\seeders;

use App\Cart;
use App\Image;
use App\Order;
use App\Payment;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Creating an Image for specific user
        $users = User::factory(20)
            ->create()
            ->each(function ($user) {
                $image = Image::factory()
                    ->user()
                    ->make();

                // Attaching the image to  specic user
                $user->image()->save($image);
            });

        $orders = Order::factory(10)
            ->make()
            ->each(function ($order) use($users) {
                $order->customer_id = $users->random()->id;
                $order->save();

                $payment = Payment::factory()->make();

                // $payment->order_id = $order->id;
                // $payment->save();

                $order->payment()->save($payment);
            });

        //Create a Cart
        $carts = Cart::factory(20)->create(); //stored in db directely

        //Create a produce  and loop over
        $products = Product::factory(50)
            ->create()
            ->each(function ($product) use($orders, $carts) {  // we're going to use the definition of the cart and orders

                //attach to random order and carts
                $order = $orders->random(); //orders is set of collection
                $order->products()->attach([
                    $product->id => ['quantity' => mt_rand(1, 3)]
                ]);

                $cart = $carts->random();
                $cart->products()->attach([
                    $product->id => ['quantity' => mt_rand(1, 3)]
                ]);

                //create a set of  image
                $images = Image::factory(mt_rand(2, 4))->make();
                $product->images()->saveMany($images);  //save the collection
            });

    }
}

/**

$products   = factory(Product::class, 50)->create(); //factory(App\Product::class, 50)->create();

$users      = factory(User::class, 20)->create(); //$users = User::factory(20)->create();

$orders     = factory(Order::class, 10) //$orders = Order::factory(10)
->make()
->each(function ($order) use ($users){
//associate oreder to one user
$order->customer_id  = $users->random()->id;
$order->save();

//assocaite new payment - one payment with each

$payment = factory(Payment::class)->make();     // $payment = Payment::factory()->make();
$order->payment()->save($payment);
//$payment->order_id  = $order->id;
//$payment->save();


}) ;
 */
