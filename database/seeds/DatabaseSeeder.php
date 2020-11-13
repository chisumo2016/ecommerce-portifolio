<?php

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

        $products   = factory(Product::class, 50)->create();
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
        //factory(App\Product::class, 50)->create();
    }
}
