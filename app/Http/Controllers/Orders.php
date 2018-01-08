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
        $order->delivery_location = $myOrder->deliveryLocation()->first()->location;
        $order->delivery_price = $myOrder->deliveryLocation()->first()->delivery_price;

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

    public function items(App\Order $order)
    {
      $items = $order->orderItems()
                     ->get()->map( function($it) {
                       $item = $it;
                       $product = $item->product()->first();

                       $item->name = $product->name;
                       $item->category = $product->category()->first()->name;
                       $item->price = $product->price;
                       $item->totalPrice = $product->price * $it->quantity;

                       return $item;
                     });
       $order = $this->getMappedOrder($order);
       return view('cms.order_items', compact('items', 'order'));
    }

    private function getMappedOrder($order)
    {
        $order->customer_name = $order->user()->first()->name;
        $order->customer_contact = $order->user()->first()->phone_number;
        $order->num_items = $order->orderItems()->count();
        $order->amount = $this->getAmount($order);
        $order->delivery_location = $order->deliveryLocation()->first()->location;
        $order->delivery_price = $order->deliveryLocation()->first()->delivery_price;

        return $order;
    }
}
