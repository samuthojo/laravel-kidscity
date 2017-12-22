<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Orders extends Controller
{
    public function cmsIndex()
    {
      $orders = App\Order::all()->map(function ($myOrder) {
        $order = $myOrder;
        $order->customer_name = $order->user()->first()->name;
        $order->customer_contact = $order->user()->first()->phone_number;
        $order->num_items = $order->orderItems()->count();
        $order->amount = $this->getAmount($myOrder);

        return $order;
      });

      return view('cms.orders', compact('orders'));
    }

    private function getAmount($order)
    {
      $amount = 0;
      foreach ($order->orderItems()->get() as $orderItem) {
        $price = $orderItem->product()->first()->price;
        $amount += $price * $orderItem->quantity;
      }
      return $amount + $order->deliveryLocation()->first()->delivery_price;
    }
}
